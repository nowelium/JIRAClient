<?php

class JiraScheme extends JiraElement {

    protected $description;

    protected $id;

    protected $name;

    protected $permissionMappings = array();

    protected $type;

    public function __construct($scheme = null){
        if($scheme !== null){
            foreach($scheme as $key => $value){
                $this->$key = $value;
            }
        }
    }
}
