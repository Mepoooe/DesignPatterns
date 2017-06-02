<?php

class Singelton
{
    private $prop = [];

    private static $instance;

    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function setProp($key, $value)
    {
        $this->prop[$key] = $value;
    }

    public function getProp($key)
    {
        return $this->prop[$key];
    }

    /**
     * Конструктор закрыт
     */
    private function __construct()
    {
    }

    /**
     * Клонирование запрещено
     */
    private function __clone()
    {
    }

    /**
     * Десериализация запрещена
     */
    private function __wakeup()
    {
    }

    /**
     * Сериализация запрещена
     */
    private function __sleep()
    {
    }
}


//Singelton
$singl = Singelton::getInstance();

$singl->setProp('1', 'membraniki');

echo $singl->getProp('1');