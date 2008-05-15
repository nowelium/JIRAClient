<?php

class JiraComponent extends JiraElement {

    protected $id;

    protected $name;

    public function __construct($component = null){
        if($component != null){
            foreach($component as $key => $value){
                $this->$key = $value;
            }
        }
    }
}

