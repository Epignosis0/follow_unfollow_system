<?php

require_once "config.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Page</title>
  <?php include_once "includes/headerScripts.php";?>
</head>

<body>

<?php

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST["confirmPassword"];

    if ($password == $confirmPassword) {

        $hashPassword = password_hash($password, PASSWORD_BCRYPT);

        // Query
        $sql = "INSERT INTO user_information (username, email, password) VALUES (:username, :email, :password)";

        //Preparing Query
        $result = $conn->prepare($sql);

        //Binding Values
        $result->bindValue(":username", $username);
        $result->bindValue(":email", $email);
        $result->bindValue(":password", $hashPassword);

        // Executing Query
        $result->execute();

        if ($result) {
            echo "<script>Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'You are successfully registered '
            })</script>";

        } else {
            echo "<script>Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'You are failed to register'
            })</script>";

        }

    } else {
        echo "<script>Swal.fire({
              icon: 'warning',
              title: 'Warning',
              text: 'Password & Confirm Password Field are not Matching'
            })</script>";

    }
}

?>

<!-- Navbar -->
<?php include_once "includes/navbarLogin.php";?>

  <main class="container my-5">
    <div class="row">
      <section class="col-md-6 offset-md-3">

          <h3 class="breadcrumb font-time mb-3 text-uppercase">Register here</h3>

          <form action= "" method="post">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username"
                aria-describedby="usernameHelp">
              <small id="usernameHelp" class="text-muted"></small>
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email">
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control"
                placeholder="Enter Your Password">
            </div>

            <div class="form-group">
              <label for="confirmPassword">Confirm Password</label>
              <input type="password" name="confirmPassword" id="confirmPassword" class="form-control"
                placeholder="Confirm Your Password">
            </div>

            <input type="submit" value="Register" name="register" class="btn btn-primary btn-block rounded-pill">
          </form>

          <p class="my-2 font-sans">Already Register? <a href="login.php">Please Login here</a></p>

      </section>
    </div>
  </main>

</body>

</html>