<?php

abstract class JiraType extends JiraElement {

    private $refClass = null;

    private $types = null;

    protected $name;

    protected $value;

    public final function __construct(){
        $args = func_get_args();
        switch(func_num_args()){
        case 0:
            $this->__call('__construct0', $args);
            break;
        case 2:
            $this->__call('__construct2', $args);
            break;
        default:
            throw new Exception('IlleagalArguments: ' . $args);
        }
    }

    private function __construct0(){
    }

    private function __construct2($name, $value){
        $this->name = $name;
        $this->value = $value;
    }

    protected function _valueOf($type){
        $refClass = $this->getReflectionClass();
        if($this->types === null){
            $this->types = $refClass->getConstants();
        }
        foreach($this->types as $name => $value){
            if($value === $type){
                $nameKey = $name . '_NAME';
                if($refClass->hasConstant($nameKey . '_NAME')){
                    return $this->newInstance($name, $refClass->getConstant($nameKey));
                }
                return $this->newInstance($name, $value);
            }
        }
        //throw new Exception('no such type: ' . $type . ' in ' . get_class($this));
        return $this->newInstance('', $value);
    }

    private function getReflectionClass(){
        if($this->refClass === null){
            $this->refClass = new ReflectionClass($this);
        }
        return $this->refClass;
    }

    private function newInstance(){
        return $this->getReflectionClass()->newInstanceArgs(func_get_args());
    }

    private function __call($method, $args){
        if(method_exists($this, $method)){
            return call_user_func_array(array($this, $method), $args);
        }
        throw new Exception('method invocation: ' . $method . '(' . $args . ')');
    }

}

