<?php

class GameCharacter {
    protected int $health;
    protected int $endurance;
    protected object $weapon;
    public string $name;

    public function __construct(int $health, int $endurance, object $weapon, string $name) {
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

    public function calculateDamage(): int
    {
        return $this->weapon->getDamage();
    }
}

class Weapon {
    protected $name;
    protected $damage;

    public function __construct($name, $damage) {
        $this->name = $name;
        $this->damage = $damage;
    }

    public function getName() {
        return $this->name;
    }

    public function getDamage() {
        return $this->damage;
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

$weaponSword = new Weapon("Меч", mt_rand(5, 15));
$weaponStaff = new Weapon("Магічний посох", mt_rand(7, 16));
$weaponBow = new Weapon("Лук", mt_rand(8, 17));

$warrior1 = new Warrior(90, 80, $weaponSword, 'Артур');
$magician1 = new Magician(70, 70, $weaponStaff, 'Мерлін');
$archer1 = new Archer(75, 80, $weaponBow, 'Робін Гуд');

$warrior2 = new Warrior(85, 85, $weaponSword, 'Річард');
$magician2 = new Magician(60, 60, $weaponStaff, 'Саруман');
$archer2 = new Archer(80, 90, $weaponBow, 'Леголаз');


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
        $damage = $this->game_character1->calculateDamage();

        $this->game_character2->reduceHealth($damage);
        return $this->game_character1->name . " атакує " . $this->game_character2->name . " і завдає " . $damage . " урон<br>";
    }

    protected function gameCharacter2Attack(): string
    {
        $damage = $this->game_character2->calculateDamage();

        $this->game_character1->reduceHealth($damage);
        return $this->game_character2->name . " атакує " . $this->game_character1->name . " і завдає " . $damage . " урон<br>";
    }
}

$battle = new Battle($warrior1, $magician2);
echo $battle->fight();