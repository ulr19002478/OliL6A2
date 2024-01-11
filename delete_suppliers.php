<?php
    require_once './inc/functions.php';

    $controllers->suppliers()->delete_supplier($_GET['id']);

    redirect('adminSuppliers');
?>