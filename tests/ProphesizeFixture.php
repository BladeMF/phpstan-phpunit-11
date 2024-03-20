<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use function PHPStan\Testing\assertType;
use Prophecy\Prophet;
use stdClass;

class ProphesizeFixture extends TestCase
{
	use ProphecyTrait;

	public function return_value_of_prophesize_of_prophet(Prophet $p): void
	{
		assertType(
			ObjectProphecy::class.'<'.TestCase::class.'>',
			$p->prophesize(TestCase::class)
		);
	}

	public function return_value_of_prophesize_of_test_case(): void
	{
		assertType(
			ObjectProphecy::class.'<'.ProphesizeFixture::class.'>',
			$this->prophesize(ProphesizeFixture::class)
		);
	}

	public function with_no_arguments(): void
	{
		assertType(
			ObjectProphecy::class.'<>',
			$this->prophesize()
		);
	}

	public function with_object(): void
	{
		$class = new stdClass();
		assertType(
			ObjectProphecy::class.'<'.stdClass::class.'>',
			$this->prophesize($class) // @phpstan-ignore-line
		);
	}

	public function with_static(): void
	{
		assertType(
			ObjectProphecy::class.'<static('.__CLASS__.')>',
			$this->prophesize(static::class)
		);
	}

	public function with_self(): void
	{
		assertType(
			ObjectProphecy::class.'<'.__CLASS__.'>',
			$this->prophesize(self::class)
		);
	}

	public function with_variable_class(): void
	{
		$class = new stdClass();
		assertType(
			ObjectProphecy::class.'<'.stdClass::class.'>',
			$this->prophesize($class::class)
		);
	}

	public function with_variable_class_string(): void
	{
		/** @var class-string<string> $class */
		$class = 'stdClass';
		assertType(
			ObjectProphecy::class.'<object>',
			$this->prophesize($class)
		);
	}
	/**
	 * @template-covariant T of object
	 * @param class-string<T> $param
	 */
	public function with_argument_with_generic_class_string(string $param): void
	{
		assertType(
			ObjectProphecy::class.'<T of object (method '.__METHOD__.'(), argument)>',
			$this->prophesize($param)
		);
	}

	/**
	 * @template T
	 * @param class-string<T> $param
	 */
	public function with_argument_with_generic_class_string_2(string $param): void
	{
		assertType(
			ObjectProphecy::class.'<T (method '.__METHOD__.'(), argument)>',
			$this->prophesize($param)
		);
	}
}