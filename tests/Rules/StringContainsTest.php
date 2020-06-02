<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Tests;

use F9Web\ValidationRules\Exceptions\StringContainsException;
use F9Web\ValidationRules\Rules\StringContains;

class StringContainsTest extends TestCase
{
    /** @test */
    public function it_validates_phrases_loosely()
    {
        $rule = (new StringContains())
            ->phrases(
                [
                    'hello',
                    'php',
                ]
            )->loosely();

        $this->assertTrue($rule->passes('field', 'ok, hello?'));
        $this->assertTrue($rule->passes('field', 'php'));
    }

    /** @test */
    public function it_validates_phrases_strictly()
    {
        $rule = (new StringContains())
            ->phrases(
                [
                    'Hello',
                    'php',
                    'laravel',
                ]
            )->strictly();

        $this->assertTrue($rule->passes('field', 'Hello laravel is a php?'));
        $this->assertFalse($rule->passes('field', 'Hello laravel'));
    }

    /** @test */
    public function it_passes_relevant_data_to_the_validation_message()
    {
        $rule = (new StringContains())
            ->phrases(
                [
                    'hello',
                    'php',
                    'laravel',
                ]
            );

        $rule->strictly();

        $rule->passes('body', 'hey');

        $this->assertEquals(
            'The body must contain all of the following phrases: "hello", "php", "laravel"',
            $rule->message()
        );

        $rule->loosely();

        $rule->passes('body', 'hello laravel');

        $this->assertEquals(
            'The body must contain at least one of the following phrases: "hello", "php", "laravel"',
            $rule->message()
        );
    }

    /** @test */
    public function it_throws_an_exception_when_zero_phrases_are_provided()
    {
        $this->expectException(StringContainsException::class);

        (new StringContains())->passes('email', 'abc');
    }
}
