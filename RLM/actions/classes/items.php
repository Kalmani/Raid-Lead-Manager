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
        echo json_encode($this->list_items(), JSON_UNESCAPED_UNICODE);
        break;
      /*case 'get_all_ids_item' :
        echo json_encode($this->get_all_ids_item());
        break;
      case 'update_type' :
        echo json_encode($this->update_type());
        break;*/
    }
  }

  /*private function update_type() {
    $ids = explode(',', $this->params['ids']);
    $item = $this->armory->getItem($ids[$this->params['i']]);
    $item_datas = $item->getData();
    $type = $item_datas['inventoryType'];
    $r = "UPDATE larmes_items_normal SET inventoryType = '".$type."' WHERE id = '".$ids[$this->params['i']]."'";
    $res = $this->mysqli->query($r);
    $r2 = "UPDATE larmes_items_heroic SET inventoryType = '".$type."' WHERE id = '".$ids[$this->params['i']]."'";
    $res = $this->mysqli->query($r2);
    $r3 = "UPDATE larmes_items_mythic SET inventoryType = '".$type."' WHERE id = '".$ids[$this->params['i']]."'";
    $res = $this->mysqli->query($r3);
    $i = $this->params['i'];
    $i++;
    return array(
      'i'=>$i,
      'ids'=>$ids
    );
  }

  private function get_all_ids_item() {
    $r = "SELECT id FROM larmes_items_normal";
    $res = $this->mysqli->query($r);
    $ids = array();
    while ($id = $res->fetch_assoc()) {
      $ids[] = $id['id'];
    }
    return $ids;
  }*/

  private function list_items() {
    //$this->params['slot'];
    $this->armory->UTF8(true);
    $this->armory->setLocale('fr_FR');
    $this->user_datas = (array) json_decode($_COOKIE['RLM_user']);
    $this->character = $this->armory->getCharacter($this->user_datas['user_perso']);
    $character_datas = $this->character->getData();
    $class = $character_datas['class'];
    //$itemType = $character_datas['audit']['appropriateArmorType'];
    $itemSubClass = Global_datas::item_class_by_character_class($class);
    $itemType = Global_datas::type_id_by_name($this->params['slot']);
    switch ($itemType) {
      case 2  : case 11 : case 12 : $itemSubClass = 0; break;
      case 16 :                     $itemSubClass = 1; break;
    }
    $r = "SELECT * FROM larmes_items_normal WHERE inventoryType = ".$itemType." AND itemSubClass = ".$itemSubClass;
    //echo $r;
    $res = $this->mysqli->query($r);
    $items_list = array();
    while ($item = $res->fetch_assoc()) {
      $item['name'] = utf8_encode($item['name']);
      $items_list[] = $item;
    }
    return array('items_list' => $items_list, 'current_item' => $character_datas['items'][$this->params['slot']]);
  }
}

$mysqli = new mysqli($host, $user, $pass, $db);
$armory = new BattlenetArmory('EU','Dalaran');
$items = new Items_datas($action, $mysqli, $armory, $params);

?>