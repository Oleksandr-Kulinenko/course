<?php

class GameCharacter {
    protected int $health;
    protected int $endurance;
    protected string $weapon;
    public string $name;

    public function __construct(int $health, int $endurance, string $weapon, string $name) {
        $this->health = $health;
        $this->endurance = $endurance;
        $this->weapon = $weapon;
        $this->name = $name;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function reduceHealth($damage): int
    {
        return $this->health -= $damage;
    }

    public function getWeapon(): string
    {
        return $this->weapon;
    }
}

class Warrior extends GameCharacter {
    public function __construct($health, $endurance, $weapon, $name) {
        parent::__construct($health, $endurance, $weapon, $name);
    }
}

class Magician extends GameCharacter {
    public function __construct($health, $endurance, $weapon, $name) {
        parent::__construct($health, $endurance, $weapon, $name);
    }
}

class Archer extends GameCharacter {
    public function __construct($health, $endurance, $weapon, $name) {
        parent::__construct($health, $endurance, $weapon, $name);
    }
}

$warrior1 = new Warrior(90, 80, 'меч', 'Артур');
$magician1 = new Magician(70, 70, 'магічний посох', 'Мерлін');
$archer1 = new Archer(75, 80, 'лук', 'Робін Гуд');

$warrior2 = new Warrior(85, 85, 'меч', 'Річард');
$magician2 = new Magician(60, 60, 'магічний посох', 'Саруман');
$archer2 = new Archer(80, 90, 'лук', 'Леголаз');

//echo "Health Warrior hero is: ".$warrior->getHealth() . PHP_EOL;

class Battle {
    protected $game_character1;
    protected $game_character2;

    public function __construct($game_character1, $game_character2) {
        $this->game_character1 = $game_character1;
        $this->game_character2 = $game_character2;
    }

    public function fight(): string
    {
        while ($this->game_character1->getHealth() > 0 && $this->game_character2->getHealth() > 0) {
            echo $this->gameCharacter1Attack();
            if ($this->game_character2->getHealth() <= 0) {
                return $this->game_character1->name . " переміг!";
            }

            echo $this->gameCharacter2Attack();
            if ($this->game_character1->getHealth() <= 0) {
                return $this->game_character2->name . " переміг!";
            }
        }

        return "Бій завершився нічиєю!";
    }

    protected function gameCharacter1Attack(): string
    {
        if($this->game_character1->getWeapon()=='меч'){
            $damage = mt_rand(5, 15);
        }elseif($this->game_character1->getWeapon()=='магічний посох'){
            $damage = mt_rand(7, 16);
        }elseif($this->game_character1->getWeapon()=='лук'){
            $damage = mt_rand(8, 17);
        }else{
            $damage = mt_rand(5, 15);
        }

        $this->game_character2->reduceHealth($damage);
        return $this->game_character1->name . " атакує " . $this->game_character2->name . " і завдає " . $damage . " урон<br>";
    }

    protected function gameCharacter2Attack(): string
    {
        if($this->game_character2->getWeapon()=='меч'){
            $damage = mt_rand(5, 15);
        }elseif($this->game_character2->getWeapon()=='магічний посох'){
            $damage = mt_rand(7, 16);
        }elseif($this->game_character2->getWeapon()=='лук'){
            $damage = mt_rand(8, 17);
        }else{
            $damage = mt_rand(5, 15);
        }

        $this->game_character1->reduceHealth($damage);
        return $this->game_character2->name . " атакує " . $this->game_character1->name . " і завдає " . $damage . " урон<br>";
    }
}

$battle = new Battle($warrior1, $magician2);
echo $battle->fight();