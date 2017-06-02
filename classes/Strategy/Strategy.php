<?php

interface payStrategy {
    public function pay($amount);
}

class payByCC implements payStrategy {

    private $ccNum = '';
    private $ccType = '';
    private $cvvNum = '';
    private $ccExpMonth = '';
    private $ccExpYear = '';

    public function pay($amount = 0) {
        echo "Paying ". $amount. " using Credit Card";
    }
}

class payByPayPal implements payStrategy {

    private $payPalEmail = '';

    public function pay($amount = 0) {
        echo "Paying ". $amount. " using PayPal";
    }

}

class payByNalik implements payStrategy {
    public function pay($amount = 0){
        echo "Налик отдан!";
    }
}

class shoppingCart {

    public $amount = 0;

    public function __construct($amount = 0) {
        $this->amount = $amount;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount = 0) {
        $this->amount = $amount;
    }

    public function payAmount() {
        if($this->amount >= 500) {
            $payment = new payByCC();
        } elseif($this->amount >= 200 && $this->amount < 500) {
            $payment = new payByPayPal();
        }else{
            $payment = new payByNalik();
        }

        $payment->pay($this->amount);
    }
}

$cart = new shoppingCart(499);
$cart->payAmount();

echo '<br/>';

$cart = new shoppingCart(501);
$cart->payAmount();

echo '<br/>';

$cart = new shoppingCart(1);
$cart->payAmount();

