<?php

/* Make some magic with locales here */
class Global_datas {
  public static function item_class_by_character_class($character_class) {
    $item_classes = Global_datas::get_item_class_by_character_class();
    foreach ($item_classes as $class_id=>$character_classes) {
      if (in_array($character_class, $character_classes))
        return $class_id;
    }
    return false;
  }

  public static function type_id_by_name($type) {
    $types = Global_datas::get_types();
    return $types[$type];
  }

  public static function get_character_classes() {
    $classes = array(
      '1'=>'Guerrier',
      '2'=>'Paladin',
      '3'=>'Chasseur',
      '4'=>'Voleur',
      '5'=>'Prêtre',
      '6'=>'Chevalier de la mort',
      '7'=>'Chaman',
      '8'=>'Mage',
      '9'=>'Démoniste',
      '10'=>'Moine',
      '11'=>'Druide'            
    );
    return $classes;
  }

  public static function get_subclasses() {
    $subclasses = array(
      '4' => array(
        '0'=>'Divers',
        '1'=>'Tissu',
        '2'=>'Cuir',
        '3'=>'Maille',
        '4'=>'Plaque',
        '6'=>'Bouclier'
      ),
      '2' => array(
        '0'=>'Haches à une main',
        '1'=>'Haches à deux mains',
        '2'=>'Arcs',
        '3'=>'Armes à feu',
        '4'=>'Masses à une main',
        '5'=>'Masses à deux mains',
        '6'=>'Armes d\'hast',
        '7'=>'Épées à une main',
        '8'=>'Épées à deux mains',
        '10'=>'Bâtons',
        '13'=>'Armes de pugilat',
        '14'=>'Divers',
        '15'=>'Dagues',
        '16'=>'Armes de jet',
        '18'=>'Arbalètes',
        '19'=>'Baguettes',
        '20'=>'Cannes à pêche'
      )
    );
    return $subclasses;
  }

  public static function get_item_class_by_character_class() {
    $item_classes = array(
      '1' => array(5, 8, 9),
      '2' => array(4, 10, 11),
      '3' => array(3, 7),
      '4' => array(1, 2, 6)
    );
    return $item_classes;
  }

  public static function get_two_hands() {
    $two_hands = array(
      '1',
      '2',
      '3',
      '5',
      '6',
      '8',
      '10',
      '18'
    );
    return $two_hands;
  }

  public static function get_types() {
    $types = array(
      'head'=>1,
      'neck'=>2,
      'shoulder'=>3,
      'chest'=>array(5, 20),
      'waist'=>6,
      'legs'=>7,
      'feet'=>8,
      'wrist'=>9,
      'hands'=>10,
      'finger1'=>11,
      'finger2'=>11,
      'trinket1'=>12,
      'trinket2'=>12,
      'back'=>16,
      'offHand'=>23
    );
    return $types;
  }

  public static function get_stats() {
    $stats = array(
      '3'=>'Agilité',
      '4'=>'Force',
      '5'=>'Intelligence',
      '6'=>'Esprit',
      '7'=>'Endurance',
      '13'=>'Esquive',
      '14'=>'Parade',
      '31'=>'Touché',
      '32'=>'Coup critique',
      '35'=>'Résilience',
      '36'=>'Hâte',
      '37'=>'Expertise',
      '45'=>'Puissance des sorts',
      '49'=>'Maîtrise',
      '57'=>'Puissance JcJ'
    );
    return $stats;
  }

  public static function get_item_classes() {
    $classes = array(
      '2'=>'Arme',
      '4'=>'Armure',
      '15'=>'Divers'
    );
    return $classes;
  }
  
}
?>