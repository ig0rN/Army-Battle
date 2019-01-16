<?php

class Army {

    private $initialNumber;

    private $armyNumber;

    private $winChance = 101;

    private $disasterReport = array();
    
    public function __construct(int $armyNumber)
    {
        $this->initialNumber = $armyNumber;
        $this->armyNumber = $armyNumber;
        $this->checkDisasterChance();
    }

    /*
    /   Calculate chance of disaster and reduce number of solider based on disaster type. Than write disaster type and number of soliders that die from it.
    */
    private function checkDisasterChance()
    {
        $r = rand(1,101);
        
        switch($r) {
            // 3% chance for plague
            case $r <= 4:

                $deficit = Disaster::plague($this->armyNumber);

                $this->armyNumber = $this->armyNumber - $deficit;
                $this->disasterReport = ['Plague' => $deficit];

            break;
            // 16% chance for craziness
            case $r >= 38 && $r <= 54:

                $deficit = Disaster::craziness($this->armyNumber);

                $this->armyNumber = $this->armyNumber - $deficit;
                $this->disasterReport = ['Craziness' => $deficit];

            break;
            // 24% chance for hepatitis
            case $r >= 76 && $r <= 100:

                $deficit = Disaster::hepatitis($this->armyNumber);

                $this->armyNumber = $this->armyNumber - $deficit;
                $this->disasterReport = ['Hepatitis' => $deficit];

            break;
        }
    }

    /*
    /   Return formated message of disaster
    */
    public function getDisasterReport()
    {
        if (!empty($this->disasterReport)) {
            $string  = key($this->disasterReport);
            $string .= " takes ";
            $string .= $this->disasterReport[key($this->disasterReport)];
            $string .= $this->disasterReport[key($this->disasterReport)] < 5 ? ' soldier' : ' soldiers';

            return $string;
        }
        return "Disaster escaped";
    }

    public function getInitialNumber()
    {
        return $this->initialNumber;
    }

    public function getArmyNumber()
    {
        return $this->armyNumber;
    }

    public function getWinChance()
    {
        return $this->winChance;
    }

    public function setWinChance($value)
    {
        $this->winChance = $value;
    }
}