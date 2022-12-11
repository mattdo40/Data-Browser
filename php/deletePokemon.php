<?php
    include "connectDB.php";



    if (isset($_POST['pokemonId'])){$inputPokemonId = $_POST['pokemonId'];};

    $sql = "DELETE FROM pokemontable WHERE pkey = $inputPokemonId";

  
    if ($conn->query($sql) === TRUE) {
       //echo "Deleted successfully";
      } else {
       // echo "delete Pokemon Error: " . $sql . "<br>" . $conn->error;
      }
    $conn->close();
    //add header to redirect to the main page
    header("Location: ../Project 2.html");
?>
