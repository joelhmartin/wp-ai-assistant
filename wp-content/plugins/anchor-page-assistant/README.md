# Anchor Page Assistant

AI-powered page builder and config manager for the [Anchor Framework](https://github.com/joelhmartin/anchor-framework) WordPress theme system. Provides an in-admin chat interface that helps you scaffold pages, generate section configs, and manage content.

## Requirements

- WordPress 6.4 or later.
- PHP 7.4 or later.
- The Anchor Framework parent theme, version 1.0.x.

## Install

1. Upload the latest release zip from [GitHub releases](https://github.com/joelhmartin/anchor-page-assistant/releases) via *Plugins → Add New → Upload Plugin*.
2. Activate.
3. Configure your AI provider credentials in *Anchor Assistant → Settings*.

Once installed, future updates surface as standard WP plugin update notifications.

## Updates

Bundled [plugin-update-checker](https://github.com/YahnisElsts/plugin-update-checker) checks the GitHub repo for new releases. For private-repo use, define `ANCHOR_PAGE_ASSISTANT_GH_TOKEN` in `wp-config.php` with a GitHub Personal Access Token that has `repo` scope.

## Coordination with Anchor Framework

The framework and the plugin version independently but ship together for major releases. Compatibility ranges are documented in each project's `CHANGELOG.md`. Mismatched versions trigger an admin notice rather than failing silently.

## License

GPL-2.0-or-later.
