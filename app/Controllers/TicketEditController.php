<?php
    require 'app/Models/Bonus.php';

    require 'app/Models/Concert.php';

    $bonus = new Bonus();
    $bons = array();
    $bons = $bonus->getAllBonus();        
    
    $concert = new Concert();
    $concerts = array();
    $concerts = $concert->getAllConcerts();

    require 'app/Views/editticket.view.php';
