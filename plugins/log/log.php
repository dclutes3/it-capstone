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

    //creates a warning log statement to push to the capstone.log file
    public function warning($statement){
        $this->log->warning($statement);
    }

    //creates an error log statement to push to the capstone.log file
    public function error($statement){
        $this->log->error($statement);
    }
}