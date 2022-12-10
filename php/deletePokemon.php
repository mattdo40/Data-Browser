<?php
    include "connectDB.php";


    // Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error ."<br>");
} 
echo "Connected successfully <br>";
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
