<?php
    require 'app/Modals/Bonus.php';

    require 'app/Modals/Concert.php';

    $bonus = new Bonus();
    $bons = array();
    $bons = $bonus->getAllBonus();        
    
    $concert = new Concert();
    $concerts = array();
    $concerts = $concert->getAllConcerts();

    require 'app/Views/addtask.view.php';

