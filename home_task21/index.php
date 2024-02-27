<?php

    use Models\Battle;
    use Models\CreateGameCharacter;

    require __DIR__ . '/vendor/autoload.php';
    /*
    $warrior1 = new Warrior(90, 80,'Артур');
    $magician1 = new Magician(70, 70, 'Мерлін');
    $archer1 = new Archer(75, 80,'Робін Гуд');

    $warrior2 = new Warrior(85, 85, 'Річард');
    $magician2 = new Magician(60, 60,  'Саруман');
    $archer2 = new Archer(80, 90, 'Леголаз');
    */

    $warrior1 = CreateGameCharacter::createWarrior(90, 25,'Артур');
    $magician1 = CreateGameCharacter::createMage(70, 35, 'Мерлін');
    $archer1 = CreateGameCharacter::createArcher(75, 20,'Робін Гуд');

    $warrior2 = CreateGameCharacter::createWarrior(85, 28, 'Річард');
    $magician2 = CreateGameCharacter::createMage(60, 37,  'Саруман');
    $archer2 = CreateGameCharacter::createArcher(80, 22, 'Леголаз');

    //$warrior2->say();
    //echo $warrior2->getWeapon();
    //$damage = $warrior2->getDamage();
    //echo $damage;
    //echo "Health Warrior hero is: ".$warrior2->getHealth() . PHP_EOL;
    //exit;
    //echo $warrior2->calculateDamageAndReduceEndurance();
    //exit;
    $battle = new Battle($warrior1, $magician1);
    echo $battle->fight();