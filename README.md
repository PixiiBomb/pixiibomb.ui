<div align="center">

# PixiiBomb UI

**Shared foundations for the PixiiBomb Laravel package ecosystem.**

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pixiibomb/ui?label=version)](https://packagist.org/packages/pixiibomb/ui)
[![Total Downloads](https://img.shields.io/packagist/dt/pixiibomb/ui?label=downloads)](https://packagist.org/packages/pixiibomb/ui/stats)
[![Monthly Downloads](https://img.shields.io/packagist/dm/pixiibomb/ui?label=monthly%20downloads)](https://packagist.org/packages/pixiibomb/ui/stats)
[![PHP Version](https://img.shields.io/packagist/dependency-v/pixiibomb/core/php?label=PHP)](https://packagist.org/packages/pixiibomb/core)
[![License](https://img.shields.io/packagist/l/pixiibomb/ui)](https://packagist.org/packages/pixiibomb/ui)
[![GitHub Stars](https://img.shields.io/github/stars/PixiiBomb/pixiibomb.ui?style=flat)](https://github.com/PixiiBomb/pixiibomb.ui/stargazers)
[![Last Commit](https://img.shields.io/github/last-commit/PixiiBomb/pixiibomb.ui)](https://github.com/PixiiBomb/pixiibomb.ui/commits/master/)

[Packagist](https://packagist.org/packages/pixiibomb/core) · [Source Code](https://github.com/PixiiBomb/pixiibomb.core) · [Report an Issue](https://github.com/PixiiBomb/pixiibomb.core/issues)

</div>

---

## About

**PixiiBomb Core** is the foundational package in the PixiiBomb ecosystem. It is intended to provide shared functionality that other PixiiBomb packages can build upon.

The packages are maintained separately so applications can install only the functionality they need.

| Package | Purpose |
| --- | --- |
| **`pixiibomb/core`** | Shared foundation |
| `pixiibomb/api` | API-related functionality |
| `pixiibomb/ui` | User interface functionality |

> API and UI are separate packages. Their availability and dependencies may change as development progresses.

## Requirements

- PHP **8.4 or newer**, within the Composer constraint `^8.4`
- A compatible Laravel application when using Laravel-specific functionality

## Installation

Install the package with Composer:

```bash
composer require pixiibomb/core
```

**Development version:** Until a stable version is tagged, explicitly install the development branch:

```bash
composer require "pixiibomb/core:dev-master"
```

The package declares its Laravel service provider for automatic discovery:

```php
PixiiBomb\Core\PixiiBombCoreServiceProvider::class
```

No manual provider registration is normally needed when Laravel package discovery is enabled.

## Development

Clone the repository:

```bash
git clone https://github.com/PixiiBomb/pixiibomb.core.git
cd pixiibomb.core
composer install
```

For local development alongside a Laravel application, you can use a Composer path repository in the **application's** `composer.json`:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "packages/pixiibomb/*",
            "options": {
                "symlink": true
            }
        }
    ]
}
```

The path must match your local project structure.

## Releases

Published versions and download statistics are available on [Packagist](https://packagist.org/packages/pixiibomb/core).

## Issues and Contributions

Found a bug or have a suggestion? [Open an issue](https://github.com/PixiiBomb/pixiibomb.core/issues).

## License

This package is currently marked **proprietary** in `composer.json`. Refer to the repository owner for permissions regarding reuse, modification, and redistribution.
