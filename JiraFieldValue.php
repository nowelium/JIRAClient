<?php

class JiraFieldValue extends JiraElement {

    protected $customfieldId;

    protected $key;

    protected $values = array();

    public function __construct($fieldValue = null){
        if($fieldValue !== null){
            foreach($fieldValue as $key => $value){
                $this->$key = $value;
            }
        }
    }
}
