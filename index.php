<?php
// 類別
class Animal{
    public $name;

    public function __construct($name)
    {
        $this->name=$name;
    }

    public function setName($name){
        $this->name=$name;
    }

    public function getName(){
        return $this->name;

    }
}

// 實例化 instant
$animal=new Animal('漢堡');

echo '顯示名稱:' .$animal->getName();
echo "<br>";
$animal->setName('漢堡');
// -> 物件顯示
echo $animal->name;
$animal->setName('漢堡');
echo '顯示名稱:' .$animal->getName();
