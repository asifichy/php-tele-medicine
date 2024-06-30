<?php


  $conn = new mysqli('localhost','root','','hcproject');
  if($conn->connect_error){

    die('Connection Failed : ' .$conn->connect_error);
  }
  else{    
      $xml = simplexml_load_file("medical_input.xml") or die("Error: Cannot create object");
    
      foreach ($xml->children()as $row) {
        $doctor= $row->doctor;
        $disease_name= $row->disease_name;
        $medicine= $row->medicine;
        $instruction= $row->instruction;       

          $stmnt = $conn->prepare("insert into medical_instruction(doctor,disease_name,medicine,instruction)
          values(?,?,?,?)");

          $stmnt->bind_param("ssss",$doctor,$disease_name,$medicine,$instruction);

          $stmnt->execute();

        $stmnt->close();         
      }

      echo "Data inserted successfully";
    }

  $conn->close();
        
?>

