<?php

namespace Models;
class Battle
{
    protected $character1;
    protected $character2;

    public function __construct($character1, $character2)
    {
        $this->character1 = $character1;
        $this->character2 = $character2;
    }

    public function fight(): string
    {
        $this->character1->say();
        $this->character2->say();
        //echo $this->character1->name." endurance: ".$this->character1->getEndurance()."<br>";
        //echo $this->character2->name." endurance: ".$this->character2->getEndurance()."<br>";
        //exit;
        //echo $this->character1->getEndurance();
        while ($this->character1->getHealth() > 0 && $this->character2->getHealth() > 0) {
            //echo $this->character1->name." endurance: ".$this->character1->getEndurance()."<br>";
            if($this->character1->getEndurance()<=0){
                $this->character1->sayOnNoEndurance();
            }else{
                $this->character1Attack();
                if ($this->character2->getHealth() <= 0) {
                    $this->character1->sayOnWin();
                    $this->character2->sayOnLose();
                    return $this->character1->name . " переміг!";
                }
            }
            //echo $this->character2->name." endurance: ".$this->character2->getEndurance()."<br>";
            if($this->character2->getEndurance()<=0) {
                $this->character2->sayOnNoEndurance();
            }else{
                $this->character2Attack();
                if ($this->character1->getHealth() <= 0) {
                    $this->character2->sayOnWin();
                    $this->character1->sayOnLose();
                    return $this->character2->name . " переміг!";
                }
            }
        }

        return "Бій завершився нічиєю!";
    }

    protected function character1Attack()
    {
        $this->character1->attack($this->character2);
    }

    protected function character2Attack()
    {
        $this->character2->attack($this->character1);
    }
}