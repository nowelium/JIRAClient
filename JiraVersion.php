<?php

class JiraVersion extends JiraElement {

    protected $archived = false;
    
    protected $id;
    
    protected $name;
    
    protected $releaseDate;
    
    protected $released = false;
    
    protected $sequence;

    public function __construct($version = null){
        if($version != null){
            foreach($version as $key => $value){
                $this->$key = $value;
            }
        }
    }
}

