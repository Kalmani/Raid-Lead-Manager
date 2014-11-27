<?php
include_once('sql.class.php');
class loots extends sql{

	public function loots($guilde_name){
		global $_SESSION;
		global $_GET;
		/* valeurs temporaires pour test, à initialiser */
		$this->boss_id = '0';
		$this->dificulty = false; // n ou hm
		// classe = arme / armure
		$this->classe = '0';
		$this->subclasse = '0';
		$this->type = '0';
		$this->raid = '0';
		
		$this->session = $_SESSION;
		$this->get = $_GET;
		$this->page = (isset($this->get['page'])) ? $this->get['page'] : '';
		$this->guilde_name = $guilde_name;
		$this->stats_get = $this->get['stats'];
		$this->gemmes_get = $this->get['gemmes'];
		$this->spells_get = $this->get['spells'];
		$this->get_classes();
		$this->get_subclasses();
		$this->get_types();
		$this->get_dificulties();
		$this->get_boss_by_raid();
		$this->get_stats();
		$this->get_gemmes();
		$this->get_spells();
		$this->get_two_hands();
		$this->get_months();
		
		$this->order = (isset($this->get['order'])) ? $this->get['order'] : '';
		
		$this->loots = array();
		$this->loots_html = '';
		$sql = new sql();
		$this->sql = $sql;
		$this->get_loots();
		$this->get_boss_down();
		$this->get_token_by_boss();
		
		/* fonction de filtre a retirer du constructeur 
		$this->get_loots_by_raid();
		$this->get_loots_by_boss();
		$this->get_loots_by_dificulty();
		$this->get_loots_by_classe();
		$this->get_loots_by_subclasse();
		$this->get_loots_by_type();		
		*/
		
		$this->take_news();
		$this->make_table_loots();	
		$this->make_form_missing();
		$this->content_general = $this->loots_html;
	}
	
	public function get_content(){
		$fichier='templates/index_tpl.html';
		$contenu = fread(fopen($fichier, "r"), filesize($fichier));
		$search = array('guilde_name', 'user_name', 'content_general', 'menu_left', 'title_general', 'update_news', 'form_missing');
		foreach ($search as $word){
			if (isset($this->{$word}))
				$contenu = str_replace('<'.$word.'>', $this->{$word}, $contenu);
		}
		return $contenu;	
	}

	private function get_loots(){
		$order = 'item_lvl DESC';
		if (!empty($this->order)){
			switch($this->order){
				case 'name1': $order = 'item_name'; break;
				case 'name2': $order = 'item_name DESC'; break;
				case 'ilvl1': $order = 'item_lvl'; break;
				case 'ilvl2': $order = 'item_lvl DESC'; break;
			}
		}
		$r = "	SELECT * FROM larmes_items_list
				ORDER BY ".$order;
		$this->loots = $this->sql->get_array($r);
	}
	
	public function get_stats_by_id(){
		$r = "SELECT * FROM larmes_items_stats WHERE item_id = '".$this->loot_id."'";
		$stats = $this->sql->get_array($r);
		return $stats;
	}
	
	public function get_loot_by_id(){
		foreach ($this->loots as $loot){
			if ($loot['item_id'] == $this->loot_id){
				return $loot;
			}
		}
	}
	
	protected function get_loots_by_boss(){
		$temp_loots = array();
		foreach ($this->loots as $loot)
			if ($loot['source_id'] == $this->boss_id)
				$temp_loots[] = $loot;
		$this->loots = $temp_loots;
	}
	
	protected function get_loots_by_dificulty(){
		$temp_loots = array();
		$dif_array = array();
		foreach ($this->dificulties as $k=>$dif){
			$dif_array[$k] = explode(',', $dif);
		}
		foreach ($this->loots as $loot){
			foreach($this->boss_by_raid as $raid=>$bosses){
				foreach ($bosses as $id=>$boss){
					if ($loot['source_id'] == $id){
						$raid_id = $raid;
					}
				}
			}
			if ($this->dificulty == 'n' && (($loot['item_lvl'] == $dif_array[$raid_id][0]))){
				$temp_loots[] = $loot;
			} else if ($this->dificulty == 'hm' && (($loot['item_lvl'] == $dif_array[$raid_id][1]))){
				$temp_loots[] = $loot;
			} else if ($this->dificulty == 'rf' && ($loot['item_lvl'] == $dif_array[$raid_id][2])){
				$temp_loots[] = $loot;
			}
		}
		$this->loots = $temp_loots;
	}
	
	private function get_raid_from_loot($loot){
		$loot = '';
		//echo 'ok';
	}
	
	protected function get_loots_by_classe(){
		$temp_loots = array();
		foreach ($this->loots as $loot)
			if ($loot['item_class'] == $this->classe)
				$temp_loots[] = $loot;
		$this->loots = $temp_loots;
	}
	
	protected function get_loots_by_subclasse(){
		$temp_loots = array();
		foreach ($this->loots as $loot){
			if ($loot['item_subclass'] == $this->subclasse)
				$temp_loots[] = $loot;
		}
		$this->loots = $temp_loots;
	}
	
	protected function get_loots_by_type(){
		$temp_loots = array();
		foreach ($this->loots as $loot){
			if ($this->type != '5' && $this->type != '20'){
				if ($loot['item_type'] == $this->type){
					$temp_loots[] = $loot;
				}
			} else{
				if ($loot['item_type'] == 5 || $loot['item_type'] == 20)
					$temp_loots[] = $loot;
			}
		}
		$this->loots = $temp_loots;
	}
	
	protected function get_loots_by_raid(){
		$temp_loots = array();
		$boss_of_raid = array();
		foreach ($this->boss_by_raid as $id_raid=>$bosses){
			$boss_of_raid[$id_raid] = array();
			foreach ($bosses as $id_boss=>$boss){
				$boss_of_raid[$id_raid][] = $id_boss;
			}
		}
		foreach ($this->loots as $loot){
			if (in_array($loot['source_id'], $boss_of_raid[$this->raid])){
				$temp_loots[] = $loot;
			}
		}
		$this->loots = $temp_loots;
	}
	
	protected function get_loots_not_assign(){
		$temp_loots = array();
		foreach ($this->loots as $loot){
			if ($loot['source_id'] == '0' && in_array($loot['item_lvl'], array(553,566,561,574,600, 608)) && $loot['item_class'] != '15' && $loot['item_id'] != '105856' && !strpos($loot['item_name'], 'Siege of Orgrimmar')){
				$temp_loots[] = $loot;
			}
		}
		$this->loots = $temp_loots;
	}
	
	protected function get_loots_by_down(){
		$temp_loots = array();
		$dif_array = array();
		$rf_loots = array();
		foreach ($this->dificulties as $k=>$dif){
			$dif_array[$k] = explode(',', $dif);
		}
		foreach ($this->loots as $loot){
			$is_pvp = strpos($loot['item_name'], 'gladiateur');
			if ($loot['item_quality'] == '5'){
				$loot['loot_temp'] = '0';
				$temp_loots[] = $loot;
			} else if ($is_pvp === false && $loot['item_quality'] == '4'){
				if (isset($this->boss_down[$loot['source_id']])){
					foreach($this->boss_by_raid as $raid=>$bosses){
						foreach ($bosses as $id=>$boss){
							if ($loot['source_id'] == $id){
								$raid_id = $raid;
							}
						}
					}
					switch($this->boss_down[$loot['source_id']]){
						case '1':
						case '0':
							if (($loot['item_lvl'] == $dif_array[$raid_id][0])){
								if ($this->boss_down[$loot['source_id']] == '0')
									$loot['loot_temp'] = '1';
								$temp_loots[] = $loot;
							}							
						break;
						case '2':
						case '3':
							if (($loot['item_lvl'] == $dif_array[$raid_id][1])){
								if ($this->boss_down[$loot['source_id']] == '3')
									$loot['loot_temp'] = '1';
								$temp_loots[] = $loot;
							}
						break;
					}
				} else if ($loot['source_type'] != 'CREATURE_DROP'){
					$temp_loots[] = $loot;
				} else {
					foreach ($dif_array as $raid_id=>$dif){
						if ($loot['item_lvl'] == $dif[2] && !isset($rf_loots[$loot['item_id']])){
							$loot['loot_temp'] = '3';
							$temp_loots[] = $loot;
							$rf_loots[$loot['item_id']] = true;
						} else if (!isset($rf_loots[$loot['item_id']]) && $loot['item_lvl'] != '528' && $loot['item_lvl'] != '541' && $loot['item_lvl'] != '559' && $loot['item_lvl'] != '572'){
							$loot['loot_temp'] = '2';
							$temp_loots[] = $loot;
							$rf_loots[$loot['item_id']] = true;
						} else if (isset($dif[3]) && ($loot['item_lvl'] == '600' || $loot['item_lvl'] == '608')){
							$loot['loot_temp'] = '1';
							$temp_loots[] = $loot;
						}
					}
				}
			}
		}
		$this->loots = $temp_loots;
	}
	
	protected function get_loot_by_stats(){
		$stats = explode(',', $this->stats_get);
		$nb_stats = count($stats);
		$r = "SELECT * FROM larmes_items_stats";
		$stats_array = $this->sql->get_array($r);
		$stats_by_item = array();
		foreach ($stats_array as $stat){
			$stats_by_item[$stat['item_id']][$stat['stat_id']] = $stat['stat_value'];
		}
		unset($stats_array);
		$temp_loots = array();
		foreach ($stats_by_item as $item_id=>$stats_array){
			foreach ($stats as $stat){
				if (array_key_exists($stat, $stats_array)){
					if (!isset($stats_by_item[$item_id]['nb_stats_found'])){
						$stats_by_item[$item_id]['nb_stats_found'] = 1;
					} else {
						$stats_by_item[$item_id]['nb_stats_found']++;
					}
					if ($stats_by_item[$item_id]['nb_stats_found'] == $nb_stats){
						foreach ($this->loots as $loot){
							if ($loot['item_id'] == $item_id)
								$temp_loots[] = $loot;
						}
					}
				}
			}
		}
		$this->loots = $temp_loots;
	}
	
	protected function get_loot_by_gemmes(){
		$gemmes = explode(',', $this->gemmes_get);
		$nb_gemmes = count($gemmes);
		$found = array();
		$temp_loots = array();
		foreach ($this->loots as $loot){
			foreach ($gemmes as $gemme){
				if (strpos($loot['item_gems'], $gemme)){
					if (!isset($found[$loot['item_id']])){
						$found[$loot['item_id']] = 1;
					} else {
						$found[$loot['item_id']]++;
					}
				}
			}
			if ($found[$loot['item_id']] == $nb_gemmes){
				$temp_loots[] = $loot;
			}
		}
		$this->loots = $temp_loots;
	}
	
	protected function get_loot_by_spells(){
		$spells = explode(',', $this->spells_get);
		$nb_spells = count($spells);
		$r = "SELECT * FROM larmes_items_spells";
		$spells_array = $this->sql->get_array($r);
		$spells_by_item = array();
		foreach ($spells_array as $spell){
			$spells_by_item[$spell['item_id']][$spell['spell_action']] = $spell['spell_desc'];
		}
		unset($spells_array);
		$temp_loots = array();
		foreach ($spells_by_item as $item_id=>$spells_array){
			foreach ($spells as $spell){
				if (array_key_exists($spell, $spells_array)){
					if (!isset($spells_by_item[$item_id]['nb_spells_found'])){
						$spells_by_item[$item_id]['nb_spells_found'] = 1;
					} else {
						$spells_by_item[$item_id]['nb_spells_found']++;
					}
					if ($spells_by_item[$item_id]['nb_spells_found'] == $nb_spells){
						foreach ($this->loots as $loot){
							if ($loot['item_id'] == $item_id)
								$temp_loots[] = $loot;
						}
					}
				}
			}
		}
		$this->loots = $temp_loots;
	}
	
	public function get_loot_foudroyant($itemdatas){
		$lvl = '528';
		if ($itemdatas['item_lvl'] > 522)
			$lvl = '559';
		$r = "SELECT * FROM larmes_items_list WHERE item_name = '".$itemdatas['item_name']."' AND item_lvl = '".$lvl."'";
		$temp = $this->sql->get_array($r);
		if ($temp[0])
			return $temp[0];
		else
			return false;
	}
	
	private function make_table_loots(){
		$this->loots_html .= '
		<table border="0" cellpadding="0" cellspacing="2">
			<tr class="loots_head">
				<td colspan="2">Objet</td>
				<td>Niveau</td>
				<td>Type</td>
				<td colspan="2">Emplacement</td>
			</tr>';
		foreach ($this->loots as $loot){
			$this->loots_html .= '
			<tr class="loots">
				<td><div class="item_slot item_slot_'.$loot['item_quality'].'"><img src="'.$loot['item_img'].'" /></div></td>
				<td class="item_name name_'.$loot['item_quality'].'">'.str_replace('?', '\'', $loot['item_name']).'</td>
				<td align="center">'.$loot['item_lvl'].'</td>
				<td align="center">'.$this->classes[$loot['item_class']].'</td>
				<td'.((($loot['item_class']==2 || $loot['item_class']==15) || ($loot['item_class']==4 && $loot['item_subclass']==6))?' colspan="2"':'').' align="center">'.
					$this->subclasses[$loot['item_class']][$loot['item_subclass']].'
				</td>'.
				(($loot['item_class']==4 && $loot['item_subclass']!=6)?'<td align="center">'.$this->types[$loot['item_type']].'</td>':'').'
			</tr>';
		}
		$this->loots_html .= '
		</table>';
	}
	
	public function get_interested_players($boss_id){
		$return = false;
		if (is_array($this->token_by_boss[$boss_id])){
			foreach ($this->token_by_boss[$boss_id] as $loot){
				if ($loot == $this->loot_id){
					foreach ($this->type_by_token as $type=>$tokens){
						if (in_array($loot, $tokens)){
							if ($type == '5' ||$type == '20')
								$r = "SELECT us.* FROM larmes_user_slots us, larmes_items_list il WHERE il.item_type IN (5, 20) AND il.source_id = '".$boss_id."' AND il.item_id = us.wich_id AND us.wich_id != us.item_id";
							else
								$r = "SELECT us.* FROM larmes_user_slots us, larmes_items_list il WHERE il.item_type = '".$type."' AND il.source_id = '".$boss_id."' AND il.item_id = us.wich_id AND us.wich_id != us.item_id";
							$return = $this->sql->get_array($r);
						}
					}
				}
			}
		}
		if (!is_array($return)){
			$r = "SELECT us.* FROM larmes_user_slots us, larmes_identifiants i WHERE us.wich_id = '".$this->loot_id."' AND us.wich_id != us.item_id AND us.user_id = i.user_id ORDER BY i.ilvl_moy";
			$return = $this->sql->get_array($r);
		}
		foreach ($return as $key=>$player){
			$loots_by_raid = $this->loots_by_raid_loot($player['user_id']);
			$return[$key]['loots_by_raid'] = $loots_by_raid;
		}		
		return $this->array_sort_deep($return, 'loots_by_raid');
	}
	
	public function get_interested_players_prov($boss_id){
		$return = false;
		if (is_array($this->token_by_boss[$boss_id])){
			foreach ($this->token_by_boss[$boss_id] as $loot){
				if ($loot == $this->loot_id){
					foreach ($this->type_by_token as $type=>$tokens){
						if (in_array($loot, $tokens)){
							if ($type == '5' ||$type == '20')
								$r = "SELECT us.* FROM larmes_user_slots us, larmes_items_list il WHERE il.item_type IN (5, 20) AND il.source_id = '".$boss_id."' AND il.item_id = us.wich_prov_id AND us.wich_prov_id != us.item_id";
							else
								$r = "SELECT us.* FROM larmes_user_slots us, larmes_items_list il WHERE il.item_type = '".$type."' AND il.source_id = '".$boss_id."' AND il.item_id = us.wich_prov_id AND us.wich_prov_id != us.item_id";
							$return = $this->sql->get_array($r);
						}
					}
				}
			}
		}
		if (!is_array($return)){
			$r = "SELECT us.* FROM larmes_user_slots us, larmes_identifiants i WHERE us.wich_prov_id = '".$this->loot_id."' AND us.wich_prov_id != us.item_id AND us.user_id = i.user_id ORDER BY i.ilvl_moy";
			$return = $this->sql->get_array($r);
		}
		foreach ($return as $key=>$player){
			$loots_by_raid = $this->loots_by_raid_loot($player['user_id']);
			$return[$key]['loots_by_raid'] = $loots_by_raid;
		}		
		return $this->array_sort_deep($return, 'loots_by_raid');
	}
	
	public function get_interested_players_spe2($boss_id){
		$return = false;
		if (is_array($this->token_by_boss[$boss_id])){
			foreach ($this->token_by_boss[$boss_id] as $loot){
				if ($loot == $this->loot_id){
					foreach ($this->type_by_token as $type=>$tokens){
						if (in_array($loot, $tokens)){
							if ($type == '5' ||$type == '20')
								$r = "SELECT us.* FROM larmes_user_slots us, larmes_items_list il WHERE il.item_type IN (5, 20) AND il.source_id = '".$boss_id."' AND il.item_id = us.wish_spe_2_id AND us.wish_spe_2_id != us.item_id";
							else
								$r = "SELECT us.* FROM larmes_user_slots us, larmes_items_list il WHERE il.item_type = '".$type."' AND il.source_id = '".$boss_id."' AND il.item_id = us.wish_spe_2_id AND us.wish_spe_2_id != us.item_id";
							$return = $this->sql->get_array($r);
						}
					}
				}
			}
		}
		if (!is_array($return)){
			$r = "SELECT us.* FROM larmes_user_slots us, larmes_identifiants i WHERE us.wish_spe_2_id = '".$this->loot_id."' AND us.wish_spe_2_id != us.item_id AND us.user_id = i.user_id ORDER BY i.ilvl_moy";
			$return = $this->sql->get_array($r);
		}
		foreach ($return as $key=>$player){
			$loots_by_raid = $this->loots_by_raid_loot($player['user_id']);
			$return[$key]['loots_by_raid'] = $loots_by_raid;
		}		
		return $this->array_sort_deep($return, 'loots_by_raid');
	}
	
	public function array_sort_deep($array,$sort_by,$order='asort'){
		$keys=array();
		foreach($array as $k=>$v)
			$keys[$k]=$v[$sort_by];
		$order($keys);
		return $this->array_merge_numeric($keys,$array);
	}
	
	private function array_merge_numeric($a,$b, $depth="array_merge"){
		$args = func_get_args();
		$res  = array_shift($args);
		$depth = is_string(end($args)) ? array_pop($args) : "array_merge";


		for($i=0;$i<count($args);$i++) {
		  foreach($args[$i] as $k=>$v) {
			$res[$k] = (is_array($v) && isset($res[$k]) && is_array($res[$k]) )? $depth($res[$k], $v) : $v;
		  }
		}

		return $res;
	}
	
	public function check_other_slot($slot_base, $user_id, $item_id){
		$r = "SELECT COUNT(*) FROM larmes_user_slots WHERE item_id = '".$item_id."' AND slot_id LIKE '".$slot_base."%' AND user_id = '".$user_id."'";
		$return = $this->sql->get_array($r);
		if ($return[0]['COUNT(*)'] == 0)
			return false;
		else
			return true;
	}
	
	public function get_infos_player($id){
		$r = "SELECT * FROM larmes_identifiants WHERE user_id = '".$id."'";
		return $this->sql->get_array($r);
	}
	
	private function get_classes(){
		$this->classes = array(
			'2'=>'Arme',
			'4'=>'Armure',
			'15'=>'Divers');
	}
	
	private function get_subclasses(){
		$this->subclasses['4'] = array(
			'0'=>'Divers',
			'1'=>'Tissu',
			'2'=>'Cuir',
			'3'=>'Maille',
			'4'=>'Plaque',
			'6'=>'Bouclier');
		$this->subclasses['2'] = array(
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
			'20'=>'Cannes à pêche');
		$this->subclasses['15'] = array(
			'0'=>'Camelotte');
	}
	
	private function get_two_hands(){
		$this->two_hands = array ('1', '2', '3', '5', '6', '8', '10', '18');
	}
	
	private function get_types(){
		$this->types = array(
			'1'=>'Tête',
			'2'=>'Cou',
			'3'=>'Epaules',
			'5'=>'Torse',
			'6'=>'Taille',
			'7'=>'Jambes',
			'8'=>'Pieds',
			'9'=>'Poignets',
			'10'=>'Mains',
			'11'=>'Doigt',
			'12'=>'Bijou',
			'16'=>'Dos',
			'20'=>'Torse',
			'23'=>'Main gauche');
	}
	
	private function get_dificulties(){
		$this->dificulties = array(
			'0'=>'489,502,476',
			'1'=>'496,509,483',
			'2'=>'496,509,483',
			'3'=>'522,535,502',
			'4'=>'553,566,528,600,608'
		);
	}
	
	private function get_boss_by_raid(){
		$this->raids = array(
			'0'=>'Caveaux Mogu\'shan',
			'1'=>'Coeur de la peur',
			'2'=>'Terrasse Printanière',
			'3'=>'Trône du tonnerre',
			'4'=>'Siège d\'Orgrimmar');
			
		$this->boss_by_raid = array(
			'0' => array(
				'60043'=>'Le garde de pierre',
				'60009'=>'Feng le Maudit',
				'60143'=>'Gara’jal le Lieur d’esprit',
				'60701'=>'Les esprits-rois',
				'60410'=>'Elegon',
				'60399'=>'Volonté de l\'empereur',
				'60400'=>'Volonté de l\'empereur'),
			'1'=>array(
				'62980'=>'Vizir impérial Zor\'lok',
				'62543'=>'Seigneur des lames Ta\'yak',
				'62164'=>'Garalon',
				'62397'=>'Seigneur du Vent Mel\'jarak',
				'62511'=>'Sculpte-ambre Un\'sok',
				'62837'=>'Grande impératrice Shek\'zeer'),
			'2'=>array(
				'60585'=>'Protecteurs de l\'Éternel',
				'62442'=>'Tsulong',
				'62983'=>'Lei Shi',
				'60999'=>'Sha de la peur'),
			'3'=>array(
				'69465'=>'Jin\'rokh le Briseur',
				'68476'=>'Horridon',
				'69078'=>'Conseil des anciens',
				'67977'=>'Tortos',
				'68066'=>'Megaera',
				'68177'=>'Ji Kun',
				'67827'=>'Durumu',
				'69017'=>'Primordius',
				'69427'=>'Sombre animus',
				'68078'=>'Qwon de fer',
				'68904'=>'Concubines jumelles',
				'68397'=>'Lei Shen',
				'69473'=>'Ra Den'),
			'4'=>array(
				'71543'=>'Immerseus',
				'71475'=>'Les protecteurs déchus',
				'71965'=>'Norushen',
				'71734'=>'Sha de l\'orgueil',
				'72249'=>'Galakras',
				'71466'=>'Mastodonte de fer',
				'71859'=>'Sombres chamans kor\'krons',
				'71515'=>'Général Nazgrim',
				'71454'=>'Malkorok',
				'71889'=>'Butin de Pandarie',
				'71529'=>'Thok le Sanguinaire',
				'71504'=>'Ingé-siège Boîte-Noire',
				'71152'=>'Parangons des Klaxxi',
				'71865'=>'Garrosh Hurlenfer')
		);
	}
	
	private function get_stats(){
		$this->stats = array(
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
	}
	
	private function get_gemmes(){
		$this->gemmes = array(
			'BLUE'=>'une châsse bleue',
			'RED'=>'une châsse rouge',
			'YELLOW'=>'une châsse jaune',
			'META'=>'une méta châsse',
			'HYDRAULIC'=>'une châsse touchée par le Sha'
		);
	}
	
	private function get_spells(){
		$this->spells = array(
			'ON_EQUIP'=>'Pouvant proc',
			'ON_USE'=>'Peut être utilisé'
		);
	}
	
	private function get_boss_down(){
		$r = "SELECT * FROM larmes_down";
		$result = $this->sql->get_array($r);
		$this->boss_down = array();
		foreach ($result as $boss){
			//$this->boss_down[] = $boss['boss_id'];
			$this->boss_down[$boss['boss_id']] = $boss['down_type'];
		}
		$this->boss_down['0'] = 'World Loot';
	}
	
	public function get_player_slots($id_user){
		$r = "SELECT * FROM larmes_user_slots WHERE user_id = '".$id_user."'";
		return $this->sql->get_array($r);
	}
	
	private function take_news(){
		$r = "SELECT user_log, user_id FROM larmes_identifiants WHERE user_statut = '3'";
		$users = array();
		$temp_users = $this->sql->get_array($r);
		foreach ($temp_users as $temp)
			$users[$temp['user_id']] = $temp['user_log'];
		$r = "SELECT * FROM larmes_maj ORDER BY maj_id DESC LIMIT 0, 6";
		$majs = $this->sql->get_array($r);
		$this->update_news = '
			<div class="panel panel-default">
				<div class="panel-heading">Notes de Mises à Jour</div>
				<div class="panel-body">
					<ul style="padding:0px; margin:0px 0px 0px 10px; list-style:none;">';
		foreach ($majs as $maj){
			$date_array = explode('-', $maj['maj_date']);
			$date = $date_array[2].'/'.$date_array[1].'/'.$date_array[0];
			$this->update_news .= '
						<li>
							<ul style="margin:0px 0px 5px 0px; padding:0px; color:#FFF;">
								<li style="list-style:none;"><strong>'.$users[$maj['user_id']].'</strong><i> ('.$date.')</i></li>
								<li style="list-style:none;">'.stripslashes($maj['maj_content']).'</li>
							</ul>
						</li>';
		}
		$this->update_news .= '
					</ul>
				</div>
			</div>';
	}
	
	public function get_all_players_attrib($itemfoud){
		global $_POST;
		$item_id = (int)$_POST['id_item'];
		$mode = $_POST['mode'];
		$boss_id = (int)$_POST['boss_id'];
		$raid_id = (int)$_POST['raid_id'];
		$r = "SELECT user_perso, user_id FROM larmes_identifiants where user_perso != '' ORDER BY user_perso";
		$users = $this->sql->get_array($r);
		
		$return = '	<center><ul id="inter_players">
						<li>
							OU attribuer &agrave; :
							<form method="post" id="select_player_form" action="">
								<input type="hidden" name="item_id" value="'.$item_id.'">
								<input type="hidden" name="mode" value="'.$mode.'">
								<input type="hidden" name="boss_id" value="'.$boss_id.'">
								<input type="hidden" name="raid_id" value="'.$raid_id.'">
								<input type="hidden" name="force_user_id" id="force_user_select" value="'.$player['user_id'].'">
								<select id="user_select" onchange="javascript:take_user(this);">
									<option value="0">---</option>';
		foreach ($users as $user){
			$return .= '			<option value="'.$user['user_id'].'">'.utf8_encode($user['user_perso']).'</option>';
		}
		$return .= '			</select>
								<input type="submit" value="OK" />
							</form>
						</li>';
		if ($itemfoud != false){
			$return .= '<li>
							OU attribuer &agrave; (Foudroyant):
							<form method="post" id="select_player_form_foudr" action="">
								<input type="hidden" name="item_id" value="'.$itemfoud['item_id'].'">
								<input type="hidden" name="mode" value="'.$mode.'">
								<input type="hidden" name="boss_id" value="'.$boss_id.'">
								<input type="hidden" name="raid_id" value="'.$raid_id.'">
								<input type="hidden" name="force_user_id" id="force_user_select_foudr" value="'.$player['user_id'].'">
								<select id="user_select" onchange="javascript:take_user_foudr(this);">
									<option value="0">---</option>';
		foreach ($users as $user){
			$return .= '			<option value="'.$user['user_id'].'">'.utf8_encode($user['user_perso']).'</option>';
		}
		$return .= '			</select>
								<input type="submit" value="OK" />
							</form>
						</li>';
		}
		$return .= '</ul></center>';
		return $return;
	}
	
	public function get_all_players($slot){
		$r = "SELECT user_id, id FROM larmes_user_slots WHERE slot_id = '".$slot."'";
		return $this->sql->get_array($r);
	}
	
	public function get_item_slot($r){
		return $this->sql->get_array($r);
	}
	
	public function get_array_action($r){
		return $this->sql->get_array($r);
	}
	
	protected function order_loots_by_down(){
		$temp_loots = array();
		foreach ($this->loots as $loot){
			if ($loot['loot_temp'] == '1')
				$temp_loots['futur'][] = $loot;
			else if ($loot['loot_temp'] == '2')
				$temp_loots['not_loot'][] = $loot;
			else if ($loot['loot_temp'] == '3')
				$temp_loots['raid_finder'][] = $loot;
			else if ($loot['source_type'] == 'CREATED_BY_SPELL')
				$temp_loots['craft'][] = $loot;
			else if ($loot['source_type'] == 'FACTION_REWARD')
				$temp_loots['reput'][] = $loot;
			else
				$temp_loots['dispo'][] = $loot;
		}
		$this->loots = $temp_loots;
	}
	
	private function get_months(){
		$this->months = array(	'01'=>'Janvier',
								'02'=>'Février',
								'03'=>'Mars',
								'04'=>'Avril',
								'05'=>'Mai',
								'06'=>'Juin',
								'07'=>'Juillet',
								'08'=>'Aout',
								'09'=>'Septembre',
								'10'=>'Octobre',
								'11'=>'Novembre',
								'12'=>'Décembre');
	}
	
	private function get_token_by_boss(){
		$this->token_by_boss = array(	'69078'=>array('95570','95575','95580','96971','96972','96973'),
										'69427'=>array('95569','95574','95579','96938','96939','96940'),
										'68177'=>array('95572','95576','95581','97003','97004','97005'),
										'68078'=>array('95573','95578','95583','97071','97072','97073'),
										'68904'=>array('95571','95577','95582','96995','96996','96997'),
										'71734'=>array('99691','99696','99686','99716','99715','99714'),
										'71515'=>array('99692','99682','99687','99721','99722','99720'),
										'71529'=>array('99694','99683','99689','99724','99725','99723'),
										'71504'=>array('99695','99685','99690','99718','99719','99717'),
										'71152'=>array('99688','99693','99684','99712','99713','99726'));
		$this->type_by_token = array(	'1'=>array('95571','95577','95582','96995','96996','96997','99694','99683','99689','99724','99725','99723'),
										'3'=>array('95573','95578','95583','97071','97072','97073','99695','99685','99690','99718','99719','99717'),
										'5'=>array('95569','95574','95579','96938','96939','96940','99691','99696','99686','99716','99715','99714'),
										'7'=>array('95572','95576','95581','97003','97004','97005','99688','99693','99684','99712','99713','99726'),
										'10'=>array('95570','95575','95580','96971','96972','96973','99692','99682','99687','99721','99722','99720'),
										'20'=>array('95569','95574','95579','96938','96939','96940','99691','99696','99686','99716','99715','99714'));
	}
	
	public function get_two_slots($slot_base, $user_id){
		$r = "SELECT * FROM larmes_user_slots WHERE user_id = '".$user_id."' AND slot_id LIKE '".$slot_base."%'";
		return $this->sql->get_array($r);
	}
	
	private function make_form_missing(){
		$this->form_missing = '
			<div class="panel panel-default">
				<div class="panel-heading">Un objet manquant ?</div>
				<div class="panel-body">
					<form method="post" action="index.php?page='.$this->page.'" class="form-horizontal" role="form">
						<div class="form-group">
							<label class="control-label col-sm-4" for="objet_manquant">Nom de l\'objet :</label>
							<div class="col-sm-8">
								<input type="text" name="objet_manquant" id="objet_manquant" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">&nbsp;</label>
							<div class="col-sm-8">
								<button type="submit" class="btn btn-success">Réclamer</button>
							</div>
						</div>
					</form>
				</div>
			</div>';
	}
	
	public function loots_by_raid_loot($user_id){
		$r = "SELECT COUNT(*) FROM larmes_raid_historique WHERE user_id = '".$user_id."'";
		$result = $this->sql->get_array($r);
		if ($result[0]['COUNT(*)'] != 0){
			$total = $result[0]['COUNT(*)'];
			$r = "SELECT DISTINCT raid FROM larmes_raid_historique";
			$raids = $this->sql->get_array($r);
			$nb_raid = 0;
			foreach ($raids as $raid)
				$nb_raid++;
			
			return round(($total / $nb_raid), 2);
		} else 
			return 0;
	}
}

	//UPDATE larmes_items_list SET source_id = '69465', source_type = 'CREATURE_DROP' WHERE item_id IN ('95510', '94512', '94738', '94735', '94737', '94739', '94730', '94726', '94724', '94728', '94733', '94725', '94727', '94723', '94732', '94734', '94722', '94731', '94729', '94736', '95997', '96005', '96010', '96002', '96012', '96015', '96011', '96006', '96000', '95999', '96007', '96009', '95996', '96008', '96004', '96014', '96016', '96001', '96003', '95498', '95061', '95066', '95499', '95500', '95516', '95503', '95631', '96375', '95642', '96386', '95644', '96388', '95626', '95998', '96370', '95625', '96369', '95633', '96377', '95639', '96383', '95636', '96380', '95638', '96382', '96235', '95505', '95632', '96376', '95634', '96378', '95628', '96372', '95629', '96373', '95643', '96387', '95627', '96371', '95635', '96379', '95640', '96384', '95065', '95630', '96374', '95068', '95637', '96381', '95624', '96368', '96243')
	//UPDATE larmes_items_list SET source_id = '68476', source_type = 'CREATURE_DROP' WHERE item_id IN ('94749', '94750', '94747', '94743', '94751', '94746', '94752', '94526', '94754', '94514', '94748', '94744', '95514', '94753', '94755', '94740', '94742', '95660', '96404', '95647', '96019', '96391', '95650', '96394', '95653', '94745', '96397', '95657', '96401', '95655', '96399', '95656', '96400', '95651', '96395', '95641', '96385', '95645', '96389', '95654', '96398', '95658', '96402', '95663', '94975', '96407', '95652', '96396', '95648', '96392', '95659', '96403', '95664', '96408', '95649', '94741', '96021', '96393', '95661', '94756', '96405', '95662', '96406', '95646', '96390')
	//gants UPDATE larmes_items_list SET source_id = '69078', source_type = 'CREATURE_DROP' WHERE item_id IN ('95670', '94760', '96414', '95673', '94767', '96417', '95677', '94516', '96421', '95666', '94759', '96410', '95665', '94523', '96409', '95672', '94763', '96416', '95671', '94765', '96415', '95668', '94761', '96412', '95667', '94762', '96411', '95676', '94766', '96420', '95674', '94764', '96418', '95669', '94513', '96413', '95675', '94758', '96419')
	//UPDATE larmes_items_list SET source_id = '67977', source_type = 'CREATURE_DROP' WHERE item_id IN ('94785', '94786', '94771', '94769', '94778', '94784', '94773', '94774', '94777', '94779', '95685', '94776', '96429', '95678', '96422', '95686', '94768', '96430', '95681', '94775', '96425', '95688', '94781', '96432', '95693', '96437', '95691', '96435', '95692', '96436', '95696', '96440', '95689', '94782', '96433', '95697', '94787', '96441', '95690', '94780', '96434', '95683', '96427', '95687', '96431', '95682', '94772', '96426', '95684', '96428', '95680', '96424', '95679', '94770', '96423', '95694', '96438', '95695', '94783', '96439')
	// UPDATE larmes_items_list SET source_id = '68066', source_type = 'CREATURE_DROP' WHERE item_id IN ('95708', '94804', '96452', '95716', '94798', '96460', '95699', '94794', '96443', '95702', '94792', '96446', '95715', '94797', '96459', '95713', '94800', '96457', '95698', '94788', '96442', '95710', '94796', '96454', '95703', '94789', '96447', '95700', '94791', '96444', '95714', '94802', '96458', '95709', '94803', '96453', '95701', '94790', '96445', '95707', '94801', '96451', '95712', '94520', '96456', '95706', '94799', '96450', '95705', '94793', '96449', '95704', '94795', '96448', '95711', '94521', '96455')
	//pantalon UPDATE larmes_items_list SET source_id = '68177', source_type = 'CREATURE_DROP' WHERE item_id IN ('94811', '94806', '94813', '94812', '94515', '94808', '94527', '96096', '94807', '96093', '94805', '96095', '96091', '96092', '94809', '94810', '96097', '96240', '96099', '95720', '96464', '95721', '96465', '95718', '96090', '96462', '95723', '96467', '96237', '96238', '95717', '96089', '96461', '96230', '95727', '96471', '95062', '95724', '96468', '95726', '96098', '96470', '95725', '96469', '95719', '96463', '95722', '96466')
	//UPDATE larmes_items_list SET source_id = '67827', source_type = 'CREATURE_DROP' WHERE item_id IN ('94928', '94820', '94926', '94929', '94822', '94816', '94818', '94821', '94931', '95511', '96112', '96101', '96113', '96109', '96106', '94817', '94924', '94923', '94925', '96103', '96114', '94930', '94815', '94922', '94927', '96107', '96118', '96111', '96119', '96110', '96115', '96116', '95734', '96478', '95745', '96489', '95732', '96476', '95741', '96485', '95736', '96480', '95731', '96475', '95747', '96491', '95733', '96477', '95743', '96487', '95735', '96479', '95746', '96490', '95729', '96473', '95742', '96486', '96230', '95739', '96483', '95730', '94819', '96474', '95738', '96482', '95728', '94814', '96472', '95744', '96488', '95740', '96484', '95737', '96481')
	//UPDATE larmes_items_list SET source_id = '69017', source_type = 'CREATURE_DROP' WHERE item_id IN ('94948', '94946', '94942', '94944', '94947', '94949', '94953', '94951', '94522', '94519', '96134', '94952', '94939', '94943', '94941', '94525', '94940', '96121', '96136', '94937', '96120', '96140', '96127', '96124', '95513', '94938', '96138', '96133', '96139', '95756', '96500', '95762', '96506', '95750', '96122', '96494', '95766', '96510', '95755', '96499', '95753', '96497', '95502', '95768', '94945', '96512', '95752', '96496', '95749', '96493', '95760', '96504', '95751', '96123', '96495', '95765', '96509', '95761', '96505', '95764', '96508', '95758', '96502', '95754', '96498', '95763', '96507', '95759', '96503', '95767', '94950', '96511', '95748', '96492', '95757', '96129', '96501')
	//torse UPDATE larmes_items_list SET source_id = '69427', source_type = 'CREATURE_DROP' WHERE item_id IN ('94959', '94960', '94518', '94956', '94957', '94961', '96144', '96145', '94531', '96151', '96143', '95774', '94955', '96146', '96518', '95773', '96517', '95771', '96515', '95778', '94958', '96522', '95777', '96521', '95776', '96520', '95769', '96513', '95772', '96516', '95779', '96523', '95775', '94962', '96519', '95770', '94954', '96514')
	//epaules UPDATE larmes_items_list SET source_id = '68078', source_type = 'CREATURE_DROP' WHERE item_id IN ('94972', '96157', '94971', '94966', '94969', '95512', '94963', '94964', '94970', '94967', '94968', '96156', '96162', '96160', '96159', '95790', '96534', '95782', '96526', '95780', '96524', '95066', '95787', '96531', '95783', '96527', '95788', '96532', '95786', '94965', '96530', '95069', '95789', '96533', '95784', '96528', '95785', '96529', '95781', '96153', '96525')
	//Casque UPDATE larmes_items_list SET source_id = '68904', source_type = 'CREATURE_DROP' WHERE item_id IN ('95798', '94976', '96542', '95794', '95515', '96538', '95796', '94979', '96540', '95797', '94978', '96541', '95800', '94981', '96544', '95801', '94757', '96545', '95799', '94529', '96543', '95792', '94977', '96536', '95793', '94980', '96537', '95795', '94974', '96539', '95791', '94973', '96535')
	//UPDATE larmes_items_list SET source_id = '68397', source_type = 'CREATURE_DROP' WHERE item_id IN ('95472', '94524', '95811', '94528', '96555', '95817', '94530', '96561', '95821', '94989', '96565', '95804', '94987', '96548', '95806', '94984', '96550', '95808', '94985', '96552', '95807', '95535', '96551', '95813', '94993', '96557', '95812', '94990', '96556', '95820', '94992', '96564', '95805', '94986', '96549', '95818', '95473', '96562', '95819', '94991', '96563', '95816', '94994', '96560', '95810', '96554', '95802', '94532', '96546', '95803', '94983', '96547', '95815', '94988', '96559', '95809', '94982', '96553', '95814', '96558')
	
?>