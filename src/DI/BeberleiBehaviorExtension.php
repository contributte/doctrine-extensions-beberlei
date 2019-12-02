<?php declare(strict_types = 1);

namespace Nettrine\Extensions\Beberlei\DI;

use Doctrine\ORM\Configuration;
use DoctrineExtensions\Query\Mysql;
use DoctrineExtensions\Query\Oracle;
use DoctrineExtensions\Query\Postgresql;
use DoctrineExtensions\Query\Sqlite;
use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\ServiceDefinition;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use stdClass;

/**
 * @property-read stdClass $config
 */
final class BeberleiBehaviorExtension extends CompilerExtension
{

	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'driver' => Expect::anyOf(
				'mysql', 'mysql2', 'pdo_mysql', // mysql
				'oci8', 'pdo_oci', // oracle
				'sqlite', 'sqlite3', 'pdo_sqlite', // sqlite
				'pgsql', 'postgres', 'postgresql', 'pdo_pgsql' // postgre
			),
		]);
	}

	public function beforeCompile(): void
	{
		$builder = $this->getContainerBuilder();
		$config = $this->config;

		if ($config->driver === null) {
			return;
		}

		$configurationDefinition = $builder->getDefinitionByType(Configuration::class);
		assert($configurationDefinition instanceof ServiceDefinition);

		switch ($config->driver) {
			case 'mysql':
			case 'mysql2':
			case 'pdo_mysql':
				$this->registerMysqlFunctions($configurationDefinition);
				break;
			case 'oci8':
			case 'pdo_oci':
				$this->registerOracleFunctions($configurationDefinition);
				break;
			case 'sqlite':
			case 'sqlite3':
			case 'pdo_sqlite':
				$this->registerSqliteFunctions($configurationDefinition);
				break;
			case 'pgsql':
			case 'postgres':
			case 'postgresql':
			case 'pdo_pgsql':
				$this->registerPostgresqlFunctions($configurationDefinition);
				break;
		}
	}

	/**
	 * @param string[] $functions
	 */
	private function registerFunctions(ServiceDefinition $configurationDefinition, array $functions, string $method): void
	{
		foreach ($functions as $name => $class) {
			$configurationDefinition->addSetup($method, [$name, $class]);
		}
	}

	/**
	 * @param string[] $functions
	 */
	private function registerDatetimeFunctions(ServiceDefinition $configurationDefinition, array $functions): void
	{
		$this->registerFunctions($configurationDefinition, $functions, 'addCustomDatetimeFunction');
	}

	/**
	 * @param string[] $functions
	 */
	private function registerNumericFunctions(ServiceDefinition $configurationDefinition, array $functions): void
	{
		$this->registerFunctions($configurationDefinition, $functions, 'addCustomNumericFunction');
	}

	/**
	 * @param string[] $functions
	 */
	private function registerStringFunctions(ServiceDefinition $configurationDefinition, array $functions): void
	{
		$this->registerFunctions($configurationDefinition, $functions, 'addCustomStringFunction');
	}

	private function registerMysqlFunctions(ServiceDefinition $configurationDefinition): void
	{
		$datetimeFunctions = [
			'addtime' => Mysql\AddTime::class,
			'convert_tz' => Mysql\ConvertTz::class,
			'date' => Mysql\Date::class,
			'date_format' => Mysql\DateFormat::class,
			'dateadd' => Mysql\DateAdd::class,
			'datesub' => Mysql\DateSub::class,
			'datediff' => Mysql\DateDiff::class,
			'day' => Mysql\Day::class,
			'dayname' => Mysql\DayName::class,
			'dayofweek' => Mysql\DayOfWeek::class,
			'dayofyear' => Mysql\DayOfYear::class,
			'div' => Mysql\Div::class,
			'from_unixtime' => Mysql\FromUnixtime::class,
			'hour' => Mysql\Hour::class,
			'last_day' => Mysql\LastDay::class,
			'makedate' => Mysql\MakeDate::class,
			'minute' => Mysql\Minute::class,
			'now' => Mysql\Now::class,
			'month' => Mysql\Month::class,
			'monthname' => Mysql\MonthName::class,
			'period_diff' => Mysql\PeriodDiff::class,
			'second' => Mysql\Second::class,
			'sectotime' => Mysql\SecToTime::class,
			'strtodate' => Mysql\StrToDate::class,
			'time' => Mysql\Time::class,
			'timediff' => Mysql\TimeDiff::class,
			'timestampadd' => Mysql\TimestampAdd::class,
			'timestampdiff' => Mysql\TimestampDiff::class,
			'timetosec' => Mysql\TimeToSec::class,
			'week' => Mysql\Week::class,
			'weekday' => Mysql\WeekDay::class,
			'year' => Mysql\Year::class,
			'yearmonth' => Mysql\YearMonth::class,
			'yearweek' => Mysql\YearWeek::class,
			'unix_timestamp' => Mysql\UnixTimestamp::class,
			'utc_timestamp' => Mysql\UtcTimestamp::class,
			'extract' => Mysql\Extract::class,
		];
		$this->registerDatetimeFunctions($configurationDefinition, $datetimeFunctions);

		$numericFunctions = [
			'acos' => Mysql\Acos::class,
			'asin' => Mysql\Asin::class,
			'atan' => Mysql\Atan::class,
			'atan2' => Mysql\Atan2::class,
			'bit_count' => Mysql\BitCount::class,
			'bit_xor' => Mysql\BitXor::class,
			'ceil' => Mysql\Ceil::class,
			'cos' => Mysql\Cos::class,
			'cot' => Mysql\Cot::class,
			'degrees' => Mysql\Degrees::class,
			'exp' => Mysql\Exp::class,
			'floor' => Mysql\Floor::class,
			'log' => Mysql\Log::class,
			'log10' => Mysql\Log10::class,
			'log2' => Mysql\Log2::class,
			'pi' => Mysql\Pi::class,
			'power' => Mysql\Power::class,
			'quarter' => Mysql\Quarter::class,
			'radians' => Mysql\Radians::class,
			'rand' => Mysql\Rand::class,
			'round' => Mysql\Round::class,
			'stddev' => Mysql\StdDev::class,
			'sin' => Mysql\Sin::class,
			'std' => Mysql\Std::class,
			'tan' => Mysql\Tan::class,
			'variance' => Mysql\Variance::class,
		];
		$this->registerNumericFunctions($configurationDefinition, $numericFunctions);

		$stringFunctions = [
			'aes_decrypt' => Mysql\AesDecrypt::class,
			'aes_encrypt' => Mysql\AesEncrypt::class,
			'any_value' => Mysql\AnyValue::class,
			'ascii' => Mysql\Ascii::class,
			'binary' => Mysql\Binary::class,
			'cast' => Mysql\Cast::class,
			'char_length' => Mysql\CharLength::class,
			'collate' => Mysql\Collate::class,
			'concat_ws' => Mysql\ConcatWs::class,
			'countif' => Mysql\CountIf::class,
			'crc32' => Mysql\Crc32::class,
			'degrees' => Mysql\Degrees::class,
			'field' => Mysql\Field::class,
			'find_in_set' => Mysql\FindInSet::class,
			'format' => Mysql\Format::class,
			'greatest' => Mysql\Greatest::class,
			'group_concat' => Mysql\GroupConcat::class,
			'hex' => Mysql\Hex::class,
			'ifelse' => Mysql\IfElse::class,
			'ifnull' => Mysql\IfNull::class,
			'inet_aton' => Mysql\InetAton::class,
			'inet_ntoa' => Mysql\InetNtoa::class,
			'inet6_aton' => Mysql\Inet6Aton::class,
			'inet6_ntoa' => Mysql\Inet6Ntoa::class,
			'instr' => Mysql\Instr::class,
			'is_ipv4' => Mysql\IsIpv4::class,
			'is_ipv4_compat' => Mysql\IsIpv4Compat::class,
			'is_ipv4_mapped' => Mysql\IsIpv4Mapped::class,
			'is_ipv6' => Mysql\IsIpv6::class,
			'lag' => Mysql\Lag::class,
			'lead' => Mysql\Lead::class,
			'least' => Mysql\Least::class,
			'lpad' => Mysql\Lpad::class,
			'match' => Mysql\MatchAgainst::class,
			'md5' => Mysql\Md5::class,
			'nullif' => Mysql\NullIf::class,
			'over' => Mysql\Over::class,
			'radians' => Mysql\Radians::class,
			'regexp' => Mysql\Regexp::class,
			'replace' => Mysql\Replace::class,
			'rpad' => Mysql\Rpad::class,
			'sha1' => Mysql\Sha1::class,
			'sha2' => Mysql\Sha2::class,
			'soundex' => Mysql\Soundex::class,
			'str_to_date' => Mysql\StrToDate::class,
			'substring_index' => Mysql\SubstringIndex::class,
			'unhex' => Mysql\Unhex::class,
			'uuid_short' => Mysql\UuidShort::class,
		];
		$this->registerStringFunctions($configurationDefinition, $stringFunctions);
	}

	private function registerOracleFunctions(ServiceDefinition $configurationDefinition): void
	{
		$datetimeFunctions = [
			'day' => Oracle\Day::class,
			'month' => Oracle\Month::class,
			'year' => Oracle\Year::class,
			'to_char' => Oracle\ToChar::class,
			'trunc' => Oracle\Trunc::class,
		];
		$this->registerDatetimeFunctions($configurationDefinition, $datetimeFunctions);

		$stringFunctions = [
			'nvl' => Oracle\Nvl::class,
			'listagg' => Oracle\Listagg::class,
			'to_date' => Oracle\ToDate::class,
		];
		$this->registerStringFunctions($configurationDefinition, $stringFunctions);
	}

	private function registerSqliteFunctions(ServiceDefinition $configurationDefinition): void
	{
		$datetimeFunctions = [
			'date' => Sqlite\Date::class,
			'date_format' => Sqlite\DateFormat::class,
			'day' => Sqlite\Day::class,
			'hour' => Sqlite\Hour::class,
			'julianday' => Sqlite\JulianDay::class,
			'minute' => Sqlite\Minute::class,
			'month' => Sqlite\Month::class,
			'strftime' => Sqlite\StrfTime::class,
			'week' => Sqlite\Week::class,
			'weekday' => Sqlite\WeekDay::class,
			'year' => Sqlite\Year::class,
		];
		$this->registerDatetimeFunctions($configurationDefinition, $datetimeFunctions);

		$numericFunctions = [
			'round' => Sqlite\Round::class,
		];
		$this->registerNumericFunctions($configurationDefinition, $numericFunctions);

		$stringFunctions = [
			'concat_ws' => Sqlite\ConcatWs::class,
			'greatest' => Sqlite\Greatest::class,
			'ifelse' => Sqlite\IfElse::class,
			'ifnull' => Sqlite\IfNull::class,
			'least' => Sqlite\Least::class,
			'random' => Sqlite\Random::class,
			'replace' => Sqlite\Replace::class,
		];
		$this->registerStringFunctions($configurationDefinition, $stringFunctions);
	}

	private function registerPostgresqlFunctions(ServiceDefinition $configurationDefinition): void
	{
		$datetimeFunctions = [
			'date_format' => Postgresql\DateFormat::class,
			'at_time_zone' => Postgresql\AtTimeZoneFunction::class,
			'date_part' => Postgresql\DatePart::class,
			'extract' => Postgresql\ExtractFunction::class,
		];
		$this->registerDatetimeFunctions($configurationDefinition, $datetimeFunctions);

		$stringFunctions = [
			'str_to_date' => Postgresql\StrToDate::class,
			'count_filter' => Postgresql\CountFilterFunction::class,
			'string_agg' => Postgresql\StringAgg::class,
			'greatest' => Postgresql\Greatest::class,
			'least' => Postgresql\Least::class,
			'regexp_replace' => Postgresql\RegexpReplace::class,
		];
		$this->registerStringFunctions($configurationDefinition, $stringFunctions);
	}

}
