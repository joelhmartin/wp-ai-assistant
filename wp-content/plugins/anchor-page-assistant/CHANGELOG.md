# Anchor Page Assistant — Changelog

The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/) and the project adheres to [Semantic Versioning](https://semver.org/).

## [1.0.0] — 2026-04-28

First public release. Initial extraction from the `wp-ai-assistant` site repository into a standalone, distributable plugin.

### Added
- GitHub-based update flow via bundled `plugin-update-checker`. New releases on `joelhmartin/anchor-page-assistant` automatically surface in WordPress *Plugins → Update*.
- `ANCHOR_PAGE_ASSISTANT_GH_TOKEN` constant — define in `wp-config.php` to authenticate against a private repository.
- `Plugin URI` and `GitHub Plugin URI` headers in the main plugin file.

### Compatibility
- WordPress: requires 6.4 or later.
- PHP: requires 7.4 or later.
- Anchor Framework: works with 1.0.x.

## Pre-1.0 (internal)

The plugin existed at version 0.2.0 inside the `wp-ai-assistant` monorepo before extraction. That history is preserved in the GitHub repository and is not retroactively versioned.
