<!DOCTYPE html>
<HTML>
<HEAD>
    <link rel="stylesheet" href="styles.css"> 
    <link rel="stylesheet" href="jquery-ui.css"> 
    <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="jquery-ui.js"></script>
    <script src="Coloris-main/dist/coloris.min.js"></script>
    <link rel="stylesheet" href="Coloris-main/dist/coloris.min.css" />
</HEAD>
<?php



// for($i = 0; $i < 50; $i++){
//     $db->createPiece("test",new Location("Kiste","Beschreibung", "Hinterm Bett", $db->rand_color()));
// }

//$db->deletePiece("test");
// $db->savePieces();
//echo $db->getPiece("test")->getName();

// echo $db->getPiecesList();

// var_dump($db);


// PHP SCRIPT




// PHP SCRIPT END
?>
<div>
<button class="create" onclick=apiRequest("create")>+</button><button class="create" onclick=apiRequest("")>◄▬</button>
<input type="text" class="input" name="search" oninput="search()"></input>
</div>

<div class="loader" name="loader" id="loader"></div>
</HTML>

<style>

body, html {
    font-family: Arial, Helvetica, sans-serif;
    background-color: #111;
}
img {
    background-color: transparent;
    object-fit: cover;
    width: auto;
    height: 100%;
    margin-left: 20px;
}
.listItem {
    font-family: Helvetica;
    padding-left: 10pt;
    border:1px solid #000;
    border-radius: 12px; 
    font-size: 32pt; 
    background-color: white;
    margin: 0px;

}

.text {
    white-space: pre-line;
    width: 30%;
}
a {
    background-color: transparent;
    text-decoration: none;
    color: transparent;
}
.options {
    object-fit: none;
    display: inline;
    width: auto;
    height: 100%;
}

.input {
    font-size: 50pt;
    width: 90%;
    border: 0px solid transparent;
    border-radius: 0px;
    margin-bottom: 20px;
    color: #02a731;
    border-bottom: 5px solid #02a731;
}
.searchinfo {
    color: #02a731;
}
.create {
    font-size: 50pt;
    background-color:   #02a731;
    color: white;
}
.ui-menu-item {
    font-size: 50pt;
}
table {
    height: 80pt;
}



</style>
<script>
    $( "#loader" ).load( "./api/" );
    function loadPage(PieceID){
        PieceID = encodeURI(PieceID);
        $( "#loader" ).load( "./api/?edit="+PieceID);
    }

function search(){
    $( "#loader" ).load( "./api/?search=" + encodeURI(document.getElementsByName("search")[0].value));
}

function apiRequest(URI){
    URI = encodeURI(URI);
        $( "#loader" ).load( "./api/?" + URI);
    }
function update(){
    objectName = encodeURI(document.getElementsByName("objectName")[0].value)
    LocationName = encodeURI(document.getElementsByName("LocationName")[0].value)
    LocationDescription = encodeURI(document.getElementsByName("LocationDescription")[0].value)
    LocationLocation = encodeURI(document.getElementsByName("LocationLocation")[0].value)
    LocationColor = encodeURI(document.getElementsByName("LocationColor")[0].value)
        $( "#loader" ).load( "./api/?add=hehe&objectName=" +objectName +"&LocationName=" +LocationName +"&LocationDescription=" +LocationDescription +"&LocationLocation=" +LocationLocation +"&LocationColor=" +encodeURI(LocationColor.replace("#","SHORP")));

        $( "#loader" ).load( "./api/");
    }
function deleteID(PieceID){
        PieceID = encodeURI(PieceID);
    $( "#loader" ).load( "./api/?delete=" + PieceID);
    $( "#loader" ).load( "./api/");
}

</script>