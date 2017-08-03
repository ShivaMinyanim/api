<?php

namespace Tests;

use Tests\utils\InteractsWithJson;
use Tests\utils\CreatesApplication;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, InteractsWithJson;
}
