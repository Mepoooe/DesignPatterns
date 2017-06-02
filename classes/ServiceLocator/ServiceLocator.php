<?php

/**
 * Created by PhpStorm.
 * User: mikhail
 * Date: 019 19.04.17
 * Time: 11:02
 */
class ServiceLocator
{
    private $components = [];
    private $definitions = [];

    public function __get($name)
    {
        if ($this->has($name)) {
            return $this->get($name);
        }

        throw new Exception('Unknown component');
    }

    public function has($id)
    {
        if (isset($this->components[$id]) || isset($this->definitions[$id])) {
            return true;
        }
        return false;
    }

    public function get($id, $throwException = true)
    {
        if (isset($this->components[$id])) {
            return $this->components[$id];
        }

        if (isset($this->definitions[$id])) {
            $definition = $this->definitions[$id];
            if (is_object($definition) && !$definition instanceof Closure) {
                return $this->components[$id] = $definition;
            } else {
                return $this->components[$id] = new $id ();
            }
        } elseif ($throwException) {
            throw new Exception ('Unknown component ID:' . $id);
        } else {
            return null;
        }
    }

    public function set($id, $definition)
    {
        if ($definition === null) {
            unset($this->components[$id], $this->definitions[$id]);
            return null;
        }

        unset($this->components[$id]);

        if (is_object($definition) || is_callable($definition, true)) {
            $this->definitions[$id] = $definition;
        } elseif (is_array($definition)) {
            if (isset($definition['class'])) {
                $this->definitions[$id] = $definition;
            } else {
                throw new Exception  ("The configuration for the \"$id\" component must contain a \"class\" element.");
            }
        } else {
            throw new Exception ("Unexpected configuration type for the \"$id\" component: " . gettype($definition));
        }
    }

    public function clear($id)
    {
        unset($this->definitions[$id], $this->components[$id]);
    }

}

class TextService
{
    public function helloService()
    {
        return 'Hello, I\'m service from TextService';
    }
}


$serviceLocator = new ServiceLocator();

$serviceLocator->set('test', new TextService());
$text = $serviceLocator->test;

echo $text->helloService();