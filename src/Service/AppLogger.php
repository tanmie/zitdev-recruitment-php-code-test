<?php

namespace App\Service;
use think\facade\Log;

class AppLogger
{
    const TYPE_LOG4PHP = 'log4php';

    private $logger;
    private $type;

    public function __construct($type = self::TYPE_LOG4PHP)
    {
        $this->type = $type;
        if ($type == self::TYPE_LOG4PHP) {
            \Logger::configure(
                array(
                    'rootLogger' => array(
                        'appenders' => array(
                            'myConsoleAppender',
                        ),
                        'level' => 'DEBUG'
                    ),
                    'appenders' =>[
                        'myConsoleAppender' => [
                            'class' => 'LoggerAppenderDailyFile',
                            'layout' => [
                                'class' => 'LoggerLayoutPattern',
                                'params' => [
                                    'conversionPattern' => '%date [%logger] %message%newline',
                                ],
                            ],
                            'params' => [
                                'file' => './logs/log4php/%s.log',
                                'datePattern' => 'Ymd',
                            ]
                        ]
                    ]
                )
            );
            $this->logger = \Logger::getLogger("Log");
//            $this->logger->assertLog(true,'isok');
        } else {
            $this->logger=Log::instance();
            $this->logger->init([
                'default' => 'file',
                'channels' => [
                    'file' => [
                        'type' => 'file',
                        'path' => './logs/think/',
                    ],
                ],
            ]);
        }
    }

    public function info($message = '')
    {
        $message = $this->LogFormat($this->type, $message);
        $this->logger->info($message);
    }

    public function debug($message = '')
    {
        $message = $this->LogFormat($this->type, $message);
        $this->logger->debug($message);
    }

    public function error($message = '')
    {
        $message = $this->LogFormat($this->type, $message);
        $this->logger->error($message);
    }

    /**
     * think-log时消息格式转换为大写
     * @param $type
     * @param $message
     * @return string
     */
    public function LogFormat($type, $message)
    {
        if ($type == self::TYPE_LOG4PHP) {
            return $message;
        }
        return strtoupper($message);
    }
}