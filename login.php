<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbproject";

// Create connection
$link = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);   
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $mypassword = $_POST['password'];
  $sql1 = "SELECT uemail, upass FROM signin WHERE uemail = '$email' ";
  $result = $link->query($sql1);
  // $stmt1 = $link->prepare($sql1);
  // $stmt1->execute();
  // $result = $stmt1->get_result();

  if ($result->num_rows > 0) {

    $row = $result->fetch_array(MYSQLI_ASSOC);
    $hashedPassword = $row['upass'];
    $email = $row['uemail'];
    // $active_status = $row['active_status'];
    echo $mypassword;
    $pass_hashed = password_hash($mypassword,PASSWORD_DEFAULT);
    echo "<br>";
    echo $pass_hashed;
    echo "<br>";
    echo $hashedPassword;
    if(password_verify($mypassword, $hashedPassword)) {
 
      
      echo 'password is correct'; 	
      session_start();
 
      $_SESSION["loggedin"] = true;
      $_SESSION["email"] = $email;

      $sql4 = "SELECT applicant_email from verified where applicant_email = '$email' and verifieremail_1 IS NOT NULL and verifieremail_2 IS NOT NULL and verifieremail_3 IS NOT NULL ";
      $result = $link->query($sql4);

      if ($result->num_rows > 0)
      {
        $sql2 = "CALL logging(?)";
        $stmt2 = $link->prepare($sql2);
        $stmt2->bind_param('s', $email);
        //$stmt2->execute();
        //run the store proc
        if (!$stmt2->execute()) {
            die( "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);
        }
        $stmt2->close();
        header("location: home.php");
      }
      else
      header("location: confirmation.php");
    } 

    else {
      $err = "Your Password is invalid";
    }
   } //else {

  //   $sql2 = "SELECT cust_id FROM customer WHERE cust_email = '$email'
  //   and active_status='deactive'";
  //   $stmt2 = $link->prepare($sql2);
  //   $stmt2->execute();
  //   $result2 = $stmt2->get_result();

  //   if ($result2->num_rows > 0) {
  //     header("location: confirmation.php");
  //   } else {
  //     $err = "Your Email is not registered.";
  //   }
  //   $stmt2->close();
  // }
  // $stmt1->close();
}  

?>
<?php include "header.php" ;?>
</head>
<body>
  <style type="text/css">
    body {
      font: 14px sans-serif;
    }

    .wrapper {
      width: 350px;
      padding: 20px;
    }
  </style>

  <div class="wrapper">
    <!-- <img class="rounded mx-auto d-block" src="img/logo.png" width="200" height="120" alt=""> -->
    <h2>Login</h2>
    <!-- <p>Please fill in your credentials to login.</p> -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Login">

      </div>
      <h2><?php echo $err ?></h2>
      <p>New to our website?<a href="signup.php"> Create an account</a></p>
    </form>
  </div>
</body>

</html>