<?php 
require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log{
    private $log;

    public function __construct($name){
        $this->log = new Logger($name);
        $this->log->pushHandler(new StreamHandler('/var/log/capstone/capstone.log',Logger::WARNING));
    }

    public function warning($statement){
        $this->log->warning($statement);
    }

    public function error($statement){
        $this->log->error($statement);
    }
}