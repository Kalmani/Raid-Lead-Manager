<?php
  class Character {
    var $namespace;
    var $action;
    var $params;

    function __construct($action) {
      $this->action = $action;
      switch ($this->action) {
        case 'show_profile' :
          $this->show_profile();
          break;
        case 'show_equipment' :
          $this->show_equipment();
          break;
      }
    }

    function show_profile() {
      $context['character'] = array(
        'pseudo' => 'Kalmani',
        'classe' => 'Chaman',
        'activ_spe' => 'Restauration',
        'ilvl' => 667,
        'wish_ilvl' => 670,
        'accomplished_purcent' => 75,
        'loots_by_raid' => 0.78,
        'professions' => array(
          0 => array('name' => 'Alchimie', 'level' => 650, 'max' => 700),
          1 => array('name' => 'Calligraphie', 'level' => 636, 'max' => 700)
        ),
        'last_loots' => array(
          0 => array('name' => 'Ceinture en anneaux chitineux', 'level' => 553),
          1 => array('name' => 'Brassards du purificateur en parfait état', 'level' => 553),
          2 => array('name' => 'Cristal de rage frénétique', 'level' => 553)
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
      echo json_encode($context);
    }

    function show_equipment() {
      //expected output
      $context = array(
        'left' => array(
          array(
            'name' => "Chapel d'harmonie céleste",
            'img_url' => "http://eu.media.blizzard.com/wow/icons/56/inv_mail_raidshaman_n_01helm.jpg",
            'item_caracs' => array(
              'item' => '99332',
              'domain' => 'fr',
              'gems' => '95347=>76694',
              'ench' => ''
            ),
            'level' => 566,
            'status' => 'warning',
            'scarcity' => 4,
            'has_item' => true
          ),
          array(
            'name' => "Collier de la lumière faiblissante",
            'img_url' => "http://eu.media.blizzard.com/wow/icons/56/inv_misc_necklace_mop5.jpg",
            'item_caracs' => array(
              'item' => '104477',
              'domain' => 'fr',
              'gems' => '',
              'ench' => ''
            ),
            'level' => 566,
            'status' => 'warning',
            'scarcity' => 4,
            'has_item' => true
          ),
          array(
            'name' => "Drape-épaules d'harmonie céleste",
            'img_url' => "http://eu.media.blizzard.com/wow/icons/56/inv_mail_raidshaman_n_01shoulder.jpg",
            'item_caracs' => array(
              'item' => '99334',
              'domain' => 'fr',
              'gems' => '76694=>76694',
              'ench' => '4915'
            ),
            'level' => 566,
            'status' => 'warning',
            'scarcity' => 4,
            'has_item' => true
          ),
          array(
            'name' => "Xing-Ho, Souffle de Yu'lon",
            'img_url' => "http://eu.media.blizzard.com/wow/icons/56/inv_cape_pandaria_dragoncaster_d_02.jpg",
            'item_caracs' => array(
              'item' => '102246',
              'domain' => 'fr',
              'gems' => '76694',
              'ench' => '4423'
            ),
            'level' => 608,
            'status' => 'warning',
            'scarcity' => 4,
            'has_item' => true
          ),
          array(
            'name' => "Haubert d'harmonie céleste",
            'img_url' => "http://eu.media.blizzard.com/wow/icons/56/inv_mail_raidshaman_n_01chest.jpg",
            'item_caracs' => array(
              'item' => '99344',
              'domain' => 'fr',
              'gems' => '76694=>76694=>76694',
              'ench' => '4419'
            ),
            'level' => 566,
            'status' => 'warning',
            'scarcity' => 4,
            'has_item' => true
          ),
          array(
            'name' => "Garde-poignets de cavernier",
            'img_url' => "http://eu.media.blizzard.com/wow/icons/56/inv_mail_raidshaman_n_01bracer.jpg",
            'item_caracs' => array(
              'item' => '105524',
              'domain' => 'fr',
              'gems' => '',
              'ench' => '4414'
            ),
            'level' => 572,
            'status' => 'warning',
            'scarcity' => 4,
            'has_item' => true
          ),
          array(
            'name' => "Gants d'harmonie céleste",
            'img_url' => "http://eu.media.blizzard.com/wow/icons/56/inv_mail_raidshaman_n_01glove.jpg",
            'item_caracs' => array(
              'item' => '99345',
              'domain' => 'fr',
              'gems' => '76694=>76694',
              'ench' => '4431'
            ),
            'level' => 566,
            'status' => 'warning',
            'scarcity' => 4,
            'has_item' => true
          ),
          array(
            'name' => "Ceinture en anneaux chitineux",
            'img_url' => "http://eu.media.blizzard.com/wow/icons/56/inv_mail_raidshaman_n_01belt.jpg",
            'item_caracs' => array(
              'item' => '103941',
              'domain' => 'fr',
              'gems' => '76694=>76668=>76694',
              'ench' => '4431'
            ),
            'level' => 553,
            'status' => 'warning',
            'scarcity' => 4,
            'has_item' => true
          )
        ),
        'right' => array(
          array(
            'name' => "Jambières d'harmonie céleste",
            'img_url' => "http://eu.media.blizzard.com/wow/icons/56/inv_mail_raidshaman_n_01pant.jpg",
            'item_caracs' => array(
              'item' => '99333',
              'domain' => 'fr',
              'gems' => '76672=>76672',
              'ench' => '4825'
            ),
            'level' => 566,
            'status' => 'warning',
            'scarcity' => 4,
            'has_item' => true
          ),
          array(
            'name' => "Solerets de profanation",
            'img_url' => "http://eu.media.blizzard.com/wow/icons/56/inv_mail_raidshaman_n_01boot.jpg",
            'item_caracs' => array(
              'item' => '104450',
              'domain' => 'fr',
              'gems' => '76694',
              'ench' => '4426'
            ),
            'level' => 566,
            'status' => 'warning',
            'scarcity' => 4,
            'has_item' => true
          ),
          array(
            'name' => "Chevalière de la coupe au laser",
            'img_url' => "http://eu.media.blizzard.com/wow/icons/56/inv_misc_ring_mop17.jpg",
            'item_caracs' => array(
              'item' => '104524',
              'domain' => 'fr',
              'gems' => '76668',
              'ench' => ''
            ),
            'level' => 566,
            'status' => 'warning',
            'scarcity' => 4,
            'has_item' => true
          ),
          array(
            'no_item' => true
          ),
          array(
            'no_item' => true
          ),
          array(
            'name' => "Liens purifiés d'Immerseus",
            'img_url' => "http://eu.media.blizzard.com/wow/icons/56/inv_jewelry_orgrimmarraid_trinket_07.jpg",
            'item_caracs' => array(
              'item' => '104426',
              'domain' => 'fr',
              'gems' => '',
              'ench' => ''
            ),
            'level' => 566,
            'status' => 'warning',
            'scarcity' => 4,
            'has_item' => true
          ),
          array(
            'name' => "Masse de guerre de Hurlenfer",
            'img_url' => "http://eu.media.blizzard.com/wow/icons/56/inv_hammer_1h_pvphorde_a_01red_upres.jpg",
            'item_caracs' => array(
              'item' => '105688',
              'domain' => 'fr',
              'gems' => '76694=>76694',
              'ench' => '4442'
            ),
            'level' => 574,
            'status' => 'warning',
            'scarcity' => 4,
            'has_item' => true
          ),
          array(
            'name' => "Barrière énigmatique de Norushen",
            'img_url' => "http://eu.media.blizzard.com/wow/icons/56/inv_shield_orgrimmarraid_d_02.jpg",
            'item_caracs' => array(
              'item' => '104470',
              'domain' => 'fr',
              'gems' => '76694',
              'ench' => '4434'
            ),
            'level' => 566,
            'status' => 'warning',
            'scarcity' => 4,
            'has_item' => true
          )
        )
      );
      echo json_encode($context);
    }

  }

  $character = new Character($action);

?>