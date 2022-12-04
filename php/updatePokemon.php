<?php
    include 'connectDB.php';
    include 'uploadImage.php';

    // get form post inputs
    if (isset($_POST['pname'])){$set_pname = ($conn, $_POST['pname']);};
    if (isset($_POST['ptype'])){$set_ptype = $_POST['ptype'];};
    if (isset($_POST['pokedexnum'])){$set_pokedexnum = $_POST['pokedexnum'];};
    if (isset($_POST['pcaught'])){$set_pcaught = $_POST['pcaught'];};
    if (isset($_POST['generation'])){$set_generation = $_POST['generation'];};
    if (isset($_POST['pokemonId'])){$set_pokemonId = $_POST['pokemonId'];};
 
    // get the current img
    $sql = "SELECT img_path AS Img_path FROM pokemonTable WHERE pkey = $set_pokemonId";
    $result = $conn->query($sql);
    $curr_img = $result->fetch_assoc();
    $curr_img = $curr_img["Img_path"];

    // get the input img
    $input_path = basename($_FILES["img_path"]["name"]);

    // if img exists in the tbl, but it was not updated, keep same img
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
    else if(file_exists('imgs/'.$input_path) || $uploadOk == 1){
      echo '<br> img already in folder or it was uploaded correctly:'.'imgs/'.$input_path.'<br>';
      $set_img_path = 'imgs/'.$input_path;
    }
    else{
      // img to folder upload failed
      if ($uploadOk == 0){echo ($message);} 
    }
    
    $sql = "UPDATE pokemonTable SET pname ='$set_pname', ptype='$set_ptype', pokedexnum='$set_pokedexnum', pcaught='$set_pcaught', generation='$set_generation', img_path='$set_img_path' WHERE pkey = $set_pokemonId;";
    
    if ($conn->query($sql) === TRUE) {
      echo $set_pname . " record updated successfully";
    } else {
        echo "add_item Error: " . $sql . "<br>" . $conn->error;
    }
  
    $conn->close();
    header("Location: ./movies.html");
?>