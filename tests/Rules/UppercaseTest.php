<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Tests;

use F9Web\ValidationRules\Rules\Uppercase;
use stdClass;

class UppercaseTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new Uppercase();
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
        $this->rule = new Uppercase();
        $this->rule->passes('title', 'abc');
        $this->assertEquals('The title field must only contain uppercase characters', $this->rule->message());
    }

    /**
     * @return array|\string[][]
     */
    public function sampleDataProvider(): array
    {
        return [
            ['ABC', true],
            ['abc', false],
            ['ABC 123', true],
            ['ABCa bc', false],
            ['ABCa DSKGDs bc', false],
            ['abcdéf G', false],
            ['ABCDÉF G', true],
            ['SPA CES', true],
            ['spa ces', false],
            ['This is a sentence', false],
            ['THIS IS A SENTENCE', true],
            [new stdClass, false],
            [['123'], false],
        ];
    }
}
