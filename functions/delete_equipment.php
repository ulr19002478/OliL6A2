<?php
    require_once 'inc/functions.php';
    
    $controllers->equipment()->delete_equipment($_GET['id']);

    redirect('AdminInventory');
?>