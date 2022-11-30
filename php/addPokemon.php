<?php
  include "connectDB.php";
  include "uploadImage.php";

  // take care of apostrophes and other special characters using mysqli_real_escape_string()
  if (isset($_POST['pname'])){$set_title = ($conn, $_POST['pname']);};
  if (isset($_POST['ptype'])){$set_year = $_POST['ptype'];};
  if (isset($_POST['pokedexnum'])){$set_rating = $_POST['pokedexnum'];};
  if (isset($_POST['pcaught'])){$set_length = $_POST['pcaught'];};
  if (isset($_POST['generation'])){$set_recommended = $_POST['generation'];};
  if (isset($_POST['pokemonid'])){$set_movie_id = $_POST['pokemonid'];};

  $input_path = basename($_FILES["imgLink"]["name"]);

  $sql = "SELECT imgLink AS Img_path FROM pokemontable WHERE pkey = $set_movie_id";
  $result = $conn->query($sql);
  $curr_img = $result->fetch_assoc();
  $curr_img = $curr_img["Img_path"];

  // no img chosen
  if($input_path == NULL){
    $set_img_path = NULL;
  }
  // if img chosen, but already exists in the local folder or it was uploaded correctly
  else if(file_exists('/imgs'.$input_path) || $uploadOk == 1){
    echo '<br> img already in folder or it was uploaded correctly:'.'/imgs'.$input_path.'<br>';
    $set_img_path = '/imgs'.$input_path;
  }
  else{
    // img to folder upload failed
    if ($uploadOk == 0){echo ($message);} 
  }

  $sql = "INSERT INTO pokemontable VALUES (NULL, '$set_title', '$set_year', '$set_length', '$set_rating', '$set_synopsis', '$set_recommended', '$set_img_path');"; 

  if ($conn->query($sql) === TRUE) {
      echo $set_title . " created successfully" ;
    } else {
      echo "add movie Error: " . $sql . "<br>" . $conn->error;
    }
  $conn->close();
  header("Location: ./movies.html");

?>