<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Tests;

use F9Web\ValidationRules\Rules\EvenNumber;
use stdClass;

class EvenNumberTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new EvenNumber();
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
        $this->rule->passes('quantity', 'abc');
        $this->assertEquals('The quantity must be an even number', $this->rule->message());
    }

    /**
     * @return array|\string[][]
     */
    public function sampleDataProvider(): array
    {
        return [
            ['1', false],
            ['2', true],
            ['100', true],
            [2.8, false],
            ['232323', false],
            [new stdClass, false],
            [['123'], false],
        ];
    }
}
