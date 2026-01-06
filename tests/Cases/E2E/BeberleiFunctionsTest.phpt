<?php declare(strict_types = 1);

namespace Tests\Cases\E2E;

use Contributte\Tester\Toolkit;
use Contributte\Tester\Utils\ContainerBuilder;
use Contributte\Tester\Utils\Neonkit;
use Doctrine\ORM\Configuration;
use DoctrineExtensions\Query\Mysql\DateFormat;
use DoctrineExtensions\Query\Mysql\GroupConcat;
use DoctrineExtensions\Query\Mysql\Now;
use DoctrineExtensions\Query\Mysql\Round;
use DoctrineExtensions\Query\Oracle\Nvl;
use DoctrineExtensions\Query\Oracle\ToChar;
use DoctrineExtensions\Query\Postgresql\StringAgg;
use DoctrineExtensions\Query\Sqlite\JulianDay;
use DoctrineExtensions\Query\Sqlite\Random;
use Nette\DI\Compiler;
use Nettrine\DBAL\DI\DbalExtension;
use Nettrine\Extensions\Beberlei\DI\BeberleiBehaviorExtension;
use Nettrine\ORM\DI\OrmExtension;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

// Test: Custom DQL functions are registered for MySQL
Toolkit::test(static function (): void {
	$container = ContainerBuilder::of()
		->withCompiler(static function (Compiler $compiler): void {
			$compiler->addExtension('nettrine.dbal', new DbalExtension());
			$compiler->addExtension('nettrine.orm', new OrmExtension());
			$compiler->addExtension('nettrine.extensions.beberlei', new BeberleiBehaviorExtension());
			$compiler->addConfig(Neonkit::load(<<<'NEON'
				nettrine.dbal:
					connections:
						default:
							driver: mysqli
							host: localhost
							port: 3306
							user: test
							password: test
							serverVersion: 11.0.0

				nettrine.orm:
					managers:
						default:
							connection: default
							mapping:
								App:
									directories: [App/Database]
									namespace: App\Database

				nettrine.extensions.beberlei:
					connections:
						default:
							driver: pdo_mysql
			NEON
			));
		})
		->build();

	$container->initialize();

	/** @var Configuration $configuration */
	$configuration = $container->getByName('nettrine.orm.managers.default.configuration');

	// Verify datetime functions
	Assert::same(Now::class, $configuration->getCustomDatetimeFunction('now'));
	Assert::same(DateFormat::class, $configuration->getCustomDatetimeFunction('date_format'));

	// Verify numeric functions
	Assert::same(Round::class, $configuration->getCustomNumericFunction('round'));

	// Verify string functions
	Assert::same(GroupConcat::class, $configuration->getCustomStringFunction('group_concat'));
});

// Test: Custom DQL functions are registered for Oracle
Toolkit::test(static function (): void {
	$container = ContainerBuilder::of()
		->withCompiler(static function (Compiler $compiler): void {
			$compiler->addExtension('nettrine.dbal', new DbalExtension());
			$compiler->addExtension('nettrine.orm', new OrmExtension());
			$compiler->addExtension('nettrine.extensions.beberlei', new BeberleiBehaviorExtension());
			$compiler->addConfig(Neonkit::load(<<<'NEON'
				nettrine.dbal:
					connections:
						default:
							driver: pdo_oci
							host: localhost
							user: test
							password: test

				nettrine.orm:
					managers:
						default:
							connection: default
							mapping:
								App:
									directories: [App/Database]
									namespace: App\Database

				nettrine.extensions.beberlei:
					connections:
						default:
							driver: pdo_oci
			NEON
			));
		})
		->build();

	$container->initialize();

	/** @var Configuration $configuration */
	$configuration = $container->getByName('nettrine.orm.managers.default.configuration');

	// Verify datetime functions
	Assert::same(ToChar::class, $configuration->getCustomDatetimeFunction('to_char'));

	// Verify string functions
	Assert::same(Nvl::class, $configuration->getCustomStringFunction('nvl'));
});

// Test: Custom DQL functions are registered for SQLite
Toolkit::test(static function (): void {
	$container = ContainerBuilder::of()
		->withCompiler(static function (Compiler $compiler): void {
			$compiler->addExtension('nettrine.dbal', new DbalExtension());
			$compiler->addExtension('nettrine.orm', new OrmExtension());
			$compiler->addExtension('nettrine.extensions.beberlei', new BeberleiBehaviorExtension());
			$compiler->addConfig(Neonkit::load(<<<'NEON'
				nettrine.dbal:
					connections:
						default:
							driver: pdo_sqlite
							url: "sqlite:///:memory:"

				nettrine.orm:
					managers:
						default:
							connection: default
							mapping:
								App:
									directories: [App/Database]
									namespace: App\Database

				nettrine.extensions.beberlei:
					connections:
						default:
							driver: pdo_sqlite
			NEON
			));
		})
		->build();

	$container->initialize();

	/** @var Configuration $configuration */
	$configuration = $container->getByName('nettrine.orm.managers.default.configuration');

	// Verify datetime functions
	Assert::same(JulianDay::class, $configuration->getCustomDatetimeFunction('julianday'));

	// Verify string functions
	Assert::same(Random::class, $configuration->getCustomStringFunction('random'));
});

// Test: Custom DQL functions are registered for PostgreSQL
Toolkit::test(static function (): void {
	$container = ContainerBuilder::of()
		->withCompiler(static function (Compiler $compiler): void {
			$compiler->addExtension('nettrine.dbal', new DbalExtension());
			$compiler->addExtension('nettrine.orm', new OrmExtension());
			$compiler->addExtension('nettrine.extensions.beberlei', new BeberleiBehaviorExtension());
			$compiler->addConfig(Neonkit::load(<<<'NEON'
				nettrine.dbal:
					connections:
						default:
							driver: pdo_pgsql
							host: localhost
							port: 5432
							user: test
							password: test
							serverVersion: 11.0.0

				nettrine.orm:
					managers:
						default:
							connection: default
							mapping:
								App:
									directories: [App/Database]
									namespace: App\Database

				nettrine.extensions.beberlei:
					connections:
						default:
							driver: pdo_pgsql
			NEON
			));
		})
		->build();

	$container->initialize();

	/** @var Configuration $configuration */
	$configuration = $container->getByName('nettrine.orm.managers.default.configuration');

	// Verify string functions
	Assert::same(StringAgg::class, $configuration->getCustomStringFunction('string_agg'));
});
