<?php


abstract class AbstractFactory {
    /**
     * @return MashinkoFactory|SosiskoFactory
     * @throws Exception
     */
    public static function getFactory() {
        switch (Param::$factory) {
            case 'Sosiski':
                return new SosiskoFactory();
            case 'Mashinki':
                return new MashinkoFactory();
        }
        throw new Exception('Param does not exist! ');
    }

    /**
     * Возвращает продукт
     *
     * @return Product
     */
    abstract public function getProduct();
}

class Param {
    public static $factory = 'Sosiski';
}

interface Product
{
    /**
     * @return string
     */
    public function getName();
}

class Mashinka implements Product {
    /**
     * @return string
     */
    public function getName()
    {
        return 'The mashinki!';
    }
}

class MashinkoFactory
{
    /**
     * @return Product
     */
    public function getProduct()
    {
        return new Mashinka();
    }
}

class Sosiski implements Product
{

    /**
     * @return string
     */
    public function getName()
    {
        return 'The sosiski!';
    }
}

class SosiskoFactory
{
    /**
     * @return Product
     */
    public function getProduct()
    {
        return new Sosiski();
    }
}




// Factory
$firstProduct = AbstractFactory::getFactory()->getProduct();
Param::$factory = 'Mashinki';
$secondProduct = AbstractFactory::getFactory()->getProduct();

echo $firstProduct->getName();
echo '<br>';
echo $secondProduct->getName();