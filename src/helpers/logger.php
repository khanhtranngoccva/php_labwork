<?php

namespace Project\Helpers;
require_once(__DIR__ . "/../../vendor/autoload.php");

use DateTimeZone;

$log = new \Monolog\Logger("main");
$log->pushHandler(new \Monolog\Handler\StreamHandler('php://stdout'));

class Logger extends \Monolog\Logger
{
    public function __construct(string $name = "main", array $handlers = [], array $processors = [], ?DateTimeZone $timezone = null)
    {
        parent::__construct($name, $handlers, $processors, $timezone);
        $this->pushHandler(new \Monolog\Handler\StreamHandler('php://stdout'));
    }

    static function _get_output($data): string
    {
        if (is_string($data)) {
            return $data;
        }
        return var_export($data, true);
    }

    function info($message, array $context = []): void
    {
        $output = Logger::_get_output($message);
        parent::info($output);
    }

    public function warning($message, array $context = []): void
    {
        $output = Logger::_get_output($message);
        parent::warning($output);
    }

    public function error($message, array $context = []): void
    {
        $output = Logger::_get_output($message);
        parent::error($output);
    }
}
