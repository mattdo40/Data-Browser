<?php
include "pokemonClassCreation.php";
include "connectDB.php";


// get pokemon from db 
if (isset($_POST["Index"])) {
	$index =(int)$_POST["Index"];

	// Selection of data 
	$sql = "SELECT pkey, pname, ptype, pokedexnum, legendary, generation, imgLink FROM pokemontable WHERE pkey=". $index;
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$newPokemon=new Pokemon();
		$newPokemon->pokemonId=($row["pkey"]);
		$newPokemon->pname=($row["pname"]);
        $newPokemon->ptype=($row["ptype"]);
		$newPokemon->pokedexnum=($row["pokedexnum"]);
		$newPokemon->legendary=($row["legendary"]);
		$newPokemon->generation=$row["generation"];
		$newPokemon->imgLink=($row["imgLink"]);
		}

		$pokemon = json_encode([$newPokemon]);
		echo $pokemon;
	}else {
		$bad1=[ 'bad' => 1];
		echo json_encode($bad1);	
	}
}

if (isset($_POST["array"])) {

	$sql = "SELECT COUNT(*) AS Total FROM pokemonTable;";
	$result = $conn->query($sql);
	$total = $result->fetch_assoc();
	$total = $total["Total"];
	
	// Selection of data 
	$sql = "SELECT pkey, pname, ptype, pokedexnum, legendary, generation, imgLink FROM pokemontable";
	$result = $conn->query($sql);

	$i=0;
	$pokemonArr= Array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
            $newPokemon=new Pokemon();
            $newPokemon->pokemonId=($row["pkey"]);
            $newPokemon->pname=($row["pname"]);
            $newPokemon->ptype=($row["ptype"]);
            $newPokemon->pokedexnum=($row["pokedexnum"]);
            $newPokemon->legendary=($row["legendary"]);
            $newPokemon->generation=$row["generation"];
            $newPokemon->imgLink=($row["imgLink"]);
            $pokemonArr[$i]=$newPokemon;
            $i+=1;
		}
		$pokemonArr[$i]= $total;
		$pokemon = json_encode($pokemonArr);
		echo $pokemon;
	}else {
		$bad1=[ 'bad' => 1];
		echo json_encode($bad1);	
	}

$conn->close();
}

?>