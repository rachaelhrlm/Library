<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Classes;

abstract class Items {
    abstract function store($location);
    public function getItem($location) {
        return $this->item=$location;
}
    Public function getName(){
        return $this->Name;
}
}