<?php
    require_once './inc/functions.php';

    $controllers->categories()->delete_category($_GET['id']);

    redirect('adminCategories');
?>