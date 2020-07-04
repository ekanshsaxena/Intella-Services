<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$firstname = $lastname = $email = $mobile = $address = $city = $state = $password = $confirm_password = "";
$firstname_err = $lastname_err = $email_err = $mobile_err = $address_err = $city_err = $state_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate firstname
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "PLease enter your firstname.";
    }
    else{
        $firstname = trim($_POST["firstname"]);
    }

    //Validate Lastname
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "PLease enter your lastname.";
    }
    else{
        $lastname = trim($_POST["lastname"]);
    }

    //Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email address.";
    }else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }



    //Validate mobile
    if(empty(trim($_POST["mobile"]))){
        $mobile_err = "Please enter your mobile number.";
    }
    elseif(strlen(trim($_POST["mobile"])) != 10){
        $mobile_err = "Mobile must be of 10 digits only.";}
    else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE mobile = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_mobile);
            
            // Set parameters
            $param_mobile = trim($_POST["mobile"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $mobile_err = "This mobile no. is already taken.";
                } else{
                    $mobile = trim($_POST["mobile"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    $address = trim($_POST["address"]);
    $city = trim($_POST["city"]);
    $state = trim($_POST["state"]);
    // Check input errors before inserting in database
    if(empty($lastname_err) && empty($email_err) && empty($mobile_err) && empty($password_err) && empty($confirm_password_err) && empty($firstname_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (firstname, lastname, email, mobile, password, address, city, state) VALUES (?, ?, ?, ?, ?, ? , ? , ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss",$param_firstname, $param_lastname, $param_email, $param_mobile, $param_password, $param_address, $param_city, $param_state);
            
            // Set parameters
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_mobile = $mobile;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_address = $address;
            $param_city = $city;
            $param_state = $state;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif;
            background: url("assets/img/login.jpg");
         text-align: center;}
        .wrapper{display: inline-block; width: 600px; padding: 20px; margin: auto;margin-top: 5%;}
    </style>
</head>
<body>
        <div class="menu">
        <?php
        Include "header.php";
        ?>
    </div><center>
    <div class="wrapper">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="background-color: rgb(255,160,7);color: black; font-size: 16px; padding: 30px 20px 30px 20px; text-align: left;margin-bottom: 40px;">
                    <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
            <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                <label>Firstname<span style="color: red;">*</span></label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                <span class="help-block"><?php echo $firstname_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                <label>Lastname<span style="color: red;">*</span></label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                <span class="help-block"><?php echo $lastname_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email<span style="color: red;">*</span></label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($mobile_err)) ? 'has-error' : ''; ?>">
                <label>Mobile<span style="color: red;">*</span></label>
                <input type="number" name="mobile" class="form-control" value="<?php echo $mobile; ?>">
                <span class="help-block"><?php echo $mobile_err; ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password<span style="color: red;">*</span></label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password<span style="color: red;">*</span></label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
            </div>
            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
            </div>
            <div class="form-group">
                <label>State</label>
                <input type="text" name="state" class="form-control" value="<?php echo $state; ?>">
            </div><br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div> </center>
       <?php
  include "footer.php";
  ?>  
</body>
</html>