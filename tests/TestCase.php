<?php

namespace Tests;

use Tests\Utils\HandlesExceptions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, HandlesExceptions;
}
