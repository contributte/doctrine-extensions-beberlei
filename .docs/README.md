# Contributte Doctrine Extensions Beberlei

## Content

Doctrine ([Beberlei/DoctrineExtensions](https://github.com/beberlei/DoctrineExtensions)) extension for Nette Framework

- [Setup](#setup)
- [Configuration](#configuration)

## Setup

Install package

```bash
composer require nettrine/extensions-beberlei
```

Register extension

```yaml
extensions:
    nettrine.extensions.beberlei: Nettrine\Extensions\Beberlei\DI\BeberleiBehaviorExtension
```

## Configuration

Specify the same driver as for the Doctrine DBAL connection, all of [beberlei/DoctrineExtensions](https://github.com/beberlei/DoctrineExtensions) custom DQL functions for the given driver will be registered.

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

