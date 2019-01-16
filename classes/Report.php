<?php

class Report {

    public $winner;
    public $army1;
    public $army2;

    public function __construct(Battle $battle)
    {
        $this->winner = $battle->battleLog['winner'];

        $this->army1 = $battle->battleLog['army1'];

        $this->army2 = $battle->battleLog['army2'];
    }

    public function render()
    {
        $table = "
        <h2>Summary of Battle:</h2>
        <table border=1 style='text-align: center;'>
            <tr>
                <th>Winner:</th>
                <td>{$this->winner}</td>
            </tr>
            <tr>
                <th colspan=2  style='background-color: black; color: white'>Army 1</th>
            </tr> ";

        // army1 details
        foreach ($this->army1 as $property => $value) {
            $table .= "
                <tr>
                    <th>{$property}</th>
                    <td>{$value}</td>
                </tr>
            ";
        }
        $table .= "
            <tr>
                <th colspan=2  style='background-color: black; color: white'>Army 2</th>
            </tr>
        ";

        //army2 details
        foreach ($this->army2 as $property => $value) {
            $table .= "
                <tr>
                    <th>{$property}</th>
                    <td>{$value}</td>
                </tr>
            ";
        }

        echo $table;
    }

}