# Releasing Anchor Page Assistant

Mirrors the [Anchor Framework release process](https://github.com/joelhmartin/anchor-framework/blob/main/RELEASING.md). The short version:

1. Bump `Version:` in `anchor-page-assistant.php` and the matching `APA_VERSION` constant.
2. Update `CHANGELOG.md`.
3. Update the framework compatibility range if it changed.
4. Commit, tag `vX.Y.Z`, push tags, create a GitHub release.

## Coordinating with Anchor Framework

When a release of this plugin requires a matching framework release:

1. Ship the framework first (its release flow is in its own repo).
2. Update this plugin's compatibility line in `CHANGELOG.md` to reference the new framework version.
3. Tag and release this plugin.

Independent fixes that don't touch the framework's API don't need a framework release.
