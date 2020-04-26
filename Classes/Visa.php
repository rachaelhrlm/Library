<?php

namespace Classes;

class Visa implements IBillable{
    public function pay(){
        echo "I'm paying by Visa <br>";
    }
    public function paymentProcess (){
        $this->pay();
    }
        
    }


