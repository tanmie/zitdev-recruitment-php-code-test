<?php

namespace Test\Service;

use PHPUnit\Framework\TestCase;
use App\Service\AppLogger;

/**
 * Class ProductHandlerTest
 */
class AppLoggerTest extends TestCase
{
    /**
     * log4php 单元测试
     */
    public function testInfoLog()
    {
        $logger = new AppLogger('log4php');
        $logger->info('This is info log message');
        $this->assertFileExists('./logs/log4php/'.date('Ymd'). '.log');
    }

    /**
     * Think-Log 单元测试
     */
    public function testThinkLog(){
        $logger = new AppLogger('think-log');
        $logger->info('This is think log message');
        $this->assertFileExists('./logs/think/'.date('Ym') . DIRECTORY_SEPARATOR . date('d'). '_cli.log');
    }
}