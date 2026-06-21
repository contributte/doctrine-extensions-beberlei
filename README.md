![](https://heatbadger.now.sh/github/readme/contributte/doctrine-extensions-beberlei/)

<p align=center>
  <a href="https://github.com/contributte/doctrine-extensions-beberlei/actions"><img src="https://badgen.net/github/checks/nettrine/extensions-beberlei/master?cache=300"></a>
  <a href="https://coveralls.io/r/nettrine/extensions-beberlei"><img src="https://badgen.net/coveralls/c/github/nettrine/extensions-beberlei?cache=300"></a>
  <a href="https://packagist.org/packages/nettrine/extensions-beberlei"><img src="https://badgen.net/packagist/dm/nettrine/extensions-beberlei"></a>
  <a href="https://packagist.org/packages/nettrine/extensions-beberlei"><img src="https://badgen.net/packagist/v/nettrine/extensions-beberlei"></a>
</p>
<p align=center>
  <a href="https://packagist.org/packages/nettrine/extensions-beberlei"><img src="https://badgen.net/packagist/php/nettrine/extensions-beberlei"></a>
  <a href="https://github.com/contributte/doctrine-extensions-beberlei"><img src="https://badgen.net/github/license/contributte/doctrine-extensions-beberlei"></a>
  <a href="https://bit.ly/ctteg"><img src="https://badgen.net/badge/support/gitter/cyan"></a>
  <a href="https://bit.ly/cttfo"><img src="https://badgen.net/badge/support/forum/yellow"></a>
  <a href="https://contributte.org/partners.html"><img src="https://badgen.net/badge/sponsor/donations/F96854"></a>
</p>

<p align=center>
Website 🚀 <a href="https://contributte.org">contributte.org</a> | Contact 👨🏻‍💻 <a href="https://f3l1x.io">f3l1x.io</a> | Twitter 🐦 <a href="https://twitter.com/contributte">@contributte</a>
</p>

Doctrine ([beberlei/DoctrineExtensions](https://github.com/beberlei/DoctrineExtensions)) extension for Nette Framework.

## Versions

| State       | Version | Branch   | Nette | PHP     |
|-------------|---------|----------|-------|---------|
| dev         | `^0.4`  | `master` | 3.3+  | `>=8.2` |
| stable      | `^0.3`  | `master` | 3.3+  | `>=8.2` |

## Installation

To install latest version of `nettrine/extensions-beberlei` use [Composer](https://getcomposer.org).

```bash
composer require nettrine/extensions-beberlei
```

Register extension.

```yaml
extensions:
    nettrine.extensions.beberlei: Nettrine\Extensions\Beberlei\DI\BeberleiBehaviorExtension
```

## Configuration

Specify the same driver as for the Doctrine DBAL connection. All [beberlei/DoctrineExtensions](https://github.com/beberlei/DoctrineExtensions) custom DQL functions for the given driver will be registered.

```yaml
nettrine.extensions.beberlei:
    connections:
        default:
            driver: mysql
            # mysql - 'mysql', 'mysql2', 'pdo_mysql'
            # oracle - 'oci8', 'pdo_oci'
            # sqlite - 'sqlite', 'sqlite3', 'pdo_sqlite'
            # postgre - 'pgsql', 'postgres', 'postgresql', 'pdo_pgsql'
```

### Advanced configuration

Here is the list of all available options with their types.

```yaml
nettrine.extensions.beberlei:
    connections:
        <name>:
            driver: mysql
```

For example:

```neon
nettrine.extensions.beberlei:
    connections:
        default:
            driver: pdo_pgsql

        # Explicit configuration
        second:
            driver: pdo_mysql
```

## Development

See [how to contribute](https://contributte.org) to this package. This package is currently maintained by these authors.

<a href="https://github.com/f3l1x">
    <img width="80" height="80" src="https://avatars2.githubusercontent.com/u/538058?v=3&s=80">
</a>

-----

Consider to [support](https://contributte.org/partners.html) **contributte** development team.
Also thank you for using this package.
