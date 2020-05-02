<?php

namespace Classes;

class Member extends Person{ 
    private $MemberID;
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

    public function Introduction() {
        echo "I am a member. <br>";
    }
}

//We've considered inheritance and possible uses of polymorphism but because we 
//have no specific type of member, we can't think of any practical use for creating child classes.