<?php
  include "connectDB.php";
  include "uploadImage.php";

  if (isset($_POST['pname'])){$setPname = $_POST['pname'];};
  if (isset($_POST['ptype'])){$setPtype = $_POST['ptype'];};
  if (isset($_POST['num'])){$setPokedexnum = $_POST['num'];};
  if (isset($_POST['caught'])){$setLegendary = $_POST['caught'];};
  if (isset($_POST['generation'])){$setGeneration = $_POST['generation'];};
  if (isset($_POST['pokemonId'])){$setPokemonId = $_POST['pokemonId'];};

  $inputPath = basename($_FILES["imgLink"]["name"]);

  $sql = "SELECT imgLink AS imgPath FROM pokemontable WHERE pkey = $setPokemonId";
  $result = $conn->query($sql);
  $currImg = $result->fetch_assoc();
  $currImg = $currImg["imgPath"];

// The below code is used for testing purposes. Removing the header line lets you see the echo messages.
if($inputPath == NULL && $currImg != NULL){
    echo '<br> not chosen but img already in db:'.$currImg.'<br>';
    $setPath = $currImg;
  }
  // if no img chosen and it doesn't exist in the tbl, no img
  else if($inputPath == NULL && $currImg == NULL){
    echo '<br> not chosen, no img in db:'.$currImg.'<br>';
    $setPath = NULL;
  }

  // if img chosen, but already exists in the local folder or it was uploaded correctly
  else if(file_exists('../imgs/'.$inputPath) || $uploadOk == 1){
    echo '<br> img already in folder or it was uploaded correctly:'.'imgs/'.$inputPath.'<br>';
    $setPath = 'imgs/'.$inputPath;
  }
  else{
    // img to folder upload failed
    if ($uploadOk == 0){echo ($message);} 
  }

  $sql = "UPDATE pokemontable SET pname ='$setPname', ptype='$setPtype', pokedexnum='$setPokedexnum', legendary='$setLegendary', generation='$setGeneration',imgLink='$setPath' WHERE pkey = $setPokemonId;";

  if ($conn->query($sql) === TRUE) {
      echo $setPname . " created successfully" ;
    } else {
      echo "add Pokemon Error: " . $sql . "<br>" . $conn->error;
    }
  $conn->close();
  //have to add this line to redirect to the main page
  header("Location: ../Project 2.html");

?>