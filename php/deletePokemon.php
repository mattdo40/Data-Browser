<?php
    include "connectDB.php";
    if (isset($_POST['pokemonId'])){$input_pokemonId = $_POST['pokemonId'];};

    $sql = "DELETE FROM pokemontable WHERE pkey = $input_pokemonId";

    // Test function to see if the delete query works
    if ($conn->query($sql) === TRUE) {
       // echo "Record deleted successfully";
      } else {
       // echo "delete Pokemon Error: " . $sql . "<br>" . $conn->error;
      }
    $conn->close();
    //add header to redirect to the main page
    header("Location: ../Project 2.html");
?>
