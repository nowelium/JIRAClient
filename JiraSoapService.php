<?php

class JiraSoapService extends SoapClient {

    private $client;

    private $token;

    private static $defaultOptions = array(
        'soap_version' => SOAP_1_2,
        'encoding' => 'UTF-8',
        'exceptions' => true
    );

    /**
     * @param $address address in JIRA Service URI
     * @param $compression compression enabled to use compression of HTTP SOAP requests and responses
     */
    public function __construct($address, array $options = array()){
        $options = array_merge(self::$defaultOptions, $options);
        $options = array_merge($options,
            array(
                'location' => $address . 'rpc/soap/jirasoapservice-v2?wsdl',
                'uri' => $address . 'rpc/soap/jirasoapservice-v2',
            )
        );
        $options['compression'] = SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP;
        $this->client = new parent(null, $options);
    }

    public function __destruct(){
        $this->logout();
    }

    public function login($user, $password){
        try {
            $this->token = $this->client->login($user, $password);
        } catch(SoapFault $e){
            throw $e;
        }
    }

    public function getServerInfo(){
        return $this->client->getServerInfo();
    }

    public function logout(){
        $this->client->logout($this->token);
    }

    public function getComponents(JiraProject $project){
        $res = array();
        $components = $this->client->getComponents($this->token, $project->key);
        foreach($components as $component){
            $res[] = new JiraComponent($component);
        }
        return $res;
    }

    public function getVersions(JiraProject $project){
        $res = array();
        $versions = $this->client->getVersions($this->token, $project->key);
        foreach($versions as $version){
            $res[] = new JiraVersion($version);
        }
        return $res;
    }

    public function addVersion(JiraProject $project, JiraVersion $version){
        $this->client->addVersion($this->token, $project->key, $version->toArray());
    }

    public function updateVersion(JiraVersion $version){
    }

    public function getIssue($key){
        return new JiraIssue($this->client->getIssue($this->token, $key));
    }

    public function createIssue(JiraProject $project, JiraIssue $issue){
        if(!($issue->type instanceof JiraIssueType)){
            $issue->type = JiraIssueType::valueOf($issue->type)->value;
        }
        if(!($issue->status instanceof JiraStatus)){
            $issue->status = JiraStatus::valueOf($issue->status)->value;
        }
        $query = array_merge($issue->toArray(), array('project' => $project->key));
        return $this->client->createIssue($this->token, $query);
    }

    public function updateIssue(JiraIssue $issue){
        $query = array_merge($issue->toArray(), array('project' => $issue->project));
        return $this->client->updateIssue($this->token, $query);
    }

    public function addComment(JiraIssue $issue, $comment){
        return $this->client->addComment($this->token, array($issue->key, array('body' => $comment)));
    }

    public function getProject($key){
        return new JiraProject($this->client->getProjectByKey($key));
    }

    public function getProjects(){
        $res = array();
        $projects = $this->client->getProjects($this->token);
        foreach($projects as $project){
            $res[] = new JiraProject($project);
        }
        return $res;
    }

    public function findProject($name){
        $projects = $this->getProjects();
        foreach($projects as $project){
            if(strcasecmp($project->name, $name) === 0){
                return $project;
            }
            if(strcasecmp($project->key, $name) === 0){
                return $project;
            }
        }
        return null;
    }
}

