<?php
// Create abstract class

// Create namespace
namespace Classes;
use \PDO;

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
    
    protected function Connect() {
        $DB_DSN = 'mysql:host=localhost;dbname=Library';
        $DB_USER = 'root';
        $DB_PASS = '';
        try {
            $pdo = new \PDO($DB_DSN, $DB_USER, $DB_PASS);
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function searchBook($author, $bookname, $ISBN){ // Add shared attributes inside the person  
        $stmt = "call searchBook (?, ?, ?)";
        $conn = self::Connect()->prepare($stmt);
        $conn->execute([$author, $bookname, $ISBN]);
        $results=$conn->fetchAll();
        foreach($results as $result) {
            echo $result ["Title"] . $result["Author"] . $result["ISBN"];
        }    
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
