<?php

class JiraStatus extends JiraType {

    const Open = 0;

    const InProgress = 1;
    const InProgress_NAME = 'In Progress';

    const Reopened = 2;

    const Resolved = 3;

    const Closed = 4;

    private static $instance = null;

    public static function valueOf($type){
        return self::getInstance()->_valueOf((integer) $type);
    }

    private static function getInstance(){
        if(self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }
}

