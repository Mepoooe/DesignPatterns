<?php

/**
 * Created by PhpStorm.
 * User: mikhail
 * Date: 019 19.04.17
 * Time: 9:00
 */
class Facade
{

    private $door = null;
    private $startCar = null;
    private $drive = null;

    public function __construct()
    {
        $this->door = new Door();
        $this->startCar = new StartCar();
        $this->drive = new Drive();
    }

    public function driveCar():string
    {
        return $this->door->OpenDoor() . $this->startCar->startACar() . $this->drive->driveCar();
    }
}

class User
{
    //without facade
    public function car():string
    {
        $door = new Door();
        $door = $door->OpenDoor();

        $startCar = new StartCar();
        $startCar = $startCar->startACar();

        $drive = new Drive();
        $drive = $drive->driveCar();

        return $door . $startCar . $drive;
    }

    //with facade
    public function carGo():string
    {
        $facade = new Facade();
        $facade = $facade->driveCar();

        return $facade;
    }
}

class Door
{
    public function OpenDoor(): string
    {
        return 'open a door. ';
    }
}

class StartCar
{
    public function startACar() : string
    {
        return '<br>'.' Start a car ';
    }
}

class Drive
{
    public function driveCar(): string
    {
        return '<br>'.' Drive ';
    }
}

$user = new User();

echo $user->car();
echo "<br>".'----------========----------'."<br>";
echo $user->carGo();

