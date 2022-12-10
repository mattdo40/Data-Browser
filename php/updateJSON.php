<?php

include "connectDB.php";
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error ."<br>");
} 

    $sql = "SELECT pname, ptype, pokedexnum, legendary, generation, imgLink FROM pokemonTable";
    $result = $conn->query($sql);
    $pokemonArr= array();
    while($row =mysqli_fetch_assoc($result)) {
        $pokemonArr[] = $row;
    }
   //echo json_encode($pokemonArr, JSON_PRETTY_PRINT);
    
    $string=json_encode($pokemonArr, JSON_PRETTY_PRINT);

	$f = fopen("pokemon.json","w");
	fwrite($f,$string);
	fclose($f);	

	
    //close the db connection
    $conn->close();
    header("Location: ../Project 2.html");
?>