<?php

include("db.php");
$flag=0;


if(isset($_POST['submit']))
{
 $result= mysqli_query($conn,"insert into users(doctorname)values('$_POST[doctorname]')");
  
 if($result)
 {
  $flag=1;

 }

}


?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input{
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.backbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<form action="adduser.php" method="post">
  <div class="container">
    <h2>The Doctor Recommendation and Rating System</h2>
    
  </div>

  <div class="container">
    <label for="doctorname"><b>Doctor Name</b></label>
    <input type="text" placeholder="Enter Doctor" name="doctorname">

    <button type="submit" name="submit">Submit</button>
  
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="backbtn">Back</button>

    <?php
    
      if($flag)
      {
          ?>
          <div><button type="button" class="backbtn">Doctor Name is Inserted successfully!!</button></div>
          
          <?php

      }

    ?>
   
  </div>
</form>

</body>
</html>





