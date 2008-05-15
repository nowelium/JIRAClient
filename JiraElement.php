<?php

abstract class JiraElement implements Serializable {

    public function __set($name, $params){
        $this->__check($name);
        $this->$name = $params;
    }

    public function __get($name){
        $this->__check($name);
        return $this->$name;
    }

    public function __toString(){
        $buf = '';
        foreach($this as $property => $value){
            $buf .= $property . '=>' . (string) $value . PHP_EOL;
        }
        return $buf;
    }

    public function __isset($name){
        return $this->$name !== null;
    }

    public function __unset($name){
        $this->__check($name);
        unset($this->$name);
    }

    private function __check($name){
        if(property_exists($this, $name) === false){
            throw new Exception('property not found, property name: ' . $name . ' in ' . get_class($this));
        }
    }

    public function toArray(){
        $array = array();
        foreach($this as $property => $value){
            $v = $value;
            if($value instanceof self){
                $v = $value->toArray();
            }
            $array[$property] = $v;
        }
        return $array;
    }

    public function serialize(){
        return serialize($this->toArray());
    }

    public function unserialize($serialized){
        $array = unserialize($serialized);
        foreach($array as $name => $value){
            $this->$name = $value;
        }
        return $this;
    }

}
