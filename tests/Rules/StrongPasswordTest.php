<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Tests;

use F9Web\ValidationRules\Rules\StrongPassword;

class StrongPasswordTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new StrongPassword();
    }

    /** @test */
    public function it_validates_the_minimum_length()
    {
        $this->rule
            ->reset()
            ->min(10);

        $this->assertFalse($this->rule->passes('password', 'laravel'));
        $this->assertTrue($this->rule->passes('password', 'laravel is cool'));
    }

    /** @test */
    public function it_validates_letter_casing()
    {
        $this->rule
            ->reset()
            ->min(1)
            ->forceUppercaseCharacters()
            ->forceLowercaseCharacters();

        $this->assertFalse($this->rule->passes('password', 'laravel7seven'));
        $this->assertFalse($this->rule->passes('password', 'ABCABCABCABC'));
        $this->assertTrue($this->rule->passes('password', 'Laravelseven'));
        $this->assertTrue($this->rule->passes('password', 'Laravel seven'));
        $this->assertTrue($this->rule->passes('password', 'AKJG-HHAKHJGsddd£&^%'));
    }

    /** @test */
    public function it_validates_numbers()
    {
        $this->rule
            ->reset()
            ->min(1)
            ->forceNumbers();

        $this->assertFalse($this->rule->passes('password', 'laravelseven'));
        $this->assertTrue($this->rule->passes('password', 'Laravel7788'));
        $this->assertTrue($this->rule->passes('password', 'Laravel 7'));
    }

    /** @test */
    public function it_determines_the_presence_of_special_characters()
    {
        $this->rule
            ->reset()
            ->min(1)
            ->forceSpecialCharacters();

        $this->assertFalse($this->rule->passes('password', 'PassW032148'));
        $this->assertTrue($this->rule->passes('password', 'PassW%^*%*032148'));

        $this->rule->withSpecialCharacters('£$');

        $this->assertFalse($this->rule->passes('password', 'PassW^**032148'));
        $this->assertTrue($this->rule->passes('password', 'Pas$sW%^**032148'));
    }

    /** @test */
    public function it_passes_relevant_attributes_to_the_validation_message()
    {
        $this->rule
            ->reset()
            ->min(8)
            ->withSpecialCharacters('$£*&')
            ->forceNumbers()
            ->forceUppercaseCharacters()
            ->forceLowercaseCharacters()
            ->forceSpecialCharacters();

        $this->rule->passes('password', 'pass');

        $this->assertEquals(
            'The password has failed the security checks and must be, at least 8 characters long, include an uppercase letter, include a lowercase letter, include numbers, include at least one special character ($£*&)',
            $this->rule->message()
        );

        $this->rule
            ->forceNumbers(false)
            ->forceSpecialCharacters(false);

        $this->assertEquals(
            'The password has failed the security checks and must be, at least 8 characters long, include an uppercase letter, include a lowercase letter',
            $this->rule->message()
        );
    }
}
