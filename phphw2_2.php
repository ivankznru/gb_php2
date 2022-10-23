<?php


trait TraitSingleton
{
    private static $instance; // Экземпляр объекта

    // Защищаем от создания через new Singleton
    private function __construct()
    { /* ... @return Singleton */
    }

    // Защищаем от создания через клонирование
    private function __clone()
    { /* ... @return Singleton */
    }

    // Защищаем от создания через unserialize
    private function __wakeup()
    { /* ... @return Singleton */
    }

    // Возвращает единственный экземпляр класса.
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

class Singleton {

    private static $instance;

    public function test(){
        echo "Test";
    }
    use TraitSingleton;
}
$objTest1 = Singleton::getInstance();
$objTest2 = Singleton::getInstance();

var_dump($objTest1 === $objTest2);








