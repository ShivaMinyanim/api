<?php

namespace Tests\Feature;

use Tests\Utils\HandlesExceptions;
use Tests\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class TestCase extends BaseTestCase
{
    use HandlesExceptions, DatabaseMigrations;
}
