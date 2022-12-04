<?php
  include "connectDB.php";
  include "uploadImage.php";

  if (isset($_POST['pname'])){$set_pname = $_POST['pname'];};
  if (isset($_POST['ptype'])){$set_ptype = $_POST['ptype'];};
  if (isset($_POST['num'])){$set_pokedexnum = $_POST['num'];};
  if (isset($_POST['caught'])){$set_pcaught = $_POST['caught'];};
  if (isset($_POST['generation'])){$set_generation = $_POST['generation'];};
  if (isset($_POST['pokemonId'])){$set_pokemonId = $_POST['pokemonId'];};

  $input_path = basename($_FILES["imgLink"]["name"]);

  $sql = "SELECT imgLink AS imgPath FROM pokemontable WHERE pkey = $set_pokemonId";
  $result = $conn->query($sql);
  $curr_img = $result->fetch_assoc();
  $curr_img = $curr_img["imgPath"];

// The below code is used for testing purposes. Removing the header line lets you see the echo messages.
if($input_path == NULL && $curr_img != NULL){
    echo '<br> not chosen but img already in db:'.$curr_img.'<br>';
    $set_img_path = $curr_img;
  }
  // if no img chosen and it doesn't exist in the tbl, no img
  else if($input_path == NULL && $curr_img == NULL){
    echo '<br> not chosen, no img in db:'.$curr_img.'<br>';
    $set_img_path = NULL;
  }

  // if img chosen, but already exists in the local folder or it was uploaded correctly
  else if(file_exists('../imgs/'.$input_path) || $uploadOk == 1){
    echo '<br> img already in folder or it was uploaded correctly:'.'imgs/'.$input_path.'<br>';
    $set_img_path = 'imgs/'.$input_path;
  }
  else{
    // img to folder upload failed
    if ($uploadOk == 0){echo ($message);} 
  }

  $sql = "UPDATE pokemontable SET pname ='$set_pname', ptype='$set_ptype', pokedexnum='$set_pokedexnum', pcaught='$set_pcaught', generation='$set_generation',imgLink='$set_img_path' WHERE pkey = $set_pokemonId;";

  if ($conn->query($sql) === TRUE) {
      echo $set_pname . " created successfully" ;
    } else {
      echo "add Pokemon Error: " . $sql . "<br>" . $conn->error;
    }
  $conn->close();
  //have to add this line to redirect to the main page
  header("Location: ../Project 2.html");

?>