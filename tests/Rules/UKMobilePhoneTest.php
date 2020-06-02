<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Tests;

use F9Web\ValidationRules\Rules\UKMobilePhone;

class UKMobilePhoneTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new UKMobilePhone();
    }

    /**
     * @test
     * @dataProvider sampleDataProvider
     * @param  mixed  $value
     * @param  bool  $shouldBeValid
     */
    public function it_validates_data_as_expected($value, bool $shouldBeValid)
    {
        $result = $this->rule->passes('mobile', $value);

        $this->{$shouldBeValid ? 'assertTrue' : 'assertFalse'}($result);
    }

    /** @test */
    public function it_passes_relevant_data_to_the_validation_message()
    {
        $this->rule->passes('mobile', 'abc');
        $this->assertEquals(
            'The mobile must be a valid UK mobile number',
            $this->rule->message()
        );
    }

    /**
     * @return array|\string[][]
     */
    public function sampleDataProvider(): array
    {
        return [
            ['07222 555555', true],
            ['7222555555', false],
            ['(07222) 555555', true],
            ['+44 7222 555 555', true],
            ['+44 7222555555', true],
            ['+447222555555', true],
            ['7222 555555', false],
            ['+44 07222 555555', false],
            ['(+447222) 555555', false],
            ['7222 555555', false],
            ['7222555555', false],
        ];
    }
}
