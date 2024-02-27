<?php

namespace Models;
use Herous\Archer;
use Herous\Magician;
use Herous\Warrior;

class CreateGameCharacter {
    public static function createWarrior($health, $endurance, $name): object
    {
        $warrior = new Warrior($health, $endurance, $name);
        $warrior->setWeapon('меч');
        $warrior->setDamage(mt_rand(1, 6));
        $warrior->setPersonUseEndurance(10);
        return $warrior;
    }

    public static function createMage($health, $endurance, $name): object
    {
        $magician = new Magician($health, $endurance, $name);
        $magician->setWeapon('магічний посох');
        $magician->setDamage(mt_rand(3, 9));
        $magician->setPersonUseEndurance(15);

        return $magician;
    }

    public static function createArcher($health, $endurance, $name): object
    {
        $archer = new Archer($health, $endurance, $name);
        $archer->setWeapon('лук');
        $archer->setDamage(mt_rand(4, 11));
        $archer->setPersonUseEndurance(20);
        return $archer;
    }
}