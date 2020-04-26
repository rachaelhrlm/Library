<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Classes;

Class Movie extends Items implements Iplayable {
    Private $MovieID;
    Private $Name;
    
    Public function __construct($MovieID, $Name) {
        $this->MovieID=$MovieID;
        $this->Name=$Name;
    }
    Public function getID() {
        return $this->MovieID;
    }

    Public function playItem() {
        echo "this movie is being played";
    }

    Public function pauseItem() {
        echo "this movie has been paused";
    }

    Public function stopItem() {
        echo "this movie stopped";
    }
     Public function store($location){
        return $this->location=$location;
}
}