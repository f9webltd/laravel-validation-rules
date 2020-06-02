<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Tests;

use F9Web\ValidationRules\Rules\HexColourCode;

class HexColourCodeTest extends TestCase
{
    /** @test */
    public function it_validates_short_format_codes()
    {
        $rule = (new HexColourCode())->shortFormat();

        $this->assertTrue($rule->passes('field', '#c00'));
        $this->assertFalse($rule->passes('field', '#cc0000'));
        $this->assertFalse($rule->passes('field', 'dklfhlhdsaf'));
        $this->assertFalse($rule->passes('field', '#'));
    }

    /** @test */
    public function it_validates_long_format_codes()
    {
        $rule = (new HexColourCode())->longFormat();

        $this->assertFalse($rule->passes('field', '#c00'));
        $this->assertFalse($rule->passes('field', '#c00'));
        $this->assertTrue($rule->passes('field', '#cc0000'));
        $this->assertFalse($rule->passes('field', 'cc0000'));
        $this->assertFalse($rule->passes('field', 'dklfhlhdsaf'));
        $this->assertFalse($rule->passes('field', '#'));
    }

    /** @test */
    public function it_validates_presence_of_the_prefix()
    {
        $rule = (new HexColourCode())->longFormat()->withPrefix();

        $this->assertFalse($rule->passes('field', '#c00'));
        $this->assertTrue($rule->passes('field', '#cc0000'));
        $this->assertFalse($rule->passes('field', 'cc0000'));
        $this->assertFalse($rule->passes('field', 'dklfhlhdsaf'));
        $this->assertFalse($rule->passes('field', '#'));

        $rule = (new HexColourCode())->longFormat()->withoutPrefix();

        $this->assertFalse($rule->passes('field', '#c00'));
        $this->assertTrue($rule->passes('field', '#cc0000'));
        $this->assertFalse($rule->passes('field', 'cc0000'));
        $this->assertFalse($rule->passes('field', 'dklfhlhdsaf'));
        $this->assertFalse($rule->passes('field', '#'));
    }

    /** @test */
    public function it_passes_relevant_data_to_the_validation_message()
    {
        $rule = (new HexColourCode());

        $rule->shortFormat()->withoutPrefix();
        $rule->passes('background', 'hey');

        $this->assertEquals(
            'The background must be a valid 3 length hex colour code',
            $rule->message()
        );

        $rule->longFormat()->withoutPrefix();

        $this->assertEquals(
            'The background must be a valid 6 length hex colour code',
            $rule->message()
        );

        $rule->longFormat()->withPrefix();

        $this->assertEquals(
            'The background must be a valid 6 length hex colour code, prefixed with the "#" symbol',
            $rule->message()
        );
    }
}
