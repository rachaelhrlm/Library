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
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php

        function trim_value(&$value) {
            $value = strip_tags(trim($value));    // this removes whitespace and related characters from the beginning and end of the string   
        }
        array_filter($_POST, 'trim_value');    // the data in $_POST is trimmed

        $postfilter = // set up the filters to be used with the trimmed post array
        array(
            'Email' => array('filter' => FILTER_SANITIZE_EMAIL, ), // removes tags. formatting code is encoded -- add nl2br() when displaying
            'Password' => array('filter' => FILTER_SANITIZE_ENCODED), // we are using this in the url
            'FirstName' => array('filter' => FILTER_SANITIZE_STRING), // we are using this in the url
            'SecondName' => array('filter' => FILTER_SANITIZE_STRING),
            'Postcode'=> array('filter' => FILTER_SANITIZE_STRING),
            'DOB'=> array('filter' => FILTER_SANITIZE_STRING)
        );

        $sanitisedInput = filter_var_array($_POST, $postfilter);    // must be referenced via a variable which is now an array that takes the place of $_POST[]
        try{
            $DOB=explode("-", $sanitisedInput["DOB"]);
            //$accepted_numbers = array_merge(range(15, 22), range(31, 41));
            if($DOB[0]<1910) {
                throw new InvalidAgeException();
            }
            elseif(!preg_match("/[A-Z]{1,2}[0-9][0-9A-Z]?\s?[0-9][A-Z]{2}/i", $sanitisedInput["Postcode"])) {
                throw new InvalidPostcodeException();
            }
            else {
                Person::addMember($sanitisedInput["FirstName"], $sanitisedInput["SecondName"],$sanitisedInput["DOB"], $sanitisedInput["Postcode"], $sanitisedInput["Email"]);
            }
        } 
        
        catch (InvalidAgeException $ex) {
            die ("Invalid age, please enter an appropriate birth year.");
        }
        catch (InvalidPostcodeException $ex) {
            die ("Please enter a valid postcode.");
        }
        ?>
    </body>
</html>
