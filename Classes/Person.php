<?php
// Create abstract class

// Create namespace
namespace Classes;
use \PDO;
use Classes\Connectable;

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
  
    public function searchBook($author, $bookname, $ISBN) { // Add shared attributes inside the person  
        //"?" means that you're expecting some form of input/data to be passed.
        $stmt = "call searchBook (?, ?, ?)";
        $conn = self::asConnect()->prepare($stmt);
        $conn->execute([$author, $bookname, $ISBN]);
        //fetchAll() can get multiple results. Best used for arrays or when there is more than one value being returned.
        $results=$conn->fetchAll();
        //Results are associative arrays. Key->Value pair is ColumnName->RecordValue.
        foreach($results as $result) {

            echo $result["Title"] . ", " . $result["Author"] . ", " . $result["ISBN"] . " <br>";
        }    
    }

    public function borrowBook($book) {
        echo "You want to borrow $book <br>";
    }

    public function returnBook($book) {
        echo "You want to return $book <br>";
    }

    public function SettleFines(IBillable $paymentType) {
        $paymentType->paymentProcess();
        echo "Fines have been settled. <br>";
    }

    abstract public function Introduction();

    public function addMember($FirstName, $SecondName, $DOB, $Postcode, $EmailAddress, $Password) {
        $stmn = "call addMember(?, ?, ?, ?, ?, ?)";
        $conn = self::asConnect()->prepare($stmn);
        $conn->execute([$FirstName, $SecondName, $DOB, $Postcode, $EmailAddress, $Password]);
        $results = $conn->fetchAll();
        foreach ($results as $result) {
            echo $result["RESULT"];
        }
    }
}
