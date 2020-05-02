<?php

namespace Classes;

class Staff extends Person{ 
    private $StaffID;
    private $Salary;
    public function __construct( $StaffID, $Email, $FirstName, $SecondName, $DOB, $Postcode, $Salary) {
        $this->StaffID = $StaffID;
        $this->Email = $Email;
        $this->FirstName = $FirstName;
        $this->SecondName = $SecondName;
        $this->DOB = $DOB;
        $this->Postcode = $Postcode;
        $this->Salary = $Salary;
    }
    public function getSalary() {
        return $this->Salary;
    }
    public function getStaffID() {
        return $this->StaffID;
    }
    public function Introduction() {
        echo "I am a staff member. <br>";
    }
}
