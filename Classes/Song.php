<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Classes;

Class Song extends Items implements Iplayable {

    Private $SongID;
    Private $Name;

    Public function __construct($SongID, $Name) {
        $this->SongID = $SongID;
        $this->Name = $Name;
    }
    Public function getID() {
        return $this->SongID;
    }

    Public function playItem() {
        echo "this song is being played";
    }

    Public function pauseItem() {
        echo "this song has been paused";
    }

    Public function stopItem() {
        echo "this song stopped";
    }
     Public function store($location){
        return $this->location=$location;
}
}
