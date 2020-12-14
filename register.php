<?php
    require_once("Mycrypt.php");// this is my own security.

    $servername = "localhost";
    $rootuser="root";
    $db="socnet";
    $rootpassword ="";

    // Create connection
    $conn = new mysqli($servername, $rootuser, $rootpassword, $db);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    //Values from form
    $username= $_POST['txtUsername'];
    $forname =$_POST['txtForename'];
    $surname = $_POST['txtSurname']; 
    $email = $_POST['txtEmail']; 
    $password = $_POST['Password']; 

    $convertedPassword = security($password);
    // echo $convertedPassword;
    $userQuery = "INSERT INTO systemuser (CustomerName, CustomPwd, ForeName, SurName, CustomerEmailAddress) Values('$username', '$convertedPassword', '$forname', '$surname', '$email')";
    print_r($conn->connect_error) ;
    if ($conn->query($userQuery) === TRUE) {
      echo "Successily add customer";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>

