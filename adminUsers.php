

<?php
    $title = 'Admin Users Page';
    require __DIR__ . "/inc/header.php";


    if (isset($_SESSION['user']))
    {
        if ($controllers->members()->get_role_id($_SESSION['user']['ID'])['role_id'] !== 2)
        {
            redirect('login', ["error" => "You need to be an admin to view this page"]);
        }
    }
?>

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <?php require __DIR__ . "/components/adminUsers.php"; ?>
        </div>
    </div>
</div>

<?php

    require __DIR__ . "/inc/footer.php";
?>