# 🤝 Contributing to KlikMart

Terima kasih sudah tertarik untuk berkontribusi! Project ini adalah Tugas Besar PBP.

---

## 🔀 Workflow

### 1. Fork & Clone

```bash
# Fork repository di GitHub, lalu:
git clone https://github.com/YOUR_USERNAME/Tugas-Besar-PBP.git
cd Tugas-Besar-PBP
```

### 2. Create Branch

```bash
# Buat branch baru untuk fitur
git checkout -b feature/nama-fitur

# atau untuk bug fix
git checkout -b fix/nama-bug
```

### 3. Make Changes

- Write clean code
- Follow Laravel best practices
- Test your changes
- Keep commits small and focused

### 4. Commit

```bash
git add .
git commit -m "feat: Add user notification feature"
```

**Commit Message Format:**

- `feat:` - New feature
- `fix:` - Bug fix
- `docs:` - Documentation changes
- `style:` - Code style changes (formatting)
- `refactor:` - Code refactoring
- `test:` - Adding tests
- `chore:` - Maintenance tasks

### 5. Push & Pull Request

```bash
git push origin feature/nama-fitur
```

Then create Pull Request di GitHub.

---

## 📝 Code Standards

### PHP/Laravel

- Follow PSR-12 coding standard
- Use type hints
- Add DocBlocks to methods
- Keep controllers thin
- Use form requests for validation

Example:

```php
/**
 * Store a new product
 *
 * @param StoreProductRequest $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function store(StoreProductRequest $request)
{
    $product = Product::create($request->validated());

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Product created successfully');
}
```

### Blade Templates

- Use components for reusable UI
- Keep logic minimal in views
- Use `@` directives properly

### JavaScript

- Use ES6+ syntax
- Keep Alpine.js usage simple
- Add comments for complex logic

### CSS (Tailwind)

- Use utility classes
- Follow mobile-first approach
- Keep custom CSS minimal

---

## 🧪 Testing

Before submitting PR:

### Manual Testing

- [ ] Test on fresh database
- [ ] Test user registration
- [ ] Test checkout flow
- [ ] Test admin features
- [ ] Test on mobile view
- [ ] Check browser console for errors
- [ ] Check Laravel logs for errors

### Code Quality

```bash
# Run Laravel Pint (code formatter)
./vendor/bin/pint

# Check for issues
php artisan route:list  # Verify routes
php artisan config:clear  # Clear caches
```

---

## 🔐 Security

- Never commit `.env` file
- Never commit API keys
- Never commit database files
- Use Laravel's built-in security features
- Validate all user inputs
- Sanitize outputs

---

## 📚 Documentation

When adding new features:

- Update README.md if needed
- Add comments in code
- Update INSTALLATION_GUIDE.md if setup changes
- Document new environment variables

---

## 🐛 Bug Reports

When reporting bugs, include:

- **Description**: What's the issue?
- **Steps to Reproduce**: How to trigger it?
- **Expected Behavior**: What should happen?
- **Actual Behavior**: What actually happens?
- **Environment**: PHP version, OS, browser
- **Screenshots**: If applicable
- **Logs**: From `storage/logs/laravel.log`

---

## 💡 Feature Requests

When suggesting features:

- Explain the use case
- Describe expected behavior
- Provide examples if possible
- Consider backward compatibility

---

## 📦 Pull Request Checklist

Before submitting PR:

- [ ] Code follows project standards
- [ ] Tested locally
- [ ] No breaking changes (or documented)
- [ ] Migrations included (if database changes)
- [ ] Documentation updated
- [ ] Commit messages are clear
- [ ] No merge conflicts
- [ ] `.env.example` updated (if new vars)

---

## 🎓 Project-Specific Guidelines

### Adding New Routes

```php
// In routes/web.php
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/your-route', [YourController::class, 'method'])
        ->name('your.route');
});
```

### Creating New Controllers

```bash
php artisan make:controller YourController
```

### Adding New Migrations

```bash
php artisan make:migration create_your_table
php artisan migrate
```

### Creating New Models

```bash
php artisan make:model YourModel -m  # with migration
```

---

## 🌟 Good First Issues

New to project? Try these:

- Fix typos in documentation
- Improve UI styling
- Add validation messages
- Enhance error handling
- Write tests

---

## 📞 Questions?

- Open an issue on GitHub
- Check existing documentation
- Review closed issues/PRs

---

**Thank you for contributing! 🎉**
