<?php

// abstract class Goods  тут наверное больше подойдет абстактный класс по аналогии со java
class Goods {
    private $goodsTitle;
    private $goodsDescription;
    private $goodsPrice;
    private $goodsAvailable;
    private $goodsState;

    /**
     * @param $goodsTitle
     * @param $goodsDescription
     * @param $goodsPrice
     * @param $goodsAvailable
     * @param $goodsState
     */
    public function __construct($goodsTitle, $goodsDescription, $goodsPrice, $goodsAvailable, $goodsState)
    {
        $this->goodsTitle = $goodsTitle;
        $this->goodsDescription = $goodsDescription;
        $this->goodsPrice = $goodsPrice;
        $this->goodsAvailable = $goodsAvailable;
        $this->goodsState = $goodsState;
    }

    /**
     * @return mixed
     */
    public function getGoodsTitle()
    {
        return $this->goodsTitle;
    }

    /**
     * @param mixed $goodsTitle
     */
    public function setGoodsTitle($goodsTitle)
    {
        $this->goodsTitle = $goodsTitle;
    }

    /**
     * @return mixed
     */
    public function getGoodsDescription()
    {
        return $this->goodsDescription;
    }

    /**
     * @param mixed $goodsDescription
     */
    public function setGoodsDescription($goodsDescription)
    {
        $this->goodsDescription = $goodsDescription;
    }

    /**
     * @return mixed
     */
    public function getGoodsPrice()
    {
        return $this->goodsPrice;
    }

    /**
     * @param mixed $goodsPrice
     */
    public function setGoodsPrice($goodsPrice)
    {
        $this->goodsPrice = $goodsPrice;
    }

    /**
     * @return mixed
     */
    public function getGoodsAvailable()
    {
        return $this->goodsAvailable;
    }

    /**
     * @param mixed $goodsAvailable
     */
    public function setGoodsAvailable($goodsAvailable)
    {
        $this->goodsAvailable = $goodsAvailable;
    }

    /**
     * @return mixed
     */
    public function getGoodsState()
    {
        return $this->goodsState;
    }

    /**
     * @param mixed $goodsState
     */
    public function setGoodsState($goodsState)
    {
        $this->goodsState = $goodsState;
    }



    protected function getData() {
         return 'Наименование: ' . $this->goodsTitle . '<br>' .
                'Описание :' . $this->goodsDescription . '<br>' .
                'Состояние: ' . $this->goodsState. '<br>' .
                'Цена: ' . $this->goodsPrice . '<br>' .
                'Наличие на складе: ' . $this->goodsAvailable . '<br>';
    }

}

class NoteBook extends Goods {
   private $cardReaderAvailable;
   private $screenSize;
   private $typeCPU;


    public function __construct($goodsTitle, $goodsDescription, $goodsPrice, $goodsAvailable, $goodsState, $cardReaderAvailable, $screenSize, $typeCPU)
    {
        parent::__construct($goodsTitle, $goodsDescription, $goodsPrice, $goodsAvailable, $goodsState);
        $this->cardReaderAvailable = $cardReaderAvailable;
        $this->screenSize = $screenSize;
        $this->typeCPU = $typeCPU;
    }

    /**
     * @return mixed
     */
    public function getCardReaderAvailable()
    {
        return $this->cardReaderAvailable;
    }

    /**
     * @param mixed $cardReaderAvailable
     */
    public function setCardReaderAvailable($cardReaderAvailable)
    {
        $this->cardReaderAvailable = $cardReaderAvailable;
    }

    /**
     * @return mixed
     */
    public function getScreenSize()
    {
        return $this->screenSize;
    }

    /**
     * @param mixed $screenSize
     */
    public function setScreenSize($screenSize)
    {
        $this->screenSize = $screenSize;
    }

    /**
     * @return mixed
     */
    public function getTypeCPU()
    {
        return $this->typeCPU;
    }

    /**
     * @param mixed $typeCPU
     */
    public function setTypeCPU($typeCPU)
    {
        $this->typeCPU = $typeCPU;
    }


    public function getData(){
   return  parent::getData() . 'Наличие карт ридера: ' . $this->cardReaderAvailable . '<br>' .
                               'Величена экрана: ' . $this->screenSize . '<br>' .
                               'Тип CPU: ' . $this->typeCPU . '<br>';
    }
}


class Fridge extends Goods {
  private  $chamberNumber;
  private $coolerType;

    /**
     * @param $chamberNumber
     * @param $coolerType
     */
    public function __construct($goodsTitle, $goodsDescription, $goodsPrice, $goodsAvailable, $goodsState, $chamberNumber, $coolerType)
    {
        parent::__construct($goodsTitle, $goodsDescription, $goodsPrice, $goodsAvailable, $goodsState);
        $this->chamberNumber = $chamberNumber;
        $this->coolerType = $coolerType;
    }

    /**
     * @return mixed
     */
    public function getChamberNumber()
    {
        return $this->chamberNumber;
    }

    /**
     * @param mixed $chamberNumber
     */
    public function setChamberNumber($chamberNumber)
    {
        $this->chamberNumber = $chamberNumber;
    }

    /**
     * @return mixed
     */
    public function getCoolerType()
    {
        return $this->coolerType;
    }

    /**
     * @param mixed $coolerType
     */
    public function setCoolerType($coolerType)
    {
        $this->coolerType = $coolerType;
    }


    public function getData(){
        return parent:: getData() . 'Число холодильных камер: ' . $this->chamberNumber . '<br>' .
                                    'Тип охладителя: ' . '<br>' ;
    }
}

 $noteBook = new NoteBook('Levono', 'уцененка', 60000, 'есть', 'новый','нет',19,'CoreDue5'
 );
echo $noteBook->getData(). '<br>';

$fridge = new Fridge('Bosch', 'последний', 40000, 'есть', 'новый',2, 'фрион-2');

echo $fridge->getData(). '<br>';













