<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Update
 *
 * @author Tristan Ackermann
 */
class Update {
    
    private $milestoneName;
    private $milestoneDateTime;
    private $clientFeedback;
    private $technicianFeedback;
    
    public function __construct($milestoneName, $milestoneDateTime, $clientFeedback, $technicianFeedback) {
        $this->milestoneName = $milestoneName;
        $this->milestoneDateTime = $milestoneDateTime;
        $this->clientFeedback = $clientFeedback;
        $this->technicianFeedback = $technicianFeedback;
    }

    public function getMilestoneName() {
        return $this->milestoneName;
    }

    public function getMilestoneDateTime() {
        return $this->milestoneDateTime;
    }

    public function getClientFeedback() {
        return $this->clientFeedback;
    }

    public function getTechnicianFeedback() {
        return $this->technicianFeedback;
    }

    public function setMilestoneName($milestoneName) {
        $this->milestoneName = $milestoneName;
    }

    public function setMilestoneDateTime($milestoneDateTime) {
        $this->milestoneDateTime = $milestoneDateTime;
    }

    public function setClientFeedback($clientFeedback) {
        $this->clientFeedback = $clientFeedback;
    }

    public function setTechnicianFeedback($technicianFeedback) {
        $this->technicianFeedback = $technicianFeedback;
    }
}
