<?php
use index\classes\Factory\AbstractFactory;
use index\classes\Factory\Param;

//include_once 'classes/Factory/AbstractFactory.php';

// Factory
$firstProduct = AbstractFactory::getFactory()->getProduct();
Param::$factory = 'Mashinki';
$secondProduct = AbstractFactory::getFactory()->getProduct();