# 📝 Git Commit Message Template

Template pesan commit yang bagus untuk project ini.

---

## 🎯 Commit Message Format

```
<type>(<scope>): <subject>

<body>

<footer>
```

### Type (Required)

- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation changes
- `style`: Code style (formatting, no logic change)
- `refactor`: Code refactoring
- `perf`: Performance improvements
- `test`: Adding tests
- `chore`: Maintenance tasks
- `build`: Build system changes

### Scope (Optional)

- `auth`: Authentication
- `cart`: Shopping cart
- `checkout`: Checkout process
- `payment`: Payment integration
- `admin`: Admin panel
- `user`: User features
- `ui`: User interface
- `api`: API changes

### Examples

#### Good Commit Messages ✅

```
feat(checkout): Add multi-step checkout flow with address

- Implement 4-step checkout: Cart → Address → Review → Payment
- Add address validation and session storage
- Update checkout controller with new methods
- Create address.blade.php and review.blade.php views

Closes #123
```

```
fix(payment): Fix decimal price issue with Midtrans

- Cast all prices to integer for Midtrans API
- Remove decimal places from tax calculation
- Limit product name to 50 characters
- Test payment with newly added products

Fixes #456
```

```
docs: Add comprehensive installation guide

- Create INSTALLATION_GUIDE.md with step-by-step setup
- Add QUICK_START.md for 5-minute setup
- Update README.md with new documentation links
- Add SETUP_CHECKLIST.md for verification
```

#### Bad Commit Messages ❌

```
Update files
Fix bug
Changes
WIP
asdfasdf
```

---

## 🚀 Suggested Commit for This Release

```bash
git add .
git commit -m "feat: Add user profile page and comprehensive documentation

Features Added:
- User profile page with 3 tabs (Info, Address, Security)
- Profile management (edit name, email, phone)
- Address management (edit shipping address)
- Password change functionality
- Alpine.js tabs for better UX

Documentation Added:
- INSTALLATION_GUIDE.md - Complete setup instructions
- QUICK_START.md - 5-minute quick start
- SETUP_CHECKLIST.md - Verification checklist
- CHECKOUT_FLOW_DIAGRAM.md - Visual checkout flow
- DOCS_INDEX.md - Documentation index
- CONTRIBUTING.md - Contribution guidelines
- Updated README.md with badges and structure
- Updated .env.example with comments
- Updated .gitignore for SQLite database

Routes Added:
- GET  /user/profile
- PUT  /user/profile
- PUT  /user/address
- PUT  /user/password

Files Modified:
- app/Http/Controllers/UserController.php
- resources/views/user/profile.blade.php
- resources/views/partials/navbar.blade.php
- routes/web.php
- .gitignore
- .env.example
- README.md

This release provides complete documentation for new contributors
to clone and setup the project from GitHub."

git push origin test_fe
```

---

## 📋 Pre-Commit Checklist

Before committing:

- [ ] Code tested locally
- [ ] No syntax errors
- [ ] Laravel logs are clean
- [ ] Browser console has no errors
- [ ] `.env` not included in commit
- [ ] Database files not included
- [ ] Documentation updated if needed
- [ ] Commit message is clear and descriptive

---

## 🌿 Branch Naming

### Feature Branch

```bash
git checkout -b feature/user-profile
git checkout -b feature/payment-integration
```

### Bug Fix Branch

```bash
git checkout -b fix/cart-quantity-bug
git checkout -b fix/midtrans-ssl-error
```

### Documentation Branch

```bash
git checkout -b docs/installation-guide
git checkout -b docs/api-documentation
```

---

## 📦 Release Workflow

### 1. Create Feature Branch

```bash
git checkout -b feature/new-feature
```

### 2. Make Changes & Commit

```bash
git add .
git commit -m "feat(scope): description"
```

### 3. Push to GitHub

```bash
git push origin feature/new-feature
```

### 4. Create Pull Request

- Go to GitHub
- Click "Compare & Pull Request"
- Fill in description
- Request review (if team project)
- Merge when approved

### 5. Sync Main Branch

```bash
git checkout main
git pull origin main
```

---

## 🔄 Syncing Fork (Jika Fork dari Orang Lain)

```bash
# Add upstream remote
git remote add upstream https://github.com/ORIGINAL_OWNER/Tugas-Besar-PBP.git

# Fetch upstream changes
git fetch upstream

# Merge upstream changes
git checkout test_fe
git merge upstream/test_fe

# Push to your fork
git push origin test_fe
```

---

## 🏷️ Tagging Releases

```bash
# Create tag
git tag -a v1.0.0 -m "Release version 1.0.0"

# Push tag
git push origin v1.0.0

# List tags
git tag -l
```

---

## 📝 Commit Message Tips

### DO ✅

- Use imperative mood: "Add feature" not "Added feature"
- Be specific and descriptive
- Reference issue numbers
- Explain WHY, not just WHAT
- Keep subject line under 50 characters
- Use body for detailed explanation

### DON'T ❌

- Don't commit WIP (work in progress)
- Don't commit broken code
- Don't commit directly to main (use branches)
- Don't include sensitive data (keys, passwords)
- Don't make huge commits (break into smaller ones)

---

## 🔍 Useful Git Commands

```bash
# Check status
git status

# View changes
git diff

# View commit history
git log --oneline --graph

# Undo last commit (keep changes)
git reset --soft HEAD~1

# Undo last commit (discard changes)
git reset --hard HEAD~1

# Amend last commit message
git commit --amend -m "New message"

# View remote URLs
git remote -v

# Stash changes temporarily
git stash
git stash pop

# Discard local changes
git checkout -- filename
git reset --hard HEAD
```

---

**Happy Committing! 🎉**
