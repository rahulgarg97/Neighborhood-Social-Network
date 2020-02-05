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
//include("config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $bio = $_POST["bio"];
    $family = $_POST["family"];
    $street = $_POST["street"];
    $apt = $_POST["apartment"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $country = $_POST["country"];
    $zip = $_POST["zip"];
    $password = password_hash($_POST["password"],PASSWORD_DEFAULT);

    
    session_start();
    $_SESSION['signup_email'] = $email;

    $sql = "SELECT uemail from signin where uemail='$email' ";
    // $stmt1 = $link->prepare($sql);
    $result = $link->query($sql);
    // $stmt1->execute();
    // $res = $stmt1->get_result();

    if ($result->num_rows > 0) {
        // output data of each row
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($email == $row['uemail']) {
            echo "Email already exists";
        }
    } else {
       $sql2 = "CALL registration(?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt2 = $link->prepare($sql2);
        $stmt2->bind_param('sssssssssssi', $email, $password, $fname, $lname, $bio, $family, $street, $apt, $city, $state, $country, $zip);
        //$stmt2->execute();
        //run the store proc
        if (!$stmt2->execute()) {
            die( "CALL failed: (" . $mysqli->errno . ") " . $mysqli->error);
        }
        $stmt2->close();
        //session_start();
        //$_SESSION["name"]=$name;
        //$cookie_name = "user";
        //$cookie_value = $name;
        //setcookie($cookie_name, $cookie_value, time() + 300, "/"); // 86400 = 1 day
        //header("location: signup.php");
    }
    // $res->close();
    // $stmt1->close();
    $link->close();
    header("location: apply.php");
}


?>

<?php include "header.php" ?>
</head>
<body>
    <style type="text/css">
        body {
            font:20px;
        }

        .wrapper {
            width: 400px;
            padding: 20px;
        }
    </style>

    <div class="wrapper">
        <!-- <img class="rounded mx-auto d-block" src="img/logo.png" width="200" height="120" alt=""> -->
        <h2>Sign Up</h2>
<!--         <p>Please fill this form to create an account.</p> -->
        <!-- <form action="login.php" method="post">

 -->

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</labeNumber>
                    <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="fname" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lname" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Bio</label>
                <input type="text" name="bio" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Family</label>
                <input type="text" name="family" class="form-control">
            </div>

            <div class="form-group">
                <label>Street</label>
                <input type="text" name="street" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Apartment</label>
                <input type="text" name="apartment" class="form-control" required>
            </div>

            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" class="form-control" required>
            </div>

            <div class="form-group">
                <label>State</label>
                <input type="text" name="state" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Country</label>
                <input type="text" name="country" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Zip</label>
                <input type="text" name="zip" class="form-control" required>
            </div>

 <!--            <div class='form-group'>
                <label>Block</label>
                <select name="block" id="blockID" class="form-control" required>
                    <option value="1">aa</option>
                </select>
            </div> -->


 <!--            <div class="form-group">
                <label>Apartment Number</label>
                <input type="text" name="apt" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Introduction</label>
                <textarea name="intro" rows="4" cols="50" id="exampleFormControlTextarea1" placeholder="Please enter intro" required></textarea>
            </div>
            <div class="form-group">
                <label>Upload a picture</label>
                <input type="file" name="cust_photo" accept="image/*" class="form-control-file" id="exampleFormControlFile1">
            </div> -->

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">

                <input type="reset" class="btn btn-default" value="Reset">
		
	

            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>


    </div>
</body>

</html>