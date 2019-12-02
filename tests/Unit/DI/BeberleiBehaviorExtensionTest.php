<?php declare(strict_types = 1);

namespace Tests\Nettrine\Extensions\Beberlei\Unit\DI;

use Doctrine\ORM\Configuration;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Nettrine\Extensions\Beberlei\DI\BeberleiBehaviorExtension;
use PHPUnit\Framework\TestCase;

final class BeberleiBehaviorExtensionTest extends TestCase
{

	/**
	 * @doesNotPerformAssertions
	 */
	public function testNothing(): void
	{
		$loader = new ContainerLoader(__DIR__ . '/../../tmp', true);
		$class = $loader->load(static function (Compiler $compiler): void {
			$compiler->addExtension('nettrine.extensions.beberlei', new BeberleiBehaviorExtension());
			$compiler->addDependencies([__FILE__]);
		}, __METHOD__);

		$container = new $class();
		assert($container instanceof Container);
	}

	/**
	 * @doesNotPerformAssertions
	 */
	public function testMysql(): void
	{
		$loader = new ContainerLoader(__DIR__ . '/../../tmp', true);
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
		}, __METHOD__);

		$container = new $class();
		assert($container instanceof Container);

		$container->getByType(Configuration::class);
	}

	/**
	 * @doesNotPerformAssertions
	 */
	public function testOracle(): void
	{
		$loader = new ContainerLoader(__DIR__ . '/../../tmp', true);
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
		}, __METHOD__);

		$container = new $class();
		assert($container instanceof Container);

		$container->getByType(Configuration::class);
	}

	/**
	 * @doesNotPerformAssertions
	 */
	public function testSqlite(): void
	{
		$loader = new ContainerLoader(__DIR__ . '/../../tmp', true);
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
		}, __METHOD__);

		$container = new $class();
		assert($container instanceof Container);

		$container->getByType(Configuration::class);
	}

	/**
	 * @doesNotPerformAssertions
	 */
	public function testPostgre(): void
	{
		$loader = new ContainerLoader(__DIR__ . '/../../tmp', true);
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
		}, __METHOD__);

		$container = new $class();
		assert($container instanceof Container);

		$container->getByType(Configuration::class);
	}

}
