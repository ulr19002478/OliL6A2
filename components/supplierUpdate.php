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
  $contact =  InputProcessor::processString($_POST['contact_email']);


  
  // Validate all inputs
  $valid = $name['valid'] && $contact['valid'];

  // Set an error message if any input is invalid
  $message = !$valid ? "Please fix the above errors:" : '';

  // If all inputs are valid, proceed with registration
  if ($valid)
  {
    // Prepare the data for registration
    $args = ['name' => $name['value'],
             'contact_email' => $contact['value'],
             'id' => $_POST['id'],
            ];

             print_r($args);

    $controllers->suppliers()->update_supplier($args);

    redirect('adminSuppliers');
  }
}

$supplier = $controllers->suppliers()->get_supplier_by_id($_GET['id']);

?>



<form method="post" action=" <?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <section class="vh-100">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <h3 class="mb-2">Update Suppliers</h3>
              <div class="form-outline mb-4">
                <input required type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Name" value="<?= htmlspecialchars($supplier['name'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($name['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="text" id="contact_email" name="contact_email" class="form-control form-control-lg" placeholder="Contact Email" value="<?= htmlspecialchars($supplier['contact_email'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($contact['error'] ?? '') ?></small>
              </div>

              <input type="hidden" id="id" name="id" value="<?= $supplier['id'] ?>"/>

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