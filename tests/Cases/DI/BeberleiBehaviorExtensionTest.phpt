<?php declare(strict_types = 1);

namespace Tests\Cases\DI;

use Contributte\Tester\Toolkit;
use Contributte\Tester\Utils\Neonkit;
use Doctrine\ORM\Configuration;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Nettrine\DBAL\DI\DbalExtension;
use Nettrine\Extensions\Beberlei\DI\BeberleiBehaviorExtension;
use Nettrine\ORM\DI\OrmExtension;
use Tester\Assert;
use Tests\Toolkit\Tests;

require_once __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$loader = new ContainerLoader(Tests::TEMP_PATH, true);
	$class = $loader->load(static function (Compiler $compiler): void {
		$compiler->addExtension('nettrine.dbal', new DbalExtension());
		$compiler->addExtension('nettrine.orm', new OrmExtension());
		$compiler->addConfig(Neonkit::load(
			<<<'NEON'
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
				NEON
		));
		$compiler->addExtension('nettrine.extensions.beberlei', new BeberleiBehaviorExtension());
		$compiler->addConfig([
			'nettrine.extensions.beberlei' => [
				'connections' => [
					'default' => [
						'driver' => 'pdo_mysql',
					],
				],
			],
		]);
		$compiler->addDependencies([__FILE__]);
	}, 1);

	$container = new $class();
	Assert::type(Container::class, $container);
});

Toolkit::test(function (): void {
	$loader = new ContainerLoader(Tests::TEMP_PATH, true);
	$class = $loader->load(static function (Compiler $compiler): void {
		$compiler->addExtension('nettrine.dbal', new DbalExtension());
		$compiler->addExtension('nettrine.orm', new OrmExtension());
		$compiler->addConfig(Neonkit::load(
			<<<'NEON'
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
				NEON
		));
		$compiler->addExtension('nettrine.extensions.beberlei', new BeberleiBehaviorExtension());
		$compiler->addConfig([
			'nettrine.extensions.beberlei' => [
				'connections' => [
					'default' => [
						'driver' => 'pdo_mysql',
					],
				],
			],
		]);
		$compiler->addDependencies([__FILE__]);
	}, 2);

	$container = new $class();
	Assert::type(Container::class, $container);

	Assert::notNull($container->getByName('nettrine.orm.managers.default.configuration'));
});

Toolkit::test(function (): void {
	$loader = new ContainerLoader(Tests::TEMP_PATH, true);
	$class = $loader->load(static function (Compiler $compiler): void {
		$compiler->addExtension('nettrine.dbal', new DbalExtension());
		$compiler->addExtension('nettrine.orm', new OrmExtension());
		$compiler->addConfig(Neonkit::load(
			<<<'NEON'
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
				NEON
		));
		$compiler->addExtension('nettrine.extensions.beberlei', new BeberleiBehaviorExtension());
		$compiler->addDependencies([__FILE__]);
		$compiler->addConfig([
			'services' => [
				Configuration::class,
			],
			'nettrine.extensions.beberlei' => [
				'connections' => [
					'default' => [
						'driver' => 'pdo_oci',
					]
				],
			],
		]);
	}, 3);

	$container = new $class();
	Assert::type(Container::class, $container);

	Assert::notNull($container->getByName('nettrine.orm.managers.default.configuration'));
});

Toolkit::test(function (): void {
	$loader = new ContainerLoader(Tests::TEMP_PATH, true);
	$class = $loader->load(static function (Compiler $compiler): void {
		$compiler->addExtension('nettrine.dbal', new DbalExtension());
		$compiler->addExtension('nettrine.orm', new OrmExtension());
		$compiler->addConfig(Neonkit::load(
			<<<'NEON'
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
				NEON
		));
		$compiler->addExtension('nettrine.extensions.beberlei', new BeberleiBehaviorExtension());
		$compiler->addConfig([
			'nettrine.extensions.beberlei' => [
				'connections' => [
					'default' => [
						'driver' => 'pdo_sqlite',
					]
				]
			],
		]);
		$compiler->addDependencies([__FILE__]);
	}, 4);

	$container = new $class();
	Assert::type(Container::class, $container);

	Assert::notNull($container->getByName('nettrine.orm.managers.default.configuration'));
});

Toolkit::test(function (): void {
	$loader = new ContainerLoader(Tests::TEMP_PATH, true);
	$class = $loader->load(static function (Compiler $compiler): void {
		$compiler->addExtension('nettrine.dbal', new DbalExtension());
		$compiler->addExtension('nettrine.orm', new OrmExtension());
		$compiler->addConfig(Neonkit::load(
			<<<'NEON'
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
				NEON
		));
		$compiler->addExtension('nettrine.extensions.beberlei', new BeberleiBehaviorExtension());
		$compiler->addConfig([
			'nettrine.extensions.beberlei' => [
				'connections' => [
					'default' => [
						'driver' => 'pdo_pgsql',
					]
				]
			],
		]);
		$compiler->addDependencies([__FILE__]);
	}, 5);

	$container = new $class();
	Assert::type(Container::class, $container);

	Assert::notNull($container->getByName('nettrine.orm.managers.default.configuration'));
});
