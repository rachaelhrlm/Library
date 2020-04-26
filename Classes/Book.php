<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Classes;

Class Book extends Items {
    Private $BookID;
    Private $Name;
    Private $ISBN;
    Private $Category;
    Private $Publisher;
    Private $Edition;
    Private $Author;
    Private $StockQuantity;
    
    Public function __construct($BookID, $Name, $ISBN, $Category, $Publisher, $Edition, $Author, $StockQuantity) {
        $this->BookID=$BookID;
        $this->Name=$Name;
        $this->ISBN=$ISBN;
        $this->Category=$Category;
        $this->Publisher=$Publisher;
        $this->Edition=$Edition;
        $this->Author=$Author;
        $this->StockQuantity=$StockQuantity;
    }
    
     Public function getBookID(){
        return $this->BookID;
    } 
    
     Public function getISBN(){
        return $this->ISBN;
    } 
     Public function getCategory(){
        return $this->Category;
    }  
    
    Public function getPublisher(){
        return $this->Publisher;
        
    }  Public function getEdition(){
        return $this->Edition;
    }
    
    Public function getAuthor(){
        return $this->Author;
    }
    Public function getStockQuantity(){
        return $this->StockQuantity;
    }  
    Public function store($location){
        return $this->location=$location;
    }
    
    Public function getItem($location) {
        echo "this book is in $location <br>";
} 
} 

