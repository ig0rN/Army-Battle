<?php

class Battle {

    private $army1Obj;
    private $army2Obj;

    private $amryDeficit = null;

    public $battleLog = [];
    
    public function __construct(Army $army1, Army $army2)
    {
        $this->army1Obj = $army1;
        $this->army2Obj = $army2;
        $this->setArmyDifference();
        $this->reduceWinChance();
    }

    /*
    /   Calculate difference in number of soliders in %
    /   Army with more soliders is 100% in this case.
    */
    private function setArmyDifference()
    {
        if ($this->army1Obj->getArmyNumber() > $this->army2Obj->getArmyNumber()) {

            $differencePercentage = round( ($this->army2Obj->getArmyNumber() * 100) / $this->army1Obj->getArmyNumber() );
            settype($differencePercentage, "integer");

            $lessPercentage = 100 - $differencePercentage;

            $this->amryDeficit = ['army2' => $lessPercentage];

        }

        if ($this->army2Obj->getArmyNumber() > $this->army1Obj->getArmyNumber()) {
            
            $differencePercentage = round( ($this->army1Obj->getArmyNumber() * 100) / $this->army2Obj->getArmyNumber() );
            settype($differencePercentage, "integer");

            $lessPercentage = 100 - $differencePercentage;

            $this->amryDeficit = ['army1' => $lessPercentage];
        }
    }

    /*
    /   Reduce Winning chance of army that have less soliders
    */
    private function reduceWinChance()
    {
        if (!is_null($this->amryDeficit)) {

            $army = key($this->amryDeficit);
            switch($army) {

                case 'army1':

                $deficitPercentage = $this->army1Obj->getWinChance() - $this->amryDeficit['army1'];

                $this->army1Obj->setWinChance($deficitPercentage);
                
                if ($this->army1Obj->getWinChance() <1) {
                    $this->army1Obj->setWinChance(1);
                }
                break;

                case 'army2':

                $deficitPercentage = $this->army2Obj->getWinChance() - $this->amryDeficit['army2'];

                $this->army2Obj->setWinChance($deficitPercentage);

                if ($this->army2Obj->getWinChance() <1) {
                    $this->army2Obj->setWinChance(1);
                }
                break;
                
            }
        }
    }

    /*
    /   Random posibility for win.
    /   Max value of random is Army object property Winning chance.
    /   Fill up battle log with data that will show summary of battle.
    */
    public function run() {
        $army1WinPosibility = rand(1, $this->army1Obj->getWinChance());
        $army2WinPosibility = rand(1, $this->army2Obj->getWinChance());

        //winner details
        if ($army1WinPosibility > $army2WinPosibility) {
            $this->battleLog['winner'] = 'Army 1';
        }
        if ($army2WinPosibility > $army1WinPosibility) {
            $this->battleLog['winner'] = 'Army 2';
        }
        if ($army1WinPosibility == $army2WinPosibility) {
            $this->battleLog['winner'] = 'No winner';
        }

        //army1 details
        $this->battleLog['army1']['Initial Number of Soliders:'] = $this->army1Obj->getInitialNumber();
        $this->battleLog['army1']['Disaster:'] = $this->army1Obj->getDisasterReport();
        $this->battleLog['army1']['Number of Soliders before War:'] = $this->army1Obj->getArmyNumber();
        $this->battleLog['army1']['Range of Winning Chance:'] = "From 1 to " . $this->army1Obj->getWinChance();
        $this->battleLog['army1']['Number in Range(bigger gives win):'] = $army1WinPosibility;

        //army2 details
        $this->battleLog['army2']['Initial Number of Soliders:'] = $this->army2Obj->getInitialNumber();
        $this->battleLog['army2']['Disaster:'] = $this->army2Obj->getDisasterReport();
        $this->battleLog['army2']['Number of Soliders before War:'] = $this->army2Obj->getArmyNumber();
        $this->battleLog['army2']['Range of Winning Chance:'] = "From 1 to " . $this->army2Obj->getWinChance();
        $this->battleLog['army2']['Number in Range(bigger gives win):'] = $army2WinPosibility;
    }
}