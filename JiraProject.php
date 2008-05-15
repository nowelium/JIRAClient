<?php

class JiraProject extends JiraElement {
    
    protected $description;

    protected $id;

    protected $issueSecurityScheme;

    protected $key;

    protected $lead;

    protected $name;

    protected $notificationScheme;

    protected $permissionScheme;

    protected $projectUrl;

    protected $url;

    public function __construct($project = null){
        if($project !== null){
            foreach($project as $key => $value){
                if(strcmp($key, 'issueSecurityScheme') === 0){
                    $this->$key = new JiraScheme($value);
                    continue;
                }
                if(strcmp($key, 'notificationScheme') === 0){
                    $this->$key = new JiraScheme($value);
                    continue;
                }
                if(strcmp($key, 'permissionScheme') === 0){
                    $this->$key = new JiraScheme($value);
                    continue;
                }
                $this->$key = $value;
            }
        }
    }
}

?>
