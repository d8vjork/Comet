# Comet

Modernized WordPress classic theme based on the original Frostpress Comet design.

## What changed

- Legacy theme options were removed in favor of the WordPress Customizer.
- Front-end assets now live in `src/css` and build to `assets/css/theme.css`.
- The theme targets WordPress 6.x and modern PHP instead of the original WP 3.x-era internals.
- Layout, color scheme, typography, footer text, and logo are handled through core theme features and theme mods.

## Development

Install dependencies and build the stylesheet:

```bash
npm install
npm run build
```

For watch mode:

```bash
npm run dev
```

## Docker

Start a minimal WordPress test stack with Docker Compose:

```bash
docker compose up --build
```

Then open `http://localhost:8080` and complete the WordPress installer.

This repository is mounted directly into the container as `wp-content/themes/comet`, so local theme edits are reflected immediately. After installation, activate the `Comet` theme in `Appearance > Themes`.

To reset the test environment completely:

```bash
docker compose down -v
```

## Notes

- Additional CSS uses the built-in WordPress Customizer feature.
- The theme attempts a one-time migration from the legacy `fp_options` option to theme mods when activated or updated in place.
- The original design assets in `images/` are still used for visual continuity.

## License

Comet is released under the [GPL-3.0-or-later](LICENSE).
