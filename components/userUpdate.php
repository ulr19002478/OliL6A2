<?php
// Include the functions file for utility functions
require_once './inc/functions.php';

// Initialize a variable to store any error message from the query string
$message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  // Process the submitted form data
  $fname = InputProcessor::processString($_POST['fname']);
  $sname =  InputProcessor::processString($_POST['sname']);
  $email =  InputProcessor::processEmail($_POST['email']);
  $password =  InputProcessor::processPassword($_POST['password'], $_POST['password-v']);
  
  // Validate all inputs
  $valid = $fname['valid'] && $sname['valid'] && $email['valid'] && $password['valid'];

  // Set an error message if any input is invalid

  // If all inputs are valid, proceed with registration
  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    // Prepare the data for registration
    $args = ['firstname' => $fname['value'],
             'lastname' => $sname['value'],
             'email' => $email['value'],
             'password' => password_hash($password['value'], PASSWORD_DEFAULT),
             'role_id' => $_POST['role'],
             'id' => $_POST['id']];

             print_r($args);

             $controllers->members()->update_member($args);
             redirect('adminUsers');
    
  } 
}

$user = $controllers->members()->get_member_by_id($_GET['id']);



?>

<!-- HTML form for registration -->
<form method="post" action=" <?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <section class="vh-100">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <h3 class="mb-2">Update User</h3>
              <p>test</p>
              <div class="form-outline mb-4">
                <input required type="text" id="fname" name="fname" class="form-control form-control-lg" placeholder="Firstname" value="<?= htmlspecialchars($fname['value'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($fname['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="text" id="sname" name="sname" class="form-control form-control-lg" placeholder="Surname" value="<?= htmlspecialchars($sname['value'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($sname['error'] ?? '') ?></small>
              </div>


              <div class="form-outline mb-4">
                <input required type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" value="<?= htmlspecialchars($email['value']?? '') ?>" />
                <small class="text-danger"><?= htmlspecialchars($email['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" />
              </div>
              
              <div class="form-outline mb-4">
                <input required type="password" id="password-v" name="password-v" class="form-control form-control-lg" placeholder="Password again" />
                <small class="text-danger"><?= htmlspecialchars($password['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="number" id="role" name="role" class="form-control form-control-lg" placeholder="Role" />
                <small class="text-danger"><?= htmlspecialchars($roles['error'] ?? '') ?></small>
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