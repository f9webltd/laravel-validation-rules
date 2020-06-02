<?php

declare(strict_types=1);

namespace F9Web\ValidationRules\Tests;

use F9Web\ValidationRules\Rules\Coordinate;

class CoordinateTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new Coordinate();
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
        $this->rule->passes('location', 'abc');
        $this->assertEquals(
            'The location must be a valid set of comma separated coordinates i.e. 27.666530,-97.367170',
            $this->rule->message()
        );
    }

    /**
     * @return array|\string[][]
     */
    public function sampleDataProvider(): array
    {
        return [
            ['ABC,DEF', false],
            ['123', false],
            ['51.507877,-0.087732', true],
            ['51.507877, -0.087732', true],
            ['47.1,179.1', true],
            ['-9995555599.111,-555559999.22', false],
            ['90.1a,180.1a', false],
            ['27.666530,-97.367170', true],
        ];
    }
}
