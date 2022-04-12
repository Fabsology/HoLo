<?php
include("objects/object.php");

const DATABASEFILENAME = "./DB/datenbank.db";
const BACKGROUNDCOLOR = "#fff";
class Database {

    private $pieces = array();
    private $locations = array();

    function __construct() {
        if (file_exists(DATABASEFILENAME)){
            $newPieces = unserialize(base64_decode(file_get_contents(DATABASEFILENAME)));
            $this->pieces = $newPieces;
            ksort($this->pieces);
            $this->pieces = array_values($this->pieces);
            foreach($this->pieces as $location) {
                $location = $location->getLocation();
                $this->locations[count($this->locations)] = new Location($location->getName(),$location->getDescription(),$location->getLocation(),$location->getColor());
            }
        }
    }
    function getLocations(){
        $arrayStringList = '';
        for($i = 0; $i < count($this->locations); $i++) {
            if (!$this->conta( $arrayStringList, $this->locations[$i]->getName() )){
                if ($i == count($this->locations)-1) {
                        $arrayStringList .= '"'.$this->locations[$i]->getName().'"';
                } else {
                        $arrayStringList .= '"'.$this->locations[$i]->getName().'",';
                }
            }
        }
        if (substr($arrayStringList, -1) == ",") {
                $arrayStringList = substr($arrayStringList, 0,-1);
        }
        echo $arrayStringList;
    }
    function getLocationColor($name){
        $colorString = "#000";
        for($i = 0; $i < count($this->locations); $i++) {
            if (strtolower($this->locations[$i]->getName()) == strtolower($name)) {
                $colorString = $this->locations[$i]->getColor();
                break;
            }
        }
        return $colorString;
    }

    function locationExists($name){
        for($i = 0; $i < count($this->locations); $i++) {
            if (strtolower($this->locations[$i]->getName()) == strtolower($name)) {
                return true;
            }
        }
        return false;
    }


    function savePieces() {
        file_put_contents(DATABASEFILENAME, base64_encode(serialize($this->pieces)));
    }

    function createPiece(string $name, Location $location ){
        $exists = false;
        foreach($this->pieces as $forPiece) {
            if (strtolower($forPiece->getName()) == strtolower($name)) {
                $exists = true;
                break;
            }
        }
        if (!$exists) {  
            $this->pieces[count($this->pieces)] = new Piece($name,$location);
        }
    }

    function deletePiece(string $name){
        for($i = 0; $i < count($this->pieces); $i++){
            if (strtolower($this->pieces[$i]->getName()) == strtolower($name)) {
                unset($this->pieces[$i]);
                $this->pieces = array_values($this->pieces);
                $i = -1;
            }
        }
        $this->pieces = array_values($this->pieces);
    }

    function getPiece(string $name) {
        $piece = new Piece("NULL", new Location("NULL","NULL", "NULL"));
        foreach($this->pieces as $forPiece) {
            if (strtolower($forPiece->getName()) == strtolower($name)) {
                $piece = $forPiece;
                break;
            }       
        }
        return $piece;
    }

    function getPieceList(string $name){
        $piece = $this->getPiece($name);
        return '<div class="listItem" style="background: linear-gradient(91deg, '.BACKGROUNDCOLOR.' 60%, '.$piece->getLocation()->getColor().' 60%); border-left: 50px solid '.$piece->getLocation()->getColor() .'; border-right: 20px solid '.$piece->getLocation()->getColor() .'; color:'.$piece->getLocation()->getColor().'"><table><tr><td width="50%"><span class="text">Name: ' . $piece->getName() . " <br> Ort: " . $piece->getLocation()->getName() . " <br>" . $piece->getLocation()->getDescription() . " <br>" . $piece->getLocation()->getLocation() .
         '</span></td><td><span class="options" style="display: inline; position: absolute; right:20px; color: white; font-size: 5pt; height: auto; min-width: 30%;"><img src="img/edit.png" onclick="loadPage(\''.bin2hex($piece->getName()).'\')"><img src="img/trash.png" onclick="deleteID(\''.bin2hex($piece->getName()).'\')">' . '</span></td></tr></table></div>';
    }

    function getPieces(){
        return $this->pieces;
    }
    
    function getPiecesList(string $search = ""){
        $returnString = "";
        foreach($this->pieces as $forPiece) {
            if($this->conta(strtolower($forPiece->getName()),strtolower($search))){
                $returnString .= '<div class="listItem" style="background: linear-gradient(95deg, '.BACKGROUNDCOLOR.' 60%, '.$forPiece->getLocation()->getColor().' 60%); border-left: 50px solid '.$forPiece->getLocation()->getColor() .'; border-right: 20px solid '.$forPiece->getLocation()->getColor() .'; font-size: 32pt; color:'.$forPiece->getLocation()->getColor().'"><table><tr><td width="50%">' . $forPiece->getName() . '</span></td><td><span class="options" style="display: inline; position: absolute; right:20px; color: white; font-size: 5pt; height: auto; min-width: 30%;"><img src="img/show.png" onclick="loadPage(\''.bin2hex($forPiece->getName()).'\')">' . '</span></td></tr></table></div>';
            }
        }
        return $returnString;
    }
    function rand_color() {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
    function conta(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}

