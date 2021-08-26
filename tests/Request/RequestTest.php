<?php

namespace SecavisWrapper\SecavisPHP\Tests\Request;

use PHPUnit\Framework\TestCase;
use SecavisWrapper\SecavisPHP\Request\Request;

class RequestTest extends TestCase
{
    public function testSend(): void
    {
        $this->expectException(\Exception::class);
        Request::send('test', 'test', 'test');
    }

}
