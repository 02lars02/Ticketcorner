<?php
    require 'app/Modals/bonus.php';

    require 'app/Modals/concert.php';

    $bonus = new Bonus();
    $bons = array();
    $bons = $bonus->getAllBonus();        
    
    $concert = new Concert();
    $concerts = array();
    $concerts = $concert->getAllConcerts();

    require 'app/Views/addtask.view.php';

