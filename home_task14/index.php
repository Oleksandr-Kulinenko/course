<?php
class dataStorage
{
    private $storage = [];
    private $type_storage = null;
    public function __construct(string $type_storage = 'turn')
    {
        $this->type_storage = $type_storage;
    }

    public function add(string $email) // метод для вставки елементу в сховище в початок або кінець в залежності від типу сховища
    {
        if($this->type_storage=='stack'){
            array_push($this->storage, $email);
            return 'success add element to stack!';
        }elseif($this->type_storage=='turn'){
            array_unshift($this->storage, $email);
            return 'success add element to turn!';
        }else{
            return 'undefined type storage!';
        }
    }

    public function getAll(): array // отримання всього сховища
    {
        return $this->storage;
    }

    public function getActiveElement(){ // метод для отримання того хто буде взятий наступний по черзі
        return reset($this->storage);
    }

    public function count(): int
    {
        return count($this->storage);
    }

    public function destroy() // очищення сховища
    {
        $this->storage = [];
    }

    public function destroyElementByEmail(string $email) // очищення сховища
    {
        $key = array_search ($email, $this->storage);
        unset($this->storage[$key]);
        return 'Елемент з імейлом '.$email.' успішно видалено';
    }
}


$newTurnStorage = new dataStorage('stack');
$newTurnStorage->add('123@test.loc');
$newTurnStorage->add('321@test.loc');
$newTurnStorage->add('456@test.loc');

//echo var_dump($newTurnStorage);
//echo "<pre>";
//print_r($newTurnStorage->getAll());
$count_element_storage = $newTurnStorage->count();

echo $newTurnStorage->getActiveElement();

echo '<br>К-сть елементів в сховищі: '. $count_element_storage;

echo "<br>".$newTurnStorage->destroyElementByEmail('456@test.loc')."<br>";

print_r($newTurnStorage->getAll());




