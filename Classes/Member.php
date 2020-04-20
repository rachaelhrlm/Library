<?php

namespace Classes;

class Member {
    private $MemberID;
    private $Email;
    private $FirstName;
    private $SecondName;
    private $DOB;
    private $Postcode;
    public function __construct($MemberID, $Email, $FirstName, $SecondName, $DOB, $Postcode) {
        $this->MemberID = $MemberID;
        $this->Email = $Email;
        $this->FirstName = $FirstName;
        $this->SecondName = $SecondName;
        $this->DOB = $DOB;
        $this->Postcode = $Postcode;
    }
    public function getMemberID() {
        return $this->MemberID;
    }
    public function getEmail() {
        return $this->Email;
    }
    public function getFirstName() {
        return $this->FirstName;
    }
    public function getSecondName() {
        return $this->SecondName;
    }
    public function getDOB() {
        return $this->DOB;
    }
    public function getPostcode() {
        return $this->Postcode;
    }
    public function updateSecondName($name) {
        return $this->SecondName = $name;
    }
    public function updateFirstName($name) {
        return $this->FirstName = $name;
    }
}

//We've considered inhertinence and possible uses of polymorphism but because we 
//have no specific type of member, we can't think of any practical use for creating child classes.