<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Tests;

use F9Web\ValidationRules\Exceptions\DomainWhitelistException;
use F9Web\ValidationRules\Rules\DomainRestrictedEmail;
use stdClass;

class DomainRestrictedEmailTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = (new DomainRestrictedEmail())->validDomains(
            [
                'f9web.co.uk',
                'laravel.com',
            ]
        );
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
        $this->rule->passes('email', 'abc');
        $this->assertEquals(
            'The email must be an email address ending with any of the following domains: @f9web.co.uk, @laravel.com',
            $this->rule->message()
        );
    }

    /** @test */
    public function it_throws_an_exception_when_the_whitelist_is_empty()
    {
        $this->expectException(DomainWhitelistException::class);

        (new DomainRestrictedEmail())->passes('email', 'abc');
    }

    /**
     * @return array|\string[][]
     */
    public function sampleDataProvider(): array
    {
        return [
            ['rob@laravel.com', true],
            ['rob@f9web.co.uk', true],
            ['rob@gmail.com', false],
            ['user.name@domain.co.uk', false],
            ['232323', false],
            [new stdClass, false],
            [['123'], false],
        ];
    }
}
