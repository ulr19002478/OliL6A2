<?php 
    require_once 'inc/functions.php';

    if (!isset($_SESSION['user'])) {
        redirect('login', ["error" => "You need to be logged in to view this page"]);
    }

    $title = 'Home'; 
    require __DIR__ . "/inc/header.php"; 
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Welcome <?= $_SESSION['user']['firstname'] ?? 'Member' ?>!</h1>

    <div class="card-deck">
        <div class="card text-center">
            <img src="https://cdn-prod.medicalnewstoday.com/content/images/articles/325/325253/assortment-of-fruits.jpg" class="card-img-top" alt="Image 1" style="height: 300px;">
            <div class="card-body">
                <h5 class="card-title">Explore Inventory</h5>
                <p class="card-text">Browse through our diverse range of equipment.</p>
            </div>
            <div class="card-footer">
                <a href="inventory.php" class="btn btn-primary btn-block">View Inventory</a>
            </div>
        </div>

        <div class="card text-center">
            <img src="https://www.healthyeating.org/images/default-source/home-0.0/nutrition-topics-2.0/general-nutrition-wellness/2-2-2-3foodgroups_fruits_detailfeature.jpg?sfvrsn=64942d53_4" class="card-img-top" alt="Image 3" style="height: 300px;">
            <div class="card-body">
                <h5 class="card-title">Logout</h5>
                <p class="card-text">Logout and come back whenever you want.</p>
            </div>
            <div class="card-footer">
                <a href="login.php" class="btn btn-primary btn-block">Logout</a>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . "/inc/footer.php"; ?>
