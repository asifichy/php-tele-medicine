
<?php

session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home_page.php");
    exit;
}



define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'hcproject');
 

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 

if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

 

$username = $password = "";
$username_err = $password_err = $login_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
   
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    
    if(empty($username_err) && empty($password_err)){
        
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            
            $stmt->bind_param("s", $param_username);
            
            
            $param_username = $username;
            
           
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
              
                if($stmt->num_rows == 1){                    
                    
                    $stmt->bind_result($id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if($password==$hashed_password){
                            
                            session_start();
                            
                             //Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                          
                            header("location: home_page.php");

                        } else{
                            
                            $login_err = "Invalid username or password.";
                            echo "Login Error.";
                        }
                    }
                } else{
                    
                    $login_err = "Invalid username or password.";
                }
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
<head>

<link rel="stylesheet" href="style.css"> 

</head>

    <body>

    <div class="loginPage">

    <div class="loginform">
    <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Login Here</h2>
        <input type="text" name="username" placeholder="Enter Username <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
        <span><?php echo $username_err; ?></span>

        <input type="password" name="password" placeholder="Enter Password <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
        <span><?php echo $password_err; ?></span>


        <input type="submit" class="btnn" value="Login">

        <p class="link">Don't Have an account?<br><br>
        <a href="landing_Registration.php">Register Here</a></p>

    </form>
       
      </div>

    </div>
    </body>
    </html>
