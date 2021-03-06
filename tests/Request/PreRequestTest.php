<?php

namespace SecavisWrapper\SecavisPHP\Tests\Request;

use PHPUnit\Framework\TestCase;
use SecavisWrapper\SecavisPHP\Request\PreRequest;

class PreRequestTest extends TestCase
{
    public function testSend(): void
    {
        $this->assertTrue(\is_string(PreRequest::send('test', 'test', 'test')));
    }

}
