<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Job
 *
 * @author Tristan Ackermann
 */
class Job {
    
    private $ref;
    private $desc;
    private $category;
    private $client;
    private $priority;
    private $dueDate;
    private $status;
    private $lastUpdated;
    private $created;
    
    public function __construct($ref, $desc, $category, $client, $priority, $dueDate, $status, $lastUpdated, $created) {
        $this->ref = $ref;
        $this->desc = $desc;
        $this->category = $category;
        $this->client = $client;
        $this->priority = $priority;
        $this->dueDate = $dueDate;
        $this->status = $status;
        $this->lastUpdated = $lastUpdated;
        $this->created = $created;
    }
    
    public function getRef() {
        return $this->ref;
    }

    public function getDesc() {
        return $this->desc;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getClient() {
        return $this->client;
    }

    public function getPriority() {
        return $this->priority;
    }

    public function getDueDate() {
        return $this->dueDate;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getLastUpdated() {
        return $this->lastUpdated;
    }

    public function getCreated() {
        return $this->created;
    }

    public function setRef($ref) {
        $this->ref = $ref;
    }

    public function setDesc($desc) {
        $this->desc = $desc;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function setClient($client) {
        $this->client = $client;
    }

    public function setPriority($priority) {
        $this->priority = $priority;
    }

    public function setDueDate($dueDate) {
        $this->dueDate = $dueDate;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setLastUpdated($lastUpdated) {
        $this->lastUpdated = $lastUpdated;
    }

    public function setCreated($created) {
        $this->created = $created;
    }

    public function toJobHeaderHTML() {
        return '';
    }
}
