<?php

define('DB_SERVER',  "localhost");
define('DB_USERNAME',  "matt");
define('DB_PASSWORD',  "matt");
define('DB_NAME',  "pokemondb"); 

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error ."<br>");
} 

    $sql = "SELECT pname, ptype, pokedexnum, pcaught, generation, imgLink FROM pokemonTable";
    $result = $conn->query($sql);
    $pokemonArr= array();
    while($row =mysqli_fetch_assoc($result)) {
        $pokemonArr[] = $row;
    }
   echo json_encode($pokemonArr, JSON_PRETTY_PRINT);
    
    $string=json_encode($pokemonArr);

	$f = fopen("pokemon.json","w");
	fwrite($f,$string);
	fclose($f);	

	
    //close the db connection
    mysqli_close($conn);
    header("Location: ../Project 2.html");
?>