
/*
const pokemon1 = new Pokemon("Squirtle", "Water", 7, 1, "squirtle.jpg");
const pokemon2 = new Pokemon("Cyndaquil", "Fire", 155, 2, "cyndaquil.jpg");
const pokemon3 = new Pokemon("Poochyena", "Dark", 261, 3, "poochyena.jpg");
const pokemon4 = new Pokemon("Lucario", "Fighting", 448, 4, "lucario.jpg");
const pokemon5 = new Pokemon("Drilbur", "Ground", 529, 5, "drilbur.jpg");

const pokemon = [pokemon1,pokemon2,pokemon3,pokemon4,pokemon5];

var jsonString = JSON.stringify(pokemon);
/*
console.log(JSON.stringify(pokemon1));
console.log(JSON.stringify(pokemon2));
console.log(JSON.stringify(pokemon3));
console.log(JSON.stringify(pokemon4));
console.log(jsonString);
*/
var curr_index = 0;
var httpRequest;
var dbobj;
function loadDB() {
  send_request("POST", "array=", "php/mySQLdata.php", display_obj_handler);
}

function getItem() {
  let input = document.getElementById("getItem").value - 1;
  if (input > max || input < 0) {
    alert("Invalid Input");
    return;
  }
  curr_index = input;
  loadElements(dbobj[curr_index]);
  displayPageNum();
}

function send_request(action, send_str, path, callback) {
  httpRequest = new XMLHttpRequest();
  if (!httpRequest) {
    alert("Cannot create an XMLHTTP instance");
    return false;
  }
  httpRequest.onreadystatechange = callback;
  httpRequest.open(action, path);
  httpRequest.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );
  httpRequest.send(send_str);
}
function display_obj_handler() {
  try {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
      if (httpRequest.status === 200) {
        dbobj = JSON.parse(httpRequest.responseText);
        max = parseInt(dbobj.pop()) - 1;
        loadElements(dbobj[curr_index]);
       displayPageNum();
      } else {
        alert("There was a problem with the request.");
      }
    }
  } catch (e) {
    alert("Display: Caught Exception: " + e.synopsis);
  }
}




function loadElements(dbobj){
  document.getElementById("pname").value = dbobj.pname;
  document.getElementById("ptype").value = dbobj.ptype;
  document.getElementById("num").value = dbobj.pokedexnum;
  dbobj.pcaught == 1
    ? (document.getElementById("caught").checked = true)
    : (document.getElementById("notcaught").checked = true);
  document.getElementById("generation").value = dbobj.generation;
  document.getElementById("loadImage").src = dbobj.imgLink;
  document.getElementById("pokemonId").value = dbobj.pokemonId;
}




function prev(){
  if (curr_index == 0) {
    return;
  } else {
    curr_index -= 1;
    loadElements(dbobj[curr_index]);
    displayPageNum();
  }
}
function next() {
  if (curr_index == max) {
    return;
  } else {
    curr_index += 1;
    loadElements(dbobj[curr_index]);
    displayPageNum();
  }
}

function skipForward(){
  curr_index = max;
  loadElements(dbobj[curr_index]);
  displayPageNum();
}
function skipBack(){
  curr_index = 0;
  loadElements(dbobj[curr_index]);
  displayPageNum();

}  

function send_request(action, send_str, path, callback) {
  httpRequest = new XMLHttpRequest();
  if (!httpRequest) {
    alert("Cannot create an XMLHTTP instance");
    return false;
  }
  httpRequest.onreadystatechange = callback;
  httpRequest.open(action, path);
  httpRequest.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );
  httpRequest.send(send_str);
}

function toggleEdit() {
  let form = document.getElementById("pokemonform");
  let elements = form.elements;
  for (let i = 0, len = elements.length; i < len; i++) {
    elements[i].disabled == true
      ? (elements[i].disabled = false)
      : (elements[i].disabled = true);
  }
}

function sortPokemon(sort_criteria) {
  send_request("POST", sort_criteria, "php/sortPokemon.php", display_obj_handler);
}

function displayPageNum() {
  document.getElementById("pagenum").innerHTML =
    "Results " + (curr_index + 1) + "/" + (max + 1);
}
loadDB();
//toggleEdit();
