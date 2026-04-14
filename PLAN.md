# Comet Theme Modernization Plan

> Recreating the Comet WordPress theme (originally by Frostpress, v1.4.2, WP 3.x era) with identical aesthetics but modern internals: TailwindCSS, WordPress 6.x compatibility, PHP 8.5 support.

---

## Current State Assessment

| Area | Status |
|------|--------|
| **WordPress compat** | Targets WP 4.4+, crashes on WP 6.x Customizer (`_WP_Editors::enqueue_default_editor()` fatal) |
| **PHP compat** | Uses patterns removed/deprecated in PHP 8.x (`$user_ID` global, uninitialized vars, no nonce checks) |
| **CSS** | 901-line monolithic `style.css` + 7 color scheme files + `print.css` + `rtl.css` + `ie.css`, fixed 960px, zero responsive |
| **JS** | Only `comment-reply` script, no build pipeline |
| **HTML** | XHTML 1.0 Transitional doctype, no viewport meta |
| **Theme Options** | Legacy admin page with raw `$_POST`, no nonces, no sanitization, stored in `fp_options` |
| **Security** | XSS in footer output, CSRF in options save, unsanitized inputs |

### Error Log Analysis

1. **`_WP_Editors::enqueue_default_editor()` fatal** - This is a WordPress core bug/regression in WP 6.x where the text widget tries to enqueue the classic editor on the Customizer page. The theme itself isn't directly causing this, but we need to ensure our theme doesn't trigger or worsen it. Removing the legacy theme options page and migrating to Customizer API properly will help.
2. **`Primary script unknown`** - Bot probing `/config/aws_settings.php` (not theme-related, ignore).

---

## Phase 1: Foundation & Build Pipeline

### 1.1 Add build tooling
- [ ] Create `package.json` with TailwindCSS v4, PostCSS, and build scripts
- [ ] Create `tailwind.config.js` matching the current design tokens (colors, fonts, spacing)
- [ ] Create `postcss.config.js`
- [ ] Create `src/css/main.css` as the TailwindCSS entry point with `@tailwind` directives
- [ ] Add `.gitignore` entries for `node_modules/`
- [ ] Add build script: `npm run build` (production) and `npm run dev` (watch mode)

### 1.2 Design token mapping (current CSS -> Tailwind config)

```
Colors:
  background:    #E5E5E5 (page bg)
  surface:       #FFFFFF (content bg)
  text:          #333333 (body text)
  text-light:    #666666 (meta/secondary)
  link:          #3172A6
  link-hover:    #5F9CCF
  border:        #CCCCCC (dotted borders)
  border-dark:   #999999

  Color schemes (accent overrides):
    grey:   { link: #D03B09, hover: #E6876A, accent: #BFBFBF, top: #999999 }
    red:    { link: #D03B09, hover: #E6876A, accent: #CC3300, top: #CC3300 }
    blue:   { link: #D03B09, hover: #E6876A, accent: #003366, top: #003366 }
    green:  { link: #D03B09, hover: #E6876A, accent: #006633, top: #006633 }
    yellow: { link: #D03B09, hover: #E6876A, accent: #CC9900, top: #CC9900 }
    teal:   { link: #D03B09, hover: #E6876A, accent: #336666, top: #336666 }
    purple: { link: #D03B09, hover: #E6876A, accent: #330066, top: #330066 }

Typography:
  body:     Georgia, Cambria, serif (16px)
  heading:  'Droid Sans', sans-serif
  h2:       Georgia italic
  ui:       Verdana, Tahoma, Helvetica, sans-serif
  mono:     'Courier New', monospace

Layout:
  max-width: 960px (fixed, will keep but add responsive breakpoints)
  sidebar:   ~200px
  content:   remaining space
```

---

## Phase 2: PHP Modernization & WP 6.x Compatibility

### 2.1 Fix PHP 8.5 incompatibilities
- [ ] **functions.php**: Remove `stripslashes()` calls (magic quotes gone since PHP 5.4)
- [ ] **functions.php**: Add proper input sanitization (`sanitize_text_field()`, `wp_kses_post()`)
- [ ] **functions.php**: Add nonce verification to `themeoptions_update()`
- [ ] **functions.php**: Fix `register_sidebars()` call (incorrect syntax - passing 2 arrays as single arg)
- [ ] **functions.php**: Replace `bloginfo('template_directory')` with `get_template_directory_uri()` (8 occurrences)
- [ ] **comments.php**: Replace `global $user_ID` with `get_current_user_id()`
- [ ] **comments.php**: Replace `$user_identity` with `wp_get_current_user()->display_name`
- [ ] **comments.php**: Add `global $post` declaration where missing
- [ ] **comments.php**: Remove legacy WP < 3.0 comment form fallback (lines 60-120), use only `comment_form()`
- [ ] **All files**: Ensure no undefined variable access (PHP 8 strict)

### 2.2 Fix WordPress 6.x compatibility
- [ ] **header.php**: Replace `wp_title()` with `add_theme_support('title-tag')` in `comet_setup()`
- [ ] **header.php**: Change DOCTYPE to `<!DOCTYPE html>`
- [ ] **header.php**: Add `<meta name="viewport" content="width=device-width, initial-scale=1">`
- [ ] **header.php**: Remove `profile="http://gmpg.org/xfn/11"` from `<head>`
- [ ] **header.php**: Move inline styles to properly enqueued stylesheet
- [ ] **functions.php**: Add `add_theme_support('html5', [...])` for modern markup
- [ ] **functions.php**: Add `add_theme_support('custom-logo')` replacing manual logo option
- [ ] **functions.php**: Add `add_theme_support('customize-selective-refresh-widgets')`
- [ ] **functions.php**: Add `add_theme_support('wp-block-styles')` for Gutenberg compatibility
- [ ] **functions.php**: Add `add_theme_support('responsive-embeds')`
- [ ] **functions.php**: Add `add_theme_support('editor-styles')` + `add_editor_style()`
- [ ] **functions.php**: Properly enqueue all styles via `wp_enqueue_scripts` hook
- [ ] **functions.php**: Fix `register_sidebars()` -> two separate `register_sidebar()` calls with proper args (before_widget, after_widget, before_title, after_title)
- [ ] **index.php**: Fix HTML syntax error at line 49 (missing `>` on `<div class="print-view"`)
- [ ] **attachment.php**: Replace `get_children()` with `get_posts()`
- [ ] **sidebar-left.php**: Remove `wp_list_bookmarks()` fallback (bookmarks feature removed)

### 2.3 Migrate Theme Options to Customizer API
- [ ] Create `inc/customizer.php` with sections:
  - **Colors**: Color scheme picker (grey/red/yellow/green/teal/blue/purple) with live preview
  - **Layout**: Sidebar layout picker (right/left/both/none) with live preview
  - **Typography**: Font family and size selectors with live preview
  - **Footer**: Custom footer text with live preview
  - **Custom CSS**: Use WordPress core Additional CSS (built-in, no custom needed)
- [ ] Remove old `themeoptions_admin_menu()`, `themeoptions_page()`, `themeoptions_update()` functions
- [ ] Migrate existing `fp_options` data to `theme_mods` on theme activation (one-time migration)
- [ ] Use `custom-logo` theme support instead of manual logo URL field
- [ ] Remove logo position option (use standard WordPress custom logo positioning)

---

## Phase 3: TailwindCSS Conversion

### 3.1 Strategy
The goal is **pixel-perfect visual parity** with the original theme. We will:
1. Map every CSS rule in `style.css` to equivalent Tailwind utilities
2. Use `@apply` sparingly for WordPress-generated markup we can't add classes to (e.g., widget output, comment lists)
3. Use CSS custom properties for the color scheme system
4. Keep the same 960px max-width but add responsive behavior below that

### 3.2 Convert templates to Tailwind classes
- [ ] **header.php**: Convert navigation, logo area, site title/description
- [ ] **footer.php**: Convert footer layout and styling
- [ ] **index.php**: Convert post listing, thumbnails, metadata, excerpts
- [ ] **page.php**: Convert page/single post template
- [ ] **wide.php**: Convert wide (no-sidebar) template
- [ ] **404.php**: Convert error page
- [ ] **attachment.php**: Convert attachment template
- [ ] **comments.php**: Convert comment list and form styling
- [ ] **sidebar-left.php** & **sidebar-right.php**: Convert widget area styling

### 3.3 Handle WordPress-generated markup
WordPress outputs HTML we can't directly modify (widgets, comment walker, navigation). For these:
- [ ] Create `src/css/components/wordpress.css` with `@apply`-based rules targeting WP classes
- [ ] Style `.widget`, `.widget-title`, `.widget ul`, `.widget li` etc.
- [ ] Style `.comment-list`, `.comment-body`, `.comment-meta`, `.reply` etc.
- [ ] Style `.navigation`, `.nav-links`, `.page-numbers` etc.
- [ ] Style `.wp-block-*` classes for Gutenberg block output
- [ ] Style `.gallery`, `.gallery-item`, `.gallery-caption` etc.

### 3.4 Color scheme system
- [ ] Define CSS custom properties in `:root` for the default scheme
- [ ] Create `body.scheme-{color}` overrides for each of the 7 schemes
- [ ] Apply color scheme class to `<body>` via `body_class` filter in functions.php
- [ ] Remove the 7 separate `_color.css` files (replaced by CSS custom properties)

### 3.5 Remove legacy CSS files
- [ ] Delete `style.css` content (keep header only, as required by WordPress)
- [ ] Delete `ie.css` (IE7 support no longer needed)
- [ ] Delete `_grey.css`, `_red.css`, `_blue.css`, `_green.css`, `_yellow.css`, `_teal.css`, `_purple.css`
- [ ] Convert `print.css` rules into Tailwind `@media print` in the main stylesheet
- [ ] Convert `rtl.css` rules into Tailwind `rtl:` variants

---

## Phase 4: Template Cleanup & Modernization

### 4.1 Semantic HTML5
- [ ] Replace `<div id="wrap">` with `<main>` or semantic container
- [ ] Use `<article>` for posts, `<aside>` for sidebars, `<nav>` for navigation
- [ ] Use `<header>` and `<footer>` elements
- [ ] Use `<figure>` and `<figcaption>` for images
- [ ] Add ARIA landmarks and skip-to-content link for accessibility
- [ ] Keep same visual structure: `#wrap` -> `#c1` (left) + `#c2` (content) + `#c3` (right)

### 4.2 Remove dead code
- [ ] Remove WP < 3.0 comment form fallback in `comments.php`
- [ ] Remove `back-compat.php` include check (WP 4.4 check, we now require WP 6.0+)
- [ ] Remove Unikia external logo/link in footer
- [ ] Remove hardcoded Spanish text in templates (use translation functions)
- [ ] Remove `fp_comments` and `fp_trackbacks` callback references (never defined)

### 4.3 Security hardening
- [ ] Escape all output with `esc_html()`, `esc_attr()`, `esc_url()`, `wp_kses_post()`
- [ ] Use `wp_nonce_field()` / `wp_verify_nonce()` for any form submissions
- [ ] Remove direct `$_POST` access without sanitization
- [ ] Add `wp_enqueue_script` with proper dependencies instead of inline scripts

---

## Phase 5: Responsive Design (Additive)

> The original theme is 960px fixed. We preserve that as the desktop view but add responsive behavior.

- [ ] Fluid layout below 960px (content takes full width)
- [ ] Sidebars stack below content on mobile (< 768px)
- [ ] Navigation becomes hamburger menu on mobile
- [ ] Typography scales appropriately
- [ ] Images are responsive (`max-width: 100%`, `height: auto`)
- [ ] Touch-friendly tap targets (min 44px)

---

## Phase 6: Quality & Testing

- [ ] Test all templates render correctly on WordPress 6.x
- [ ] Test Customizer preview works without crashes
- [ ] Test PHP 8.5 produces no warnings/errors/notices
- [ ] Verify visual parity with original design at desktop width
- [ ] Test responsive behavior at common breakpoints
- [ ] Test RTL layout
- [ ] Run Theme Check plugin
- [ ] Validate against WordPress theme requirements for directory submission
- [ ] Update `style.css` theme header (bump version, update tags, update WP requirement)
- [ ] Update `README.md`

---

## File Changes Summary

### New files
| File | Purpose |
|------|---------|
| `package.json` | npm deps (TailwindCSS, PostCSS) |
| `tailwind.config.js` | Design tokens config |
| `postcss.config.js` | PostCSS pipeline |
| `src/css/main.css` | TailwindCSS entry point |
| `src/css/components/wordpress.css` | Styles for WP-generated markup |
| `inc/customizer.php` | Customizer API settings |
| `.gitignore` | Ignore node_modules, build artifacts |

### Modified files
| File | Changes |
|------|---------|
| `functions.php` | Complete rewrite: proper enqueuing, customizer, theme supports, security, PHP 8.5 |
| `header.php` | HTML5 doctype, Tailwind classes, remove inline styles, semantic markup |
| `footer.php` | Tailwind classes, escaped output, remove external links |
| `index.php` | Fix syntax error, Tailwind classes, semantic HTML5 |
| `page.php` | Tailwind classes, semantic HTML5 |
| `wide.php` | Tailwind classes, semantic HTML5 |
| `404.php` | Tailwind classes |
| `attachment.php` | Replace `get_children()`, Tailwind classes |
| `comments.php` | Remove legacy form, fix PHP 8 vars, Tailwind classes |
| `sidebar-left.php` | Remove bookmarks fallback, Tailwind classes |
| `sidebar-right.php` | Tailwind classes |
| `style.css` | Keep theme header only, body compiled by Tailwind |
| `print.css` | Merge into main Tailwind build |
| `rtl.css` | Merge into Tailwind RTL variants |

### Deleted files
| File | Reason |
|------|--------|
| `ie.css` | IE7 support unnecessary |
| `_grey.css` | Replaced by CSS custom properties |
| `_red.css` | Replaced by CSS custom properties |
| `_blue.css` | Replaced by CSS custom properties |
| `_green.css` | Replaced by CSS custom properties |
| `_yellow.css` | Replaced by CSS custom properties |
| `_teal.css` | Replaced by CSS custom properties |
| `_purple.css` | Replaced by CSS custom properties |

---

## Execution Order

```
Phase 1 (Foundation)     -> Can start immediately
Phase 2 (PHP/WP compat)  -> Can start in parallel with Phase 1
Phase 3 (TailwindCSS)    -> Requires Phase 1 complete
Phase 4 (Templates)      -> Do alongside Phase 3
Phase 5 (Responsive)     -> After Phase 3
Phase 6 (Testing)        -> After all phases
```

Estimated scope: ~15-20 files touched, ~2000 lines rewritten.
