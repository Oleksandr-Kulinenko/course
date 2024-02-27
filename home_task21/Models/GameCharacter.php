<?php

namespace Models;

abstract class GameCharacter {
    protected int $health;
    protected int $endurance;
    protected string $weapon;
    public string $name;
    protected int $baseDamage = 5;
    protected int $useEndurance;

    protected int $damage;
    protected int $person_use_endurance;

    public function __construct(int $health, int $endurance, string $name) {
        $this->health = $health;
        $this->endurance = $endurance;
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

    public function getEndurance(): int
    {
        return $this->endurance;
    }

    public function setWeapon($weapon)
    {
        $this->weapon = $weapon;
    }

    public function getWeapon(): string
    {
        return $this->weapon;
    }

    public function setDamage($damage)
    {
        $this->damage = $damage;
    }

    public function getDamage(): int
    {
        return $this->damage;
    }

    public function setPersonUseEndurance($person_use_endurance)
    {
        $this->person_use_endurance = $person_use_endurance;
    }

    public function calculateDamage(): int
    {
         if($this->baseDamage<$this->damage){
             $this->useEndurance = ceil(($this->damage*($this->person_use_endurance/100)));
             $this->endurance -= $this->useEndurance;
             return $this->damage;
         }else{
             $this->useEndurance = ceil(($this->baseDamage*($this->person_use_endurance/100)));
             $this->endurance -= $this->useEndurance;
             return $this->baseDamage;
         }
    }

    abstract public function attack($opponent);
    /*
    protected function attack($opponent): string
    {
        $damage = $this->calculateDamage();
        $opponent->health -= $damage;
        return $this->name . " атакує " . $opponent->name . " і завдає " . $damage . " пошкодження<br>";
    }
    */
    public function sayOnWin() {
        $phrases = ["Переміг! Я найсильніший!", "Влавеус Вікторі!", "Знову переміг!"];
        echo $this->name . ": " . $phrases[array_rand($phrases)] . "<br>";
    }

    public function sayOnLose() {
        $phrases = ["Програв битву, але не війну!", "На цей раз мені не пощастило.", "Повернусь сильнішим!"];
        echo $this->name . ": " . $phrases[array_rand($phrases)] . "<br>";
    }

    public function sayOnNoEndurance() {
        $phrases = ["Ох! Сили покинули мене!", "Більше не можу! Нема сил!", "Потрібно більше тренуватись!"];
        echo $this->name . ": " . $phrases[array_rand($phrases)] . "<br>";
    }

    public function say() {
        $phrases = ["Я готовий до бою!", "Я окроплю арену кров'ю!", "Дайте мені гідного суперника!"];
        echo $this->name . ": " . $phrases[array_rand($phrases)] . "<br>";
    }
}