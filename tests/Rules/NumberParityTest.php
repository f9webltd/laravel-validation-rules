<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Tests;

use F9Web\ValidationRules\Exceptions\NumberParityException;
use F9Web\ValidationRules\Rules\NumberParity;
use stdClass;

class NumberParityTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new NumberParity();
    }

    /** @test */
    public function it_throws_an_exception_when_no_mode_is_defined()
    {
        $this->expectException(NumberParityException::class);
        $this->expectExceptionMessage('Ensure the "odd()" or "even()" methods are called');

        $this->rule->passes('field', 1);
    }

    /**
     * @test
     * @dataProvider evenNumbersDataProvider
     * @param  mixed  $value
     * @param  bool  $shouldBeValid
     */
    public function it_validates_even_numbers($value, bool $shouldBeValid)
    {
        $this->rule->even();

        $result = $this->rule->passes('field', $value);

        $this->{$shouldBeValid ? 'assertTrue' : 'assertFalse'}($result);
    }

    /**
     * @test
     * @dataProvider oddNumbersDataProvider
     * @param  mixed  $value
     * @param  bool  $shouldBeValid
     */
    public function it_validates_odd_numbers($value, bool $shouldBeValid)
    {
        $this->rule->odd();

        $result = $this->rule->passes('field', $value);

        $this->{$shouldBeValid ? 'assertTrue' : 'assertFalse'}($result);
    }

    /** @test */
    public function it_passes_relevant_data_to_the_validation_message()
    {
        $this->rule->even();
        $this->rule->passes('quantity', 'abc');
        $this->assertEquals('The quantity must be an even number', $this->rule->message());

        $this->rule->odd();
        $this->assertEquals('The quantity must be an odd number', $this->rule->message());
    }

    /**
     * @return array|\string[][]
     */
    public function evenNumbersDataProvider(): array
    {
        return [
            ['1', false],
            ['2', true],
            ['100', true],
            [-4, true],
            [0, true],
            [2.8, false],
            [82, true],
            [178, true],
            ['232323', false],
            [new stdClass, false],
            [['123'], false],
        ];
    }

    /**
     * @return array|\string[][]
     */
    public function oddNumbersDataProvider(): array
    {
        return [
            ['1', true],
            ['2', false],
            ['100', false],
            [2.8, false],
            [10, false],
            ['232323', true],
            ['-5', true],
            [-5, true],
            [3, true],
            [29, true],
            [73, true],
        ];
    }
}
