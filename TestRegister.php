<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
//Order of includes matter. Parent classes should be included before child classes.
        include 'Classes/Interfaces.php';
        include 'Classes/Traits.php';
        require_once 'Classes/Exceptions/RegisterExceptions.php';
        require_once 'Classes/Exceptions/SearchBookExceptions.php';
        include 'Classes/Person_1.php';
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
        use Classes\Connectable;
        use Classes\Person_1;
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
        $Amanda = new Member('2','amanda.smith@gmail.com','Amanda','Smith','1991-12-12','BN1 7JF');
                // Classes\Person_1::Register("Amanda", "Fluff", 19880612, "SE17 9HH", "amanda.fluff@yahoo.com");
        $Amanda->searchBook('', "Slime", '');
        $Amanda->Register("Amanda", "Fluff", 19880612, "SE17 9HH", "amanda.fluff@yahoo.com");
        ?>
    </body>
</html>
