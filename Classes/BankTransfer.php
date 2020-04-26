<?php

namespace Classes;

class BankTransfer implements IBillable, ILoginable {
    public function login(){
        echo "I'm logging into complete a bank transfer <br>";
    }
    public function pay(){
        echo "I'm paying with a bank transfer<br>";
    }
    public function paymentProcess(){
        $this->login();
        $this->pay();
    }
}