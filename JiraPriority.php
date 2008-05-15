<?php

class JiraPriority extends JiraType {

    const Blocker = 1;

    const Critical = 2;

    const Major = 3;

    const Minor = 4;

    const Trival = 5;

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

