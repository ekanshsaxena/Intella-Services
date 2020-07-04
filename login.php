<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$mobile = $password = "";
$mobile_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["mobile"]))){
        $mobile_err = "Please enter your mobile number.";
    } else{
        $mobile = trim($_POST["mobile"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($mobile_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, mobile, password FROM users WHERE mobile = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_mobile);
            
            // Set parameters
            $param_mobile = $mobile;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $mobile, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["mobile"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $mobile_err = "No account found with this mobile number.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif;
            background-image: url("assets/img/login.jpg");
         text-align: center;}
        .wrapper{display: inline-block; width: 450px; padding: 20px; margin: auto;margin-top: 5%;}
    </style>
</head>
<body>
    <div class="menu">
        <?php
        Include "header.php";
        ?>
    </div><center>
    <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="background-color: rgb(255,193,7);color: black;height: 400px; font-size: 16px; padding: 30px 20px 30px 20px; text-align: left; margin-bottom: 40px;">
            <h2>LOGIN</h2><br>
        <p>Please fill in your credentials to login.</p><br>
            <div class="form-group <?php echo (!empty($mobile_err)) ? 'has-error' : ''; ?>" style="margin-bottom: 20px;">
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control" value="<?php echo $mobile; ?>">
                <span class="help-block"><?php echo $mobile_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>" style="margin-bottom: 30px;">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login" style="margin-bottom: 30px;">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div> </center>
   <?php
  include "footer.php";
  ?>
</body>
</html>