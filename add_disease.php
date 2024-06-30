<?php

    session_start();

    if(isset($_GET['id']))
    {

       $_SESSION['id']= $_GET['id'];
       
    }

     
include("db.php");
$flag=0;


if(isset($_POST['submit']))
{

 $result= mysqli_query($conn,"insert into doctor_rating(doctor_id,disease_name,disease_rating)values('$_SESSION[id]','$_POST[disease_name]','$_POST[disease_rating]')");
  
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

  button{
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

  <form action="add_disease.php" method="post">
    <div class="container">
      <h2>The Doctor Recommendation and Rating System</h2>
      
    </div>

    <div class="container">
      <label for="disease_name"><b>Disease Name</b></label>
      <input type="text" placeholder="Enter Disease Name" name="disease_name" id="disease_name">
    </div>
      
    <div class="container">
      <label for="disease_name"><b>Rating</b></label>
      <input type="Number" placeholder="Enter Ratings" name="disease_rating" id="number">
      <button type="submit" name="submit">Submit</button>
    
    </div>


    <div class="container" style="background-color:#f1f1f1">
    <a href="in.php"> <button type="button" class="backbtn">Back</button> </a>

      <?php
      
        if($flag)
        {
            ?>
            <div><button type="button" class="backbtn">Ratings Information is Inserted successfully!!</button></div>
            
            <?php

        }

      ?>
    
    </div>
  </form>

  </body>
</html>
