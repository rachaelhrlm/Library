<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Classes;
use \PDO;

trait Connectable {

    protected function asConnect() {
        $DB_DSN = 'mysql:host=localhost;dbname=Library';
        $DB_USER = 'root';
        $DB_PASS = '';   
        try {
            $pdo = new \PDO($DB_DSN, $DB_USER, $DB_PASS);
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

}
