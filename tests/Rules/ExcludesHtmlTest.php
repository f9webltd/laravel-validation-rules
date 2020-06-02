<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Tests;

use F9Web\ValidationRules\Rules\ExcludesHtml;

class ExcludesHtmlTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new ExcludesHtml();
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
        $this->rule->passes('quantity', '<p>tag</p>');
        $this->assertEquals('The quantity contains html', $this->rule->message());
    }

    /**
     * @return array|\string[][]
     */
    public function sampleDataProvider(): array
    {
        return [
            ['some text', true],
            ['<h1>title</h1>', false],
            ['<h1>title</h1>', false],
            ['h1titleh1', true],
        ];
    }
}
