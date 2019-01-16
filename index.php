<h1>Army Battle</h1>
<p>Enter number of each army</p>
<form action="index.php" method="GET">
<input type="number" min="0" name="army1" required placeholder="Army1"><br>
<input type="number" min="0" name="army2" required placeholder="Army2"><br>
<input type="submit" value="Run battle"><br>
</form>

<?php
if ( (isset($_GET['army1']) && !empty($_GET['army1'])) && (isset($_GET['army2']) && !empty($_GET['army2'])) ) {

    require_once 'helpers.php';


    $battle = new Battle(
        new Army($_GET['army1']),
        new Army($_GET['army2'])
    );
    $battle->run();
    
    $report = new Report($battle);
    $report->render();



}
?>