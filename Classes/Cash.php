<?php

namespace Classes;

class Cash implements IBillable{
    public function pay(){
        echo "I'm paying by Cash <br>";
    }
    public function paymentProcess (){
        $this->pay();
    }
        
    }

