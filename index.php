<!DOCTYPE html>
<?php
        require_once 'Classes/Member.php';
        use Classes\Member;
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $John = NEW Member('1','john.smith@gmail.com','John','Smith','1991-10-10','BN1 7JF');
        echo $John->getMemberID() . "<br>";
        
        $Amanda = NEW Member('2','amanda.smith@gmail.com','Amanda','Smith','1991-12-12','BN1 7JF');
        echo $Amanda->getMemberID() . "<br>";
        echo $Amanda->getSecondName() . "<br>";
        
        $Amanda->updateSecondName('Tolstoy');
        echo $Amanda->getSecondName();
        ?>
    </body>
</html>
