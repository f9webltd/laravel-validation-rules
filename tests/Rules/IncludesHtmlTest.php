<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Tests;

use F9Web\ValidationRules\Rules\IncludesHtml;

class IncludesHtmlTestTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new IncludesHtml();
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
        $this->rule->passes('body', '<p>tag</p>');
        $this->assertEquals('The body must contain html', $this->rule->message());
    }

    /**
     * @return array|\string[][]
     */
    public function sampleDataProvider(): array
    {
        return [
            ['some text', false],
            ['<h1>title</h1>', true],
            ['h1titleh1', false],
        ];
    }
}
