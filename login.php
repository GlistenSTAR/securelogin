<?php
    session_start();
    require_once("Mycrypt.php");// this is my own security.

    // defined value
    $servername = "localhost";
    $rootUser="root";
    $db="socnet";
    $rootPassword ="";
    
    // Create connection
    $conn = new mysqli($servername, $rootUser, $rootPassword, $db);
    //get int value
    $username =$_POST['CustomerName'];
    $password =  $_POST['Password'];

    //my own security area
    $convertedPassword = security($password);
    print_r($convertedPassword);
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    // query
    $userQuery = "SELECT * FROM SystemUser";
    $userResult = $conn->query($userQuery);

    $userFound = 0;

    echo "<table border='1'>";
    if ($userResult->num_rows > 0)
    {
        while($userRow = $userResult->fetch_assoc()){
            if ($userRow['CustomerName'] == $username)
            {
                $_SESSION[$username]=0;
                if($userRow['closed']==1){
                    echo "Your account closed! Please contact admin.";
                } else {
                    $userFound = 1; 
                    $storedPassword = $userRow['CustomPwd'];
                    
                    if ($storedPassword == $convertedPassword)
                    {
                        echo "Hi" .$username. "!";
                        echo "<br/> Welcome to our website";
                    }
                    else
                    {
                        echo "Wrong password";
                        // If you typing 3 times wrong password, your account closed.
                        $_SESSION[$username]++;

                        if($_SESSION[$username] > 3){
                            $userRow['closed'] = 1;
                            echo "Your account closed!";
                            // this value initial set 0( in sql setDefault=0);
                        } else if($_SESSION[$username]==3){
                            echo "Warning. 1 time remain.";
                        } else if($_SESSION[$username]==2){
                            echo "Warning. 2 time remain.";
                        } else if($_SESSION[$username]==1){
                            echo "Warning. Three mistypes will lead to suspension.";
                        }
                    }
                }
            }
        }
    }
    if ($userFound == 0)
    {
        echo "This user was not found in our Database";
    }
 ?>