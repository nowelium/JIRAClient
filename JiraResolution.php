<?php

class JiraResolution extends JiraType {

    const Fixed = 0;

    const WontFix = 1;
    const WontFix_NAME = 'Won\'t Fix';

    const Duplicate = 2;

    const Incomplete = 3;

    const CannotReproduce = 4;
    const CannotReproduce_NAME = 'Cannot Reproduce';

    private static $instance = null;

    public static function valueOf($type){
        return self::getInstance()->valueOf((integer) $type);
    }

    private static function getInstance(){
        if(self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }
}

