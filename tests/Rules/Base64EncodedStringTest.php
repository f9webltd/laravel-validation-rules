<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Tests;

use F9Web\ValidationRules\Rules\Base64EncodedString;

use function str_replace;

class Base64EncodedStringTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new Base64EncodedString();
    }

    /**
     * @test
     * @dataProvider sampleDataProvider
     * @param  mixed  $value
     * @param  bool  $shouldBeValid
     */
    public function it_validates_strings_as_expected($value, bool $shouldBeValid)
    {
        $result = $this->rule->passes('base64', $value);

        $this->{$shouldBeValid ? 'assertTrue' : 'assertFalse'}($result);
    }

    /** @test */
    public function it_passes_relevant_data_to_the_validation_message()
    {
        $this->rule->passes('hash', 'abc');
        $this->assertEquals(
            'The hash must be a valid base64 encoded string',
            $this->rule->message()
        );
    }

    /**
     * @return array|\string[][]
     */
    public function sampleDataProvider(): array
    {
        return [
            ['bGFyYXZlbA==', true],
            ['bGFyYXZlbCBpcyBzbyBjb29s', true],
            [
                $long = 'SGF2ZSB0byBkZWFsIHdpdGggQmFzZTY0IGZvcm1hdD8gVGhlbiB0aGlzIHNpdGUgaXMgbWFkZSBmb3IgeW91ISBVc2Ugb3VyIHN1cGVyIGhhbmR5IG9ubGluZSB0b29sIHRvIGRlY29kZSBvciBlbmNvZGUgeW91ciBkYXRhLg==',
                true,
            ],
            [str_replace('==', '', $long), false],
            ['b', false],
            ['super', false],
            ['11111111111111', false],
            ['a==', false],
            ['MA=', false],
            ['ok?', false],
            ['a+b+c=d', false],
        ];
    }
}
