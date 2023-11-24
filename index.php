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
// $animal=new Animal('漢堡');

// echo '顯示名稱:' .$animal->getName();
// echo "<br>";
// $animal->setName('漢堡');
// // -> 物件顯示
// echo $animal->name;
// $animal->setName('漢堡');
// echo '顯示名稱:' .$animal->getName();

// 繼承特性
class Dog extends Animal{
    function sit(){
        echo "趴下";
    }
}

$dog=new Dog('來福');
echo $dog->getName();
echo "<br>";
echo $dog->setName('來西');
echo $dog->getName();
$dog->sit();

