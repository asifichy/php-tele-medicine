<?php
include("db.php");

include("recommend.php");

$disease = mysqli_query($conn,"select * from doctor_rating");
$matrix=array();

    while($ds=mysqli_fetch_array($disease))
    {   

        $doctors= mysqli_query($conn,"select doctorname from doctors where id=$ds[doctor_id]");
        $doctorname=mysqli_fetch_array($doctors);

        $matrix[$doctorname['doctorname']][$ds['disease_name']]=$ds['disease_rating'];



    }

       $doctors= mysqli_query($conn,"select doctorname from doctors where id=$_GET[id]");
       $doctorname=mysqli_fetch_array($doctors);

    
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
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


  <div class="container">
    <h2>Disease Wise Recommendation for the Doctor</h2>
    
  </div>

  <div class="container">
   <table>

    <th>Diseases Name</th>
    <th>Recommendation Rating </th>
    


    <?php

        $recomendation=array();

        $recomendation=(getrecommendation($matrix,$doctorname['doctorname']));

        foreach($recomendation as $disease=>$rating)
        {
  
            ?> 
            <tr>
            <td><?php echo $disease; ?> </td>
            <td><?php echo $rating;?> </td>
            
            </tr>

    <?php } ?>

   </table>
    
  </div>

 

  <div class="container" style="background-color:#f1f1f1">
  <a href="in.php"> <button type="button" class="backbtn">Back</button> </a>
  
  </div>


</body>
</html>