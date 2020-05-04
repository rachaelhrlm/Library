<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once 'Classes/Traits.php';
require_once 'Classes/Interfaces.php';
require_once 'Classes/Person.php';
require_once 'Classes/Exceptions/RegisterExceptions.php';

use Classes\Person;
use Exceptions\InvalidAgeException;
use Exceptions\InvalidPostcodeException;
use Exceptions\InvalidPasswordException;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="LibraryStyle.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <div class="container-fluid header">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-9"> </div>
                    <div class="col-md-3 logo">logo</div>
                </div>
            </div>
        </div>
        <div class="container-fluid Header2">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-3 PageTitle"> Page Title </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3 SearchBar"> Search Bar</div>
                </div>
            </div>
        </div>
        <!-- the middle column is for Bootstrap while the second one is for personal design--> 
        <div class="container-fluid NavBar">
            <div class="container">
                <div class="row justify-content-between"> 
                    <div class="col-md-3"><a href="index.php"> Home </a></div>
                    <div class="col-md-3">Location and Hours</div>
                    <div class="col-md-3">Library Services</div>
                    <div class="col-md-3"><a href="Register.php"> Register </a></div>
                </div> 
            </div>
        </div>
        <div class="container">
            <div class="row Content">
                <div class="col-md-12">
                    <h1>Registration Form</h1>
                    <form action="" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6"> 
                                <label for="Email" >Email:</label>
                                <input type="Email" name="Email" class="form-control" id="Email" placeholder="Email" required autofocus>  
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Password">Password:</label>
                                <input type="Password" name="Password" class="form-control" id="Password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="FirstName">First Name:</label>
                                <input type="text" name="FirstName" class="form-control" id="FirstName" placeholder="First Name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="SecondName">Second Name:</label>
                                <input type="text" name="SecondName" class="form-control" id="SecondName" placeholder="Second Name" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Postcode">Postcode:</label>
                                <input type="text" name="Postcode" class="form-control" id="Postcode" placeholder="Postcode" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="DOB">Date of Birth:</label>
                                <input type="date" name="DOB" class="form-control" id="DOB" placeholder="Date of Birth" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>  


                    </form>
                    <!--</div>-->
                    <!--</div>-->
                    <!--<div class="row Results">--> 
                    <div>
                        <?php
                        if (!empty($_POST)) {

                            function trim_value(&$value) {
                                $value = strip_tags(trim($value));    // this removes whitespace and related characters from the beginning and end of the string   
                            }

                            array_filter($_POST, 'trim_value');    // the data in $_POST is trimmed

                            $postfilter = // set up the filters to be used with the trimmed post array
                                    array(
                                        'Email' => array('filter' => FILTER_SANITIZE_EMAIL,), // removes tags. formatting code is encoded -- add nl2br() when displaying
                                        'Password' => array('filter' => FILTER_SANITIZE_ENCODED), // we are using this in the url
                                        'FirstName' => array('filter' => FILTER_SANITIZE_STRING), // we are using this in the url
                                        'SecondName' => array('filter' => FILTER_SANITIZE_STRING),
                                        'Postcode' => array('filter' => FILTER_SANITIZE_STRING)
                            );
                            $sanitisedInput = filter_var_array($_POST, $postfilter);    // must be referenced via a variable which is now an array that takes the place of $_POST[]
                            try {
                                $DOB = explode("-", $_POST["DOB"]);
                                $sanitisedInput["DOB"] = implode("", $DOB);
                                //$accepted_numbers = array_merge(range(15, 22), range(31, 41));
                                if ($DOB[0] < 1910) {
                                    throw new InvalidAgeException();
                                } elseif (!preg_match("/[A-Z]{1,2}[0-9][0-9A-Z]?\s?[0-9][A-Z]{2}/i", $sanitisedInput["Postcode"])) {
                                    throw new InvalidPostcodeException();
                                } elseif (strlen($sanitisedInput["Password"]) < 8) {
                                    throw new InvalidPasswordException();
                                } else {
                                    Person::addMember($sanitisedInput["FirstName"], $sanitisedInput["SecondName"], $sanitisedInput["DOB"], $sanitisedInput["Postcode"], $sanitisedInput["Email"], $sanitisedInput["Password"]);
                                }
                            } catch (InvalidAgeException $ex) {
                                error_log("Invalid age, please enter an appropriate birth year.", 3, "Error.log"); //3 with error log means writing in a physical file 
                                die('<div class="Results"> Invalid age, please enter an appropriate birth year.</div>');
                            } catch (InvalidPostcodeException $ex) {
                                error_log("Please enter a valid postcode.", 3, "Error.log");
                                die('<div class="Results"> Please enter a valid postcode.</div>');
                            } catch (InvalidPasswordException $ex) {
                                error_log("Please enter a password of at least 8 characters.", 3, "Error.log");
                                die('<div class="Results"> Please enter a password of at least 8 characters.</div>');
                            }
                        }
                        ?>
                    </div>    
                </div>
            </div>
        </div> 
            <div class="container-fluid Footer">
                <div class="container">
                    <div class="row Footer"> Footer </div>
                </div>
            </div>
            <?php
// put your code here
            ?>
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>