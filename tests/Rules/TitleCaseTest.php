<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Tests;

use F9Web\ValidationRules\Rules\TitleCase;
use stdClass;

class TitleCaseTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new TitleCase();
    }

    /**
     * @test
     * @dataProvider sampleDataProvider
     * @param  mixed  $value
     * @param  bool  $shouldBeValid
     */
    public function it_validates_strings_as_expected($value, bool $shouldBeValid)
    {
        $this->rule = new TitleCase();

        $result = $this->rule->passes('field', $value);

        $this->{$shouldBeValid ? 'assertTrue' : 'assertFalse'}($result);
    }

    /** @test */
    public function it_passes_relevant_data_to_the_validation_message()
    {
        $this->rule = new TitleCase();
        $this->rule->passes('city', 'thanks for that');
        $this->assertEquals('The city must be in title case form', $this->rule->message());
    }

    /**
     * @return array|\string[][]
     */
    public function sampleDataProvider(): array
    {
        return [
            ['It’s Not A Bug. It’s A Feature!', true],
            ['It’s not a bug. It’s a feature!', false],
            ['Éasy money', false],
            ['Éasy Money', true],
            ['A', true],
            ['a', false],
            [new stdClass, false],
            [['123'], false],
        ];
    }
}
