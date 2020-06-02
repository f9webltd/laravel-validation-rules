<?php

namespace F9Web\ValidationRules\Tests;

use F9Web\ValidationRules\ValidationRulesServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    /** @var \Illuminate\Validation\Rule */
    protected $rule;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @param  \Illuminate\Foundation\Application  $app
     * @return array|string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            ValidationRulesServiceProvider::class,
        ];
    }
}
