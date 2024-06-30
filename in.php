<?php

include("db.php");

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="manualpage.css">
<style>


input{
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

.button{
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover{
  opacity: 0.8;
}

.backbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.container{
  padding: 16px;
}

span.psw{
  float: right;
  padding-top: 16px;
}

table{
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
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

<div class="manual">
       
       <div class="navbar">
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
           <a class="active" href="home_page.php"><i class="fa fa-fw fa-home"></i> Home</a> 
           <a href="#"><i class="fa fa-fw fa-envelope"></i> About Us</a> 
         </div>
</div>


  <div class="container">
    <h2>Ratings Of the Doctor for Recommendation</h2>
    
  </div>

  <div class="container">
   <table>

    <th>Doctor Name</th>
    <th>Give Ratings</th>
    <th>Show Ratings</th>


    <?php
    $result= mysqli_query($conn,"select * from doctors");

    while($row= mysqli_fetch_array($result))
    {
    ?> 
    <tr>
      <td><?php echo $row['doctorname']?> </td>
      <td>
        <form action="add_disease.php">
          <input type="submit" name="add_disease" class="button" value="Give Ratings">
          <input type="hidden" name="id" value="<?php echo $row['id']?>">
          
        </form>
      </td>

      <td>
        <form action="show_ratings.php">
          <input type="submit" name="show_rating" class="button" value="Show Ratings">
          <input type="hidden" name="id" value="<?php echo $row['id']?>">
          
        </form>
      </td>






    </tr>

    <?php } ?>

   </table>
    
  </div>

 

  <div class="container" style="background-color:#f1f1f1">
  <a href="home_page.php"> <button type="button" class="backbtn">Back</button> </a>
  </div>


</body>
</html>