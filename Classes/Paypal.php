<?php

namespace Classes;

class Paypal implements IBillable, ILoginable{
    public function login(){
        echo "I'm logging into Paypal <br>";
    }
    public function pay(){
        echo "I'm paying with Paypal<br>";
    }
    public function paymentProcess(){
        $this->login();
        $this->pay();
    }
}

