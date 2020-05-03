<!DOCTYPE html>
<?php
// Link the other classes and exceptions 
include 'Classes/Interfaces.php';
include 'Classes/Traits.php'; // Link the index.php form to the searchbook stored procedure in DB
include 'Classes/Person.php';
include 'Classes/Exceptions/SearchBookExceptions.php';

use Classes\Person;
use Exceptions\EmptyException;
use Exceptions\InvalidISBNException;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="LibraryStyle.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title></title>
    </head>
    <body>
        <div class="container">
            <div class="row header"> 
                <div class="col-md-10"> </div>
                <div class="col-md-2 logo">logo</div>
            </div>
            <div class="row Header2">
                <div class="col-md-2 PageTitle"> Page Title </div>
                <div class="col-md-8"></div>
                <div class="col-md-2 SearchBar"> Search Bar</div>
            </div>
            <!-- the middle column is for Bootstrap while the second one is for personal design-->        
            <div class="row NavBar"> 
                <div class="col-md-3">Home</div>
                <div class="col-md-3">Location and Hours</div>
                <div class="col-md-3">Library Services</div>
                <div class="col-md-3">Contact Us</div>

            </div> 

            <div class="row Content">
                <?php
                $search = $_POST;
                
                $search["keyword"] = trim(filter_input(INPUT_POST, 'keyword', FILTER_SANITIZE_STRING));
                echo "No records found";
                echo "<a href='http://localhost/Library/index.php'>Please try again</a>";
                // Link the DB back to the results page to get the info back

                try {
                    if ($search["keyword"] === "") {
                        throw new EmptyException();
                    } elseif (($search["search"] === "ISBN") && (strlen($search["keyword"]) !== 13)) {
                        throw new InvalidISBNException("");
                    } else {


                        if ($search["search"] === "title") {
                            person::searchBook("", $search["keyword"], "");
                        } elseif ($search["search"] === "author") {
                            person::searchBook($search["keyword"], "", "");
                        } elseif ($search["search"] === "ISBN") {
                            person::searchBook("", "", $search["keyword"]);
                        }
                    }
                } catch (EmptyException $e) {
                    die("Please enter keywords");
                } catch (InvalidISBNException $e) {
                    die("Check if your ISBN is 13 characters long");
                }
                ?>
            </div>

            <div class="row Footer">Footer </div>
        </div>
    </div>  

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
