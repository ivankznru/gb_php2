<?php

/*Абстрактный класс Товар*/

/*
 * Создать структуру классов ведения товарной номенклатуры.
a. Есть абстрактный товар;
b. Есть цифровой товар, штучный физический товар и товар на вес;
c. У каждого есть метод подсчета финальной стоимости;
d. У цифрового товара стоимость постоянная. У штучного товара стоимость зависит от
количества штук, у весового – в зависимости от продаваемого количества в
килограммах. У всех формируется в конечном итоге доход с продаж.
Что можно вынести в абстрактный класс, наследование?
 *
 *
 */

abstract class Product {
    const PROFIT_PERCENT = 5;

    abstract public function getTotalCost();
    abstract public function getProfitCalc();


}

class  ProductDigital extends Product{
    const PRICE =100;// у цифрового товара стоимость постоянная
    private $amount;


    public function __construct($amount)
    {
        $this->amount = $amount;
    }


    public function getAmount()
    {
        return $this->amount;
    }


    public function setAmount($amount)
    {
        $this->amount = $amount;
    }
    public function getPrice()
    {
        return PRICE;
    }
    public function getTotalCost()

    {
    return self::PRICE * $this->amount;
    }

    public function getProfitCalc()
    {
    return $this->getTotalCost()/100 * parent::PROFIT_PERCENT;
    }

}

class ProductPiece extends Product{
    private $price;
    private $amount;


    public function __construct($price, $amount)
    {
        $this->price = $price;
        $this->amount = $amount;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }


    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

public function getTotalCost()
{
    return $this->price * $this->amount;
}

public function getProfitCalc()
{
    return $this->price * $this->amount /100 * parent::PROFIT_PERCENT;
}

}

class ProductWeight extends Product {

    private $price;
    private $weight;


    public function __construct($price, $weight)
    {
        $this->price = $price;
        $this->weight = $weight;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
    public function getTotalCost()
    {
       return $this->price * $this->weight;
    }

    public function getProfitCalc()
    {
        return $this->price * $this->weight /100 * parent::PROFIT_PERCENT;
    }

}

$itemDigital = new ProductDigital(10);
echo $itemDigital->getTotalCost() . '<br>' ;

$itemPiece = new ProductPiece(200, 100);
echo $itemPiece->getTotalCost() . '<br>';

$itemByWeight = new ProductWeight(1000,5);
echo $itemByWeight->getTotalCost() . '<br>';

$revenue1 = $itemDigital->getProfitCalc();
$revenue2 = $itemPiece->getProfitCalc();
$revenue3 = $itemByWeight->getProfitCalc();

echo "Доход 1: $revenue1 <br> Доход 2: $revenue2<br> Доход 3: $revenue3  <br> ";


























