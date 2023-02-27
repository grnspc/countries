<?php

namespace Grnspc\Country\Tests;

use PHPUnit\Framework\TestCase as FrameworkTestCase;
use Grnspc\Country\CountryServiceProvider;

abstract class TestCase extends FrameworkTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            CountryServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
