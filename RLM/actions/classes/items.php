<?php
require 'config.php';
include('../dependencies/wowarmoryapi/BattlenetArmory.class.php');
require 'global.php';
class Items_datas {
  var $namespace;
  var $action;
  var $params;

  public function __construct($action, $mysqli, $armory, $params) {
    $this->action = $action;
    $this->params = $params;
    $this->armory = $armory;
    $this->mysqli = $mysqli;

    switch ($this->action) {
      case 'list_items' :
        echo json_encode($this->list_items());
        break;
    }
  }

  private function list_items() {
    //$this->params['slot'];
    $this->armory->UTF8(true);
    $this->armory->setLocale('fr_FR');
    $this->user_datas = (array) json_decode($_COOKIE['RLM_user']);
    $this->character = $this->armory->getCharacter($this->user_datas['user_perso']);
    $character_datas = $this->character->getData();
    $class = $character_datas['class'];
    $armor_type = $character_datas['audit']['appropriateArmorType'];
    $itemSubClass = Global_datas::item_class_by_character_class($class);
    $itemType = Global_datas::type_id_by_name($this->params['slot']);
    $r = "SELECT * FROM larmes_items_normal WHERE inventoryType = '".$itemType."' AND itemSubClass = '".$itemSubClass."'";
    $res = $this->mysqli->query($r);
    while ($item = $res->fetch_assoc()) {
      //print_r($item);
    }
    return array('test'=>true);
  }
}

$mysqli = new mysqli($host, $user, $pass, $db);
$armory = new BattlenetArmory('EU','Dalaran');
$items = new Items_datas($action, $mysqli, $armory, $params);

?>