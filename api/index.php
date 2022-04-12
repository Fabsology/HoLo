<?php

include("database.php");
$db = new Database();
if (isset($_REQUEST["edit"])){
    echo $db->getPieceList(hex2bin($_REQUEST["edit"]));
    
}else if (isset($_REQUEST["show"])){
    echo $db->getPieceList(hex2bin($_REQUEST["edit"]));
} else if (isset($_REQUEST["delete"])){
    $db->deletePiece(hex2bin($_REQUEST["delete"]));
    echo hex2bin($_REQUEST["delete"]);

} else if (isset($_REQUEST["add"]) && isset($_REQUEST["objectName"]) && isset($_REQUEST["LocationName"]) && isset($_REQUEST["LocationDescription"]) && isset($_REQUEST["LocationLocation"]) && isset($_REQUEST["LocationColor"])){
// WENN UPDATE-> LISTE VON LOCATIONS AUTOFILL--MÄSSIG VORSCHLAGEN und so
//$db->createPiece($_REQUEST["name"],new Location($_REQUEST["locationName"],"","",$_REQUEST["color"]));
$color = "#000";
if ($db->locationExists($_REQUEST["LocationName"])){
    $color = $db->getLocationColor($_REQUEST["LocationName"]);
} else {
    $color = str_replace("SHORP","#",$_REQUEST["LocationColor"]);
}

$db->createPiece($_REQUEST["objectName"],new location($_REQUEST["LocationName"],$_REQUEST["LocationDescription"],$_REQUEST["LocationLocation"],$color));


} else if (isset($_REQUEST["create"])){
?>
<input class="input" type="text" name="objectName" placeholder="Objekt-Name"></input>
<input class="input" type="text" name="LocationName" class="LocationName autocomplete" id="autocomplete" oninput="getLocations()" placeholder="Location-Name"></input>
<input class="input" type="text" name="LocationDescription" placeholder="Location-Beschreibung"></input>
<input class="input" type="text" name="LocationLocation" placeholder="Location-ORT(Kiste, Fach, etc)"></input>
<input class="input" type="text" name="LocationColor" data-coloris />
<button onclick="update()" class="create">Erstellen</button>

<script type="text/javascript" src="autocomplete.js"></script>
<?php
} else if (isset($_REQUEST["get"])){
    $db->getLocations();
} else {
    if (isset($_REQUEST["search"])){
        if (strlen($_REQUEST["search"])>0){
            echo '<h1 class="searchinfo">Suchergebnis für: "'.$_REQUEST["search"].'"</h1>';
        }
        echo $db->getPiecesList($_REQUEST["search"]);
    } else {
        echo $db->getPiecesList();
    }
}
$db->savePieces();