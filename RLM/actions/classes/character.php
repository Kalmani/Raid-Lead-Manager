<?php
require 'config.php';
include('../dependencies/wowarmoryapi/BattlenetArmory.class.php');
$armory = new BattlenetArmory('EU','Dalaran');

class Character_datas {
  var $namespace;
  var $action;
  var $params;

  public function __construct($action, $armory, /*$mysqli, */$params) {
    $this->action = $action;
    $this->armory = $armory;
    $this->params = $params;
    //$this->mysqli = $mysqli;

    if (isset($this->params['nocache']))
      $this->armory->useCache(FALSE);
    else
      $this->set_big_cache();

    $this->armory->UTF8(true);
    $this->armory->setLocale('fr_FR'); //conf
    $this->user_datas = (array) json_decode($_COOKIE['RLM_user']);
    $this->character = $this->armory->getCharacter(utf8_decode($this->user_datas['user_perso']));
    switch ($this->action) {
      case 'show_profile' :
        echo json_encode($this->show_profile());
        break;
      case 'show_equipment' :
        echo json_encode($this->show_equipment());
        break;
      case 'show_equipment_wish' :
        echo json_encode($this->show_equipment_wish());
        break;
      case 'update_item' :
        echo json_encode($this->update_item());
        break;
    }
  }

  private function set_big_cache() {
    // 1 year cache by default
    $this->armory->setCharactersCacheTTL(31104000);
    $this->armory->setGuildsCacheTTL(31104000);
    $this->armory->setAuctionHouseCacheTTL(31104000);
    $this->armory->setItemsCacheTTL(31104000);
    $this->armory->setAchievementsCacheTTL(31104000);
    $this->armory->setArenaTeamsCacheTTL(31104000);
  }

  /*private function import_item() {
    $item = $this->armory->getItem($this->params['item']);
    $item_datas = $item->getData();
    $return = array();
    if ($item_datas && $item_datas['raid-heroic']) {
      foreach ($item_datas as $mode=>$datas) {
        $return[$mode] = array(
          'id'           => $datas['id'],
          'name'         => $datas['name'],
          'icon'         => $datas['icon'],
          'itemClass'    => $datas['itemClass'],
          'itemSubClass' => $datas['itemSubClass'],
          'itemLevel'    => $datas['itemLevel'],
          'quality'      => $datas['quality'],
          'armor'        => $datas['armor'],
          'itemSource'   => $datas['itemSource']['sourceId'],
          'stats'        => $datas['bonusStats']
        );
      }


      foreach ($return as $mode=>$datas) {
        $mode_name = explode('-', $mode)[1];
        $data_sql = $datas;
        unset($data_sql['stats']);
        $r = "INSERT INTO larmes_items_".$mode_name." VALUES ('";
          $datas_str = implode("', '", $data_sql);
        $r .= $datas_str;
        $r .= "')";
        $r = utf8_decode($r);
        $res = $this->mysqli->query($r);
        foreach ($datas['stats'] as $stat) {
          $r = "INSERT INTO larmes_items_stats VALUES('', '".$data_sql['id']."', '".$stat['stat']."', '".$stat['amount']."', '".$mode_name."')";
          $res = $this->mysqli->query($r);
        }
      }
      //print_r($item_datas);
      return $return;
    } else
      return array('no_item'=>'true');
  }*/

  private function show_profile() {

    $class = $this->character->getClassName();
    $spe = $this->character->getActiveTalents();
    $datas = $this->character->getData();
    $img = $this->character->getProfileInsetURL();
    $professions = $this->character->getPrimaryProfessions();
    $ilvl = $datas['items']['averageItemLevelEquipped'];
    //$ilvlwish = $this->session['wish_ilvl'];
    $context = array();
    $context['character'] = array(
      'pseudo' => $this->user_datas['user_perso'],
      'classe' => $class,
      'classe_icon' => $spe['spec']['icon'],
      'activ_spe' => $spe['spec']['name'],
      'profil_img' => $img,
      'ilvl' => $ilvl,
      'wish_ilvl' => 0, // needed
      'accomplished_purcent' => 0, // needed
      'loots_by_raid' => 0, // needed
      'professions' => array( // max = $this->config ....
        0 => array('name' => $professions[0]['name'], 'level' => $professions[0]['rank'], 'max' => 700),
        1 => array('name' => $professions[1]['name'], 'level' => $professions[1]['rank'], 'max' => 700)
      ),
      'last_loots' => array()
    );
    $context['guild_characters'] = array(
        0 => array('pseudo' => 'Deewan'),
        1 => array('pseudo' => 'Efcaïa'),
        2 => array('pseudo' => 'Faytas'),
        3 => array('pseudo' => 'Grimnak'),
        4 => array('pseudo' => 'Harôkar'),
        5 => array('pseudo' => 'Ilmïrïs'),
        6 => array('pseudo' => 'Kalhan'),
        7 => array('pseudo' => 'Kélarno'),
        8 => array('pseudo' => 'Rotkäppchen'),
        9 => array('pseudo' => 'Telvia'),
        10 => array('pseudo' => 'Valhallà'),
        11 => array('pseudo' => 'Warana'),
        12 => array('pseudo' => 'Zhalob')
      );
    return $context;
  }

  private function show_equipment() {
    //expected output
    $items = $this->character->getGear();
    unset($items['averageItemLevel']);
    unset($items['averageItemLevelEquipped']);

    $context = array(
      'left'  => array(),
      'right' => array()
    );
    $i = 0;
    foreach ($items as $slot => $item) {
      $item_url = 'item='.$item['id'];
      //&gems=95347:76694&ench=......
      $item_datas = array(
        'name' => $item['name'],
        'img_url' => "http://eu.media.blizzard.com/wow/icons/56/".$item['icon'].".jpg",
        'item_url' => $item_url,
        'slot' => $slot,
        'item_caracs' => array(
          'item' => $item['id'],
          'domain' => 'fr',
          'gems' => '',
          'ench' => ((isset($item['tooltipParams']['enchant'])) ? $item['tooltipParams']['enchant'] : '')
        ),
        'level' => $item['itemLevel'],
        'status' => 'warning',
        'scarcity' => $item['quality'],
        'has_item' => true
      );
      if ($i > 7)
        $context['right'][] = $item_datas;
      else
        $context['left'][] = $item_datas;
      $i++;
    }

    return $context;
  }

  private function show_equipment_wish() {
    $context = $this->show_equipment();
    $real_context = array('equipment' => array());
    $i = 0;
    $status = array ('warning', 'error', 'done');
    foreach ($context['left'] as $equipment) {
      $equipment['status'] = $status[$i];
      $i++;
      if ($i > 2) $i = 0;
      $real_context['equipment'][] = $equipment;
    }
    foreach ($context['right'] as $equipment) {
      $equipment['status'] = $status[$i];
      $i++;
      if ($i > 2) $i = 0;
      $real_context['equipment'][] = $equipment;
    }
    return $real_context;
  }

  private function update_item() {
    // need a clear cache here
    $updated_item = $this->character->getItemSlot($this->params['slot']);
    $return = array(
      'img' => $updated_item['icon'],
      'scarcity' => $updated_item['quality'],
      'name' => $updated_item['name'],
      'level' => $updated_item['itemLevel']);
    return $return;

  }
}

//$mysqli = new mysqli($host, $user, $pass, $db);
$character = new Character_datas($action, $armory, /*$mysqli, */$params);

?>