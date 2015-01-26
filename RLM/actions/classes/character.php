<?php
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
?>