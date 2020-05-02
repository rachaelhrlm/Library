<!DOCTYPE html>
<?php
//Order of includes matter. Parent classes should be included before child classes.
        include 'Classes/Interfaces.php';
        include 'Classes/Traits.php';
        include 'Classes/Person.php';
        include 'Classes/Member.php';
        include 'Classes/Staff.php';
        include 'Classes/Paypal.php';
//        include 'Classes/Autoloader.php'; --opted out because of error finding a non-existent "IBillable.php"
        require_once 'Classes/Items.php';
        require_once 'Classes/Book.php';
        require_once 'Classes/AudioBook.php';
        require_once 'Classes/Song.php';
        require_once 'Classes/Movie.php';
        
        use Classes\Member;
        use Classes\Traits;
        use Classes\Connectable;
        use Classes\Person;
        use Classes\Paypal;
        use Classes\Staff;
        use Classes\Items;
        use Classes\Book;
        use Classes\AudioBook;
        use Classes\Song;
        use Classes\Movie;
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $John = new Staff('1','john.smith@gmail.com','John','Smith','1991-10-10','BN1 7JF','27,000');
        echo "Hi! My name is " . $John->getFirstName() . " " . $John->getSecondName() . " " . "<br> My Staff id is " . $John->getStaffID() . "<br>";

        $Amanda = new Member('2','amanda.smith@gmail.com','Amanda','Smith','1991-12-12','BN1 7JF');
        echo $Amanda->getMemberID() . "<br>";
        echo $Amanda->getSecondName() . "<br>";
        
        $Amanda->updateSecondName('Tolstoy');
        echo $Amanda->getSecondName(). "<br>";
        
        $Amanda->borrowBook('slime');
        
        $paymentType = new Paypal();
        $Amanda->SettleFines($paymentType);   
        
        $John->Introduction();
        $Amanda->Introduction();
        
        $OceanTwelve=new Movie(4, "OceanTwelve");
        echo $OceanTwelve->getItem("topShelf"). "<br>";
        
        $AChildCalledIt= new AudioBook(5, "AChildCalledIt");
        echo $AChildCalledIt->playItem()."<br>";
               
        Person::searchBook("", "slime", "");
    
        ?>
    </body>
</html>

