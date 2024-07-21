<?php declare(strict_types = 1);

namespace Nettrine\Extensions\Beberlei\DI;

use Doctrine\ORM\Configuration;
use DoctrineExtensions\Query\Mysql\Acos;
use DoctrineExtensions\Query\Mysql\AddTime;
use DoctrineExtensions\Query\Mysql\AesDecrypt;
use DoctrineExtensions\Query\Mysql\AesEncrypt;
use DoctrineExtensions\Query\Mysql\AnyValue;
use DoctrineExtensions\Query\Mysql\Ascii;
use DoctrineExtensions\Query\Mysql\Asin;
use DoctrineExtensions\Query\Mysql\Atan;
use DoctrineExtensions\Query\Mysql\Atan2;
use DoctrineExtensions\Query\Mysql\Binary;
use DoctrineExtensions\Query\Mysql\BitCount;
use DoctrineExtensions\Query\Mysql\BitXor;
use DoctrineExtensions\Query\Mysql\Cast;
use DoctrineExtensions\Query\Mysql\Ceil;
use DoctrineExtensions\Query\Mysql\CharLength;
use DoctrineExtensions\Query\Mysql\Collate;
use DoctrineExtensions\Query\Mysql\ConcatWs;
use DoctrineExtensions\Query\Mysql\ConvertTz;
use DoctrineExtensions\Query\Mysql\Cos;
use DoctrineExtensions\Query\Mysql\Cot;
use DoctrineExtensions\Query\Mysql\CountIf;
use DoctrineExtensions\Query\Mysql\Crc32;
use DoctrineExtensions\Query\Mysql\Date;
use DoctrineExtensions\Query\Mysql\DateAdd;
use DoctrineExtensions\Query\Mysql\DateDiff;
use DoctrineExtensions\Query\Mysql\DateFormat;
use DoctrineExtensions\Query\Mysql\DateSub;
use DoctrineExtensions\Query\Mysql\Day;
use DoctrineExtensions\Query\Mysql\DayName;
use DoctrineExtensions\Query\Mysql\DayOfWeek;
use DoctrineExtensions\Query\Mysql\DayOfYear;
use DoctrineExtensions\Query\Mysql\Degrees;
use DoctrineExtensions\Query\Mysql\Div;
use DoctrineExtensions\Query\Mysql\Exp;
use DoctrineExtensions\Query\Mysql\Extract;
use DoctrineExtensions\Query\Mysql\Field;
use DoctrineExtensions\Query\Mysql\FindInSet;
use DoctrineExtensions\Query\Mysql\Floor;
use DoctrineExtensions\Query\Mysql\Format;
use DoctrineExtensions\Query\Mysql\FromUnixtime;
use DoctrineExtensions\Query\Mysql\Greatest;
use DoctrineExtensions\Query\Mysql\GroupConcat;
use DoctrineExtensions\Query\Mysql\Hex;
use DoctrineExtensions\Query\Mysql\Hour;
use DoctrineExtensions\Query\Mysql\IfElse;
use DoctrineExtensions\Query\Mysql\IfNull;
use DoctrineExtensions\Query\Mysql\Inet6Aton;
use DoctrineExtensions\Query\Mysql\Inet6Ntoa;
use DoctrineExtensions\Query\Mysql\InetAton;
use DoctrineExtensions\Query\Mysql\InetNtoa;
use DoctrineExtensions\Query\Mysql\Instr;
use DoctrineExtensions\Query\Mysql\IsIpv4;
use DoctrineExtensions\Query\Mysql\IsIpv4Compat;
use DoctrineExtensions\Query\Mysql\IsIpv4Mapped;
use DoctrineExtensions\Query\Mysql\IsIpv6;
use DoctrineExtensions\Query\Mysql\Lag;
use DoctrineExtensions\Query\Mysql\LastDay;
use DoctrineExtensions\Query\Mysql\Lead;
use DoctrineExtensions\Query\Mysql\Least;
use DoctrineExtensions\Query\Mysql\Log;
use DoctrineExtensions\Query\Mysql\Log10;
use DoctrineExtensions\Query\Mysql\Log2;
use DoctrineExtensions\Query\Mysql\Lpad;
use DoctrineExtensions\Query\Mysql\MakeDate;
use DoctrineExtensions\Query\Mysql\MatchAgainst;
use DoctrineExtensions\Query\Mysql\Md5;
use DoctrineExtensions\Query\Mysql\Minute;
use DoctrineExtensions\Query\Mysql\Month;
use DoctrineExtensions\Query\Mysql\MonthName;
use DoctrineExtensions\Query\Mysql\Now;
use DoctrineExtensions\Query\Mysql\NullIf;
use DoctrineExtensions\Query\Mysql\Over;
use DoctrineExtensions\Query\Mysql\PeriodDiff;
use DoctrineExtensions\Query\Mysql\Pi;
use DoctrineExtensions\Query\Mysql\Power;
use DoctrineExtensions\Query\Mysql\Quarter;
use DoctrineExtensions\Query\Mysql\Radians;
use DoctrineExtensions\Query\Mysql\Rand;
use DoctrineExtensions\Query\Mysql\Regexp;
use DoctrineExtensions\Query\Mysql\Replace;
use DoctrineExtensions\Query\Mysql\Round;
use DoctrineExtensions\Query\Mysql\Rpad;
use DoctrineExtensions\Query\Mysql\Second;
use DoctrineExtensions\Query\Mysql\SecToTime;
use DoctrineExtensions\Query\Mysql\Sha1;
use DoctrineExtensions\Query\Mysql\Sha2;
use DoctrineExtensions\Query\Mysql\Sin;
use DoctrineExtensions\Query\Mysql\Soundex;
use DoctrineExtensions\Query\Mysql\Std;
use DoctrineExtensions\Query\Mysql\StdDev;
use DoctrineExtensions\Query\Mysql\StrToDate;
use DoctrineExtensions\Query\Mysql\SubstringIndex;
use DoctrineExtensions\Query\Mysql\Tan;
use DoctrineExtensions\Query\Mysql\Time;
use DoctrineExtensions\Query\Mysql\TimeDiff;
use DoctrineExtensions\Query\Mysql\TimestampAdd;
use DoctrineExtensions\Query\Mysql\TimestampDiff;
use DoctrineExtensions\Query\Mysql\TimeToSec;
use DoctrineExtensions\Query\Mysql\Unhex;
use DoctrineExtensions\Query\Mysql\UnixTimestamp;
use DoctrineExtensions\Query\Mysql\UtcTimestamp;
use DoctrineExtensions\Query\Mysql\UuidShort;
use DoctrineExtensions\Query\Mysql\Variance;
use DoctrineExtensions\Query\Mysql\Week;
use DoctrineExtensions\Query\Mysql\WeekDay;
use DoctrineExtensions\Query\Mysql\Year;
use DoctrineExtensions\Query\Mysql\YearMonth;
use DoctrineExtensions\Query\Mysql\YearWeek;
use DoctrineExtensions\Query\Oracle\Listagg;
use DoctrineExtensions\Query\Oracle\Nvl;
use DoctrineExtensions\Query\Oracle\ToChar;
use DoctrineExtensions\Query\Oracle\ToDate;
use DoctrineExtensions\Query\Oracle\Trunc;
use DoctrineExtensions\Query\Postgresql\AtTimeZoneFunction;
use DoctrineExtensions\Query\Postgresql\CountFilterFunction;
use DoctrineExtensions\Query\Postgresql\DatePart;
use DoctrineExtensions\Query\Postgresql\ExtractFunction;
use DoctrineExtensions\Query\Postgresql\RegexpReplace;
use DoctrineExtensions\Query\Postgresql\StringAgg;
use DoctrineExtensions\Query\Sqlite\JulianDay;
use DoctrineExtensions\Query\Sqlite\Random;
use DoctrineExtensions\Query\Sqlite\StrfTime;
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
				'mysql', // mysql
				'mysql2',
				'pdo_mysql',
				'oci8', // oracle
				'pdo_oci',
				'sqlite',
				'sqlite3', // sqlite
				'pdo_sqlite',
				'pgsql', // postgre
				'postgres',
				'postgresql',
				'pdo_pgsql'
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
			'addtime' => AddTime::class,
			'convert_tz' => ConvertTz::class,
			'date' => Date::class,
			'date_format' => DateFormat::class,
			'dateadd' => DateAdd::class,
			'datesub' => DateSub::class,
			'datediff' => DateDiff::class,
			'day' => Day::class,
			'dayname' => DayName::class,
			'dayofweek' => DayOfWeek::class,
			'dayofyear' => DayOfYear::class,
			'div' => Div::class,
			'from_unixtime' => FromUnixtime::class,
			'hour' => Hour::class,
			'last_day' => LastDay::class,
			'makedate' => MakeDate::class,
			'minute' => Minute::class,
			'now' => Now::class,
			'month' => Month::class,
			'monthname' => MonthName::class,
			'period_diff' => PeriodDiff::class,
			'second' => Second::class,
			'sectotime' => SecToTime::class,
			'strtodate' => StrToDate::class,
			'time' => Time::class,
			'timediff' => TimeDiff::class,
			'timestampadd' => TimestampAdd::class,
			'timestampdiff' => TimestampDiff::class,
			'timetosec' => TimeToSec::class,
			'week' => Week::class,
			'weekday' => WeekDay::class,
			'year' => Year::class,
			'yearmonth' => YearMonth::class,
			'yearweek' => YearWeek::class,
			'unix_timestamp' => UnixTimestamp::class,
			'utc_timestamp' => UtcTimestamp::class,
			'extract' => Extract::class,
		];
		$this->registerDatetimeFunctions($configurationDefinition, $datetimeFunctions);

		$numericFunctions = [
			'acos' => Acos::class,
			'asin' => Asin::class,
			'atan' => Atan::class,
			'atan2' => Atan2::class,
			'bit_count' => BitCount::class,
			'bit_xor' => BitXor::class,
			'ceil' => Ceil::class,
			'cos' => Cos::class,
			'cot' => Cot::class,
			'degrees' => Degrees::class,
			'exp' => Exp::class,
			'floor' => Floor::class,
			'log' => Log::class,
			'log10' => Log10::class,
			'log2' => Log2::class,
			'pi' => Pi::class,
			'power' => Power::class,
			'quarter' => Quarter::class,
			'radians' => Radians::class,
			'rand' => Rand::class,
			'round' => Round::class,
			'stddev' => StdDev::class,
			'sin' => Sin::class,
			'std' => Std::class,
			'tan' => Tan::class,
			'variance' => Variance::class,
		];
		$this->registerNumericFunctions($configurationDefinition, $numericFunctions);

		$stringFunctions = [
			'aes_decrypt' => AesDecrypt::class,
			'aes_encrypt' => AesEncrypt::class,
			'any_value' => AnyValue::class,
			'ascii' => Ascii::class,
			'binary' => Binary::class,
			'cast' => Cast::class,
			'char_length' => CharLength::class,
			'collate' => Collate::class,
			'concat_ws' => ConcatWs::class,
			'countif' => CountIf::class,
			'crc32' => Crc32::class,
			'degrees' => Degrees::class,
			'field' => Field::class,
			'find_in_set' => FindInSet::class,
			'format' => Format::class,
			'greatest' => Greatest::class,
			'group_concat' => GroupConcat::class,
			'hex' => Hex::class,
			'ifelse' => IfElse::class,
			'ifnull' => IfNull::class,
			'inet_aton' => InetAton::class,
			'inet_ntoa' => InetNtoa::class,
			'inet6_aton' => Inet6Aton::class,
			'inet6_ntoa' => Inet6Ntoa::class,
			'instr' => Instr::class,
			'is_ipv4' => IsIpv4::class,
			'is_ipv4_compat' => IsIpv4Compat::class,
			'is_ipv4_mapped' => IsIpv4Mapped::class,
			'is_ipv6' => IsIpv6::class,
			'lag' => Lag::class,
			'lead' => Lead::class,
			'least' => Least::class,
			'lpad' => Lpad::class,
			'match' => MatchAgainst::class,
			'md5' => Md5::class,
			'nullif' => NullIf::class,
			'over' => Over::class,
			'radians' => Radians::class,
			'regexp' => Regexp::class,
			'replace' => Replace::class,
			'rpad' => Rpad::class,
			'sha1' => Sha1::class,
			'sha2' => Sha2::class,
			'soundex' => Soundex::class,
			'str_to_date' => StrToDate::class,
			'substring_index' => SubstringIndex::class,
			'unhex' => Unhex::class,
			'uuid_short' => UuidShort::class,
		];
		$this->registerStringFunctions($configurationDefinition, $stringFunctions);
	}

	private function registerOracleFunctions(ServiceDefinition $configurationDefinition): void
	{
		$datetimeFunctions = [
			'day' => \DoctrineExtensions\Query\Oracle\Day::class,
			'month' => \DoctrineExtensions\Query\Oracle\Month::class,
			'year' => \DoctrineExtensions\Query\Oracle\Year::class,
			'to_char' => ToChar::class,
			'trunc' => Trunc::class,
		];
		$this->registerDatetimeFunctions($configurationDefinition, $datetimeFunctions);

		$stringFunctions = [
			'nvl' => Nvl::class,
			'listagg' => Listagg::class,
			'to_date' => ToDate::class,
		];
		$this->registerStringFunctions($configurationDefinition, $stringFunctions);
	}

	private function registerSqliteFunctions(ServiceDefinition $configurationDefinition): void
	{
		$datetimeFunctions = [
			'date' => \DoctrineExtensions\Query\Sqlite\Date::class,
			'date_format' => \DoctrineExtensions\Query\Sqlite\DateFormat::class,
			'day' => \DoctrineExtensions\Query\Sqlite\Day::class,
			'hour' => \DoctrineExtensions\Query\Sqlite\Hour::class,
			'julianday' => JulianDay::class,
			'minute' => \DoctrineExtensions\Query\Sqlite\Minute::class,
			'month' => \DoctrineExtensions\Query\Sqlite\Month::class,
			'strftime' => StrfTime::class,
			'week' => \DoctrineExtensions\Query\Sqlite\Week::class,
			'weekday' => \DoctrineExtensions\Query\Sqlite\WeekDay::class,
			'year' => \DoctrineExtensions\Query\Sqlite\Year::class,
		];
		$this->registerDatetimeFunctions($configurationDefinition, $datetimeFunctions);

		$numericFunctions = [
			'round' => \DoctrineExtensions\Query\Sqlite\Round::class,
		];
		$this->registerNumericFunctions($configurationDefinition, $numericFunctions);

		$stringFunctions = [
			'concat_ws' => \DoctrineExtensions\Query\Sqlite\ConcatWs::class,
			'greatest' => \DoctrineExtensions\Query\Sqlite\Greatest::class,
			'ifelse' => \DoctrineExtensions\Query\Sqlite\IfElse::class,
			'ifnull' => \DoctrineExtensions\Query\Sqlite\IfNull::class,
			'least' => \DoctrineExtensions\Query\Sqlite\Least::class,
			'random' => Random::class,
			'replace' => \DoctrineExtensions\Query\Sqlite\Replace::class,
		];
		$this->registerStringFunctions($configurationDefinition, $stringFunctions);
	}

	private function registerPostgresqlFunctions(ServiceDefinition $configurationDefinition): void
	{
		$datetimeFunctions = [
			'date_format' => \DoctrineExtensions\Query\Postgresql\DateFormat::class,
			'at_time_zone' => AtTimeZoneFunction::class,
			'date_part' => DatePart::class,
			'extract' => ExtractFunction::class,
		];
		$this->registerDatetimeFunctions($configurationDefinition, $datetimeFunctions);

		$stringFunctions = [
			'str_to_date' => \DoctrineExtensions\Query\Postgresql\StrToDate::class,
			'count_filter' => CountFilterFunction::class,
			'string_agg' => StringAgg::class,
			'greatest' => \DoctrineExtensions\Query\Postgresql\Greatest::class,
			'least' => \DoctrineExtensions\Query\Postgresql\Least::class,
			'regexp_replace' => RegexpReplace::class,
		];
		$this->registerStringFunctions($configurationDefinition, $stringFunctions);
	}

}
