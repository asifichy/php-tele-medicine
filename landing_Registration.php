<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'hcproject');
 

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 

if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

 

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    }
     elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"])))
     
     {
        $username_err = "Username can only contain letters, numbers, and underscores.";

    }
    
    else{
        
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            
            $stmt->bind_param("s", $param_username);
            
            
            $param_username = trim($_POST["username"]);
            
            
            if($stmt->execute()){
                
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

          
            $stmt->close();
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
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = $password; 
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css"> 

</head>  

<body>
<div class="loginPage">
    <div class="loginform">
        <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
            <h2>Register Here</h2>
            
               
                <input type="text" name="username" placeholder="Enter Username <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span style="color:white"><?php echo $username_err; ?></span>

                
                <input type="password" name="password" placeholder="Enter Password <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span style="color:white"><?php echo $password_err; ?></span>
                
                <input type="password" name="confirm_password" placeholder="Confirm Password <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span style="color:white"><?php echo $confirm_password_err; ?></span>
                
                <input type="submit" class="btnn" value=" Click For Register">
                <input type="reset" class="btnn" value="Reset">

        <p class="link">Already Have an account?<br><br>
        <a href="login.php"> Click For Login</a></p>
            
            
        </form>
    </div>
</div>    
</body>
</html>