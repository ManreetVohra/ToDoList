<?php
    $insert = false;
    $update = false;
    $delete = false;
    // Connect to the Database 
    $servername = "localhost:3306";
    $username = "root";
    $password = "Gurjit@27";
    $database = "to_do_list";
  
    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);
  
    // Die if connection was not successful
    if (!$conn){
        die("Sorry we failed to connect: ". mysqli_connect_error());
    }
  
    if(isset($_GET['delete'])){
      $sno = $_GET['delete'];
      $delete = true;
      $sql = "DELETE FROM `to-do-list` WHERE `sno` = $sno";
      $result = mysqli_query($conn, $sql);
    }
  
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      if (isset( $_POST['snoEdit'])){
        // Update the record
          $sno = $_POST["snoEdit"];
          $title = $_POST["titleEdit"];
          $description = $_POST["descriptionEdit"];
  
        // Sql query to be executed
        $sql = "UPDATE `to-do-list` SET `title` = '$title' , `description` = '$description' , `tstamp` =  current_timestamp() WHERE `to-do-list`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);
        if($result){
          $update = true;
        }
        else{
          echo "We could not update the record successfully";
        }
      }
      else{
          $title = $_POST["title"];
          $description = $_POST["description"];
  
        // Sql query to be executed
        $sql = "INSERT INTO `to-do-list` (`title`, `description`, `tstamp`) VALUES ('$title', '$description',current_timestamp())";
        $result = mysqli_query($conn, $sql);
  
        
        if($result){ 
            $insert = true;
        }
        else{
            echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
        } 
      }
    }
?>