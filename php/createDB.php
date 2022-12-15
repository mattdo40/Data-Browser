<?php
include "pokemonClassCreation.php";
// Create connection
$servername = "localhost"; // default server name
$username = "root"; // user name that you created
$password = ""; // password that you created
$dbname = "pokemondb";
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error ."<br>");
} 
echo "Connected successfully <br>";

// add if not exists just in case
$sql = "CREATE DATABASE IF NOT EXISTS ".$dbname;
if ($conn->query($sql) === TRUE) {
    echo "Database ". $dbname ." created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error ."<br>";
}
// close the connection
$conn->close();
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "CREATE TABLE IF NOT EXISTS pokemonTable (
pkey INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
pname  VARCHAR(30) NOT NULL,
ptype   VARCHAR(30) NOT NULL,
pokedexnum  INT(4) NOT NULL,
legendary  TINYINT(1) NOT NULL,
generation INT(4) NOT NULL,
imgLink VARCHAR(100)
)";

if ($conn->query($sql) === TRUE) {
    echo "table pokemonTable created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error ."<br>";
}


$stmt = $conn->prepare("INSERT INTO pokemonTable (pname, ptype, pokedexnum, legendary, generation, imgLink) VALUES (?,?,?,?,?,?)");
if ($stmt==FALSE) {
	echo "There is a problem with prepare <br>";
	echo $conn->error; // Need to connect/reconnect before the prepare call otherwise it doesnt work
}
// bind parameters
// The first parameter is the data type of the rest of the parameters
// i - integer
// d - double
// s - string
// b - BLOB: a binary large object that can hold a variable amount of data
$stmt->bind_param("ssiiis", $pname, $ptype, $pokedexnum, $legendary, $generation, $imgLink);

// load json data into table
$json_str = file_get_contents('pokemon.json');
$pokemonArr = json_decode($json_str);
$count = count($pokemonArr);

for ($i=0;$i<$count;$i++) {
    $pname = $pokemonArr[$i]->pname;
    $ptype = $pokemonArr[$i]->ptype;
    $pokedexnum = $pokemonArr[$i]->pokedexnum;
    $legendary = $pokemonArr[$i]->legendary;
    $generation =$pokemonArr[$i]->generation;
    $imgLink=$pokemonArr[$i]->imgLink;
    $stmt->execute();
    echo "New record ". $i ." created successfully<br>";
}

$stmt->close();

// close the connection
$conn->close();

header ("Location: ../Project 2.html");
?>
