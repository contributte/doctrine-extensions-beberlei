<?php declare(strict_types = 1);

namespace Tests\Cases\DI;

use Contributte\Tester\Toolkit;
use Contributte\Tester\Utils\ContainerBuilder;
use Contributte\Tester\Utils\Neonkit;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nettrine\DBAL\DI\DbalExtension;
use Nettrine\Extensions\Beberlei\DI\BeberleiBehaviorExtension;
use Nettrine\ORM\DI\OrmExtension;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

// MySQL
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

	Assert::type(Container::class, $container);
});

// MySQL with configuration retrieval
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

	Assert::type(Container::class, $container);
	Assert::notNull($container->getByName('nettrine.orm.managers.default.configuration'));
});

// Oracle
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

	Assert::type(Container::class, $container);
	Assert::notNull($container->getByName('nettrine.orm.managers.default.configuration'));
});

// SQLite
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

	Assert::type(Container::class, $container);
	Assert::notNull($container->getByName('nettrine.orm.managers.default.configuration'));
});

// PostgreSQL
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

	Assert::type(Container::class, $container);
	Assert::notNull($container->getByName('nettrine.orm.managers.default.configuration'));
});
