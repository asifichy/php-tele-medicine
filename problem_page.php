<?php

include("db.php");

$nameErr = $emailErr = $mobilenoErr = $ErrMsg = "";  
$name = $email = $mobileno = ""; 

 
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
      
//Name validation

    $name = $_POST["name"];

    $name_pattern = '/^[a-z A-Z]{3,30}+$/';

      if (empty($_POST["name"])) 
      { 

        $nameErr = "*Empty Name Field"; 


      }

      elseif(!preg_match($name_pattern,$name))
      { 

          $nameErr = "*Invalid Name"; 

                
      }

      else{

        $nameErr = ""; 

      }



//Email Validation
      $email = $_POST ["email"];

      $pattern = '/^[a-z 0-9]+[@][a-z]+[\.][a-z]+$/';

      if (empty($email)) 
      { 

        $ErrMsg = "*Empty Email Field"; 


      } 

      elseif(!preg_match($pattern, $email) )

      {  
          $ErrMsg = " *Invalid Email.";  
                 
      } 
      
      else
      
      {  
        $ErrMsg = ""; 

      }

    //Mobile Number validation

     
  $mobileno= $_POST["mobile"];

  $MOB_pattern = '/^01[3-9]{1}+[0-9]{8}+$/';

  if (empty($mobileno)) 
  { 

    $mobilenoErr= "*Empty MobileNo Field"; 
    

  } 

  elseif(!preg_match($MOB_pattern, $mobileno))

  {  
    $mobilenoErr= " *Invalid Mobile Number.";  
           
  } 

  else{

    $mobilenoErr= ""; 

  }

}



?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="manualpage.css">
<link rel="stylesheet" href="form.css">

<style>

.backbtn {
  width: auto;
  color:white;
  font-size: 15px;
  padding: 10px 18px;
  margin-left: 850px;
  margin-top: 100px;
  background-color:	#8d12b3;
}

.container
{
    margin-left: 400px;
    margin-top: 50px;
    border: 3px solid black;
    width: 1006px;   
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

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >

<div class="container">
            <div>
                <table bgcolor="Thistle">
                    <tr> 
                        <td>
                            <p style="text-align: left; font-family: Arial; font-size: 25px; color:black; margin: 10px;"><strong>Enter Medical Information</strong></p>

                            <tr bgcolor="white">
                                <td style="color: black; padding-top: 8px; padding-left: 12px;">
                          
                                    <br><br>
                                    <label for="name"><b>Name :</b></label> 
                                        <input type="text" name="name" size="30">
                                        <span> <?php echo $nameErr; ?> </span>
                                    <br><br>
                           
                                    <label for="doctor"><b>Doctor:</b></label>
                                    <select name="doctor">
                                        <option value="choose">-Select-</option>

                                        <?php
                                        $result= mysqli_query($conn,"select * from doctors");

                                        while($row= mysqli_fetch_array($result))
                                        {  
                                        ?> 
                                        <option value="<?php echo $row['doctorname']?>"><?php echo $row['doctorname']?></option>

                                        <?php } ?>   
                                    </select>

                                    <br><br>
                                    <label for="disease_name"><b>Disease:</b></label>

                                        <select name ="disease_name" id="disease_name">
                                            <option value="NULL">-Select-</option>
                                            <option value="cold">Cold</option>
                                            <option value="fever">Fever</option>
                                            <option value="HighCough">High Cough</option>
                                            <option value="Headache">Headech</option>
                                            <option value="HighFever">High Fever</option>
                                        </select>
                                    <br><br>
                                    <label for="email"><b>Email :</b></label> 
                                        <input type="text" name="email">
                                        <span> <?php echo $ErrMsg; ?> </span><br><br>
                                    <br><br>
                                    <label for="mobile"><b>Phone Number :</b></label> 
                                        <input type="text" name="mobile">
                                        <span> <?php echo $mobilenoErr; ?> </span><br><br>
                                    <br><br>
                                                
                                </td>

                                <td>
                                    <div>
                                        <div style="margin-top: 10px; margin-left: -80px;">
                                          
                                            <label for="Gender"><b>Gender:</b></label>
                                                <select name="gender">
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            <br><br>

                                            
                                            <br><br>

                                            <label for="age"><b>AGE:</b></label>  
                                                <div style="display: block; padding-left: 100px; margin-top: -18px;">

                                                    <input type="checkbox" name ="age" value="6"> Under 12 
                                                    <br>
                                                    <input type="checkbox" name ="age" value="16"> Under 18
                                                    <br>
                                                    <input type="checkbox" name ="age" value="30"> Avobe 18
                                                </div>
                                            <br><br>

                                        </div>
                                    </div>                                  
                                    
                                </td>

                                <tr bgcolor="Thistle">
                                    <td style="padding-left: 400px; margin: 5px;">
                                        <input type="submit" name="submit" class="button_submit" value="Submit">
                                        <input type="reset" class="button_cancel" name="reset">
                                    </td>
                                </tr>
                            </tr>
                        </td>
                    </tr>
                </table>
            </div>
 </div>

</form>

            <div>
            <a href="home_page.php"> <button type="button" class="backbtn">Back</button> </a>
            </div>


<?php 

if(isset($_POST['submit'])) 
{ 

 if($nameErr == "" && $emailErr == "" && $mobilenoErr == "")

  {


            $name = $_POST['name'];
            $doctor = $_POST['doctor'];
            $disease_name = $_POST['disease_name'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $gender = $_POST['gender'];
            $age = $_POST['age'];


      if($conn->connect_error){

        die('Connection Failed : ' .$conn->connect_error);


      }
      else{

        $stmnt = $conn->prepare("insert into patientinfo(name,doctor,disease_name,email,mobile,gender,age)


        values(?,?,?,?,?,?,?)");

        $stmnt->bind_param("sssssss",$name,$doctor,$disease_name,$email,$mobile,$gender,$age);


        $stmnt->execute();


        $stmnt->close();

        

      }
        

        $sql ="SELECT medicine,instruction FROM medical_instruction WHERE doctor='$doctor' AND disease_name='$disease_name'";


         $retval = mysqli_query($conn,$sql);

        if(! $retval ) {
            die('Could not get data: ' . mysql_error());
        }
        
        while($row = mysqli_fetch_array($retval)) 
        {
            
            echo "<table>";

            echo "<tr>";
            echo "<th>Your Prescription</th>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Name :{$name}</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Doctor Name :{$doctor}</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Your Age :{$age}</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Gender :{$gender}</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Your Email ID :{$email}</td>";
            echo "</tr>";
            
            echo "<tr>";
            echo "<td>Mobile Number :{$mobile}</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Suggested Medicine :{$row['medicine']}</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Instruction For You :{$row['instruction']}</td>";
            echo "</tr>";

            echo "</table>";

          
        }

    }
   
   
   
    $conn->close();
     
}

?>


</body>
</html>