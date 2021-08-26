<?php

namespace SecavisWrapper\SecavisPHP\Tests\Request;

use PHPUnit\Framework\TestCase;
use SecavisWrapper\SecavisPHP\Request\Request;

class RequestTest extends TestCase
{
    public function testSend(): void
    {
        $this->assertInstanceOf(\DOMDocument::class, Request::send('test', 'test', 'test'));
    }

}
