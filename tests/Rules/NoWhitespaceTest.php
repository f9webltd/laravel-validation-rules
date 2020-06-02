<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Tests;

use F9Web\ValidationRules\Rules\NoWhitespace;

class NoWhitespaceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new NoWhitespace();
    }

    /**
     * @test
     * @dataProvider sampleDataProvider
     * @param  mixed  $value
     * @param  bool  $shouldBeValid
     */
    public function it_validates_strings_as_expected($value, bool $shouldBeValid)
    {
        $result = $this->rule->passes('field', $value);

        $this->{$shouldBeValid ? 'assertTrue' : 'assertFalse'}($result);
    }

    /** @test */
    public function it_passes_relevant_data_to_the_validation_message()
    {
        $this->rule->passes('quantity', 'abc ');
        $this->assertEquals('The quantity cannot contain spaces', $this->rule->message());
    }

    /**
     * @return array|\string[][]
     */
    public function sampleDataProvider(): array
    {
        return [
            ['abc', true],
            ['abc de', false],
            ['abc d e ', false],
            ['abc ', false],
            [' abc', false],
            ['1234abc56def', true],
            ['1234ab c56def', false],
        ];
    }
}
