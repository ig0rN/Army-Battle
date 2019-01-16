<?php 

class Disaster {

    public static function hepatitis($armyNumber)
    {
        //reduce 6% od army
        $reduceNumber = ceil($armyNumber*6/100);
        settype ($reduceNumber, "integer");
        return $reduceNumber;

    }

    public static function craziness($armyNumber)
    {
        //reduce 20% od army
        $reduceNumber = ceil($armyNumber*20/100);
        settype ($reduceNumber, "integer");
        return $reduceNumber;
    }

    public static function plague($armyNumber)
    {
        //reduce 55% od army
        $reduceNumber = ceil($armyNumber*55/100);
        settype ($reduceNumber, "integer");
        return $reduceNumber;
    }

}