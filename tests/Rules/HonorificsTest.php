<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Tests;

use F9Web\ValidationRules\Rules\Honorific;

class HonorificsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new Honorific();
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
        $this->rule->passes('honorific_title', 'abc');
        $this->assertEquals('The honorific_title must be a valid honorific', $this->rule->message());
    }

    /**
     * @return array|\string[][]
     */
    public function sampleDataProvider(): array
    {
        return [
            ['Mr.', true],
            ['mr', true],
            ['abc', false],
            ['Mr .', false],
            ['The Right Honourable', true],
        ];
    }
}
