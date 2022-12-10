<?php

include "connectDB.php";
// function from class examples
function generateRandomString($pokedexnum = 10) {
	// list of characters that can be present in the string
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $pokedexnum; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

class Pokemon implements JsonSerializable{
    public $pokemonId;
    public $pname;
    public $ptype;
    public $pokedexnum;
    public $legendary;
    public $generation;
    public $imgLink;

    public function __construct() {
        $this->pokemonId = strval(10);
        $this->pname = generateRandomString();
        $this->ptype = generateRandomString();
        $this->pokedexnum = strval(rand(1,1500));
        $this->legendary = 1;
        $this->generation = 1;
        $this ->imgLink = strval(100);
    }

    // obj to str
    public function jsonSerialize() {
        return [
            'pokemonId' => $this->pokemonId,
            'pname' => $this->pname,
            'ptype' => $this->ptype,
            'pokedexnum' => $this->pokedexnum,
            'legendary' => $this->legendary,
            'generation' => $this->generation,
            'imgLink' => $this->imgLink
            ];
    }
    
    public function Set($json) {
        $this->pokemonId=$json['pokemonId'];
        $this->pname=$json['pname'];
        $this->ptype=$json['ptype'];
        $this->pokedexnum=$json['pokedexnum'];
        $this->legendary=$json['legendary'];
        $this->generation=$json['generation'];
        $this->imgLink=$json['imgLink'];
    }

    public function Display() {
        $v=json_encode($this);
        echo $v;
    }
    
    public function GetString() {
        return json_encode($this);
    }
}
?>