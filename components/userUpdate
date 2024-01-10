<?php
    require_once './inc/functions.php';

    // Initialize variables for message, email, and password
    $message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
    $email = null;
    $password = null;

    // Check if the form is submitted via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $args = ['firstname' => $_POST['fname'],
                 'lastname' => $_POST['sname'],
                 'email' => $_POST['email'],
                 'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                 'role_id' => $_POST['role']];

        print_r($args);
        print($_POST['id']);

        $controllers->members()->update_member($args, $_POST['id']);
        redirect('adminUsers');
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
              <div class="form-outline mb-4">
                <input required type="text" id="fname" name="fname" class="form-control form-control-lg" placeholder="Firstname" value="<?= htmlspecialchars($user['firstname'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($fname['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="text" id="sname" name="sname" class="form-control form-control-lg" placeholder="Surname" value="<?= htmlspecialchars($user['lastname'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($sname['error'] ?? '') ?></small>
              </div>


              <div class="form-outline mb-4">
                <input required type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" value="<?= htmlspecialchars($user['email']?? '') ?>" />
                <small class="text-danger"><?= htmlspecialchars($email['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" />
              </div>

              <div class="form-outline mb-4">
                <input required type="number" id="role" name="role" class="form-control form-control-lg" placeholder="Role" value="<?= htmlspecialchars($user['role_id'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($role['error'] ?? '') ?></small>
              </div>

              <input type="hidden" id="id" name="id" value="<?= htmlspecialchars($user['ID'] ?? '') ?>">

              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Update</button>

              <?php if ($message): ?>
                <div class="alert alert-danger mt-4">
                  <?= $message ?? '' ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>