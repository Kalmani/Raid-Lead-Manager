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
      case 'show_item' :
        echo json_encode($this->show_item(), JSON_UNESCAPED_UNICODE);
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
    $this->character = $this->armory->getCharacter(utf8_decode($this->user_datas['user_perso']));
    $character_datas = $this->character->getData();
    $class = $character_datas['class'];
    $itemSubClass = Global_datas::item_class_by_character_class($class);
    $itemType = Global_datas::type_id_by_name($this->params['slot']);
    switch ($itemType) {
      case 2  : case 11 : case 12 : $itemSubClass = 0; break;
      case 16 :                     $itemSubClass = 1; break;
    }
    $r = "SELECT * FROM larmes_items_normal WHERE inventoryType = ".$itemType." AND itemSubClass = ".$itemSubClass;
    $res = $this->mysqli->query($r);
    $items_list = array();
    while ($item = $res->fetch_assoc()) {
      $item['name'] = str_replace('?', "'", utf8_encode($item['name']));
      $items_list[] = $item;
    }

    $current_item = $character_datas['items'][$this->params['slot']];
    $stats_names = Global_datas::get_stats();
    foreach ($current_item['stats'] as $id=>$amount) {
      $amount['name'] = ($stats_names[$amount['stat']]) ? $stats_names[$amount['stat']] : 'Si tu sais, dis le moi';
      $current_item['stats'][$id] = $amount;
    }
    return array('items_list' => $items_list, 'current_item' => $current_item);
  }

  private function show_item() {
    // need this
    $this->params['dificulty'] = 'heroic';

    $stats_name = Global_datas::get_stats();

    $r = "SELECT * FROM larmes_items_".$this->params['dificulty']." WHERE id = ".$this->params['id'];
    $res = $this->mysqli->query($r);
    $new_item = $res->fetch_assoc();
    $r2 = "SELECT * FROM larmes_items_stats WHERE item_id = ".$this->params['id']." AND mode = '".$this->params['dificulty']."'";
    $res2 = $this->mysqli->query($r2);
    $new_item['stats'] = array();
    $i = 0;
    $new_item['name'] = utf8_encode($new_item['name']);
    while ($stat = $res2->fetch_assoc()) {
      $new_item['stats'][$i]['name'] = $stats_name[$stat['stat_id']];
      $new_item['stats'][$i]['amount'] = $stat['stat_amount'];
      $i++;
    }
    return array('new_item'=>$new_item);
  }
}

$mysqli = new mysqli($host, $user, $pass, $db);
$armory = new BattlenetArmory('EU','Dalaran');
$items = new Items_datas($action, $mysqli, $armory, $params);

?>