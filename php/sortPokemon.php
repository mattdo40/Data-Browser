<?php
    include "connectDB.php";
    include "pokemonClassCreation.php";
    
    $sql = "SELECT COUNT(*) AS AmountPokemon FROM pokemonTable;";
    $result = $conn->query($sql);
    $amount = $result->fetch_assoc();
    $amount = $amount["AmountPokemon"];
    
    if (isset($_POST['Alphabetical'])){
        $sql = "SELECT pkey, pname, ptype, pokedexnum, legendary, generation, imgLink FROM pokemonTable ORDER BY pname ASC";
    
    }
    if (isset($_POST['Index'])){
        $sql = "SELECT pkey, pname, ptype, pokedexnum, legendary, generation, imgLink FROM pokemonTable ORDER BY pokemonTable.pkey ASC";
    }
    $result = $conn->query($sql);

    $i=0;
    $pokemonArr= Array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $newPokemon= new Pokemon();
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
        $pokemonArr[$i]= $amount;
        $pokemon = json_encode($pokemonArr);
        echo $pokemon;
    } else {
        echo "name sorting Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>