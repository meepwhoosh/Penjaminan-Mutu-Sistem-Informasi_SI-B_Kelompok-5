<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Force synchronous queue and a non-blocking mailer for tests
        config(['queue.default' => 'sync']);
        config(['mail.default' => 'log']);
    }
}
