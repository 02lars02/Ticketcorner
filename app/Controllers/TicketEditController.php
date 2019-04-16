<?php
    require 'app/Models/bonus.php';

    require 'app/Models/concert.php';

    $bonus = new Bonus();
    $bons = array();
    $bons = $bonus->getAllBonus();        
    
    $concert = new Concert();
    $concerts = array();
    $concerts = $concert->getAllConcerts();

    require 'app/Views/editticket.view.php';
