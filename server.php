<?php
    session_start();
    // connect to db
    $db = mysqli_connect('localhost', 'root', '', 'crud-php');
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
      }
      else
      {
        // echo "Connected Successfully.";
      
   
        // initialize variables
        $name = "";
        $address = "";
        $id = 0;
        $update = false;
    
        // if save button is clicked
        if (isset($_POST['save']))
         {
            
            $name = $_POST['name'];
            $address = $_POST['address'];
            // echo $name,$address;
            $query="INSERT INTO info (name, address) VALUES ('$name', '$address')";
            mysqli_query($db,$query); 
            $_SESSION['message'] = "Address saved"; 
            // redirecting to home page after insertion
            header('location: index.php');
        }
        // else{
        //     print "failure to insert";
        // }
      }

    //   retrieve records
    $results = mysqli_query($db, "SELECT * FROM info");

    // update records
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $address = $_POST['address'];
    
        mysqli_query($db, "UPDATE info SET name='$name', address='$address' WHERE id=$id");
        $_SESSION['message'] = "Address updated!"; 
        header('location: index.php');
    }
 
    // deleting record
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($db, "DELETE FROM info WHERE id=$id");
        $_SESSION['message'] = "Address deleted!"; 
        header('location: index.php');
    }
?>