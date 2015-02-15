<?php
require 'config.php';
include('../dependencies/wowarmoryapi/BattlenetArmory.class.php');
$armory = new BattlenetArmory('EU','Dalaran');
class Character_datas {
  var $namespace;
  var $action;
  var $params;

  public function __construct($action, $armory, $params) {
    $this->action = $action;
    $this->armory = $armory;
    $this->params = $params;

    if (isset($this->params['nocache']))
      $this->armory->useCache(FALSE);

    $this->armory->UTF8(true);
    $this->armory->setLocale('fr_FR'); //conf
    $this->user_datas = (array) json_decode($_COOKIE['RLM_user']);
    $this->character = $this->armory->getCharacter($this->user_datas['user_perso']);

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

  private function show_profile() {

    $class = utf8_decode($this->character->getClassName());
    $spe = $this->character->getActiveTalents();
    $datas = $this->character->getData();
    $img = $this->character->getProfileInsetURL();
    $professions = $this->character->getPrimaryProfessions();
    $ilvl = $datas['items']['averageItemLevelEquipped'];
    //$ilvlwish = $this->session['wish_ilvl'];

    $context['character'] = array(
      'pseudo' => $this->user_datas['user_perso'],
      'classe' => $class,
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
      'last_loots' => array( // needed
        /*0 => array('name' => 'Ceinture en anneaux chitineux', 'level' => 553),
        1 => array('name' => 'Brassards du purificateur en parfait état', 'level' => 553),
        2 => array('name' => 'Cristal de rage frénétique', 'level' => 553)*/
      )
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
      $item_datas = array(
        'name' => $item['name'],
        'img_url' => "http://eu.media.blizzard.com/wow/icons/56/".$item['icon'].".jpg",
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
    foreach ($context['left'] as $equipment) {
      $real_context['equipment'][] = $equipment;
    }
    foreach ($context['right'] as $equipment) {
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
$character = new Character_datas($action, $armory, $params);

?>