<?php
  include "connectDB.php";
  include "uploadImage.php";
  

  if (isset($_POST['pname'])){$setPname = $_POST['pname'];};
  if (isset($_POST['ptype'])){$setPtype = $_POST['ptype'];};
  if (isset($_POST['num'])){$setPokedexnum = $_POST['num'];};
  if (isset($_POST['legendary'])){$setLegendary = $_POST['legendary'];};
  if (isset($_POST['generation'])){$setGeneration = $_POST['generation'];};
  if (isset($_POST['pokemonId'])){$setPokemonId = $_POST['pokemonId'];};


  $inputpath = basename($_FILES["imgLink"]["name"]);

  $sql = "SELECT imgLink AS imgPath FROM pokemontable WHERE pkey = $setPokemonId";
  $result = $conn->query($sql);
  $currimg = $result->fetch_assoc();
  $currimg = $curr_img["imgPath"];

// The below code is used for testing purposes. Removing the header line lets you see the echo messages.
 // check if there is no image chosen
  if($inputpath == NULL){
    $setPath = NULL;
    echo "no image chosen";
  }
  // if img chosen, but already exists in the local folder or it was uploaded correctly
  else if(file_exists('../imgs/'.$inputpath) || $uploadOk == 1){
    echo '<br> img already in folder or it was uploaded correctly:'.'imgs/'.$inputpath.'<br>';
    $setPath = 'imgs/'.$inputpath;
  }
  else{
    // img to folder upload failed
    if ($uploadOk == 0){echo ($message);} 
  }

  $sql = "INSERT INTO pokemonTable VALUES (NULL, '$setPname', '$setPtype', '$setPokedexnum', '$setLegendary', '$setGeneration', '$setPath');"; 

  if ($conn->query($sql) === TRUE) {
      echo $setPname . " created successfully" ;
    } else {
      echo "add Pokemon Error: " . $sql . "<br>" . $conn->error;
    }
  $conn->close();
  //have to add this line to redirect to the main page
  header("Location: ../Project 2.html");

?>