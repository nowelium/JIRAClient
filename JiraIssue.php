<?php

class JiraIssue extends JiraElement {

    protected $affectsVersions = array();

    protected $assignee;

    protected $attachmentNames = array();

    protected $components = array();

    protected $created;

    protected $customFieldValues = array();

    protected $description;

    protected $duedate;

    protected $environment;

    protected $fixVersions;

    protected $id;

    protected $key;

    protected $priority;

    protected $project;

    protected $reporter;

    protected $resolution;

    protected $status;

    protected $summary;

    protected $type;

    protected $updated;

    protected $votes;

    public function __construct($issue = null){
        if($issue !== null){
            foreach($issue as $key => $value){
                if(strcmp($key, 'affectsVersions') === 0){
                    foreach($value as $version){
                        $this->addAffectsVersion(new JiraVersion($version));
                    }
                    continue;
                }
                if(strcmp($key, 'components') === 0){
                    foreach($value as $component){
                        $this->addComponent(new JiraComponent($component));
                    }
                    continue;
                }
                if(strcmp($key, 'customFieldValues') === 0){
                    foreach($value as $fieldValue){
                        $this->addCustomFieldValue(new JiraFieldValue($fieldValue));
                    }
                    continue;
                }
                if(strcmp($key, 'fixVersions') === 0){
                    foreach($value as $fixVersion){
                        $this->addFixVersion(new JiraVersion($fixVersion));
                    }
                    continue;
                }
                if(strcmp($key, 'priority') === 0){
                    $this->$key = JiraPriority::valueOf($value);
                    continue;
                }
                if(strcmp($key, 'status') === 0){
                    $this->$key = JiraStatus::valueOf($value);
                    continue;
                }
                if(strcmp($key, 'type') === 0){
                    $this->$key = JiraIssueType::valueOf($value);
                    continue;
                }
                $this->$key = $value;
            }
        }
    }

    public function addAffectsVersion(JiraVersion $version){
        $this->affectsVersions[] = $version;
    }

    public function setAffectsVersions(array $versions){
        $this->affectsVersions = array();
        foreach($versions as $version){
            $this->addAffectsVersion($version);
        }
    }

    public function addComponent(JiraComponent $component){
        $this->components[] = $component;
    }

    public function setComponents(array $components){
        $this->components = array();
        foreach($components as $component){
            $this->addComponent($component);
        }
    }

    public function addCustomFieldValue(JiraFieldValue $fieldValue){
        $this->customFieldValues[] = $fieldValue;
    }

    public function setCustomFieldValues(array $fieldValues){
        $this->customFieldValues = array();
        foreach($fieldValues as $fieldValue){
            $this->addCustomFieldValue($fieldValue);
        }
    }

    public function addFixVersion(JiraVersion $version){
        $this->fixVersions[] = $version;
    }

    public function setFixVersions(array $fixVersions){
        $this->fixVersions = array();
        foreach($fixVersions as $fixVersion){
            $this->addFixVersion($fixVersion);
        }
    }
}

