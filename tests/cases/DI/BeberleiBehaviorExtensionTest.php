<?php declare(strict_types = 1);

namespace Tests\Cases\DI;

use Doctrine\ORM\Configuration;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Nettrine\Extensions\Beberlei\DI\BeberleiBehaviorExtension;
use Ninjify\Nunjuck\Toolkit;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$loader = new ContainerLoader(TEMP_DIR, true);
	$class = $loader->load(static function (Compiler $compiler): void {
		$compiler->addExtension('nettrine.extensions.beberlei', new BeberleiBehaviorExtension());
		$compiler->addDependencies([__FILE__]);
	}, 1);

	$container = new $class();
	Assert::type(Container::class, $container);
});

Toolkit::test(function (): void {
	$loader = new ContainerLoader(TEMP_DIR, true);
	$class = $loader->load(static function (Compiler $compiler): void {
		$compiler->addExtension('nettrine.extensions.beberlei', new BeberleiBehaviorExtension());
		$compiler->addDependencies([__FILE__]);
		$compiler->addConfig([
			'services' => [
				Configuration::class,
			],
			'nettrine.extensions.beberlei' => [
				'driver' => 'pdo_mysql',
			],
		]);
	}, 2);

	$container = new $class();
	Assert::type(Container::class, $container);

	$container->getByType(Configuration::class);
});

Toolkit::test(function (): void {
	$loader = new ContainerLoader(TEMP_DIR, true);
	$class = $loader->load(static function (Compiler $compiler): void {
		$compiler->addExtension('nettrine.extensions.beberlei', new BeberleiBehaviorExtension());
		$compiler->addDependencies([__FILE__]);
		$compiler->addConfig([
			'services' => [
				Configuration::class,
			],
			'nettrine.extensions.beberlei' => [
				'driver' => 'pdo_oci',
			],
		]);
	}, 3);

	$container = new $class();
	Assert::type(Container::class, $container);

	$container->getByType(Configuration::class);
});

Toolkit::test(function (): void {
	$loader = new ContainerLoader(TEMP_DIR, true);
	$class = $loader->load(static function (Compiler $compiler): void {
		$compiler->addExtension('nettrine.extensions.beberlei', new BeberleiBehaviorExtension());
		$compiler->addDependencies([__FILE__]);
		$compiler->addConfig([
			'services' => [
				Configuration::class,
			],
			'nettrine.extensions.beberlei' => [
				'driver' => 'pdo_sqlite',
			],
		]);
	}, 4);

	$container = new $class();
	Assert::type(Container::class, $container);

	$container->getByType(Configuration::class);
});

Toolkit::test(function (): void {
	$loader = new ContainerLoader(TEMP_DIR, true);
	$class = $loader->load(static function (Compiler $compiler): void {
		$compiler->addExtension('nettrine.extensions.beberlei', new BeberleiBehaviorExtension());
		$compiler->addDependencies([__FILE__]);
		$compiler->addConfig([
			'services' => [
				Configuration::class,
			],
			'nettrine.extensions.beberlei' => [
				'driver' => 'pdo_pgsql',
			],
		]);
	}, 5);

	$container = new $class();
	Assert::type(Container::class, $container);

	$container->getByType(Configuration::class);
});
