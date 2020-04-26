<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Classes;

Class AudioBook extends Items implements Iplayable {
    Private $AudioBookID;
    Private $Name;
    
    Public function __construct($AudioBookID, $Name) {
        $this->AudioBookID=$AudioBookID;
        $this->Name=$Name;
    }
    Public function getID(){
        return $this->AudioBookID;
            }
    Public function playItem() {
        echo "this audiobook is being played";
    }
    Public function pauseItem() {
        echo "this audiobook has been paused";
    }
    Public function stopItem() {
        echo "this audiobook stopped";
     }
    Public function store($location){
        return $this->location=$location;
}
}