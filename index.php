<!DOCTYPE html>
<?php
//Order of includes matter. Parent classes should be included before child classes.
        include 'Classes/Interfaces.php';
        include 'Classes/Person.php';
        include 'Classes/Member.php';
        include 'Classes/Staff.php';
        include 'Classes/Paypal.php';
//        include 'Classes/Autoloader.php'; --opted out because of error finding a non-existent "IBillable.php"
        use Classes\Member;
        use Classes\Person;
        use Classes\Paypal;
        use Classes\Staff;
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $John = NEW Staff('1','john.smith@gmail.com','John','Smith','1991-10-10','BN1 7JF','27,000');
        echo "Hi! My name is " . $John->getFirstName() . " " . $John->getSecondName() . " " . "<br> My Staff id is " . $John->getStaffID() . "<br>";

        $Amanda = NEW Member('2','amanda.smith@gmail.com','Amanda','Smith','1991-12-12','BN1 7JF');
        echo $Amanda->getMemberID() . "<br>";
        echo $Amanda->getSecondName() . "<br>";
        
        $Amanda->updateSecondName('Tolstoy');
        echo $Amanda->getSecondName(). "<br>";
        
        $Amanda->borrowBook('slime');
        
        $paymentType = New Paypal();
        $Amanda->SettleFines($paymentType);   
        
        $John->Introduction();
        $Amanda->Introduction();
        ?>
    </body>
</html>
