<?php
namespace Classes;
interface IBillable{
    public function pay();
}
interface ILoginable{
    public function login();
}

interface Iplayable{
    public function playItem();
    public function pauseItem();
    public function stopItem();
}