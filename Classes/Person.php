<?php
// Create abstract class

// Create namespace
namespace Classes;

abstract class Person { // cannot be instantiated 
    
    use Connectable;
    
    Protected $Email;
    Protected $FirstName;
    Protected $SecondName;
    Protected $DOB;
    Protected $Postcode;
    
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
    
    public function searchBook($book){ // Add shared attributes inside the person  
        echo "You have searched for $book <br>";
    }
    public function borrowBook($book){
        echo "You want to borrow $book <br>" ;
    }
    public function returnBook($book){
        echo "You want to return $book <br>";
    }
    public function SettleFines(IBillable $paymentType){
        $paymentType->paymentProcess();
        echo "Fines have been settled. <br>";
    }
    abstract public function Introduction();
}
