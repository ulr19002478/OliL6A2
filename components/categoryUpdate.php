<?php
// Include the functions file for utility functions
require_once './inc/functions.php';

// Initialize a variable to store any error message from the query string
$message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  // Process the submitted form data
  $name = InputProcessor::processString($_POST['name']);

  
  // Validate all inputs
  $valid = $fname['valid'];

  // Set an error message if any input is invalid

  // If all inputs are valid, proceed with registration
  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    // Prepare the data for registration
    $args = ['firstname' => $name['value'],
             'id' => $_POST['id']];

             print_r($args);

             $controllers->categories()->update_category($args);
             redirect('adminCategory');
    
  } 
}

$category = $controllers->categories()->get_category_by_id($_GET['id']);



?>

<!-- HTML form for registration -->
<form method="post" action=" <?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <section class="vh-100">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <h3 class="mb-2">Update Category</h3>
              <div class="form-outline mb-4">
                <input required type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Category Name" value="<?= htmlspecialchars($name['value'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($name['error'] ?? '') ?></small>
              </div>

              <input type="hidden" id="id" name="id" value="<?= htmlspecialchars($user['ID'] ?? '') ?>">

              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Update</button>


              <?php if ($message): ?>
                <div class="alert alert-danger mt-4">
                  <?= $message ?? '' ?>
                </div>
              <?php endif ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>