<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class CartPage extends Component
{
    public $cart = null;
    public $items = [];
    public $selectedItems = [];
    public $subtotal = 0;
    public $tax = 0;
    public $total = 0;
    public $taxPercent = 10;

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->loadCart();
    }

    public function loadCart()
    {
        try {
            $this->cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            $cartItems = $this->cart->items()
                ->with('product')
                ->get();

            $this->items = $cartItems && count($cartItems) > 0 ? $cartItems->toArray() : [];
            $this->updateTotal();
        } catch (\Exception $e) {
            $this->items = [];
            \Log::error('CartPage - Load Cart Error: ' . $e->getMessage());
        }
    }

    public function toggleSelect($itemId)
    {
        if (!is_numeric($itemId)) {
            return;
        }

        $key = array_search($itemId, $this->selectedItems, true);

        if ($key !== false) {
            unset($this->selectedItems[$key]);
            $this->selectedItems = array_values($this->selectedItems);
        } else {
            $this->selectedItems[] = $itemId;
        }

        $this->updateTotal();
    }

    public function selectAll()
    {
        if (!is_array($this->items) || count($this->items) === 0) {
            return;
        }

        $itemIds = array_column($this->items, 'id');

        if (count($this->selectedItems) === count($itemIds)) {
            $this->selectedItems = [];
        } else {
            $this->selectedItems = $itemIds;
        }

        $this->updateTotal();
    }

    public function incrementQty($itemId)
    {
        if (!is_numeric($itemId)) {
            return;
        }

        try {
            $item = CartItem::with('product')->find($itemId);

            if (!$item) {
                return;
            }

            if ($item->product->stock > $item->qty) {
                $item->increment('qty');
                $this->loadCart();
            }
        } catch (\Exception $e) {
            \Log::error('CartPage - Increment Qty Error: ' . $e->getMessage());
        }
    }

    public function decrementQty($itemId)
    {
        if (!is_numeric($itemId)) {
            return;
        }

        try {
            $item = CartItem::find($itemId);

            if (!$item) {
                return;
            }

            if ($item->qty > 1) {
                $item->decrement('qty');
                $this->loadCart();
            } else {
                $item->delete();
                $key = array_search($itemId, $this->selectedItems, true);
                if ($key !== false) {
                    unset($this->selectedItems[$key]);
                    $this->selectedItems = array_values($this->selectedItems);
                }
                $this->loadCart();
            }
        } catch (\Exception $e) {
            \Log::error('CartPage - Decrement Qty Error: ' . $e->getMessage());
        }
    }

    public function removeItem($itemId)
    {
        if (!is_numeric($itemId)) {
            return;
        }

        try {
            $item = CartItem::find($itemId);

            if (!$item) {
                return;
            }

            $item->delete();

            $key = array_search($itemId, $this->selectedItems, true);
            if ($key !== false) {
                unset($this->selectedItems[$key]);
                $this->selectedItems = array_values($this->selectedItems);
            }

            $this->loadCart();
        } catch (\Exception $e) {
            \Log::error('CartPage - Remove Item Error: ' . $e->getMessage());
        }
    }

    public function updateTotal()
    {
        $this->subtotal = 0;

        if (is_array($this->items) && count($this->items) > 0) {
            foreach ($this->items as $item) {
                if (in_array($item['id'], $this->selectedItems, true)) {
                    $price = (int)($item['product']['price'] ?? 0);
                    $qty = (int)($item['qty'] ?? 1);
                    $this->subtotal += $price * $qty;
                }
            }
        }

        $this->tax = round($this->subtotal * ($this->taxPercent / 100), 2);
        $this->total = $this->subtotal + $this->tax;
    }

    public function checkout()
    {
        if (empty($this->selectedItems) || !is_array($this->selectedItems)) {
            return;
        }

        if ($this->total <= 0) {
            return;
        }

        session()->put('checkout_items', $this->selectedItems);

        return redirect()->route('checkout.show');
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
