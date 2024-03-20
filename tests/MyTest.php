<?php

namespace Tests;

use PHPStan\Testing\TypeInferenceTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class MyTest extends TypeInferenceTestCase
{
	#[DataProvider('_provideDataFileAsserts')]
	public function test_type_inference(
		string $assertType,
		string $file,
		...$args
	): void {
		$this->assertFileAsserts($assertType, $file, ...$args);
	}

	public static function _provideDataFileAsserts(): iterable
	{
		yield from self::gatherAssertTypes(__DIR__.'/ProphesizeFixture.php');
	}
}