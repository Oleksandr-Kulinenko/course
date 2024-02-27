<?php

namespace Herous;
use Models\GameCharacter;

class Magician extends GameCharacter {
    public function attack($opponent) {
        $damage = $this->calculateDamage();
        $opponent->health -= $damage;
        echo $this->name . " атакує " . $opponent->name . " і завдає " . $damage . " пошкодження<br>";
    }
}
