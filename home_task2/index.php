<?php
class Animal{
    private function Hello(){ // private method can use only class Animal
        echo "Animal say Hello<br>";
    }

    protected function Eat(){
        echo "I can eat many kinds of foods<br>";
    }
}

class Mammoth extends Animal{
    private function Hello(){ // can't use in children class
        echo "Mammoth say Hello<br>";
    }
    public function Eat(){
        echo "I like eat some plants<br>";
    }
}
class Lion extends Animal{
    public function Eat(){
        echo "I like eat meat<br>";
    }
}
class Monkey extends Animal{
    public function Eat(){
        echo "I like eat bananas<br>";
    }
}
class Shark extends Animal{
    public function Eat(){
        echo "I like to eat other sea animals<br>";
    }
}

$animal = new Animal();

$mammoth = new Mammoth();
$mammoth->Eat();//display food Mammoth

$lion = new Lion();
$lion->Eat();//display food lion

$monkey = new Monkey();
$monkey->Eat();//display food monkey

$shark = new Shark();
$shark->Eat();//display food shark