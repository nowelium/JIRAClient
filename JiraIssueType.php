<?php

class JiraIssueType extends JiraType {

    const Bug = 1;

    const NewFeature = 2;
    const NewFeature_NAME = 'New Feature';

    const Task = 3;

    const Improvement = 4;

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

