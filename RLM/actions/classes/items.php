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

    $this->modes = array(
      'normal',
      'heroic',
      'mythic'
    );

    switch ($this->action) {
      case 'list_items' :
        echo json_encode($this->list_items(), JSON_UNESCAPED_UNICODE);
        break;
      case 'show_item' :
        echo json_encode($this->show_item(), JSON_UNESCAPED_UNICODE);
        break;
      case 'get_last_item' :
        echo json_encode($this->get_last_item(), JSON_UNESCAPED_UNICODE);
        break;
      case 'import_item' :
        echo json_encode($this->import_item(), JSON_UNESCAPED_UNICODE);
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

  private function get_last_item() {
    $last_item = array('id' => 0);
    foreach ($this->modes as $mode) {
      $r = "SELECT * FROM larmes_items_".$mode." ORDER BY id DESC LIMIT 1";
      $res = $this->mysqli->query($r);
      $new_item = $res->fetch_assoc();
      if ($new_item['id'] > $last_item['id']) {
        $last_item = $new_item;
      }
    }
    $last_item['name'] = utf8_encode($last_item['name']);
    $last_item['item_url'] = 'item='.$last_item['id'];
    $last_item['img_url'] = "http://eu.media.blizzard.com/wow/icons/56/".$last_item['icon'].".jpg";
    return array('last_item' => $last_item);
  }

  private function import_item() {
    $item_id = $this->params['item_id'];
    $next_id = $item_id + 1;
    $this->armory->UTF8(true);
    $this->armory->setLocale('fr_FR');
    $item = $this->armory->getItem($item_id);
    $itemdatas = $item->getData();
    if (!$itemdatas['raid-normal']) {
      return array('no_item' => $item_id, 'next_id' => $next_id);
    } else {
      foreach ($this->modes as $key=>$mode) {
        $itm = $itemdatas['raid-' . $mode];
        $gems = (isset($itm['socketInfo'])) ? serialize($itm['socketInfo']['sockets']) : '';
        $gem_bonus = (isset($itm['socketInfo'])) ? $itm['socketInfo']['socketBonus'] : '';
        $r = "INSERT INTO larmes_items_" . $mode ."
              VALUES (
                '".$itm['id']."',
                '".utf8_decode($itm['name'])."',
                '".$itm['icon']."',
                '".$itm['inventoryType']."',
                '".$itm['itemClass']."',
                '".$itm['itemSubClass']."',
                '".$itm['itemLevel']."',
                '".$itm['quality']."',
                '".$itm['baseArmor']."',
                '".$itm['itemSource']['sourceId']."'
              )";
        $result = $this->mysqli->query($r);
        if ($result) {
          foreach ($itm['bonusStats'] as $stat){
            $r = "INSERT INTO larmes_items_stats VALUES ('', '".$itm['id']."', '".$stat['stat']."', '".$stat['amount']."')";
            $result = $this->mysqli->query($r);
          }
          if (isset($itm['itemSpells']) && !empty($itm['itemSpells'])){
            foreach ($itm['itemSpells'] as $spell){
              $r = "INSERT INTO larmes_items_spells VALUES ('', '".$itm['id']."', '".utf8_decode($spell['spell']['name'])."', '".utf8_decode($spell['spell']['description'])."', '".$spell['trigger']."')";
              $result = $this->mysqli->query($r);
            }
          }
        }
      }

      return array('item_id' => $item_id, 'next_id' => $next_id);
    }
  }
}

$mysqli = new mysqli($host, $user, $pass, $db);
$armory = new BattlenetArmory('EU','Dalaran');
$items = new Items_datas($action, $mysqli, $armory, $params);

?>