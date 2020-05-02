<?php

namespace Classes;

class SearchBookExceptions extends Exception{
    
    function invalidTitle($title){
        if ($title===""){
            throw new Exception ("Please enter title of book");
        }
    
    try {
        invalidTitle();
    } catch (Exception $e) {
        echo "No records found";
    } catch (Exception $e) {
        echo "Try different keywords";    
    }
    
    
    
    function invalidAuthor($author) {
        if ($author===""){
            throw new Exception ("Please capitalise name");
    }
   
    try {
        invalidAuthor();
    } catch (Exception $e) {
        echo "Author not found";
    } catch (Exception $e) {
        echo "Try different keywords";    
    }  
        
    function invalidIsbn($ISBN){
        if (str_len($ISBN ["ISBN"]) !== 13) {
            throw new Exception ("Make sure you have inputted 13 characters");
    }
     try {
        invalidISBN();
    } catch (Exception $e) {
        echo "ISBN not found";
    } catch (Exception $e) {
        echo "Check ISBN number is correct";    
    } 
}
    }
    }
}
//try, catch, throw new
//finally



