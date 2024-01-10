<?php
    require_once './inc/functions.php';

    $controllers->members()->delete_member($_GET['id']);

    redirect('adminUsers');
?>