<?php
include_once('loots.class.php');
class user extends loots{
	
	public function user($guilde_name){
		global $_SESSION;
		global $_POST;
		global $_GET;
		global $armory;
		$this->session = $_SESSION;
		$this->post = $_POST;
		$this->get = $_GET;
		$this->action = $this->get['action'];
		$this->action_form = $this->post['action_form'];
		$this->action_form_valide = $this->post['action_form_valide'];
		$this->add_stat = $this->get['add_stat'];
		$this->add_gemme = $this->get['add_gemme'];
		$this->add_spell = $this->get['add_spell'];
		$this->stats_get = $this->get['stats'];
		$this->gemmes_get = $this->get['gemmes'];
		$this->spells_get = $this->get['spells'];
		$this->guilde_name = $guilde_name;
		$this->armory = $armory;
		$loots->menu_left = '';
		$this->user_slots = array();
		$this->objet_manquant = $this->post['objet_manquant'];
		
		$this->page = (isset($this->get['page'])) ? $this->get['page'] : '';
		$this->action = (isset($this->get['action'])) ? $this->get['action'] : '';
		$this->order = (isset($this->get['order'])) ? $this->get['order'] : '';
		
		$this->dificulty = (isset($this->get['dificulty'])) ? $this->get['dificulty'] : '';
		
		$this->id_to_change = (isset($this->get['id'])) ? $this->get['id'] : '';
		$sql = new sql();
		$loots = new loots($this->guilde_name);
		
		$this->loot = $loots;
		$this->sql = $sql;
		
		$this->id_user = (isset($this->session['id_user'])) ? $this->session['id_user'] : false;
		$loots->user_name = (isset($this->session['user_name'])) ? '<div style="position:absolute; margin:5px 0px 0px 5px;">Bonjour, '.$this->session['user_name'].'</div>' : '';
		$this->logged = $this->check_logged();
		if (!$this->id_user)
			$this->login_page();
		else {
			$this->get_slots();
			$loots->menu_left = $this->make_menu_left();
			switch ($this->page){
				case 'params':
					$this->loot->title_general = 'Paramettres';
					$this->get_content_params();
				break;
				case 'wish':
					$this->loot->title_general = 'Wish List';
					if ($this->session['statut'] > 0)
						$this->get_content_wish('wish');
					else
						$this->get_content_acceuil();
				break;
				case 'wish_prov':
					$this->loot->title_general = 'Wish List - S?lection provisoire';
					if ($this->session['statut'] > 0)
						$this->get_content_wish('prov');
					else
						$this->get_content_acceuil();
				break;
				case 'wish_spe2':
					$this->loot->title_general = 'Wish List - 2?me sp?cialisation';
					if ($this->session['statut'] > 0)
						$this->get_content_wish('spe2');
					else
						$this->get_content_acceuil();
				break;
				case 'compare':
					$this->loot->title_general = 'Outil comparatif pour votre classe';
					if ($this->session['statut'] > 0)
						$this->get_content_compare();
					else
						$this->get_content_acceuil();
				break;
				case 'hist':
					$this->loot->title_general = 'Historique';
					if ($this->session['statut'] > 0)
						$this->get_content_hist();
					else
						$this->get_content_acceuil();
				break;
				case 'assign':
					$this->loot->title_general = 'Admin - Assignation dse objets';
					if ($this->session['statut'] > 1)
						$this->get_content_assign();
					else
						$this->get_content_acceuil();
				break;
				case 'downs':
					$this->loot->title_general = 'Admin - Downs';
					if ($this->session['statut'] > 1)
						$this->get_content_downs();
					else
						$this->get_content_acceuil();
				break;
				case 'attrib':
					$this->loot->title_general = 'Admin - Attribution';
					if ($this->session['statut'] > 1)
						$this->get_content_attrib();
					else
						$this->get_content_acceuil();
				break;
				case 'echange':
					$this->loot->title_general = 'Admin - Correctif d\'attribution';
					if ($this->session['statut'] > 1)
						$this->get_content_echange();
					else
						$this->get_content_acceuil();
				break;
				case 'accounts':
					$this->loot->title_general = 'Admin - Comptes';
					if ($this->session['statut'] > 2)
						$this->get_content_accounts();
					else
						$this->get_content_acceuil();
				break;
				case 'stats':
					$this->loot->title_general = 'Admin - Statistiques';
					if ($this->session['statut'] > 2)
						$this->get_content_stats();
					else
						$this->get_content_acceuil();
				break;
				case 'stats_lfr':
					$this->loot->title_general = 'Admin - Statistiques Raid Finder';
					if ($this->session['statut'] > 2)
						$this->get_content_stats_lfr();
					else
						$this->get_content_acceuil();
				break;
				case 'majs':
					$this->loot->title_general = 'Admin - Notes de mise ? jour';
					if ($this->session['statut'] > 2)
						$this->get_content_majs();
					else
						$this->get_content_acceuil();
				break;
				case 'import':
					$this->loot->title_general = 'Admin - Importation d\'?quipement';
					if ($this->session['statut'] > 2)
						$this->get_content_import();
					else
						$this->get_content_acceuil();
				break;
				case 'manquants':
					$this->loot->title_general = 'Admin - Objets manquants';
					if ($this->session['statut'] > 2)
						$this->get_content_objets_manquants();
					else
						$this->get_content_acceuil();
				break;
				case 'emails':
					$this->loot->title_general = 'Admin - Newsletters';
					if ($this->session['statut'] > 2)
						$this->get_content_emails();
					else
						$this->get_content_acceuil();
				break;
				case 'calendar':
					$this->loot->title_general = 'Admin - Gestion des absences';
					if ($this->session['statut'] > 1)
						$this->get_content_calendar();
					else
						$this->get_content_acceuil();
				break;
				case 'crafts':
					$this->loot->title_general = 'Admin - Gestion des crafts';
					if ($this->session['statut'] > 1)
						$this->get_content_crafts();
					else
						$this->get_content_acceuil();
				break;
				case 'deco':
					$this->deconnection();
				break;
				case 'accueil':
				default:
					$this->loot->title_general = 'Accueil';
					$this->get_content_acceuil();
				break;
			}
			$this->check_email();
		}
		if ($this->objet_manquant != false){
			$this->add_objet_manquant();
		}
		
		echo $this->loot->get_content();
	}

	private function login_page(){
		$this->tpl_vars = array();
		$this->tpl_vars['error_message'] = '';
		if (isset($this->action_form) && $this->action_form == 'try_log'){
			$this->tpl_vars['error_message'] = $this->error_text('Identifiant / Mot de passe incorrect');
		}
		
		$this->loot->content_general = $this->load_template('login');
	}
	
	private function valide_text($message){
		$return = '
			<div class="alert alert-success">
    			<a href="#" class="close" data-dismiss="alert">&times;</a>
				'.$message.'
			</div>';
		return $return;
	}
	
	private function error_text($message){
		$return = '
	    <div class="alert alert-danger">
	        <a href="#" class="close" data-dismiss="alert">&times;</a>
	        <strong>Erreur!</strong><br />'.
	        $message.'
	    </div>';
		return $return;
	}
	
	private function warning_text($message, $bool = false, $other_vars = false){
		$txt = '';
		if (is_array($other_vars)){
			foreach ($other_vars as $name=>$var)
				$txt .= '<input type="hidden" name="'.$name.'" value="'.$var.'" />';
		}
		$return = '
			<div class="alert alert-warning">
    			<a href="#" class="close" data-dismiss="alert">&times;</a>
    			<strong>Attention!</strong><br />
				'.$message;
		if ($bool === true){
			$return .= '&nbsp;&nbsp;&nbsp;
						<form method="post" action="index.php?page='.$this->page.'">
							<input type="hidden" name="action_form" value="'.$this->action_form.'" />
							<input type="hidden" name="action_form_valide" value="oui" />'.$txt.'
							<input type="submit" value="Oui" class="submit yes" />
						</form>
						<form method="post" action="index.php?page='.$this->page.'">
							<input type="hidden" name="action_form" value="'.$this->action_form.'" />
							<input type="hidden" name="action_form_valide" value="non" />'.$txt.'
							<input type="submit" value="Non" class="submit no" />
						</form>';
		}		
		$return .= '
			</div>';
		return $return;
	}
	
	private function check_logged(){
		global $_SESSION;
		if (isset($this->action_form) && $this->action_form == 'try_log'){
			$r = "SELECT * FROM larmes_identifiants WHERE user_log = '".$this->post['identifiant_rlm']."' AND user_pass ='".$this->post['password_rlm']."'";
			$result = $this->sql->get_array($r);
			if ($result[0]['user_id']){
				$id_user = $result[0]['user_id'];
				$user_name = $result[0]['user_log'];
				$email = $result[0]['user_mail'];
				$personnage = $result[0]['user_perso'];
				$_SESSION['id_user'] = $id_user;
				$_SESSION['user_name'] = $user_name;
				$_SESSION['user_mail'] = $email;
				$_SESSION['personnage'] = $personnage;
				$_SESSION['wish_ilvl'] = $result[0]['user_ilvl_wish'];
				$_SESSION['statut'] = $result[0]['user_statut'];
				if (!empty($personnage)){
					$r = "UPDATE larmes_identifiants SET user_perso = '".$_SESSION['personnage']."' WHERE user_id = '".$id_user."'";
					$result = $this->sql->request($r);
				}
				echo '<script type="text/javascript">document.location.href="index.php"</script>';
				return true;
			} else
				return false;
		}
	}
	
	private function get_content_acceuil(){
		$error = true;
		if ($this->action_form == 'import_perso')
			$error = $this->import_perso();
		if ($error === false){
			echo '<script type="text/javascript">document.location.href="index.php";</script>';
		}
		if (empty($this->user_slots)){
			$this->tpl_vars = array();
			$this->tpl_vars['error_message'] = $this->warning_text('Votre personnage n\'a pas ?t? import? sur votre profil');
			$this->tpl_vars['error_import'] = (($error === 'ok') ? $this->error_text('Votre personnage n\'existe pas') : '');
			$this->loot->content_general = $this->load_template('import_perso');
		} else {
			$this->loot->content_general = $this->main_profil();
		}
	}
	
	private function get_content_echange(){
		$return = '';
		if ($this->action && $this->action == 'valid_echange'){
			$r = "UPDATE larmes_raid_historique SET user_id = '".$_POST['new_perso']."' WHERE id = '".$_POST['hist_id']."'";
			if ($result = $this->sql->request($r))
				$return .= $this->valide_text('Modifications enregistr?es');
		}
		$r = "SELECT rh.*, i.user_perso FROM larmes_raid_historique rh, larmes_identifiants i WHERE rh.user_id = i.user_id ORDER BY rh.id DESC";
		$result = $this->sql->get_array($r);
		$raid = false;
		$final = array();
		foreach ($result as $loot){
			if ($raid === false){
				$raid = $loot['raid'];
				$final[] = $loot;
			} else if ($raid == $loot['raid'])
				$final[] = $loot;
		}
		$r = "SELECT user_id, user_perso FROM larmes_identifiants WHERE user_statut > 0 ORDER BY user_perso";
		$persos = $this->sql->get_array($r);
		$return .= '	<table border="1" cellpadding="5" cellspacing="0">
						<tr>
							<td align="center"><strong>Joueur actuel</strong></td>
							<td align="center"><strong>Objet</strong></td>
							<td align="center" colspan="2"><strong>Nouveau joueur</strong></td>
						</tr>';
		foreach ($final as $attrib){
			$this->loot->loot_id = $attrib['item_id'];
			$loot = $this->loot->get_loot_by_id();
			$return .= '<tr>
							<form method="post" action="index.php?page=echange&action=valid_echange">
							<td align="center"><strong>'.$attrib['user_perso'].'</strong></td>
							<td><strong>'.$loot['item_name'].'</strong></td>
							<td><select name="new_perso">';
			foreach ($persos as $perso){
				$return .= '<option value="'.$perso['user_id'].'">'.$perso['user_perso'].'</option>';
			}
			$return .= '		</select></td>
							<td>
								<input type="hidden" name="hist_id" value="'.$attrib['id'].'" />
								<input type="submit" class="submit" value="Modifier" />
							</td>
							</form>
						</tr>';
		}
		$return .= '</table>';
		$this->loot->content_general = $return;
	}
	
	private function get_slots(){
		$r = "SELECT * FROM larmes_user_slots WHERE user_id = '".$this->id_user."'";
		$result = $this->sql->get_array($r);
		if (isset($result[0])){
			$order = array(
				0=>'head', 1=>'neck', 2=>'shoulder', 3=>'back', 4=>'chest', 5=>'wrist',
				6=>'hands', 7=>'waist', 8=>'legs', 9=>'feet', 10=>'finger1', 11=>'finger2',
				12=>'trinket1', 13=>'trinket2', 14=>'mainHand', 15=>'offHand');
			$result_temp = array();
			for ($i = 0; $i < 16; $i++)
				foreach ($result as $slot)
					if ($slot['slot_id'] == $order[$i])
						$result_temp[] = $slot;
				
			$this->user_slots = $result_temp;
		}
	}
	
	private function get_nb_abs(){
		$r = "SELECT * FROM larmes_calendar";
		$events = $this->sql->get_array($r);
		$return = 0;
		$date_str = date('Y-m-d');
		foreach ($events as $event){
			$begin_arr = explode('-', $event['evenement_date']);
			$end_arr = explode('-', $event['eventement_fin']);
			$now_arr = explode('-', $date_str);
			$begin_time = mktime(0, 0, 0, $begin_arr[1], $begin_arr[2], $begin_arr[0]);
			$end_time = mktime(0, 0, 0, $end_arr[1], $end_arr[2], $end_arr[0]);
			$now_time = mktime(0, 0, 0, $now_arr[1], $now_arr[2], $now_arr[0]);
			if ($now_time >= $begin_time && $now_time <= $end_time){
				$return ++;
			}
		}
		return $return;
	}
	
	private function get_nb_crafts(){
		$return = 0;
		$r = "SELECT il.*, us.user_id, i.user_perso 
		FROM larmes_items_list il, larmes_user_slots us, larmes_identifiants i  
		WHERE il.item_id = us.wich_id 
		AND us.wich_id != us.item_id
		AND us.user_id = i.user_id
		AND il.source_type = 'CREATED_BY_SPELL'";
		$crafts = $this->sql->get_array($r);
		if (!empty($crafts)){
			$return = count($crafts);
		}
		return $return;
	}
	
	private function get_nb_objets(){
		$r = "SELECT COUNT(*) FROM larmes_objets_manquants";
		$objets = $this->sql->get_array($r);
		return $objets[0]['COUNT(*)'];
	}
	
	private function make_menu_left(){
		$nb_abs = $this->get_nb_abs();
		$nb_crafts = $this->get_nb_crafts();
		$nb_objets = $this->get_nb_objets();
		$return = '<li '.(empty($this->page) ? 'class="active"' : '').'><a href="index.php">Accueil</a></li>
				<li '.($this->page == 'params' ? 'class="active"' : '').'><a href="index.php?page=params">Parametres</a></li>';
		if ($this->session['statut'] > 0){
			$return .= '
				<li class="dropdown'.(($this->page == 'wish' || $this->page == 'wish_prov' || $this->page == 'wish_spe2') ? ' active' : '').'""><a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">Wish List <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="index.php?page=wish">S?lection BIS</a></li>
						<li><a href="index.php?page=wish_prov">S?lection provisoire</a></li>
						<li><a href="index.php?page=wish_spe2">S?lection Sp? 2</a></li>
					</ul>
				</li>
				<li '.($this->page == 'compare' ? 'class="active"' : '').'><a href="index.php?page=compare">Comparateur</a></li>
				<li '.($this->page == 'hist' ? 'class="active"' : '').'><a href="index.php?page=hist">Historique</a></li>';
		}
		if ($this->session['statut'] > 1){
			$return .= '
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">Administration <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li '.($this->page == 'downs' ? 'class="active"' : '').'><a href="index.php?page=downs">Downs de boss</a></li>
						<!--<li '.($this->page == 'assign' ? 'class="active"' : '').'><a href="index.php?page=assign">Assignation</a></li>-->
						<li '.($this->page == 'attrib' ? 'class="active"' : '').'><a href="index.php?page=attrib">Attributions</a></li>
						<li '.($this->page == 'echange' ? 'class="active"' : '').'><a href="index.php?page=echange">Correct. Attrib</a></li>';
			if ($this->session['statut'] > 2){
				$return .= '
						<li '.($this->page == 'accounts' ? 'class="active"' : '').'><a href="index.php?page=accounts">Comptes</a></li>
						<li '.($this->page == 'stats' ? 'class="active"' : '').'><a href="index.php?page=stats">Stats</a></li>
						<li '.($this->page == 'stats_lfr' ? 'class="active"' : '').'><a href="index.php?page=stats_lfr">Stats LFR</a></li>
						<li '.($this->page == 'majs' ? 'class="active"' : '').'><a href="index.php?page=majs">Notes MaJ</a></li>
						<li '.($this->page == 'import' ? 'class="active"' : '').'><a href="index.php?page=import">Importation</a></li>
						<li '.($this->page == 'manquants' ? 'class="active"' : '').'><a href="index.php?page=manquants"'.(($nb_objets>0) ? 'style="color:red;"' : '').'>Ajout objs. ('.$nb_objets.')</a></li>
						<li '.($this->page == 'emails' ? 'class="active"' : '').'><a href="index.php?page=emails">Envoie mails</a></li>
						<li '.($this->page == 'calendar' ? 'class="active"' : '').'><a href="index.php?page=calendar" '.(($nb_abs>0) ? 'style="color:red;"' : '').'>Calendrier ('.$nb_abs.')</a></li>
						<li '.($this->page == 'crafts' ? 'class="active"' : '').'><a href="index.php?page=crafts" '.(($nb_crafts>0) ? 'style="color:red;"' : '').'>Crafts ('.$nb_crafts.')</a></li>';
			}
			$return .= '
					</ul>
				</li>';
		}
		$return .= '
				<li><a href="index.php?page=deco">Deconnexion</a></li>';
		return $return;
	}

	private function load_template($tpl_name, $other_perso = false){
		$fichier='templates/'.$tpl_name.'.html';
		$tpl_content = fread(fopen($fichier, "r"), filesize($fichier));
		if (!in_array($tpl_name, array('login')))
			$this->tpl_vars['left_col'] = $this->make_left_col($other_perso);
		
		foreach ($this->tpl_vars as $key=>$cont){
			$tpl_content = str_replace('<'.$key.'>', $cont, $tpl_content);
		}
		return $tpl_content;
	}

	private function make_left_col($other_perso){
		$this->armory->UTF8(true);
		$this->armory->setLocale('fr_FR');
		if ($other_perso !== false) {
			$character = $this->armory->getCharacter($other_perso['user_perso']);
			$ilvlwish = $other_perso['user_ilvl_wish'];
			$no_search = $other_perso['user_perso'];
		} else {
			$character = $this->armory->getCharacter($this->session['personnage']);
			$ilvlwish = $this->session['wish_ilvl'];
			$no_search =$this->session['personnage'];
		}
		$class = utf8_decode($character->getClassName());
		$spe = $character->getActiveTalents();
		$datas = $character->getData();
		$professions = $character->getProfessions();
		$i = 0;
		$j = 0;
		foreach($this->user_slots as $slot){
			$j++;
			if ($slot['item_id'] == $slot['wich_id'] && $slot['wich_id'] != 0)
				$i++;
		}
		
		if ($ilvlwish == 0)	$this->tpl_vars['ilvlwish'] = 'Non d?fini';
		else 				$this->tpl_vars['ilvlwish'] = $ilvlwish;
		$purcent = ($i * 100) / $j;
		$this->tpl_vars['purcent'] = $purcent;
		$this->tpl_vars['persos_list'] = '';
		$r = "SELECT user_perso FROM larmes_identifiants WHERE user_perso != '' AND user_perso != '".$no_search."' AND user_statut > 0 ORDER BY user_perso";
		$persos = $this->sql->get_array($r);
		foreach ($persos as $perso_pseudo){
			$this->tpl_vars['persos_list'] .= '<option value="'.$perso_pseudo['user_perso'].'">'.$perso_pseudo['user_perso'].'</option>';
		}
		$this->tpl_vars['perso_name'] = $no_search;
		$this->tpl_vars['spec_icon'] = $spe['spec']['icon'];
		$this->tpl_vars['class_and_spec'] = $class.' '.utf8_decode($spe['spec']['name']);
		$this->tpl_vars['img_perso'] = $character->getProfileInsetURL();
		$this->tpl_vars['ilvl'] = $ilvl = $datas['items']['averageItemLevelEquipped'];
		$this->tpl_vars['loots_by_raid'] = $this->loots_by_raid();
		$this->tpl_vars['professions'] = '';
		foreach ($professions['primary'] as $profession){
			if ($profession['rank'] >= $profession['max'])
					$this->tpl_vars['professions'] .= '<tr><td><span style="color:#FFD200;">';
			else
				$this->tpl_vars['professions'] .= '<tr><td><span style="color:#FFD200;">';
			$this->tpl_vars['professions'] .= utf8_decode($profession['name']).'</td><td style="font-weight:bold;">'.$profession['rank'].'/'.$profession['max'].'</td></tr>';
		}
		$this->tpl_vars['last_loots'] = $this->last_loots();
		$fichier='templates/left_col.html';
		$tpl_content = fread(fopen($fichier, "r"), filesize($fichier));
		foreach ($this->tpl_vars as $key=>$cont){
			$tpl_content = str_replace('<'.$key.'>', $cont, $tpl_content);
		}
		return $tpl_content;
	}
	
	private function import_perso(){
		$name = $this->post['perso_name'];
		$this->armory->UTF8(true);
		$guild = $this->armory->getGuild($this->guilde_name);
		$this->armory->setLocale('fr_FR');
		$temp_array = $guild->getData();
		$members = $temp_array['members'];
		foreach ($members as $member){
			if (utf8_decode($member['character']['name']) == $name){
				$this->character = $this->armory->getCharacter(utf8_decode($member['character']['name']));
				$gear = $this->character->getGear();
				$datas = $this->character->getData();
				foreach ($gear as $slot=>$item){
					$gems_enchant = '';
					if (isset($gear['tooltipParams']['gem0']))
						$gems_enchant .= $gear['tooltipParams']['gem0'].'_';
					if (isset($gear['tooltipParams']['gem1']))
						$gems_enchant .= $gear['tooltipParams']['gem1'].'_';
					if (isset($gear['tooltipParams']['gem2']))
						$gems_enchant .= $gear['tooltipParams']['gem2'].'_';
						if (isset($gear['tooltipParams']['gem3']))
						$gems_enchant .= $gear['tooltipParams']['gem3'].'_';
					$gems_enchant = substr($gems_enchant, 0, strlen($gems_enchant)-1).'[||]';
					if (isset($gear['tooltipParams']['enchant']))
						$gems_enchant .= $gear['tooltipParams']['enchant'];
					if (is_array($item) && $slot != 'shirt' && $slot != 'tabard'){
						$r = "INSERT INTO larmes_user_slots VALUES('', '".$this->id_user."', '".$slot."', '".$item['id']."', '', '', '', '".$gems_enchant."')";
						$result = $this->sql->request($r);
					}
				}
				$r = "SELECT * FROM larmes_user_slots WHERE slot_id = 'offHand' AND user_id = '".$this->id_user."'";
				$result = $this->sql->get_array($r);
				if (!isset($result[0])){
					$r = "INSERT INTO larmes_user_slots VALUES('', '".$this->id_user."', 'offHand', '0', '', '', '', '')";
					$ok = $this->sql->request($r);
				}
				$_SESSION['personnage'] = utf8_decode($member['character']['name']);
				$r = "UPDATE larmes_identifiants SET user_perso = '".$name."', perso_class = '".$datas['class']."' WHERE user_id = '".$this->id_user."'";
				$result = $this->sql->request($r);
				return false;
			}
		}
		$this->add_historique('Importation du personnage '.$name);
		return 'ok';
	}
	
	private function loots_by_raid(){
		$r = "SELECT COUNT(*) FROM larmes_raid_historique WHERE user_id = '".$this->id_user."'";
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
	
	private function last_loots(){
		$r = "SELECT il.item_name, il.item_lvl FROM larmes_items_list il, larmes_raid_historique rh WHERE rh.user_id = '".$this->id_user."' AND il.item_id = rh.item_id ORDER BY rh.id DESC LIMIT 0, 3";
		$result = $this->sql->get_array($r);
		if (!empty($result)){
			$return = '';
			foreach ($result as $loot){
				$return .= '<tr><td>'.str_replace('?', '\'', $loot['item_name']).' ('.$loot['item_lvl'].')</td></tr>';
			}
			return $return;
		} else
			return '';
	}
	
	private function main_profil(){
		if (!empty($this->action_form) && $this->action_form == 'search_player'){
			return $this->search_player_view();
		} else {
			return $this->main_profil_view();
		}
	}

	private function main_profil_view(){
		$this->tpl_vars = array();
		$i = 0;
		$this->tpl_vars['items_list'] = '<div class="col-md-6"><table class="table-condensed" width="100%">';
		foreach ($this->user_slots as $gear){
			$gems_ench = explode('[||]', $gear['gems_ench']);
			$gemmes = explode('_', $gems_ench[0]);
			$enchant = $gems_ench[1];
			$this->loot->loot_id = $gear['item_id'];
			$loot = $this->loot->get_loot_by_id();
			$loot['item_name'] = str_replace('?', '\'', $loot['item_name']);
			$this->tpl_vars['items_list'] .= '<tr><td align="left">';
			$ok = false;
			if (!empty($loot['item_name']))
				$ok = true;
			else {
				$this->armory->UTF8(true);
				$this->armory->setLocale('fr_FR');
				$item = $this->armory->getItem($gear['item_id']);
				$itemdatas = $item->getData();
				$gems = (isset($itemdatas['socketInfo'])) ? serialize($itemdatas['socketInfo']['sockets']) : '';
				$gem_bonus = (isset($itemdatas['socketInfo'])) ? $itemdatas['socketInfo']['socketBonus'] : '';
				$r = "	INSERT INTO larmes_items_list 
						VALUES ('',
								'".$itemdatas['id']."',
								'".$itemdatas['itemLevel']."',
								'".$itemdatas['itemClass']."',
								'".$itemdatas['itemSubClass']."',
								'".$itemdatas['inventoryType']."',
								'".$itemdatas['maxDurability']."',
								'".$itemdatas['quality']."',
								'".$itemdatas['requiredLevel']."',
								'".$gems."',
								'".addslashes($gem_bonus)."',
								'".$itemdatas['itemSource']['sourceId']."',
								'".$itemdatas['itemSource']['sourceType']."',
								'".$itemdatas['baseArmor']."',
								'".$item->getIcon()."',
								'".utf8_decode($itemdatas['name'])."')";
				$result = $this->sql->request($r);
				if ($result){
					$ok = true;
					$loot['item_name'] = utf8_decode($itemdatas['name']);
					$loot['item_img'] = $item->getIcon();
					$loot['item_quality'] = $itemdatas['quality'];
					$loot['item_lvl'] = $itemdatas['itemLevel'];
					$loot['item_lvl'] = $itemdatas['itemLevel'];
					foreach ($itemdatas['bonusStats'] as $stat){
						$r = "INSERT INTO larmes_items_stats VALUES ('', '".$itemdatas['id']."', '".$stat['stat']."', '".$stat['amount']."')";
						$result = $this->sql->request($r);
					}
					if (isset($itemdatas['itemSpells']) && !empty($itemdatas['itemSpells'])){
						foreach ($itemdatas['itemSpells'] as $spell){
							$r = "INSERT INTO larmes_items_spells VALUES ('', '".$itemdatas['id']."', '".utf8_decode($spell['spell']['name'])."', '".utf8_decode($spell['spell']['description'])."', '".$spell['trigger']."')";
							$result = $this->sql->request($r);
						}
					}
				}
			}							
			if ($gear['wich_id'] == 0)
				$this->tpl_vars['items_list'] .= '<div class="panel panel-warning" style="margin-bottom:10px;"><div class="panel-heading">';
			else if ($gear['item_id'] == $gear['wich_id'])
				$this->tpl_vars['items_list'] .= '<div class="panel panel-success" style="margin-bottom:10px;"><div class="panel-heading">';
			else
				$this->tpl_vars['items_list'] .= '<div class="panel panel-danger" style="margin-bottom:10px;"><div class="panel-heading">';
			if ($ok === true){
				$this->tpl_vars['items_list'] .= $this->build_item($loot, $gear, $gemmes, $enchant);
				$i++;
			} else {
				$this->tpl_vars['items_list'] .= '	<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td width="56" colspan="2">
																<span class="glyphicon glyphicon-remove-circle" style="font-size:40px;"> </span>
															</td>
														</tr>
													</table>';
				$i++;
			}
			$this->tpl_vars['items_list'] .= '</div></div></td></tr>';
			if ($i == 8 || $i == 16){
				$this->tpl_vars['items_list'] .= '
						</table></div><div class="col-md-6">
						<table class="table-condensed" width="100%">';
			}
		}
		$this->tpl_vars['items_list'] .= '</table>';

		return $this->load_template('main_profil_view');
	}

	private function build_item($loot, $gear, $gemmes, $enchant){
		return '<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
							<img src="'.$loot['item_img'].'" />
						</td>
						<td align="left">
							<span class="color-'.$loot['item_quality'].'">'.$loot['item_name'].'</span><br />
							<span style="color:#000;">'.
								$loot['item_lvl'].'<br />
							</span>
						</td>
					</tr>
				</table>
				<a href="#" rel="item='.$gear['item_id'].'&amp;domain=fr&amp;gems='.implode(':', $gemmes).'&amp;ench='.$enchant.'" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>';
				
	}
	
	/*private function get_content_wish_prov(){
		$r = "SELECT item_id, slot_id, wich_prov_id, wich_id FROM larmes_user_slots WHERE user_id = '".$this->id_user."'";
		$result = $this->sql->get_array($r);
		$is_complete = true;
		foreach ($result as $slot){
			if ($slot['wich_id'] == '0' && $slot['item_id'] != '0' && $slot['slot_id'] != 'offHand')
				$is_complete = false;
		}
		if ($is_complete === false)
			$return = $this->warning_text('Merci de compl?ter votre wish list principale dans un premier temps !');
		else {
			if ($this->action == 'change'){
				$temp_slot = false;
				foreach ($this->user_slots as $slot){
					if ($this->id_to_change == $slot['id']){
						$this->loot->loot_id = $slot['item_id'];
						$temp_slot = $slot;
						$loot = $this->loot->get_loot_by_id();
						$loot['item_name'] = str_replace('?', '\'', $loot['item_name']);
					}
				}
				$this->armory->UTF8(true);
				$this->armory->setLocale('fr_FR');
				$item = $this->armory->getItem($this->loot->loot_id);
				$itemdatas = $item->getData();
				$class = $itemdatas['itemClass'];
				$subclass = $itemdatas['itemSubClass'];
				$type = $itemdatas['inventoryType'];	
				$return = '
					<div id="stuff">
						<table border="0" align="left" cellpadding="0" cellspacing="1" bgcolor="#D1B285" width="30%">
							<tr class="head_list">
								<td colspan="2"> Equipement actuel </td>
							</tr>
							<tr>
								<td align="left" class="general" style="border:solid 1px #3A2718; width:250px;" colspan="2">
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
												<img src="'.$loot['item_img'].'" /></a>';
				if ($loot['item_id'])
					$return .= '				<span class="frame frame_'.$loot['item_quality'].'"> </span>';
				$return .= '				</td>
											<td align="left">
												<span class="color-'.$loot['item_quality'].'">'.$loot['item_name'].'</span><br />
												<span style="color:#999999;">'.
													$loot['item_lvl'].'<br />
												</span>
											</td>
										</tr>
									</table>';
				if ($loot['item_id'])
					$return .= '	<a href="#" rel="item='.$loot['item_id'].'&amp;domain=fr" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>';
				$return .= '	</td>
							</tr>
							<tr>
								<td valign="top">';
				if (isset($itemdatas['id'])){
					$return .='		<table border="0" align="left" cellpadding="0" cellspacing="1" class="stat_list">';
					foreach ($itemdatas['bonusStats'] as $stat){
						$return .= 	'		<tr>
												<td align="left" width="140">
													'.$this->loot->stats[$stat['stat']].' : 
												</td>
												<td align="center" width="90">
													'.$stat['amount'].'
												</td>
											</tr>';
					}
					if ($itemdatas['armor'] != 0){
						$return .= '		<tr>
												<td align="left">Armure : </td>
												<td align="center">'.$itemdatas['armor'].'</td>
											</tr>';
					}
					$return .= '	</table>';
				}
				$return .= '	</td>
								<td valign="top">
									<form action="index.php?page=wish_prov&action=change_valide&id='.$this->id_to_change.'" method="post">
										<input type="hidden" value="'.$loot['item_id'].'" name="item_id">
										<center>
											<input type="submit" style="margin-top:1px;" value="Conserver">
										</center>
									</form>
								</td>
							</tr>';
				foreach ($this->user_slots as $slot){
					if ($this->id_to_change == $slot['id']){
						$this->loot->loot_id = $slot['wich_id'];
						$loot = $this->loot->get_loot_by_id();
						$loot['item_name'] = str_replace('?', '\'', $loot['item_name']);
					}
				}
				$this->armory->UTF8(true);
				$this->armory->setLocale('fr_FR');
				$item = $this->armory->getItem($this->loot->loot_id);
				$itemdatas = $item->getData();			
							
				$return .= '<tr class="head_list">
								<td colspan="2"> BIS s?lectionn? </td>
							</tr>
							<tr>
								<td align="left" class="general" style="border:solid 1px #3A2718; width:250px;" colspan="2">
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
												<img src="'.$loot['item_img'].'" /></a>';
				if ($loot['item_id'])
					$return .= '				<span class="frame frame_'.$loot['item_quality'].'"> </span>';
				$return .= '				</td>
											<td align="left">
												<span class="color-'.$loot['item_quality'].'">'.$loot['item_name'].'</span><br />
												<span style="color:#999999;">'.
													$loot['item_lvl'].'<br />
												</span>
											</td>
										</tr>
									</table>';
				if ($loot['item_id'])
					$return .= '	<a href="#" rel="item='.$loot['item_id'].'&amp;domain=fr" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>';
				$return .= '	</td>
							</tr>
							<tr>
								<td valign="top">';
				if (isset($itemdatas['id'])){
					$return .='		<table border="0" align="left" cellpadding="0" cellspacing="1" class="stat_list">';
					foreach ($itemdatas['bonusStats'] as $stat){
						$return .= 	'		<tr>
												<td align="left" width="140">
													'.$this->loot->stats[$stat['stat']].' : 
												</td>
												<td align="center" width="90">
													'.$stat['amount'].'
												</td>
											</tr>';
					}
					if ($itemdatas['armor'] != 0){
						$return .= '		<tr>
												<td align="left">Armure : </td>
												<td align="center">'.$itemdatas['armor'].'</td>
											</tr>';
					}
					$return .= '	</table>';
				}
				$return .= '	</td>
								<td valign="top">
								</td>
							</tr>
							<tr>
								<td id="wish_new" colspan="2">
								</td>
							</tr>
						</table>';
						$this->loot->classe = $class;
						$this->loot->subclasse = $subclass;
						$this->loot->type = $type;
						if ($this->get['classe'] !== NULL){
							$this->loot->classe = $this->get['classe'];
							$this->classe = $this->loot->classe;
						}
						if ($this->get['subclass'] !== NULL){
							$this->loot->subclasse = $this->get['subclass'];
							$this->subclasse = $this->loot->subclasse;
							if ($this->subclasse == 'arme' || ($this->get['info'] && $this->get['info'] == 'arme')){
								$this->loot->classe = '2';
								if ($this->get['info'] && $this->get['info'] == 'arme')
									$this->loot->subclasse = $this->get['subclass'];
								else 
									$this->loot->subclasse = '0';
							}
						}
						if ($this->get['type'] !== NULL){
							$this->loot->type = $this->get['type'];
							$this->type = $this->loot->type;
						}
						$this->loot->get_loots_by_down();
						$this->loot->get_loots_by_classe();
						$this->loot->get_loots_by_subclasse();
						if (($this->get['subclass'] === NULL || $this->get['subclass'] === '0') && $this->loot->classe != '2')
							$this->loot->get_loots_by_type();
						if (!empty($this->dificulty) && $this->dificulty != 'all'){
								$this->loot->dificulty = $this->dificulty;
								$this->loot->get_loots_by_dificulty();
						}
						if ($this->stats_get && !empty($this->stats_get)){
							$this->loot->get_loot_by_stats();
						}
						
						if ($this->gemmes_get && !empty($this->gemmes_get)){
							$this->loot->get_loot_by_gemmes();
						}
						
						if ($this->spells_get && !empty($this->spells_get)){
							$this->loot->get_loot_by_spells();
						}
						
				$return .= '
						<table border="0" align="left" cellpadding="0" cellspacing="1" class="stat_list">
							<tr class="head_list">
								<td> Equipements ?quivalents </td>
							</tr>
							<tr>
								<td>';
				if ($temp_slot['item_id'] == '0' && $temp_slot['slot_id'] == 'offHand')
					$return .= $this->get_offhands('_prov');
				else
					$return .= $this->make_filters('_prov');
				$return .= '	</td>
							</tr>
							<tr>
								<td style="background-color:#D1B285;">
								<script type="text/javascript">
									$(document).ready(function(){
										$("#search_loot").keyup(function(){
											var temp_val = $(this).val();
											$(".item_to_chose").each(function(){
												var temp_id = $(this).attr("id");
												if (temp_id){
													var temp_ind = temp_id.indexOf(temp_val);
													if (temp_ind == -1)
														$(this).css("display", "none");
													else
														$(this).css("display", "block");
												}
											});
										});
									});
								</script>&nbsp;<span style="color:#3A2718;">Rechercher une pi?ce :</span><br />
								<input type="text" id="search_loot" class="text">';			
				$this->loot->order_loots_by_down();
				$types = array ('dispo'=>'Objets disponibles',
								'reput'=>'Objets par r?putation',
								'craft'=>'Crafts',
								'raid_finder'=>'Versions Raid Finder',
								'futur'=>'Prochainement disponibles',
								'not_loot'=>'Non disponibles');
				foreach ($types as $key=>$type_str){
					if (in_array($key, array('dispo', 'reput'))){ 
						$return .= '<fieldset>
										<legend style="color:#3A2718;">'.$type_str.'</legend>';
						if (isset($this->loot->loots[$key])){
							foreach ($this->loot->loots[$key] as $loot){
								//echo $loot['item_id'].' => '.$loot['source_type'].'<br />';
								$more_class = '';
								if (isset($loot['loot_temp']) && $loot['loot_temp'] == '1')
									$more_class = ' temp_loot';
								else if (isset($loot['loot_temp']) && $loot['loot_temp'] == '2')
									$more_class = ' not_loot';
								else if (isset($loot['loot_temp']) && $loot['loot_temp'] == '3')
									$more_class = ' raid_finder';
								else if ($loot['source_type'] == 'CREATED_BY_SPELL')
									$more_class = ' craft';
								else if ($loot['source_type'] == 'FACTION_REWARD')
									$more_class = ' reputation';
								$loot['item_name'] = str_replace('?', '\'', $loot['item_name']);
								$temp_name_id = str_replace ('\'', '_', $loot['item_name']);
								$temp_name_id = str_replace (' ', '_', $temp_name_id);
								$return .= '<div class="item_to_chose'.$more_class.'" id="'.strtolower($temp_name_id).'" ';
								if ($loot['item_id'] != $this->loot->loot_id)
									$return .= 'onclick="get_wich_view_prov(\''.$loot['item_id'].'\', \''.$this->loot->loot_id.'\', \''.$this->id_to_change.'\');"';
								$return .= '>
												<table border="0" cellpadding="0" cellspacing="0" width="100%">
													<tr>
														<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
															<img src="'.$loot['item_img'].'" />
															<span class="frame frame_'.$loot['item_quality'].'"> </span>
														</td>
														<td valign="top">';
								if ($more_class == ' raid_finder'){
									$return .= '			<span style="color:#000;">'.
																$loot['item_lvl'].'<br />
															</span>';
								} else {
									$return .= '			<span style="color:#999999;">'.
																$loot['item_lvl'].'<br />
															</span>';
								}
								$return .= '			</td>
													</tr>
													<tr>
														<td align="center" colspan="2">
															<span class="color-'.$loot['item_quality'].'">'.
																$loot['item_name'];
								if ($more_class == ' temp_loot')
									$return .= '				<span style="color:#000; font-size:9px;"><br />Boss prochainement dispo</span>';
								if ($more_class == ' not_loot')
									$return .= '				<span style="color:#000; font-size:9px;"><br />Objet non dispo</span>';
								if ($more_class == ' raid_finder')
									$return .= '				<span style="color:#000; font-size:9px;"><br />Raid Finder</span>';
								if ($loot['source_type'] == 'CREATED_BY_SPELL')
									$return .= '				<span style="color:#000; font-size:9px;"><br />craft</span>';
								if ($loot['source_type'] == 'FACTION_REWARD')
									$return .= '				<span style="color:#000; font-size:9px;"><br />R?putation / Vaillance</span>';
								$return .= '				</span><br />
														</td>
													</tr>
												</table>
												<a href="#" rel="item='.$loot['item_id'].'&amp;domain=fr" style="display:block; position:absolute; width:150px; height:100px; margin-top:-85px;">&nbsp;</a>
											</div>';
								$i++;
								if ($i%4 == 0){
									$return .= '<div style="clear:both; width:1px; height:1px;">&nbsp;</div>';
								}
							}
						} else {
							$return .= '<span style="color:#3A2718;">Aucun objet pour cette cat?gorie.</span>';
						}
						$return .= '</fieldset>';
					}
				}
				$return .= '	</td>
							</tr>
						</table>
					</div>';
				$this->loot->content_general = $return;
			} else {
				if (!empty($this->action) && $this->action == 'change_valide'){					
					$infos_r = "SELECT * FROM larmes_user_slots WHERE id = '".(int)$this->get['id']."'";
					$infos = $this->sql->get_array($infos_r);
					$r = "UPDATE larmes_user_slots SET wich_prov_id = '".(int)$this->post['item_id']."' WHERE id = '".(int)$this->get['id']."'";
					$ok = $this->sql->request($r);
					$r = "SELECT item_class, item_subclass FROM larmes_items_list WHERE item_id = '".(int)$this->post['item_id']."'";
					$result = $this->sql->get_array($r);
					$classe = $result[0]['item_class'];
					$subclasse = $result[0]['item_subclass'];				
					if ($classe == '2' && in_array($subclasse, $this->loot->two_hands)){						
						$r = "UPDATE larmes_user_slots SET wich_prov_id = '0' WHERE slot_id = 'offHand' AND user_id = '".$this->id_user."'";
						$ok = $this->sql->request($r);
					}
					$this->add_historique('Modification de la wish list provisoire. Slot concern? : '.$infos[0]['slot_id']);
					echo '<script type="text/javascript">document.location.href="index.php?page=wish_prov";</script>';
				}
				$this->list_wich_list_prov();
			}
		}
	}
	
	private function get_content_wish_spe2(){
		$r = "SELECT item_id, slot_id, wich_prov_id FROM larmes_user_slots WHERE user_id = '".$this->id_user."'";
		$result = $this->sql->get_array($r);
		$is_complete = true;
		foreach ($result as $slot){
			if ($slot['wich_id'] == '0' && $slot['item_id'] != '0' && $slot['slot_id'] != 'offHand')
				$is_complete = false;
		}
		if ($is_complete === false)
			$return = $this->warning_text('Merci de compl?ter votre wish list principale dans un premier temps !');
		else {
			if ($this->action == 'change'){
				$temp_slot = false;
				foreach ($this->user_slots as $slot){
					if ($this->id_to_change == $slot['id']){
						$this->loot->loot_id = $slot['item_id'];
						$temp_slot = $slot;
						$loot = $this->loot->get_loot_by_id();
						$loot['item_name'] = str_replace('?', '\'', $loot['item_name']);
					}
				}
				$this->armory->UTF8(true);
				$this->armory->setLocale('fr_FR');
				$item = $this->armory->getItem($this->loot->loot_id);
				$itemdatas = $item->getData();
				$class = $itemdatas['itemClass'];
				$subclass = $itemdatas['itemSubClass'];
				$type = $itemdatas['inventoryType'];	
				$return = '
					<div id="stuff">
						<table border="0" align="left" cellpadding="0" cellspacing="1" bgcolor="#D1B285" width="30%">
							<tr class="head_list">
								<td colspan="2"> Equipement actuel </td>
							</tr>
							<tr>
								<td align="left" class="general" style="border:solid 1px #3A2718; width:250px;" colspan="2">
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
												<img src="'.$loot['item_img'].'" /></a>';
				if ($loot['item_id'])
					$return .= '				<span class="frame frame_'.$loot['item_quality'].'"> </span>';
				$return .= '				</td>
											<td align="left">
												<span class="color-'.$loot['item_quality'].'">'.$loot['item_name'].'</span><br />
												<span style="color:#999999;">'.
													$loot['item_lvl'].'<br />
												</span>
											</td>
										</tr>
									</table>';
				if ($loot['item_id'])
					$return .= '	<a href="#" rel="item='.$loot['item_id'].'&amp;domain=fr" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>';
				$return .= '	</td>
							</tr>
							<tr>
								<td valign="top">';
				if (isset($itemdatas['id'])){
					$return .='		<table border="0" align="left" cellpadding="0" cellspacing="1" class="stat_list">';
					foreach ($itemdatas['bonusStats'] as $stat){
						$return .= 	'		<tr>
												<td align="left" width="140">
													'.$this->loot->stats[$stat['stat']].' : 
												</td>
												<td align="center" width="90">
													'.$stat['amount'].'
												</td>
											</tr>';
					}
					if ($itemdatas['armor'] != 0){
						$return .= '		<tr>
												<td align="left">Armure : </td>
												<td align="center">'.$itemdatas['armor'].'</td>
											</tr>';
					}
					$return .= '	</table>';
				}
				$return .= '	</td>
								<td valign="top">
									<form action="index.php?page=wish_spe2&action=change_valide&id='.$this->id_to_change.'" method="post">
										<input type="hidden" value="'.$loot['item_id'].'" name="item_id">
										<center>
											<input type="submit" style="margin-top:1px;" value="Conserver">
										</center>
									</form>
								</td>
							</tr>';
				foreach ($this->user_slots as $slot){
					if ($this->id_to_change == $slot['id']){
						$this->loot->loot_id = $slot['wich_id'];
						$loot = $this->loot->get_loot_by_id();
						$loot['item_name'] = str_replace('?', '\'', $loot['item_name']);
					}
				}
				$this->armory->UTF8(true);
				$this->armory->setLocale('fr_FR');
				$item = $this->armory->getItem($this->loot->loot_id);
				$itemdatas = $item->getData();			
							

				$return .= '<tr>
								<td id="wish_new" colspan="2">
								</td>
							</tr>
						</table>';
						$this->loot->classe = $class;
						$this->loot->subclasse = $subclass;
						$this->loot->type = $type;
						if ($this->get['classe'] !== NULL){
							$this->loot->classe = $this->get['classe'];
							$this->classe = $this->loot->classe;
						}
						if ($this->get['subclass'] !== NULL){
							$this->loot->subclasse = $this->get['subclass'];
							$this->subclasse = $this->loot->subclasse;
							if ($this->subclasse == 'arme' || ($this->get['info'] && $this->get['info'] == 'arme')){
								$this->loot->classe = '2';
								if ($this->get['info'] && $this->get['info'] == 'arme')
									$this->loot->subclasse = $this->get['subclass'];
								else 
									$this->loot->subclasse = '0';
							}
						}
						if ($this->get['type'] !== NULL){
							$this->loot->type = $this->get['type'];
							$this->type = $this->loot->type;
						}
						$this->loot->get_loots_by_down();
						$this->loot->get_loots_by_classe();
						$this->loot->get_loots_by_subclasse();
						if (($this->get['subclass'] === NULL || $this->get['subclass'] === '0') && $this->loot->classe != '2')
							$this->loot->get_loots_by_type();
						if (!empty($this->dificulty) && $this->dificulty != 'all'){
								$this->loot->dificulty = $this->dificulty;
								$this->loot->get_loots_by_dificulty();
						}
						if ($this->stats_get && !empty($this->stats_get)){
							$this->loot->get_loot_by_stats();
						}
						
						if ($this->gemmes_get && !empty($this->gemmes_get)){
							$this->loot->get_loot_by_gemmes();
						}
						
						if ($this->spells_get && !empty($this->spells_get)){
							$this->loot->get_loot_by_spells();
						}
						
				$return .= '
						<table border="0" align="left" cellpadding="0" cellspacing="1" class="stat_list">
							<tr class="head_list">
								<td> Equipements ?quivalents </td>
							</tr>
							<tr>
								<td>';
				if ($temp_slot['item_id'] == '0' && $temp_slot['slot_id'] == 'offHand')
					$return .= $this->get_offhands('_spe2');
				else
					$return .= $this->make_filters('_spe2');
				$return .= '	</td>
							</tr>
							<tr>
								<td style="background-color:#D1B285;">
								<script type="text/javascript">
									$(document).ready(function(){
										$("#search_loot").keyup(function(){
											var temp_val = $(this).val();
											$(".item_to_chose").each(function(){
												var temp_id = $(this).attr("id");
												if (temp_id){
													var temp_ind = temp_id.indexOf(temp_val);
													if (temp_ind == -1)
														$(this).css("display", "none");
													else
														$(this).css("display", "block");
												}
											});
										});
									});
								</script>&nbsp;<span style="color:#3A2718;">Rechercher une pi?ce :</span><br />
								<input type="text" id="search_loot" class="text">';			
				$this->loot->order_loots_by_down();
				$types = array ('dispo'=>'Objets disponibles',
								'reput'=>'Objets par r?putation',
								'craft'=>'Crafts',
								'raid_finder'=>'Versions Raid Finder',
								'futur'=>'Prochainement disponibles',
								'not_loot'=>'Non disponibles');
				foreach ($types as $key=>$type_str){
					if (in_array($key, array('dispo', 'reput'))){ 
						$return .= '<fieldset>
										<legend style="color:#3A2718;">'.$type_str.'</legend>';
						if (isset($this->loot->loots[$key])){
							foreach ($this->loot->loots[$key] as $loot){
								//echo $loot['item_id'].' => '.$loot['source_type'].'<br />';
								$more_class = '';
								if (isset($loot['loot_temp']) && $loot['loot_temp'] == '1')
									$more_class = ' temp_loot';
								else if (isset($loot['loot_temp']) && $loot['loot_temp'] == '2')
									$more_class = ' not_loot';
								else if (isset($loot['loot_temp']) && $loot['loot_temp'] == '3')
									$more_class = ' raid_finder';
								else if ($loot['source_type'] == 'CREATED_BY_SPELL')
									$more_class = ' craft';
								else if ($loot['source_type'] == 'FACTION_REWARD')
									$more_class = ' reputation';
								$loot['item_name'] = str_replace('?', '\'', $loot['item_name']);
								$temp_name_id = str_replace ('\'', '_', $loot['item_name']);
								$temp_name_id = str_replace (' ', '_', $temp_name_id);
								$return .= '<div class="item_to_chose'.$more_class.'" id="'.strtolower($temp_name_id).'" ';
								if ($loot['item_id'] != $this->loot->loot_id)
									$return .= 'onclick="get_wich_view_spe2(\''.$loot['item_id'].'\', \''.$this->loot->loot_id.'\', \''.$this->id_to_change.'\');"';
								$return .= '>
												<table border="0" cellpadding="0" cellspacing="0" width="100%">
													<tr>
														<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
															<img src="'.$loot['item_img'].'" />
															<span class="frame frame_'.$loot['item_quality'].'"> </span>
														</td>
														<td valign="top">';
								if ($more_class == ' raid_finder'){
									$return .= '			<span style="color:#000;">'.
																$loot['item_lvl'].'<br />
															</span>';
								} else {
									$return .= '			<span style="color:#999999;">'.
																$loot['item_lvl'].'<br />
															</span>';
								}
								$return .= '			</td>
													</tr>
													<tr>
														<td align="center" colspan="2">
															<span class="color-'.$loot['item_quality'].'">'.
																$loot['item_name'];
								if ($more_class == ' temp_loot')
									$return .= '				<span style="color:#000; font-size:9px;"><br />Boss prochainement dispo</span>';
								if ($more_class == ' not_loot')
									$return .= '				<span style="color:#000; font-size:9px;"><br />Objet non dispo</span>';
								if ($more_class == ' raid_finder')
									$return .= '				<span style="color:#000; font-size:9px;"><br />Raid Finder</span>';
								if ($loot['source_type'] == 'CREATED_BY_SPELL')
									$return .= '				<span style="color:#000; font-size:9px;"><br />craft</span>';
								if ($loot['source_type'] == 'FACTION_REWARD')
									$return .= '				<span style="color:#000; font-size:9px;"><br />R?putation / Vaillance</span>';
								$return .= '				</span><br />
														</td>
													</tr>
												</table>
												<a href="#" rel="item='.$loot['item_id'].'&amp;domain=fr" style="display:block; position:absolute; width:150px; height:100px; margin-top:-85px;">&nbsp;</a>
											</div>';
								$i++;
								if ($i%4 == 0){
									$return .= '<div style="clear:both; width:1px; height:1px;">&nbsp;</div>';
								}
							}
						} else {
							$return .= '<span style="color:#3A2718;">Aucun objet pour cette cat?gorie.</span>';
						}
						$return .= '</fieldset>';
					}
				}
				$return .= '	</td>
							</tr>
						</table>
					</div>';
				$this->loot->content_general = $return;
			} else {
				if (!empty($this->action) && $this->action == 'change_valide'){					
					$infos_r = "SELECT * FROM larmes_user_slots WHERE id = '".(int)$this->get['id']."'";
					$infos = $this->sql->get_array($infos_r);
					$r = "UPDATE larmes_user_slots SET wish_spe_2_id = '".(int)$this->post['item_id']."' WHERE id = '".(int)$this->get['id']."'";
					$ok = $this->sql->request($r);
					$r = "SELECT item_class, item_subclass FROM larmes_items_list WHERE item_id = '".(int)$this->post['item_id']."'";
					$result = $this->sql->get_array($r);
					$classe = $result[0]['item_class'];
					$subclasse = $result[0]['item_subclass'];				
					if ($classe == '2' && in_array($subclasse, $this->loot->two_hands)){						
						$r = "UPDATE larmes_user_slots SET wish_spe_2_id = '0' WHERE slot_id = 'offHand' AND user_id = '".$this->id_user."'";
						$ok = $this->sql->request($r);
					}
					$this->add_historique('Modification de la wish list 2?me sp?. Slot concern? : '.$infos[0]['slot_id']);
					echo '<script type="text/javascript">document.location.href="index.php?page=wish_spe2";</script>';
				}
				$this->list_wich_list_spe2();
			}
		}
	}*/
	
	private function get_content_wish($type){
		$is_complete = true;
		switch ($type){
			case 'wish':
				$champ = 'wich_id';
				$page = '';
			break;
			case 'prov':
				$champ = 'wich_prov_id';
				$page = '_prov';
				$r = "SELECT item_id, slot_id, wich_prov_id, user_id, wich_id FROM larmes_user_slots WHERE user_id = '".$this->id_user."'";
				$result = $this->sql->get_array($r);
				foreach ($result as $slot)
					if ($slot['wich_id'] == '0' && $slot['item_id'] != '0' && $slot['slot_id'] != 'offHand')
						$is_complete = false;
				if ($is_complete === false)
					$this->loot->content_general = $this->warning_text('Merci de compl?ter votre wish list principale dans un premier temps !');
			break;
			case 'spe2':
				$champ = 'wish_spe_2_id';
				$page = ' _spe2';
				$r = "SELECT item_id, slot_id, wish_spe_2_id, user_id, wich_id FROM larmes_user_slots WHERE user_id = '".$this->id_user."'";
				$result = $this->sql->get_array($r);
				foreach ($result as $slot)
					if ($slot['wich_id'] == '0' && $slot['item_id'] != '0' && $slot['slot_id'] != 'offHand')
						$is_complete = false;
				if ($is_complete === false)
					$this->loot->content_general = $this->warning_text('Merci de compl?ter votre wish list principale dans un premier temps !');
			break;
		}


		if ($this->action == 'change'){
			$temp_slot = false;
			foreach ($this->user_slots as $slot){
				if ($this->id_to_change == $slot['id']){
					$this->loot->loot_id = $slot['item_id'];
					$temp_slot = $slot;
					$loot = $this->loot->get_loot_by_id();
					$loot['item_name'] = str_replace('?', '\'', $loot['item_name']);
				}
			}
			$this->armory->UTF8(true);
			$this->armory->setLocale('fr_FR');
			$item = $this->armory->getItem($this->loot->loot_id);
			$itemdatas = $item->getData();
			$class = $itemdatas['itemClass'];
			$subclass = $itemdatas['itemSubClass'];
			$type = $itemdatas['inventoryType'];	

			$this->tpl_vars = array(
				'item_id' => $loot['item_id'],
				'item_img' => $loot['item_img'],
				'item_name' => $loot['item_name'],
				'item_lvl' => $loot['item_lvl'],
				'id_to_change' => $this->id_to_change,
				'item_bulle' => (($loot['item_id']) ? '<a href="#" rel="item='.$loot['item_id'].'&amp;domain=fr" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>' : ''),
				'item_quality' => (($loot['item_id']) ? $loot['item_quality'] : 1));
			$itemstats = '';
			if (isset($itemdatas['id'])){
				$itemstats .= '<table class="table table-striped table-condensed">';
				foreach ($itemdatas['bonusStats'] as $stat){
					$itemstats .= 	'<tr>
										<td align="left" width="140">
											'.$this->loot->stats[$stat['stat']].' : 
										</td>
										<td align="center" width="90">
											'.$stat['amount'].'
										</td>
									</tr>';
				}
				if ($itemdatas['armor'] != 0){
					$itemstats .= '	<tr>
										<td align="left">Armure : </td>
										<td align="center">'.$itemdatas['armor'].'</td>
									</tr>';
				}
				$itemstats .= '	</table>';
			}
			$this->tpl_vars['item_stats'] = $itemstats;

			foreach ($this->user_slots as $slot){
				if ($this->id_to_change == $slot['id']){
					$this->loot->loot_id = $slot['wich_id'];
					$loot = $this->loot->get_loot_by_id();
					$loot['item_name'] = str_replace('?', '\'', $loot['item_name']);
					$this->tpl_vars['item_id_s'] = $loot['item_id'];
					$this->tpl_vars['item_img_s'] = $loot['item_img'];
					$this->tpl_vars['item_name_s'] = $loot['item_name'];
					$this->tpl_vars['item_lvl_s'] = $loot['item_lvl'];
					$this->tpl_vars['item_bulle_s'] = (($loot['item_id']) ? '<a href="#" rel="item='.$loot['item_id'].'&amp;domain=fr" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>' : '');
					$this->tpl_vars['item_quality_s'] = (($loot['item_id']) ? $loot['item_quality'] : 1);
					$this->armory->UTF8(true);
					$this->armory->setLocale('fr_FR');
					$item = $this->armory->getItem($this->loot->loot_id);
					$itemdatas = $item->getData();
					$itemstats = '';
					if (isset($itemdatas['id'])){
						$itemstats .= '<table class="table table-striped table-condensed">';
						foreach ($itemdatas['bonusStats'] as $stat){
							$itemstats .= 	'<tr>
												<td align="left" width="140">
													'.$this->loot->stats[$stat['stat']].' : 
												</td>
												<td align="center" width="90">
													'.$stat['amount'].'
												</td>
											</tr>';
						}
						if ($itemdatas['armor'] != 0){
							$itemstats .= '	<tr>
												<td align="left">Armure : </td>
												<td align="center">'.$itemdatas['armor'].'</td>
											</tr>';
						}
						$itemstats .= '	</table>';
					}
					$this->tpl_vars['item_stats_s'] = $itemstats;
				}
			}
			$this->loot->classe = $class;
			$this->loot->subclasse = $subclass;
			$this->loot->type = $type;
			if ($this->get['classe'] !== NULL){
				$this->loot->classe = $this->get['classe'];
				$this->classe = $this->loot->classe;
			}
			if ($this->get['subclass'] !== NULL){
				$this->loot->subclasse = $this->get['subclass'];
				$this->subclasse = $this->loot->subclasse;
				if ($this->subclasse == 'arme' || ($this->get['info'] && $this->get['info'] == 'arme')){
					$this->loot->classe = '2';
					if ($this->get['info'] && $this->get['info'] == 'arme')
						$this->loot->subclasse = $this->get['subclass'];
					else 
						$this->loot->subclasse = '0';
				}
			}
			if ($this->get['type'] !== NULL){
				$this->loot->type = $this->get['type'];
				$this->type = $this->loot->type;
			}
			$this->loot->get_loots_by_down();
			$this->loot->get_loots_by_classe();
			$this->loot->get_loots_by_subclasse();
			if (($this->get['subclass'] === NULL || $this->get['subclass'] === '0') && $this->loot->classe != '2')
				$this->loot->get_loots_by_type();
			if (!empty($this->dificulty) && $this->dificulty != 'all'){
					$this->loot->dificulty = $this->dificulty;
					$this->loot->get_loots_by_dificulty();
			}
			if ($this->stats_get && !empty($this->stats_get))
				$this->loot->get_loot_by_stats();
			if ($this->gemmes_get && !empty($this->gemmes_get))
				$this->loot->get_loot_by_gemmes();
			if ($this->spells_get && !empty($this->spells_get))
				$this->loot->get_loot_by_spells();

			$this->tpl_vars['filtres'] = (($temp_slot['item_id'] == '0' && $temp_slot['slot_id'] == 'offHand') ? $this->get_offhands($page) : $this->make_filters($page));
			
			$this->tpl_vars['loots_list'] = '';		
			$this->loot->order_loots_by_down();
			$types = array ('dispo'=>'Objets disponibles',
							'reput'=>'Objets par r?putation',
							'craft'=>'Crafts',
							'raid_finder'=>'Versions Raid Finder',
							'futur'=>'Prochainement disponibles',
							'not_loot'=>'Non disponibles');
			foreach ($types as $key=>$type_str){
				$i = 0;
				$this->tpl_vars['loots_list'] .= '<fieldset>
								<legend style="color:#fff;">'.$type_str.'</legend>
								<table class="table-condensed" width="100%"><tr>';
				if (isset($this->loot->loots[$key])){
					foreach ($this->loot->loots[$key] as $loot){
						$more_class = '';
						if (isset($loot['loot_temp']) && $loot['loot_temp'] == '1')
							$more_class = ' temp_loot';
						else if (isset($loot['loot_temp']) && $loot['loot_temp'] == '2')
							$more_class = ' not_loot';
						else if (isset($loot['loot_temp']) && $loot['loot_temp'] == '3')
							$more_class = ' raid_finder';
						else if ($loot['source_type'] == 'CREATED_BY_SPELL')
							$more_class = ' craft';
						else if ($loot['source_type'] == 'FACTION_REWARD')
							$more_class = ' reputation';
						$loot['item_name'] = str_replace('?', '\'', $loot['item_name']);
						$temp_name_id = str_replace ('\'', '_', $loot['item_name']);
						$temp_name_id = str_replace (' ', '_', $temp_name_id);
						$this->tpl_vars['loots_list'] .= '<td width="25%" class="item_to_chose_cont" id="'.strtolower($temp_name_id).'"><div class="panel panel-warning item_to_chose'.$more_class.'" style="margin-bottom:10px;" ';
						if ($loot['item_id'] != $this->loot->loot_id)
							$this->tpl_vars['loots_list'] .= 'onclick="get_wich_view(\''.$loot['item_id'].'\', \''.$this->loot->loot_id.'\', \''.$this->id_to_change.'\');"';
						$this->tpl_vars['loots_list'] .= '>
										<div class="panel-heading">
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
													<img src="'.$loot['item_img'].'" />
													<span class="frame frame_'.$loot['item_quality'].'"> </span>
												</td>
												<td valign="top">
													<span style="color:#000;">'.
														$loot['item_lvl'].'
													</span>
												</td>
											</tr>
											<tr>
												<td align="center" colspan="2">
													<span class="color-'.$loot['item_quality'].'">'.
														$loot['item_name'];
						if ($more_class == ' temp_loot')
							$this->tpl_vars['loots_list'] .= '	<span style="color:#000; font-size:9px;"><br />Boss prochainement dispo</span>';
						if ($more_class == ' not_loot')
							$this->tpl_vars['loots_list'] .= '	<span style="color:#000; font-size:9px;"><br />Objet non dispo</span>';
						if ($more_class == ' raid_finder')
							$this->tpl_vars['loots_list'] .= '	<span style="color:#000; font-size:9px;"><br />Raid Finder</span>';
						if ($loot['source_type'] == 'CREATED_BY_SPELL')
							$this->tpl_vars['loots_list'] .= '	<span style="color:#000; font-size:9px;"><br />craft</span>';
						if ($loot['source_type'] == 'FACTION_REWARD')
							$this->tpl_vars['loots_list'] .= '	<span style="color:#000; font-size:9px;"><br />R?putation / Vaillance</span>';
						$this->tpl_vars['loots_list'] .= '				</span>
												</td>
											</tr>
										</table>
										<a href="#" rel="item='.$loot['item_id'].'&amp;domain=fr" style="display:block; position:absolute; width:150px; height:100px; margin-top:-85px;">&nbsp;</a>
										</div>
									</div>
								</td>';
						$i++;
						if ($i%4 == 0)
							$this->tpl_vars['loots_list'] .= '</tr><tr>';
					}
				} else 
					$this->tpl_vars['loots_list'] .= '<span style="color:#3A2718;">Aucun objet pour cette cat?gorie.</span>';
				$this->tpl_vars['loots_list'] .= '</table></fieldset>';
			}
			$this->tpl_vars['items_list'] .= $this->load_template('items_list');

			$this->loot->content_general = $this->load_template('equipement_actuel');
		} else {
			if ($this->action == 'refresh'){
				$r2 = "SELECT user_perso FROM larmes_identifiants WHERE user_id = '".$this->id_user."'";
				$r3 = "SELECT slot_id FROM larmes_user_slots WHERE id = '".$this->id_to_change."'";
				$user = $this->sql->get_array($r2);
				$slot_array = $this->sql->get_array($r3);
				$slot_id = $slot_array[0]['slot_id'];
				$name = $user[0]['user_perso'];
				$new_item_id = 0;
				$gems_enchant = '';
				$this->armory->UTF8(true);
				$this->armory->setLocale('fr_FR');
				$this->character = $this->armory->getCharacter($name);
				$gears = $this->character->getGear();
				foreach ($gears as $slot=>$gear){
					if ($slot == $slot_id){
						if (isset($gear['tooltipParams']['gem0']))
							$gems_enchant .= $gear['tooltipParams']['gem0'].'_';
						if (isset($gear['tooltipParams']['gem1']))
							$gems_enchant .= $gear['tooltipParams']['gem1'].'_';
						if (isset($gear['tooltipParams']['gem2']))
							$gems_enchant .= $gear['tooltipParams']['gem2'].'_';
							if (isset($gear['tooltipParams']['gem3']))
							$gems_enchant .= $gear['tooltipParams']['gem3'].'_';
						$gems_enchant = substr($gems_enchant, 0, strlen($gems_enchant)-1).'[||]';
						if (isset($gear['tooltipParams']['enchant']))
							$gems_enchant .= $gear['tooltipParams']['enchant'];
						$new_item_id = $gear['id'];
					}
				}
				$r = "UPDATE larmes_user_slots SET ".$champ." = '0', item_id = '".$new_item_id."', gems_ench = '".$gems_enchant."' WHERE id = '".$this->id_to_change."' AND user_id = '".$this->id_user."'";
				$ok = $this->sql->request($r);
				$r = "SELECT * FROM larmes_items_list WHERE item_id = '".$new_item_id."'";
				$count = $this->sql->get_array($r);
				if (empty($count))
					$this->add_loot($new_item_id);
				$this->get_slots();
			}
			if (!empty($this->action) && $this->action == 'change_valide'){					
				$infos_r = "SELECT * FROM larmes_user_slots WHERE id = '".(int)$this->get['id']."'";
				$infos = $this->sql->get_array($infos_r);
				$r = "UPDATE larmes_user_slots SET ".$champ." = '".(int)$this->post['item_id']."' WHERE id = '".(int)$this->get['id']."'";
				$ok = $this->sql->request($r);
				$r = "SELECT item_class, item_subclass FROM larmes_items_list WHERE item_id = '".(int)$this->post['item_id']."'";
				$result = $this->sql->get_array($r);
				$classe = $result[0]['item_class'];
				$subclasse = $result[0]['item_subclass'];				
				if ($classe == '2' && in_array($subclasse, $this->loot->two_hands)){						
					$r = "UPDATE larmes_user_slots SET ".$champ." = '0' WHERE slot_id = 'offHand' AND user_id = '".$this->id_user."'";
					$ok = $this->sql->request($r);
				}
				$this->add_historique('Modification de la wish list. Slot concern? : '.$infos[0]['slot_id']);
				echo '<script type="text/javascript">document.location.href="index.php?page=wish";</script>';
			} else if (!empty($this->action) && ($this->action == 'change_valide_getting' || $this->action == 'change_valide_getting_prov' || $this->action == 'change_valide_getting_spe2')){
				
				if ($this->post['force_user_id'])
					$this->id_user = $this->post['force_user_id'];
				
				$infos_r = "SELECT * FROM larmes_user_slots WHERE id = '".(int)$this->get['id']."'";
				$infos = $this->sql->get_array($infos_r);
				if (!$this->get['bis'] || $this->get['bis'] != 'non' && $this->action == 'change_valide_getting'){
					$r = "UPDATE larmes_user_slots SET item_id = '".(int)$this->post['item_id']."', gems_ench = '', wich_id = '".(int)$this->post['item_id']."' WHERE id = '".(int)$this->get['id']."'";
					$ok = $this->sql->request($r);
				} else if (!$this->get['bis'] || $this->get['bis'] != 'non' && $this->action == 'change_valide_getting_prov'){
					$r = "UPDATE larmes_user_slots SET item_id = '".(int)$this->post['item_id']."', gems_ench = '', wich_prov_id = '".(int)$this->post['item_id']."' WHERE id = '".(int)$this->get['id']."'";
					$ok = $this->sql->request($r);
				}
				$r = "SELECT item_class, item_subclass FROM larmes_items_list WHERE item_id = '".(int)$this->post['item_id']."'";
				$result = $this->sql->get_array($r);
				$classe = $result[0]['item_class'];
				$subclasse = $result[0]['item_subclass'];	
				if (!$this->get['bis'] || $this->get['bis'] != 'non' && $this->action == 'change_valide_getting'){				
					if ($classe == '2' && in_array($subclasse, $this->loot->two_hands) && ($infos[0]['wich_id'] == $infos[0]['item_id'])){						
						$r = "UPDATE larmes_user_slots SET wich_id = '0', item_id = '0' WHERE slot_id = 'offHand' AND user_id = '".$this->post['force_user_id']."'";
						$ok = $this->sql->request($r);
					}
				}
				if ($this->action == 'change_valide_getting' || $this->action == 'change_valide_getting_prov'){
					$r = "INSERT INTO larmes_raid_historique VALUES ('', '".$this->post['force_user_id']."', '".$this->session['raid']."', '".(int)$this->post['item_id']."', NOW())";
					$ok = $this->sql->request($r);
					$this->add_historique('Attribution d\'un item. Slot concern? : '.$infos[0]['slot_id']);
				}
				$r = "SELECT * FROM larmes_identifiants WHERE user_id = '".$this->id_user."'";
				$user_array = $this->sql->get_array($r);
				$user = array(	'user_perso'=>$user_array[0]['user_perso'],
								'user_mail'=>$user_array[0]['user_mail']);
				$search = array(
					0=>'head',
					1=>'neck',
					2=>'shoulder',
					3=>'back',
					4=>'chest',
					5=>'wrist',
					6=>'hands',
					7=>'waist',
					8=>'legs',
					9=>'feet',
					10=>'finger1',
					11=>'finger2',
					12=>'trinket1',
					13=>'trinket2',
					14=>'mainHand',
					15=>'offHand');
				$replace = array(
					0=>'Casque',
					1=>'Cou',
					2=>'Epaules',
					3=>'Cape',
					4=>'Torse',
					5=>'Brassards',
					6=>'Mains',
					7=>'Ceinture',
					8=>'Jambes',
					9=>'Pieds',
					10=>'Bague 1',
					11=>'Bague 2',
					12=>'Bijou 1',
					13=>'Bijou 2',
					14=>'Main principale',
					15=>'Main gauche');
				$objet = $infos[0]['slot_id'];
				for ($i = 0; $i < 16; $i++)
					$objet = str_replace($search[$i], $replace[$i], $objet);
				if ($this->get['bis'] && $this->get['bis'] == 'non'){
					$not_personal = array(	'titre_mail'=>"Attribution d'un item",
											'mail_content'=>'Un objet vous a ?t? automatiquement attribu?. Slot concern? : <strong>'.$objet.'</strong>.<br/>Cette objet n\'est pas consid?r? comme Bis mais votre ratio de loots/raid a tout de m?me ?t? augment?.<br />Cet objet a ?t? consid?r? comme ?quipement pour votre sp?cialisation principale.<br /><br />N\'oubliez pas de r?actualiser ce slot sur le Raid Lead Manager !');
				} else {
					if ($this->action == 'change_valide_getting'){
						$not_personal = array(	'titre_mail'=>"Attribution d'un item",
												'mail_content'=>'Un objet vous a ?t? automatiquement attribu?. Slot concern? : <strong>'.$objet.'</strong>.<br/>Cette objet est consid?r? comme Bis. Votre ratio de loots/raid a ?t? augment?.<br /><br />N\'oubliez pas de r?actualiser ce slot sur le Raid Lead Manager !');
					} else if ($this->action == 'change_valide_getting_prov'){
						$not_personal = array(	'titre_mail'=>"Attribution d'un item",
												'mail_content'=>'Un objet vous a ?t? automatiquement attribu?. Slot concern? : <strong>'.$objet.'</strong>.<br/>Cette objet n\'est pas consid?r? comme Bis mais votre ratio de loots/raid a tout de m?me ?t? augment?.<br />Cet objet a ?t? consid?r? comme ?quipement pour votre sp?cialisation principale.<br /><br />N\'oubliez pas de r?actualiser ce slot sur le Raid Lead Manager !');
					} else if ($this->action == 'change_valide_getting_spe2'){
						$not_personal = array(	'titre_mail'=>"Attribution d'un item",
												'mail_content'=>'Un objet vous a ?t? automatiquement attribu?. Slot concern? : <strong>'.$objet.'</strong>.<br/>Cette objet est consid?r? comme faisant partie de votre sp? 2 Votre ration de loots/raid n\'a pas ?t? augment?.<br /><br />N\'oubliez pas de r?actualiser ce slot sur le Raid Lead Manager !');
					}
				}
				$this->send_mail($user, $not_personal);

				echo '<script type="text/javascript">document.location.href="index.php?page=attrib&raid_id='.$this->post['raid_id'].'&mode='.$this->post['mode'].'&boss_id='.$this->post['boss_id'].'&attrib=ok";</script>';
			}
			if ($is_complete === true)
				$this->list_wich_list($type);
		}
	}

	private function list_wich_list_prov(){
		global $_SESSION;
		$return = '
			<div id="stuff">
				<table border="0" align="left" cellpadding="0" cellspacing="1" bgcolor="#D1B285">
					<tr class="head_list">
						<td>
							Equipement obtenu
						</td>
						<td>
							Equipement souhait?
						</td>
						<td>
							Etat
						</td>
						<td>
							Actions
						</td>
					</tr>';
		$all_wishes = true;
		$wishes_lvl = array();
		foreach ($this->user_slots as $gear){
			$gems_ench = explode('[||]', $gear['gems_ench']);
			$gemmes = explode('_', $gems_ench[0]);
			$enchant = $gems_ench[1];
			$this->loot->loot_id = $gear['item_id'];
			$loot = $this->loot->get_loot_by_id();
			$loot['item_name'] = str_replace('?', '\'', $loot['item_name']);
			$this->loot->loot_id = $gear['wich_prov_id'];
			$wloot = $this->loot->get_loot_by_id();
			$ok = true;
			if($gear['wich_prov_id'] == '0'){
				$all_wishes = false;
				$wloot['item_img'] = 'styles/imgs/Warning.png';
				$wloot['item_quality'] = '1';
				$wloot['item_name'] = 'Non d?finie';
				$wloot['item_lvl'] = '0';
				if ($gear['slot_id'] == 'offHand'){
					$r = "SELECT i.item_subclass FROM larmes_user_slots s, larmes_items_list i WHERE s.slot_id = 'mainHand' AND s.user_id = '".$this->id_user."' AND s.wich_prov_id = i.item_id";
					$result = $this->sql->get_array($r);
					if (in_array($result[0]['item_subclass'], $this->loot->two_hands)){
						$wloot['item_img'] = '';
						$wloot['item_quality'] = '1';
						$wloot['item_name'] = '';
						$wloot['item_lvl'] = '';
						$ok = false;
					}						
				}
			} else {
				$wishes_lvl[] = $wloot['item_lvl'];
			}
			$wloot['item_name'] = str_replace('?', '\'', $wloot['item_name']);
			if ($ok === false){
					$etat = '';
					$action = '';
			} else {
				if ($gear['item_id'] == $gear['wich_prov_id']){
					$etat = '<img src="styles/imgs/Tick.png" width="32" /><br />Equipement obtenu !';
					$action = '<a href="index.php?page=wish_prov&action=change&id='.$gear['id'].'"><img src="styles/imgs/Edit.png" width="32" /></a>';
				} else if ($gear['wich_prov_id'] != 0){
					$etat = '<img src="styles/imgs/Error.png" width="32" /><br />Equipement non obtenu';
					$action = '<a href="index.php?page=wish_prov&action=change&id='.$gear['id'].'"><img src="styles/imgs/Edit.png" width="32" /></a>';
				} else{ 
					$etat = '<img src="styles/imgs/Warning.png" width="32" /><br />Wish list non d?finie';
					$action = '<a href="index.php?page=wish_prov&action=change&id='.$gear['id'].'"><img src="styles/imgs/Add.png" width="32" /></a>';
				}
			}
			$return .= '
					<tr>
						<td align="left" class="general" style="border:solid 1px #3A2718;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
										<img src="'.$loot['item_img'].'" />
										<span class="frame frame_'.$loot['item_quality'].'"> </span>
									</td>
									<td align="left" width="245">
										<span class="color-'.$loot['item_quality'].'">'.$loot['item_name'].'</span><br />
										<span style="color:#999999;">'.
											$loot['item_lvl'].'<br />
										</span>
									</td>
								</tr>
							</table>
							<a href="#" rel="item='.$gear['item_id'].'&amp;domain=fr&amp;gems='.implode(':', $gemmes).'&amp;ench='.$enchant.'" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>
						</td>
						<td align="left" class="general" style="border:solid 1px #3A2718;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
										<img src="'.$wloot['item_img'].'" />
										<span class="frame frame_'.$wloot['item_quality'].'"> </span>
									</td>
									<td align="left" width="245">
										<span class="color-'.$wloot['item_quality'].'">'.$wloot['item_name'].'</span><br />
										<span style="color:#999999;">'.
											$wloot['item_lvl'].'<br />
										</span>
									</td>
								</tr>
							</table>
							<a href="#" rel="item='.$wloot['item_id'].'&amp;domain=fr" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>
						</td>
						<td align="center" style="border:solid 1px #3A2718;">
							'.$etat.'
						</td>
						<td style="border:solid 1px #3A2718; padding:0px 5px;" align="center">
							'.$action.'
						</td>
					</tr>';
		}
		$w_lvl_m = 0;
		$return .= '
				</table>
			</div>';
		$this->loot->content_general = $return;
	}
	
	private function list_wich_list_spe2(){
		global $_SESSION;
		$return = '
			<div id="stuff">
				<table border="0" align="left" cellpadding="0" cellspacing="1" bgcolor="#D1B285">
					<tr class="head_list">
						<td>
							Equipement obtenu
						</td>
						<td>
							Equipement souhait?
						</td>
						<td>
							Etat
						</td>
						<td>
							Actions
						</td>
					</tr>';
		$all_wishes = true;
		$wishes_lvl = array();
		foreach ($this->user_slots as $gear){
			$gems_ench = explode('[||]', $gear['gems_ench']);
			$gemmes = explode('_', $gems_ench[0]);
			$enchant = $gems_ench[1];
			$this->loot->loot_id = $gear['item_id'];
			$loot = $this->loot->get_loot_by_id();
			$loot['item_name'] = str_replace('?', '\'', $loot['item_name']);
			$this->loot->loot_id = $gear['wish_spe_2_id'];
			$wloot = $this->loot->get_loot_by_id();
			$ok = true;
			if($gear['wish_spe_2_id'] == '0'){
				$all_wishes = false;
				$wloot['item_img'] = 'styles/imgs/Warning.png';
				$wloot['item_quality'] = '1';
				$wloot['item_name'] = 'Non d?finie';
				$wloot['item_lvl'] = '0';
				if ($gear['slot_id'] == 'offHand'){
					$r = "SELECT i.item_subclass FROM larmes_user_slots s, larmes_items_list i WHERE s.slot_id = 'mainHand' AND s.user_id = '".$this->id_user."' AND s.wish_spe_2_id = i.item_id";
					$result = $this->sql->get_array($r);
					if (in_array($result[0]['item_subclass'], $this->loot->two_hands)){
						$wloot['item_img'] = '';
						$wloot['item_quality'] = '1';
						$wloot['item_name'] = '';
						$wloot['item_lvl'] = '';
						$ok = false;
					}						
				}
			} else {
				$wishes_lvl[] = $wloot['item_lvl'];
			}
			$wloot['item_name'] = str_replace('?', '\'', $wloot['item_name']);
			if ($ok === false){
					$etat = '';
					$action = '';
			} else {
				if ($gear['item_id'] == $gear['wish_spe_2_id']){
					$etat = '<img src="styles/imgs/Tick.png" width="32" /><br />Equipement obtenu !';
					$action = '<a href="index.php?page=wish_spe2&action=change&id='.$gear['id'].'"><img src="styles/imgs/Edit.png" width="32" /></a>';
				} else if ($gear['wish_spe_2_id'] != 0){
					$etat = '<img src="styles/imgs/Error.png" width="32" /><br />Equipement non obtenu';
					$action = '<a href="index.php?page=wish_spe2&action=change&id='.$gear['id'].'"><img src="styles/imgs/Edit.png" width="32" /></a>';
				} else{ 
					$etat = '<img src="styles/imgs/Warning.png" width="32" /><br />Wish list non d?finie';
					$action = '<a href="index.php?page=wish_spe2&action=change&id='.$gear['id'].'"><img src="styles/imgs/Add.png" width="32" /></a>';
				}
			}
			$return .= '
					<tr>
						<td align="left" class="general" style="border:solid 1px #3A2718;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
										<img src="'.$loot['item_img'].'" />
										<span class="frame frame_'.$loot['item_quality'].'"> </span>
									</td>
									<td align="left" width="245">
										<span class="color-'.$loot['item_quality'].'">'.$loot['item_name'].'</span><br />
										<span style="color:#999999;">'.
											$loot['item_lvl'].'<br />
										</span>
									</td>
								</tr>
							</table>
							<a href="#" rel="item='.$gear['item_id'].'&amp;domain=fr&amp;gems='.implode(':', $gemmes).'&amp;ench='.$enchant.'" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>
						</td>
						<td align="left" class="general" style="border:solid 1px #3A2718;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
										<img src="'.$wloot['item_img'].'" />
										<span class="frame frame_'.$wloot['item_quality'].'"> </span>
									</td>
									<td align="left" width="245">
										<span class="color-'.$wloot['item_quality'].'">'.$wloot['item_name'].'</span><br />
										<span style="color:#999999;">'.
											$wloot['item_lvl'].'<br />
										</span>
									</td>
								</tr>
							</table>
							<a href="#" rel="item='.$wloot['item_id'].'&amp;domain=fr" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>
						</td>
						<td align="center" style="border:solid 1px #3A2718;">
							'.$etat.'
						</td>
						<td style="border:solid 1px #3A2718; padding:0px 5px;" align="center">
							'.$action.'
						</td>
					</tr>';
		}
		$return .= '
				</table>
			</div>';
		$this->loot->content_general = $return;
	}
	
	private function list_wich_list($type){
		switch ($type){
			case 'wish':
				$champ = 'wich_id'; $page = 'wish';
				$this->tpl_vars['titre'] = 'Wish List principale';
			break;
			case 'prov':
				$champ = 'wich_prov_id'; $page = 'wish_prov';
				$this->tpl_vars['titre'] = 'Wish List provisoire';
			break;
			case 'spe2':
				$champ = 'wish_spe_2_id';  $page = 'wish_spe2';
				$this->tpl_vars['titre'] = 'Wish List Sp? 2';
			break;
		}
		global $_SESSION;
		
		$all_wishes = true;
		$wishes_lvl = array();

		$fichier='templates/item_tpl.html';
		$item_tpl = fread(fopen($fichier, "r"), filesize($fichier));
		$this->tpl_vars['items_list'] = '';
		foreach ($this->user_slots as $gear){
			$current_tpl = $item_tpl;
			$this->item_vars = array();
			$gems_ench = explode('[||]', $gear['gems_ench']);
			$gemmes = explode('_', $gems_ench[0]);
			$enchant = $gems_ench[1];
			$this->loot->loot_id = $gear['item_id'];
			$loot = $this->loot->get_loot_by_id();
			$loot['item_name'] = str_replace('?', '\'', $loot['item_name']);
			$this->loot->loot_id = $gear[$champ];
			$wloot = $this->loot->get_loot_by_id();
			$ok = true;
			if($gear[$champ] == '0'){
				$all_wishes = false;
				$wloot['item_img'] = 'styles/imgs/Warning.png';
				$wloot['item_quality'] = '1';
				$wloot['item_name'] = 'Non d?finie';
				$wloot['item_lvl'] = '0';
				if ($gear['slot_id'] == 'offHand'){
					$r = "SELECT i.item_subclass FROM larmes_user_slots s, larmes_items_list i WHERE s.slot_id = 'mainHand' AND s.user_id = '".$this->id_user."' AND s.".$champ." = i.item_id";
					$result = $this->sql->get_array($r);
					if (in_array($result[0]['item_subclass'], $this->loot->two_hands)){
						$wloot['item_img'] = '';
						$wloot['item_quality'] = '1';
						$wloot['item_name'] = '';
						$wloot['item_lvl'] = '';
						$ok = false;
					}						
				}
			} else {
				$wishes_lvl[] = $wloot['item_lvl'];
			}
			$wloot['item_name'] = str_replace('?', '\'', $wloot['item_name']);
			if ($ok === false){
					$this->item_vars['etat'] = '';
					$this->item_vars['actions'] = '';
			} else {
				if ($gear['item_id'] == $gear[$champ]){
					$this->item_vars['etat'] = '<img src="styles/imgs/Tick.png" width="32" /><br />Equipement obtenu !';
					$this->item_vars['actions'] = '<a href="index.php?page='.$page.'&action=change&id='.$gear['id'].'"><span class="glyphicon glyphicon-edit" style="font-size:30px; line-height:57px;"></span></a> <a href="index.php?page='.$page.'&action=refresh&id='.$gear['id'].'"><span class="glyphicon glyphicon-refresh" style="font-size:30px; line-height:57px;"></span></a>';
				} else if ($gear[$champ] != 0){
					$this->item_vars['etat'] = '<img src="styles/imgs/Error.png" width="32" /><br />Equipement non obtenu';
					$this->item_vars['actions'] = '<a href="index.php?page='.$page.'&action=change&id='.$gear['id'].'"><span class="glyphicon glyphicon-edit" style="font-size:30px; line-height:57px;"></span></a> <a href="index.php?page='.$page.'&action=refresh&id='.$gear['id'].'"><span class="glyphicon glyphicon-refresh" style="font-size:30px; line-height:57px;"></span></a>';
				} else{ 
					$this->item_vars['etat'] = '<img src="styles/imgs/Warning.png" width="32" /><br />Wish list non d?finie';
					$this->item_vars['actions'] = '<a href="index.php?page='.$page.'&action=change&id='.$gear['id'].'"><span class="glyphicon glyphicon-plus" style="font-size:30px; line-height:57px;"></span></a> <a href="index.php?page='.$page.'&action=refresh&id='.$gear['id'].'"><span class="glyphicon glyphicon-refresh" style="font-size:30px; line-height:57px;"></span></a>';
				}
			}
			$this->item_vars['item_img'] = $loot['item_img'];
			$this->item_vars['item_quality'] = $loot['item_quality'];
			$this->item_vars['item_name'] = $loot['item_name'];
			$this->item_vars['item_lvl'] = $loot['item_lvl'];
			$this->item_vars['item_id'] = $gear['item_id'];
			$this->item_vars['gemmes'] = implode(':', $gemmes);
			$this->item_vars['enchant'] = $enchant;
			$this->item_vars['item_img_w'] = $wloot['item_img'];
			$this->item_vars['item_quality_w'] = $wloot['item_quality'];
			$this->item_vars['item_name_w'] = $wloot['item_name'];
			$this->item_vars['item_lvl_w'] = $wloot['item_lvl'];
			$this->item_vars['item_id_w'] = $wloot['item_id'];
			foreach ($this->item_vars as $key=>$cont){
				$current_tpl = str_replace('<'.$key.'>', $cont, $current_tpl);
			}
			$this->tpl_vars['items_list'] .= $current_tpl;
		}
		$w_lvl_m = 0;
		if (!empty($wishes_lvl)){
			foreach ($wishes_lvl as $lvl)
				$w_lvl_m += $lvl;
			$w_lvl_m = $w_lvl_m / count($wishes_lvl);
			$w_lvl_m = (int)$w_lvl_m;
			$r = "UPDATE larmes_identifiants SET user_ilvl_wish = '".$w_lvl_m."' WHERE user_id = '".$this->id_user."'";
			$ok = $this->sql->request($r);
			$_SESSION['wish_ilvl'] = $w_lvl_m;
		}
		
		$this->loot->content_general = $this->load_template('wish_list');
	}
	
	private function get_offhands(){
		if ($this->type == '23'){
			$return = '	Armure > Divers > <select onchange="window.location.href=\'index.php?page=wish&action=change&id='.$this->id_to_change.'&subclass=\'+this.options[selectedIndex].value;">
							<option value="0&type=23" selected="selected">Main gauche</option>
							<option value="6&classe=4">Bouclier</option>
							<option value="arme">Arme</option>
						</select>';
		} else {
			$this->classe = '4';
			$this->subclasse = '6';
			$return = '	Armure > <select onchange="window.location.href=\'index.php?page=wish&action=change&id='.$this->id_to_change.'&subclass=\'+this.options[selectedIndex].value;">
							<option value="0&type=23&classe=4">Main gauche</option>
							<option value="6&classe=4" selected="selected">Bouclier</option>
							<option value="arme">Arme</option>
						</select>';
		}
		return $return;
	}
	
	private function make_filters($page){
		if ($this->add_stat && $this->add_stat != ''){
			$url = $this->genere_base_link($page, 'stats');
			if ($this->get['stats'] && $this->get['stats'] != ''){
				$url .= '&stats=';
				$stats = explode(',', $this->get['stats']);
				$find = false;
				foreach ($stats as $stat){
					if ($stat == $this->add_stat)
						$find = true;
					else
						$url .= $stat.',';
				}
				if ($find === false){
					$url .= $this->add_stat;
				}
			} else {
				$url .= '&stats='.$this->add_stat;
			}
			echo '<script type="text/javascript">document.location.href="'.$url.'";</script>';
		}
		if ($this->add_gemme && $this->add_gemme != ''){
			$url = $this->genere_base_link($page, 'gemmes');
			if ($this->get['gemmes'] && $this->get['gemmes'] != ''){
				$url .= '&gemmes=';
				$gemmes = explode(',', $this->get['gemmes']);
				$find = false;
				foreach ($gemmes as $gemme){
					if ($gemme == $this->add_gemme)
						$find = true;
					else
						$url .= $gemme.',';
				}
				if ($find === false){
					$url .= $this->add_gemme;
				}
			} else {
				$url .= '&gemmes='.$this->add_gemme;
			}
			echo '<script type="text/javascript">document.location.href="'.$url.'";</script>';
		}
		if ($this->add_spell && $this->add_spell != ''){
			$url = $this->genere_base_link($page, 'spells');
			if ($this->get['spells'] && $this->get['spells'] != ''){
				$url .= '&spells=';
				$spells = explode(',', $this->get['spells']);
				$find = false;
				foreach ($spells as $spell){
					if ($spell == $this->add_spell)
						$find = true;
					else
						$url .= $spell.',';
				}
				if ($find === false){
					$url .= $this->add_spell;
				}
			} else {
				$url .= '&spells='.$this->add_spell;
			}
			echo '<script type="text/javascript">document.location.href="'.$url.'";</script>';
		}
		$return = '	<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td align="left" class="arian">'.
								$this->loot->classes[$this->loot->classe].' > ';
		if ($this->loot->classe == 2 || ($this->loot->classe == 4 && $this->loot->subclasse == 6)){
			if ($this->loot->classe == 2){
				$return .= '<select class="filter" onchange="window.location.href=\'index.php?page=wish'.$page.'&action=change&info=arme&class='.$this->loot->classe.'&id='.$this->id_to_change.(($this->get['dificulty']) ? '+\'&subclass='.$this->get['dificulty'].'\'' : '').'&subclass=\'+this.options[selectedIndex].value'.(($this->get['order']) ? '+\'&order='.$this->get['order'].'\'' : '').';">';
				foreach ($this->loot->subclasses[$this->loot->classe] as $id=>$name){
					$return .= '<option value="'.$id.'" ';
					if ($id == $this->loot->subclasse)
						$return .= 'selected="selected"';
					$return .= '>'.$name.'</option>';
				}
				$return .= '</select>';
			} else {
				$return .= '<select onchange="window.location.href=\'index.php?page=wish'.$page.'&action=change&id='.$this->id_to_change.'&subclass=\'+this.options[selectedIndex].value;">
								<option value="0&type=23&classe=4">Main gauche</option>
								<option value="6" selected="selected">Bouclier</option>
								<option value="arme">Arme</option>
							</select>';
			}
		} else
			$return .= $this->loot->subclasses[$this->loot->classe][$this->loot->subclasse].' > ';
		if ($this->loot->classe != 2){
			$this->type = $this->loot->type;
			if ($this->get['type'] === NULL && $this->get['subclass'] !== NULL){
				$this->type = '0';
			} else if ($this->get['subclass'] !== NULL){
				$this->type = $this->get['type'];
			}
			if ($this->type == '23'){
				$return .= '<select onchange="window.location.href=\'index.php?page=wish'.$page.'&action=change&id='.$this->id_to_change.'&subclass=\'+this.options[selectedIndex].value;">
								<option value="0&type=23" selected="selected">Main gauche</option>
								<option value="6">Bouclier</option>
								<option value="arme">Arme</option>
							</select>';
			} else {
				$return .= $this->loot->types[$this->loot->type];
			}
			
		}
		$return .= '		</td>
							<td align="right">
								Trier par :
								<select class="filter" onchange="window.location.href=\''.$this->genere_base_link($page, 'order').'&order=\'+this.options[selectedIndex].value;">
									'.$this->genere_filters().'
								</select>
								<select class="filter" onchange="window.location.href=\''.$this->genere_base_link($page, 'dificulty').'&dificulty=\'+this.options[selectedIndex].value;">
									'.$this->genere_raid_filter().'
								</select>
							</td>
						</tr>
					</table>';
		$return .= '<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td align="left">'.
								$this->get_stats_selected().'
							</td>
							<td align="right" valign="top">
							Contenant la statistique : 
								<select class="filter" onchange="javascript:add_stat(this);">
									<option value="0">- - -</option>';
		$stats = explode(',', $this->get['stats']);
		foreach ($this->loot->stats as $id=>$name){
			if (!in_array($id, $stats))
				$return .= '		<option value="'.$id.'">'.$name.'</option>';
			else
				$return .= '		<option value="'.$id.'" disabled="disabled">'.$name.'</option>';
		}
		$return .= '			</select>
							</td>
						</tr>
					</table>';
		$return .= '<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tr>';
		if ($this->loot->classe == 4 && $this->loot->subclasse == 0 && $this->type == 12){
			$return .= '	<td align="left">'.
								$this->get_spells_selected().'
							</td>
							<td align="right" valign="top">
								propri?t? du bijou : 
								<select class="filter" onchange="javascript:add_spell(this);">
									<option value="0">- - -</option>';
		$spells = explode(',', $this->get['spells']);
		foreach ($this->loot->spells as $id=>$name){
			if (!in_array($id, $spells))
				$return .= '		<option value="'.$id.'">'.$name.'</option>';
			else
				$return .= '		<option value="'.$id.'" disabled="disabled">'.$name.'</option>';
		}
		$return .= '			</select>
							</td>';
		} else {
			$return .= '	<td align="left">'.
								$this->get_gemmes_selected().'
							</td>
							<td align="right" valign="top">
								Contenant au moins : 
								<select class="filter" onchange="javascript:add_gemme(this);">
									<option value="0">- - -</option>';
		$gemmes = explode(',', $this->get['gemmes']);
		foreach ($this->loot->gemmes as $id=>$name){
			if (!in_array($id, $gemmes))
				$return .= '		<option value="'.$id.'">'.$name.'</option>';
			else
				$return .= '		<option value="'.$id.'" disabled="disabled">'.$name.'</option>';
		}
		$return .= '			</select>
							</td>';
		}
		$return .= '	</tr>
					</table>';
		return $return;
	}
	
	private function genere_base_link($page, $exept = false){
		$return = 'index.php?page=wish'.$page.'&action=change&id='.$this->id_to_change.(($this->get['subclass']) ? '&subclass='.$this->get['subclass'].'' : '');
		if ($exept != 'order')
			$return .= (($this->get['order']) ? '&order='.$this->get['order'] : '');
		if ($exept != 'dificulty')
			$return .= (($this->get['dificulty']) ? '&dificulty='.$this->get['dificulty'] : '');
		if ($this->get['stats'] && $exept != 'stats')
			$return .= '&stats='.$this->get['stats'];
		if ($this->get['gemmes'] && $exept != 'gemmes')
			$return .= '&gemmes='.$this->get['gemmes'];
		if ($this->get['spells'] && $exept != 'spells')
			$return .= '&spells='.$this->get['spells'];
		return $return;
	}
	
	private function get_stats_selected(){
		$return = '';
		if ($this->get['stats'] && !empty($this->get['stats'])){
			$stats = explode(',', $this->get['stats']);
			$return .= '<table border="0" cellpadding="0" cellspacing="2">';
			foreach ($stats as $stat){
				$return .= '<tr>
								<td style="background-color:#F7E3C8; color:#3A2718; padding:0px 2px;"><img src="styles/imgs/Error.png" width="25" style="border:none; display:block; cursor:pointer;" onclick="javascript:delete_stat(\''.$this->genere_base_link('stats').'\', \''.$this->get['stats'].'\', \''.$stat.'\');" /></td>
								<td style="background-color:#F7E3C8; color:#3A2718; padding:0px 2px;">'.$this->loot->stats[$stat].'</td>
							</tr>';
			}
			$return .= '</table>';
		}
		return $return;
	}
	
	private function get_gemmes_selected(){
		$return = '';
		if ($this->get['gemmes'] && !empty($this->get['gemmes'])){
			$gemmes = explode(',', $this->get['gemmes']);
			$return .= '<table border="0" cellpadding="0" cellspacing="2">';
			foreach ($gemmes as $gemme){
				$return .= '<tr>
								<td style="background-color:#F7E3C8; color:#3A2718; padding:0px 2px;"><img src="styles/imgs/Error.png" width="25" style="border:none; display:block; cursor:pointer;" onclick="javascript:delete_gemme(\''.$this->genere_base_link('gemmes').'\', \''.$this->get['gemmes'].'\', \''.$gemme.'\');" /></td>
								<td style="background-color:#F7E3C8; color:#3A2718; padding:0px 2px;">'.$this->loot->gemmes[$gemme].'</td>
							</tr>';
			}
			$return .= '</table>';
		}
		return $return;
	}
	
	private function get_spells_selected(){
		$return = '';
		if ($this->get['spells'] && !empty($this->get['spells'])){
			$spells = explode(',', $this->get['spells']);
			$return .= '<table border="0" cellpadding="0" cellspacing="2">';
			foreach ($spells as $spell){
				$return .= '<tr>
								<td style="background-color:#F7E3C8; color:#3A2718; padding:0px 2px;"><img src="styles/imgs/Error.png" width="25" style="border:none; display:block; cursor:pointer;" onclick="javascript:delete_spell(\''.$this->genere_base_link('spells').'\', \''.$this->get['spells'].'\', \''.$spell.'\');" /></td>
								<td style="background-color:#F7E3C8; color:#3A2718; padding:0px 2px;">'.$this->loot->spells[$spell].'</td>
							</tr>';
			}
			$return .= '</table>';
		}
		return $return;
	}
	
	private function deconnection(){
		global $_SESSION;
		session_destroy();
		echo '<script type="text/javascript">window.location.href="index.php";</script>';
	}
	
	private function genere_filters(){
		$options = array(
			'ilvl1'=>'Niveau croissant',
			'ilvl2'=>'Niveau d?croissant',
			'name1'=>'Nom d\'objet A-Z',
			'name2'=>'Nom d\'objet Z-A');
		$return = '';
		foreach ($options as $val=>$option){
			$return .= '<option value="'.$val.'"';
			if ($this->order == $val || (empty($this->order) && $val == 'ilvl2'))
				$return .= ' selected="selected"';
			$return .= '>'.$option.'</option>';
		}
		return $return;
	}
	
	private function genere_raid_filter(){
		$options = array(
			'n'=>'Raid Normal',
			'hm'=>'Raid Hard Mode',
			'all'=>'Tous types de raid');
		$return = '';
		foreach ($options as $val=>$option){
			$return .= '<option value="'.$val.'"';
			if ($this->dificulty == $val || (empty($this->dificulty) && $val == 'all'))
				$return .= ' selected="selected"';
			$return .= '>'.$option.'</option>';
		}
		return $return;
	}
	
	private function check_dif($dif){
		if ((!$this->dificulty) || (!empty($this->dificulty) && $this->dificulty[$dif]))
			return 'checked="checked"';
		return '';
	}
	
	private function get_content_assign(){
		$this->loot->get_loots_not_assign();
		if ($this->action == 'change_valide'){
			if ($this->post['boss_id'] != '0'){
				$r = "UPDATE larmes_items_list SET source_id = '".$this->post['boss_id']."', source_type = 'CREATURE_DROP' WHERE item_id = '".$this->post['loot_id']."'";
				$ok = $this->sql->request($r);
				echo '<script type="text/javascript">document.location.href="index.php?page=assign";</script>';
			}
		}
		$return = '<div id="stuff">';
		$return .= '<strong>'.count($this->loot->loots).' objets ? associer... Bon courrage !</strong><br /><br />';
		$return .= '	<table border="0" align="left" cellpadding="0" cellspacing="1" bgcolor="#D1B285">';
		$i = 0;
		foreach ($this->loot->loots as $loot){
			if ($i < 25){
			$return .= '	<tr>
								<td align="left" class="general" style="border:solid 1px #3A2718;">
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tr>
											<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
												<img src="'.$loot['item_img'].'" />
												<span class="frame frame_'.$loot['item_quality'].'"> </span>
											</td>
											<td align="left" width="245">
												<span class="color-'.$loot['item_quality'].'">'.str_replace ('?', '\'', $loot['item_name']).'</span><br />
												<span style="color:#999999;">'.
													$loot['item_lvl'].'<br />
												</span>
											</td>
										</tr>
									</table>
									<a href="#" rel="item='.$loot['item_id'].'&amp;domain=fr" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>
								</td>
								<td>
									<form action="index.php?page=assign&action=change_valide" method="post">
									<input type="hidden" name="loot_id" value="'.$loot['item_id'].'" />
									<select class="filter" name="boss_id">
										<option value="0">S?lectionner le boss associ?</option>';
										foreach($this->loot->boss_by_raid as $raid=>$bosses){
											if ($raid == '4'){
												foreach ($bosses as $id=>$boss){
													$return .= '
										<option value="'.$id.'">'.$boss.'</option>';
												}
											}
										}
			$return .= '			</select>
									<input type="submit" value="VALIDER" class="submit" />
									</form>
								</td>
							</tr>
							<tr>
								<td colspan="2"><strong>'.str_replace ('?', '\'', $loot['item_name']).' &nbsp;&nbsp;&nbsp;'.$loot['item_id'].'</strong></td>
							</tr>';
			}
			$i++;
		}
		$return .= '	</table>
					</div>';
		$this->loot->content_general = $return;
	}
	
	private function get_content_params(){
		$this->loot->content_general = '';
		if ($this->action_form){
			switch($this->action_form){
				case 'change_log':	$return .= $this->change_log();		break;
				case 'change_mail':	$return .= $this->change_email();	break;
				case 'refresh_perso':
					if (!isset($this->action_form_valide))
						$this->loot->content_general .= $this->warning_text('Etes-vous s?r de vouloir recharger votre personnage ?', true);
					else if ($this->action_form_valide == 'oui')
						$this->loot->content_general .= $this->refresh_perso();
				break;
				case 'refrech_perso_only':
					if (!isset($this->action_form_valide))
						$this->loot->content_general .= $this->warning_text('Etes-vous s?r de vouloir rafraichir votre personnage ?', true);
					else if ($this->action_form_valide == 'oui')
						$this->loot->content_general .= $this->refresh_perso_only();				
				break;
				case 'delete_perso':
					if (!isset($this->action_form_valide))
						$this->loot->content_general .= $this->warning_text('Etes-vous s?r de vouloir supprimer votre personnage ?', true);
					else if ($this->action_form_valide == 'oui')
						$this->loot->content_general .= $this->delete_perso();
				break;
			}
		}
		$this->tpl_vars['user_name'] = $this->session['user_name'];
		$this->tpl_vars['user_mail'] = $this->session['user_mail'];
		$this->tpl_vars['actions_perso'] = '';
		if ($this->session['personnage'] && $this->session['personnage'] != ''){
			$this->tpl_vars['actions_perso'] = $this->load_template('actions_perso');
		}

		$this->loot->content_general .= $this->load_template('parametres');
	}
	
	private function change_log(){
		global $_SESSION;
		$ok = 1;
		$old_pass = trim($this->post['old_password']);
		$new_pass = trim($this->post['new_password']);
		$new_pass_conf = trim($this->post['new_password_conf']);
		$user_name = trim($this->post['identifiant']);
		$r = "SELECT * FROM larmes_identifiants WHERE user_id = '".$this->id_user."'";
		$return = $this->sql->get_array($r);
		$r2 = "SELECT COUNT(*) FROM larmes_identifiants WHERE user_log = '".$user_name."' AND user_id != '".$this->id_user."'";
		$return2 = $this->sql->get_array($r2);
		if ($old_pass != $return['0']['user_pass']){
			$ok = 0;
			$error = 'old_pass';
		}
		if ($new_pass != $new_pass_conf){
			$ok = 0;
			$error = 'new_pass_dif';
		}
		if ($new_pass == '' || $new_pass_conf == ''){
			$ok = 0;
			$error = 'new_pass_empty';
		}
		if ($return2[0]['COUNT(*)'] != 0){
			$ok = 0;
			$error = 'name_use';
		}
		if ($user_name == ''){
			$ok = 0;
			$error = 'empty_name';
		}
		
		if ($ok === 0){
			switch ($error){
				case 'empty_name': return $this->error_text('Merci de pr?ciser un nom d\'utilisateur.'); break;
				case 'name_use': return $this->error_text('Ce nom d\'utilisateur est d?j? utilis?.'); break;
				case 'new_pass_empty': return $this->error_text('Merci de pr?ciser un mot de passe.'); break;
				case 'new_pass_dif': return $this->error_text('vos nouveaux mots de passe doivent ?tre identiques.'); break;
				case 'old_pass': return $this->error_text('Ancien mot de passe incorrecte.'); break;
			}
		} else {
			$statut = $return[0]['user_statut'];
			if ($return[0]['user_statut'] == '0'){
				$statut = '1';
				$_SESSION['statut'] = '1';
			}
			$r = "UPDATE larmes_identifiants SET user_log = '".$user_name."', user_pass = '".$new_pass."', user_statut = '".$statut."' WHERE user_id = '".$this->id_user."'";
			$ok = $this->sql->request($r);
			if ($user_name != $this->session['user_name']){
				$_SESSION['user_name'] = $user_name;
			}
			$this->add_historique('Modification des informations de compte');
			return $this->valide_text('Vos nouvelles informations ont ?t? sauvegard?es');
		}
	}
	
	private function change_email(){
		global $_SESSION;
		$ok = 1;
		$email = trim($this->post['email']);
		$syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
		if(!preg_match($syntaxe,$email)){
			$ok = 0;
			$error = 'mail_not_valide';
		}
		if ($email == ''){
			$ok = 0;
			$error = 'mail_empty';
		}
		if ($ok === 0){
			switch ($error){
				case 'mail_empty': return $this->error_text('Merci de pr?ciser une adresse email.'); break;
				case 'mail_not_valide': return $this->error_text('Votre adresse email n\'est pas valide.'); break;
			}
		} else {
			$r = "UPDATE larmes_identifiants SET user_mail = '".$email."' WHERE user_id = '".$this->id_user."'";
			$ok = $this->sql->request($r);
			if (empty($_SESSION['user_mail']))
				$this->add_historique('Adresse email associ?e au compte');
			$_SESSION['user_mail'] = $email;
			return $this->valide_text('Vos nouvelles informations ont ?t? sauvegard?es');
		}
	}
	
	private function check_email(){
		$message = '';
		if(empty($this->session['user_mail']))
			$message .= 'Vous n\'avez pas encore pr?cis? votre adresse Email.<br />';
		if ($this->session['statut'] == '0')
			$message .= 'Votre mot de passe est toujours celui d\'ogirine.<br />';
		if (!empty($message))
			$this->loot->content_general = $this->warning_text($message).$this->loot->content_general;
	}
	
	private function refresh_perso(){
		$this->armory->UTF8(true);
		$this->armory->setLocale('fr_FR');
		$this->character = $this->armory->getCharacter($this->session['personnage']);
		$gears = $this->character->getGear();
		foreach ($this->user_slots as $slot){
			$slot_id = $slot['slot_id'];
			foreach ($gears as $slot_name=>$gear){
				if ($slot_name == $slot_id){
					$gems_enchant = '';
					if (isset($gear['tooltipParams']['gem0']))
						$gems_enchant .= $gear['tooltipParams']['gem0'].'_';
					if (isset($gear['tooltipParams']['gem1']))
						$gems_enchant .= $gear['tooltipParams']['gem1'].'_';
					if (isset($gear['tooltipParams']['gem2']))
						$gems_enchant .= $gear['tooltipParams']['gem2'].'_';
						if (isset($gear['tooltipParams']['gem3']))
						$gems_enchant .= $gear['tooltipParams']['gem3'].'_';
					$gems_enchant = substr($gems_enchant, 0, strlen($gems_enchant)-1).'[||]';
					if (isset($gear['tooltipParams']['enchant']))
						$gems_enchant .= $gear['tooltipParams']['enchant'];
					$new_item_id = $gear['id'];
					$r = "UPDATE larmes_user_slots SET wich_id = '0', item_id = '".$new_item_id."', gems_ench = '".$gems_enchant."' WHERE id = '".$slot['id']."' AND user_id = '".$this->id_user."'";
					$ok = $this->sql->request($r);
					$r2 = "SELECT * FROM larmes_items_list WHERE item_id = '".$new_item_id."'";
					$count = $this->sql->get_array($r2);
					if (empty($count))
						$this->add_loot($new_item_id);
				}
			}
		}
		$this->add_historique('Votre personnage a ?t? recharg?');
		$this->get_slots();
		return $this->valide_text('Votre personnage a bien ?t? recharg?');
	}
	
	private function refresh_perso_only(){
		$this->armory->UTF8(true);
		$this->armory->setLocale('fr_FR');
		$this->character = $this->armory->getCharacter($this->session['personnage']);
		$gears = $this->character->getGear();
		foreach ($this->user_slots as $slot){
			$slot_id = $slot['slot_id'];
			foreach ($gears as $slot_name=>$gear){
				if ($slot_name == $slot_id){
					$gems_enchant = '';
					if (isset($gear['tooltipParams']['gem0']))
						$gems_enchant .= $gear['tooltipParams']['gem0'].'_';
					if (isset($gear['tooltipParams']['gem1']))
						$gems_enchant .= $gear['tooltipParams']['gem1'].'_';
					if (isset($gear['tooltipParams']['gem2']))
						$gems_enchant .= $gear['tooltipParams']['gem2'].'_';
						if (isset($gear['tooltipParams']['gem3']))
						$gems_enchant .= $gear['tooltipParams']['gem3'].'_';
					$gems_enchant = substr($gems_enchant, 0, strlen($gems_enchant)-1).'[||]';
					if (isset($gear['tooltipParams']['enchant']))
						$gems_enchant .= $gear['tooltipParams']['enchant'];
					$new_item_id = $gear['id'];
					$r = "UPDATE larmes_user_slots SET item_id = '".$new_item_id."', gems_ench = '".$gems_enchant."' WHERE id = '".$slot['id']."' AND user_id = '".$this->id_user."'";
					$ok = $this->sql->request($r);
					$r2 = "SELECT * FROM larmes_items_list WHERE item_id = '".$new_item_id."'";
					$count = $this->sql->get_array($r2);
					if (empty($count))
						$this->add_loot($new_item_id);
				}
			}
		}
		$this->add_historique('Votre personnage a ?t? rafraichi');
		$this->get_slots();
		return $this->valide_text('Votre personnage a bien ?t? rafraichi');
	}
	
	private function delete_perso(){
		$r = "DELETE FROM larmes_user_slots WHERE user_id = '".$this->id_user."'";
		$ok = $this->sql->request($r);
		$r = "UPDATE larmes_identifiants SET user_perso = '', user_ilvl_wish = '0' WHERE user_id = '".$this->id_user."'";
		$ok = $this->sql->request($r);
		$this->add_historique('Votre personnage a ?t? supprim?');
		$_SESSION['personnage'] = '';
		$_SESSION['wish_ilvl'] = '0';
		return $this->valide_text('Votre personnage a bien ?t? supprim?');
	}
	
	private function add_historique($action){
		$r = "INSERT INTO larmes_historique VALUES ('', '".$this->id_user."', '".$action."', NOW())";
		$ok = $this->sql->request($r);
	}
	
	private function get_content_hist(){
		$return = '
			<table border="0" cellpadding="2" cellspacing="2" width="100%" class="stat_list">';
		$r = "SELECT * FROM larmes_historique WHERE user_id = '".$this->id_user."' ORDER BY id DESC LIMIT 0, 30";
		$result = $this->sql->get_array($r);
		foreach ($result as $hist){
			$date = explode(' ', $hist['date']);
			$d = explode('-', $date[0]);
			$h = explode(':', $date[1]);
			$search = array(
				0=>'head',
				1=>'neck',
				2=>'shoulder',
				3=>'back',
				4=>'chest',
				5=>'wrist',
				6=>'hands',
				7=>'waist',
				8=>'legs',
				9=>'feet',
				10=>'finger1',
				11=>'finger2',
				12=>'trinket1',
				13=>'trinket2',
				14=>'mainHand',
				15=>'offHand');
			$replace = array(
				0=>'Casque',
				1=>'Cou',
				2=>'Epaules',
				3=>'Cape',
				4=>'Torse',
				5=>'Brassards',
				6=>'Mains',
				7=>'Ceinture',
				8=>'Jambes',
				9=>'Pieds',
				10=>'Bague 1',
				11=>'Bague 2',
				12=>'Bijou 1',
				13=>'Bijou 2',
				14=>'Main principale',
				15=>'Main gauche');	
			for ($i = 0; $i < 16; $i++)
				$hist['action'] = str_replace($search[$i], $replace[$i], $hist['action']);
			$date_str = 'le '.$d[2].'/'.$d[1].'/'.$d[0].' ? '.$h[0].':'.$h[1];
			$return .= '
				<tr>
					<td align="left">'.$hist['action'].'</td>
					<td width="200" align="left">'.$date_str.'</td>
				</tr>';
		}
		$return .= '
			</table>';
		$this->loot->content_general = $return;
	}
	
	private function get_content_downs(){
		$return = '';
		$r = "SELECT * FROM larmes_down";
		$downs = $this->sql->get_array($r);
		$downs_final = array();
		foreach ($downs as $down){
			$downs_final[$down['boss_id']] = $down['down_type'];
		}
		if ($this->action_form && $this->action_form == 'modif_downs'){
			if ($this->post['hm']){
				foreach ($this->post['hm'] as $id_boss_hm=>$osef){
					$r = '';
					if ($downs_final[$id_boss_hm] && ($downs_final[$id_boss_hm] == '1' || $downs_final[$id_boss_hm] == '3'))
						$r = "UPDATE larmes_down SET down_type = '2' WHERE boss_id = '".$id_boss_hm."'";
					else if (!isset($downs_final[$id_boss_hm]))
						$r = "INSERT INTO larmes_down VALUES ('', '".$id_boss_hm."', '2')";
					if (!empty($r))
						$ok = $this->sql->request($r);
				}
			}
			if ($this->post['normal']){
				foreach ($this->post['normal'] as $id_boss=>$osef){
					$r = '';
					if (!isset($downs_final[$id_boss])){
						$r = "INSERT INTO larmes_down VALUES ('', '".$id_boss."', '1')";
					}
					if (!empty($r))
						$ok = $this->sql->request($r);
				}
			}
			foreach ($downs_final as $boss_id=>$down_type){
				$r = '';
				if ($down_type == '2' && !isset($this->post['hm'][$boss_id]))
					$r = "UPDATE larmes_down SET down_type = '1' WHERE boss_id = '".$boss_id."'";
				if ($down_type == '1' && !isset($this->post['normal'][$boss_id]))
					$r = "DELETE FROM larmes_down WHERE boss_id = '".$boss_id."'";
				if (!empty($r))
					$ok = $this->sql->request($r);
			}
			echo '<script type="text/javascript">document.location.href="index.php?page=downs&valid_modif=ok";</script>';
			exit();
		}
		if ($this->get['valid_modif'])
			$return .= $this->valide_text('Modifications enregistr?es');
		$return .= '
			<form method="post" action="index.php?page=downs">
			<input type="hidden" name="action_form" value="modif_downs" />
			<table border="0" cellpadding="2" cellspacing="2" class="stat_list">';
		foreach ($this->loot->raids as $id=>$raid){
			$return .= '
				<tr class="head_list">
					<td>'.$raid.'</td>
					<td>Normal</td>
					<td>Hard mode</td>
				</tr>';
			$next_down_n = true;
			$next_down_hm = true;
			$is_first = true;
			foreach ($this->loot->boss_by_raid[$id] as $id_boss=>$boss){
				$r = '';
				$check1 = '';
				$check2 = '';
				$style_n = '';
				$style_hm = '';
				if ($downs_final[$id_boss] == '1' || $downs_final[$id_boss] == '2' || $downs_final[$id_boss] == '3')
					$check1 = 'checked="checked"';
				if ($downs_final[$id_boss] == '2')
					$check2 = 'checked="checked"';
				if ($check1 == '' && $check2 == '' && $next_down_n === true){
					$next_down_n = false;
					$style_n = 'style="background-color:green;"';
					if (!isset($downs_final[$id_boss]))
						$r = "INSERT INTO larmes_down VALUES ('', '".$id_boss."', '0')";
				}
				if ($check2 == '' && $next_down_hm === true){
					$style_hm = 'style="background-color:green;"';
					if (!isset($downs_final[$id_boss]) || $downs_final[$id_boss] == '1' && $is_first === false && $next_down_hm === true){
						if (!isset($downs_final[$id_boss]))
							$r = "INSERT INTO larmes_down VALUES ('', '".$id_boss."', '3')";
						else
							$r = "UPDATE larmes_down SET down_type = '3' WHERE boss_id = '".$id_boss."'";
					}
					$next_down_hm = false;
				} else if ($check2 == '' && $next_down_hm === false && $check1 != ''){
					$r = "UPDATE larmes_down SET down_type = '1' WHERE  boss_id = '".$id_boss."'";
				} else if ($check2 == '' && $next_down_hm === false && $check1 == '' && $r == ''){
					$r = "DELETE FROM larmes_down WHERE boss_id = '".$id_boss."'";
				}
				if ($r != '')
					$ok = $this->sql->request($r);
				$return .= '
				<tr>
					<td>'.$boss.'</td>
					<td align="center" '.$style_n.'><input type="checkbox" name="normal['.$id_boss.']" value="1" '.$check1.' /></td>
					<td align="center" '.$style_hm.'><input type="checkbox" name="hm['.$id_boss.']" value="1" '.$check2.' /></td>
				</tr>';
				$is_first = false;
			}
		}
		$return .= '
				<tr>
					<td colspan="3" align="center"><br /><input type="submit" value="Valider les modifications" /><br /><br /></td>
				</tr>
			</table>
			</form>';
		$this->loot->content_general = $return;
	}
	
	private function get_content_attrib(){
		global $_SESSION;
		if (isset($this->post['abs']))
			$_SESSION['abs'] = $this->post['abs'];
		if (!isset($_SESSION['abs']) || $_SESSION['abs'] == false){
			if (isset($this->action) && $this->action == 'open_raid')
				$return = $this->get_players_abs();
			else
				$return = $this->open_raid();
		} else if (!isset($this->session['raid']) || $this->session['raid'] == false){
			if (isset($this->action) && $this->action == 'open_raid_conf')
				$return = $this->open_raid_confirm();
			else
				$return = $this->get_players_abs();
		} else {
			if (isset($this->action) && $this->action == 'close_raid')
				$return = $this->close_raid_confirm();
			else {
				$return = $this->close_raid();
				if (!isset($this->get['raid_id']))
					$return .= $this->chose_raid();
				else if (!isset($this->get['mode']))
					$return .= $this->chose_mode();
				else if (!isset($this->get['boss_id']))
					$return .= $this->chose_boss();
				else
					$return .= $this->get_loots_attrib();
			}
		}
		$this->loot->content_general = $return;
	}
	
	private function open_raid(){
		$return = '
			<form method="post" action="index.php?page=attrib&action=open_raid">
				<center><br /><br /><input type="submit" value="Ouvrir un raid" class="submit" /><br /><br /><br /></center>
			</form>';
		return $return;
	}
	
	private function open_raid_confirm(){
		global $_SESSION;
		$_SESSION['raid'] = $this->get_new_pass(5);
		$this->refresh_all_persos();
		return $this->close_raid().$this->chose_raid();
	}
	
	private function get_players_abs(){
		global $_SESSION;
		$r = "SELECT * FROM larmes_identifiants WHERE user_perso != '' ORDER by user_perso";
		$players = $this->sql->get_array($r);
		$return = '	<table border="0" cellspacing="5" cellpadding="0" width="100%" class="stat_list">
						<tr class="head_list">
							<td align="left">
								Etape 1 : D?finir les absences non justifi?es.
							</td>
						</tr>
						<tr>
							<td>
								<form method="post" action="index.php?page=attrib&action=open_raid_conf">
									<input type="hidden" name="abs[]" value="0" />';
		foreach ($players as $player){
			$return .= '			<input type="checkbox" name="abs[]" value="'.$player['user_id'].'" /> '.$player['user_perso'].'<br />';
		}
		$return .= '				<input type="submit" value="Valider" />
								</form>
							</td>
						</tr>
					</table>';
		return $return;
	}
	
	private function refresh_all_persos(){
		$r = "SELECT user_id, user_perso FROM larmes_identifiants WHERE user_perso != '' AND user_statut > 0";
		$users = $this->sql->get_array($r);
		$this->armory->UTF8(true);
		$this->armory->setLocale('fr_FR');
		foreach ($users as $user){
			$this->id_user = $user['user_id'];
			$r2 = "SELECT id, slot_id FROM larmes_user_slots WHERE user_id = '".$this->id_user."'";
			$slot_array = $this->sql->get_array($r2);
			$new_item_id = 0;
			$this->character = $this->armory->getCharacter($user['user_perso']);
			$gears = $this->character->getGear();
			$datas = $this->character->getData();
			$r = "UPDATE larmes_identifiants SET ilvl_moy = '".$datas['items']['averageItemLevelEquipped']."' WHERE user_id = '".$this->id_user."'";
			$ok = $this->sql->request($r);
			foreach ($gears as $slot=>$gear){
				foreach ($slot_array as $slots){
					if ($slot == $slots['slot_id']){
						$new_item_id = $gear['id'];
						$gems_enchant = '';
						if (isset($gear['tooltipParams']['gem0']))
							$gems_enchant .= $gear['tooltipParams']['gem0'].'_';
						if (isset($gear['tooltipParams']['gem1']))
							$gems_enchant .= $gear['tooltipParams']['gem1'].'_';
						if (isset($gear['tooltipParams']['gem2']))
							$gems_enchant .= $gear['tooltipParams']['gem2'].'_';
							if (isset($gear['tooltipParams']['gem3']))
							$gems_enchant .= $gear['tooltipParams']['gem3'].'_';
						$gems_enchant = substr($gems_enchant, 0, strlen($gems_enchant)-1).'[||]';
						if (isset($gear['tooltipParams']['enchant']))
							$gems_enchant .= $gear['tooltipParams']['enchant'];

						$r = "UPDATE larmes_user_slots SET item_id = '".$new_item_id."', gems_ench = '".$gems_enchant."' WHERE id = '".$slots['id']."' AND user_id = '".$this->id_user."'";
						$ok = $this->sql->request($r);
						$r = "SELECT * FROM larmes_items_list WHERE item_id = '".$new_item_id."'";
						$count = $this->sql->get_array($r);
						if (empty($count))
							$this->add_loot($new_item_id);
					}
				}
			}			
		}
	}
	
	private function close_raid(){
		$return = '
			<form method="post" action="index.php?page=attrib&action=close_raid">
				&nbsp;<input type="submit" value="Cloturer le raid" class="submit" /><br />
			</form>';
		return $return;
	}
	
	private function close_raid_confirm(){
		global $_SESSION;
		$_SESSION['raid'] = false;
		foreach ($_SESSION['abs'] as $abs){
			$r = "INSERT INTO larmes_absents VALUES ('', '".$abs."', NOW())";
			$this->sql->request($r);
		}
		$_SESSION['abs'] = false;
		return $this->open_raid();
	}
	
	private function chose_raid(){
		global $_SESSION;
		$return = '
			<table border="0" cellspacing="5" cellpadding="0" width="100%" class="stat_list">
				<tr>
					<td align="center">
						Absences non justifi?es :<br />';
		foreach ($_SESSION['abs'] as $abs){
			$r = "SELECT * FROM larmes_identifiants WHERE user_perso != '' ORDER by user_perso";
			$players = $this->sql->get_array($r);
			foreach ($players as $player){
				if ($player['user_id'] == $abs)
					$return .= $player['user_perso'].', ';
			}
		}
		$return .= '</td>
				</tr>
				<tr class="head_list">
					<td align="left">
						Etape 2 : Choisir le raid.
					</td>
				</tr>
				<tr>
					<td align="center">
						<a href="index.php?page=attrib&raid_id=0">
							<img src="styles/imgs/raid_1.jpg" />
						</a>
					</td>
				</tr>
				<tr>
					<td align="center">
						<a href="index.php?page=attrib&raid_id=1">
							<img src="styles/imgs/raid_2.jpg" />
						</a>
					</td>
				</tr>
				<tr>
					<td align="center">
						<a href="index.php?page=attrib&raid_id=2">
							<img src="styles/imgs/raid_3.jpg" />
						</a>
					</td>
				</tr>
				<tr>
					<td align="center">
						<a href="index.php?page=attrib&raid_id=3">
							<img src="styles/imgs/raid_4.jpg" />
						</a>
					</td>
				</tr>
				<tr>
					<td align="center">
						<a href="index.php?page=attrib&raid_id=4">
							<img src="styles/imgs/raid_5.jpg" />
						</a>
					</td>
				</tr>
			</table>';
		return $return;
	}
	
	private function chose_mode(){
		$raid_id = (int)$this->get['raid_id'];
		$raid_img = $raid_id + 1;
		$return = '
			<table border="0" cellspacing="5" cellpadding="0" width="100%" class="stat_list">
				<tr>
					<td align="center">
						Absences non justifi?es :<br />';
		foreach ($this->session['abs'] as $abs){
			$r = "SELECT * FROM larmes_identifiants WHERE user_perso != '' ORDER by user_perso";
			$players = $this->sql->get_array($r);
			foreach ($players as $player){
				if ($player['user_id'] == $abs)
					$return .= $player['user_perso'].', ';
			}
		}
		$return .= '</td>
				</tr>
				<tr>
					<td align="center">
						<a href="index.php?page=attrib">
							<img src="styles/imgs/raid_'.$raid_img.'.jpg" />
						</a>
					</td>
				</tr>
				<tr class="head_list">
					<td align="left">
						Etape 3 : Choisir la difficult?.
					</td>
				</tr>
				<tr>
					<td align="center">
						<a href="index.php?page=attrib&raid_id='.$raid_id.'&mode=n" style="display:block; width:90%; height:100px; margin:auto; line-height:100px; font-size:15px;">
							NORMAL
						</a>
					</td>
				</tr>
				<tr>
					<td align="center">
						<a href="index.php?page=attrib&raid_id='.$raid_id.'&mode=hm" style="display:block; width:90%; height:100px; margin:auto; line-height:100px; font-size:15px;">
							HARD MODE
						</a>
					</td>
				</tr>
			</table>';
		return $return;
	}
	
	private function chose_boss(){
		$raid_id = (int)$this->get['raid_id'];
		$raid_img = $raid_id + 1;
		$mode = $this->get['mode'];
		$cols = count($this->loot->boss_by_raid[$raid_id]);
		if ($raid_id == '3' || $raid_id == '4')
			$cols = 7;
		if ($raid_id == '0')
			$cols--;
		if ($mode == 'n')
			$mode_str = 'NORMAL';
		else
			$mode_str = 'HARD MODE';
		$return = '
			<table border="0" cellspacing="5" cellpadding="0" width="100%" class="stat_list">
				<tr>
					<td align="center">
						Absences non justifi?es :<br />';
		foreach ($this->session['abs'] as $abs){
			$r = "SELECT * FROM larmes_identifiants WHERE user_perso != '' ORDER by user_perso";
			$players = $this->sql->get_array($r);
			foreach ($players as $player){
				if ($player['user_id'] == $abs)
					$return .= $player['user_perso'].', ';
			}
		}
		$return .= '</td>
				</tr>
				<tr>
					<td align="center" colspan="'.$cols.'">
						<a href="index.php?page=attrib">
							<img src="styles/imgs/raid_'.$raid_img.'.jpg" />
						</a>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="'.$cols.'">
						<a href="index.php?page=attrib&raid_id='.$raid_id.'" style="display:block; width:90%; height:50px; margin:auto; line-height:50px; font-size:15px;">
							'.$mode_str.'
						</a>
					</td>
				</tr>
				<tr class="head_list">
					<td align="left" colspan="'.$cols.'">
						Etape 4 : Choisir le boss.
					</td>
				</tr>
				<tr>';
		$first = true;
		$i = 0;
		foreach ($this->loot->boss_by_raid[$raid_id] as $boss_id=>$boss){
			if ($boss != "Volont? de l'empereur"){
				$return .= '
						<td align="center">
							<a href="index.php?page=attrib&raid_id='.$raid_id.'&mode='.$mode.'&boss_id='.$boss_id.'">
								'.$boss.'<br /><img src="styles/imgs/boss/'.$boss_id.'.png" border="0" style="display:block;" />
							</a>
						</td>';
			} else if ($first == true){
				$first = false;
				$return .= '
						<td align="center">
							<a href="index.php?page=attrib&raid_id='.$raid_id.'&mode='.$mode.'&boss_id='.$boss_id.'">
								'.$boss.'<br /><img src="styles/imgs/boss/'.$boss_id.'.png" border="0" style="display:block;" />
							</a>
						</td>';
			}
			$i++;
			if ($i == 7 && ($raid_id == '3' || $raid_id == '4'))
				$return .= '</tr><tr>';
		}
		if ($raid_id == '3')
			$return .= '<td>&nbsp;</td>';
		$return .= '
				<tr>
			</table>';
		return $return;
	}
	
	private function get_loots_attrib(){
		$return = '';
		$raid_id = (int)$this->get['raid_id'];
		$raid_img = $raid_id + 1;
		$mode = $this->get['mode'];
		if ($mode == 'n')
			$mode_str = 'NORMAL';
		else
			$mode_str = 'HARD MODE';
		$boss_id = (int)$this->get['boss_id'];
		$boss_name = $this->loot->boss_by_raid[$raid_id][$boss_id];
		$this->loot->boss_id = $boss_id;
		$this->loot->dificulty = $mode;
		
		$this->loot->get_loots_by_boss();
		$this->loot->get_loots_by_dificulty();
		
		$temp_loots = array();
		foreach ($this->loot->loots as $loot){
			$temp_loots[$loot['item_class']][$loot['item_subclass']][] = $loot;
		}
		$this->loot->loots = $temp_loots;
		$return .= '
			<table border="0" cellspacing="5" cellpadding="0" width="100%" class="stat_list">
				<tr>
					<td align="center">
						Absences non justifi?es :<br />';
		foreach ($this->session['abs'] as $abs){
			$r = "SELECT * FROM larmes_identifiants WHERE user_perso != '' ORDER by user_perso";
			$players = $this->sql->get_array($r);
			foreach ($players as $player){
				if ($player['user_id'] == $abs)
					$return .= $player['user_perso'].', ';
			}
		}
		$return .= '</td>
				</tr>
				<tr>
					<td align="center">
						<a href="index.php?page=attrib">
							<img src="styles/imgs/raid_'.$raid_img.'.jpg" />
						</a>
					</td>
				</tr>
				<tr>
					<td align="center">
						<a href="index.php?page=attrib&raid_id='.$raid_id.'" style="display:block; width:90%; height:50px; margin:auto; line-height:50px; font-size:15px;">
							'.$mode_str.'
						</a>
					</td>
				</tr>
				<tr>
					<td align="center">
						<a href="index.php?page=attrib&raid_id='.$raid_id.'&mode='.$mode.'" style="display:block; width:90%; height:85px; margin:auto; font-size:15px;">
							'.$boss_name.'<br /><img src="styles/imgs/boss/'.$boss_id.'.png" />
						</a>
					</td>
				</tr>
				<tr class="head_list">
					<td align="left" colspan="'.$cols.'">
						Etape 5 : Attribution des loots.
					</td>
				</tr>
				<tr>
					<td style="background-color:#D1B285;">
						<div id="stuff">
						<script type="text/javascript">
							$(document).ready(function(){
								$("#search_loot").keyup(function(){
									var temp_val = $(this).val();
									$(".item_to_chose").each(function(){
										var temp_id = $(this).attr("id");
										if (temp_id){
											var temp_ind = temp_id.indexOf(temp_val);
											if (temp_ind == -1)
												$(this).css("display", "none");
											else
												$(this).css("display", "block");
										}
									});
								});
							});
						</script>
						<br />&nbsp;<span style="color:#3A2718;">Rechercher une pi?ce :</span><br />
						<input type="text" id="search_loot" class="text">';
		$return .= $this->check_if_token();
		foreach ($this->loot->loots as $classe=>$subclasses){
			foreach ($subclasses as $subclasse=>$loots){
				if ($this->loot->subclasses[$classe][$subclasse] != 'Camelotte'){
					$return .= '<div style="clear:both;">&nbsp;</div>
								<div class="item_to_chose">
									<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100">
										<tr valign="middle">
											<td align="center">'.
												$this->loot->subclasses[$classe][$subclasse].'
											</td>
										</tr>
									</table>
								</div>';
					foreach ($loots as $loot){
						$loot['item_name'] = str_replace('?', '\'', $loot['item_name']);
						$temp_name_id = str_replace ('\'', '_', $loot['item_name']);
						$temp_name_id = str_replace (' ', '_', $temp_name_id);
						$return .=	'
								<div class="item_to_chose" id="'.strtolower($temp_name_id).'" onclick="get_wich_players(\''.$loot['item_id'].'\', \''.$raid_id.'\', \''.$mode.'\', \''.$boss_id.'\');">
									<table width="100%" cellspacing="0" cellpadding="0" border="0">
										<tr>
											<td class="equipement_icon" width="56" style="width:56px; padding-left:5px;">
												<img src="'.$loot['item_img'].'" />
												<span class="frame frame_'.$loot['item_quality'].'"></span>
											</td>
											<td valign="top">
												<span style="color:#999999;">'.$loot['item_lvl'].'<br /></span>
											</td>
										</tr>
										<tr>
											<td align="center" colspan="2">
												<span class="color-'.$loot['item_quality'].'">'.$loot['item_name'].'</span>
												<br>
											</td>
										</tr>
									</table>
									<a href="#" rel="item='.$loot['item_id'].'&amp;domain=fr" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>
								</div>';
					}
				}
			}
		
		}
						
		$return .= '</div>
					</td>
				</tr>
			</table>';
		return $return;		
	}
	
	private function check_if_token(){
		$return = '';
		if (is_array($this->loot->token_by_boss[$this->loot->boss_id])){
			$r = "	SELECT * FROM larmes_items_list
					WHERE item_id IN (".implode(',', $this->loot->token_by_boss[$this->loot->boss_id]).")";
			$tokens = $this->sql->get_array($r);
			$return .= '<div style="clear:both;">&nbsp;</div>
								<div class="item_to_chose">
									<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100">
										<tr valign="middle">
											<td align="center">
												TOKENS
											</td>
										</tr>
									</table>
								</div>';
			$dif_array = array();
			foreach ($this->loot->dificulties as $k=>$dif){
				$dif_array[$k] = explode(',', $dif);
			}
			foreach ($tokens as $loot){
				$loot['item_name'] = str_replace('?', '\'', $loot['item_name']);
				$ok = false;
				if ($this->loot->dificulty == 'n' && (($loot['item_lvl'] == $dif_array[(int)$this->get['raid_id']][0]))){
					$ok = true;
				} else if ($this->loot->dificulty == 'hm' && (($loot['item_lvl'] == $dif_array[(int)$this->get['raid_id']][1]))){
					$ok = true;
				}
				if ($ok === true){
					$return .=	'	<div class="item_to_chose" onclick="get_wich_players(\''.$loot['item_id'].'\', \''.(int)$this->get['raid_id'].'\', \''.$this->loot->dificulty.'\', \''.$this->loot->boss_id.'\');">
										<table width="100%" cellspacing="0" cellpadding="0" border="0">
											<tr>
												<td class="equipement_icon" width="56" style="width:56px; padding-left:5px;">
													<img src="'.$loot['item_img'].'" />
													<span class="frame frame_'.$loot['item_quality'].'"></span>
												</td>
												<td valign="top">
													<span style="color:#999999;">'.$loot['item_lvl'].'<br /></span>
												</td>
											</tr>
											<tr>
												<td align="center" colspan="2">
													<span class="color-'.$loot['item_quality'].'">'.$loot['item_name'].'</span>
													<br>
												</td>
											</tr>
										</table>
										<a href="#" rel="item='.$loot['item_id'].'&amp;domain=fr" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>
									</div>';
				}
			}
		}
		
		return $return;
	}
	
	private function get_content_accounts(){
		$return = '';
		if ($this->action != '' || $this->action_form != ''){
			if ($this->action == 'delete' || $this->action_form == 'delete_account'){
				$this->action_form = 'delete_account';
				$more = array('id_to_delete'=>$this->get['id']);
				if (!isset($this->action_form_valide)) {
					$return .= $this->warning_text('Etes-vous s?r de vouloir supprimer ce compte utilisateur ?', true, $more);
					$r = "SELECT * FROM larmes_identifiants WHERE user_id = '".$this->get['id']."'";
					$accounts = $this->sql->get_array($r);
					$return .= '	<table border="0" cellspacing="5" cellpadding="0" width="100%" class="stat_list">
									<tr class="head_list">
										<td>ID</td>
										<td>Identifiant</td>
										<td>Email</td>
										<td>Personnage</td>
										<td>Grade</td>
										<td>Note</td>
									</tr>';
					foreach ($accounts as $account){
						$return .= '<tr>
										<td width="30" align="center">'.$account['user_id'].'</td>
										<td width="130">'.$account['user_log'].'</td>
										<td width="200">'.$account['user_mail'].'</td>
										<td width="130">'.$account['user_perso'].'</td>
										<td width="110" align="center">';
						switch ($account['user_statut']){
							case '0': $return .= 'Nouvel utilisateur'; break;
							case '1': $return .= 'Profil complet'; break;
							case '2': $return .= 'Raid Lead'; break;
							case '3': $return .= 'Administrateur'; break;
						}
						$return .= '	</td>
										<td>'.$account['user_note'].'</td>
									</tr>';
					}
					$return .= '</table>';
				} else if ($this->action_form_valide == 'oui'){
					$return .= $this->delete_account();
					$return .= $this->account_list();
				} else
					$return .= $this->account_list();
			} else if ($this->action == 'edit'){
				if ($this->action_form == 'edit_confirm')
					$this->edit_acount();
				else if ($this->action_form == 'add_confirm')
					$return = $this->create_acount();
				$id = false;
				if ($this->get['id'] != '')
					$id = $this->get['id'];
				$return .= $this->form_account($id);
			} else if ($this->action == 'see'){
				$this->id_user = $this->get['id'];
				$this->get_slots();
				$return .= $this->main_profil_admin();
			} else if ($this->action == 'refresh'){
				$this->id_user = $this->get['user_id'];
				$this->id_to_change = $this->get['id'];
				$r2 = "SELECT user_perso FROM larmes_identifiants WHERE user_id = '".$this->id_user."'";
				$r3 = "SELECT slot_id FROM larmes_user_slots WHERE id = '".$this->id_to_change."'";
				$user = $this->sql->get_array($r2);
				$slot_array = $this->sql->get_array($r3);
				$slot_id = $slot_array[0]['slot_id'];
				$name = $user[0]['user_perso'];
				$new_item_id = 0;
				$this->armory->UTF8(true);
				$this->armory->setLocale('fr_FR');
				$this->character = $this->armory->getCharacter($name);
				$gears = $this->character->getGear();
				foreach ($gears as $slot=>$gear){
					if ($slot == $slot_id){
						$new_item_id = $gear['id'];
					}
				}
				$r = "UPDATE larmes_user_slots SET item_id = '".$new_item_id."' WHERE id = '".$this->id_to_change."' AND user_id = '".$this->id_user."'";
				$ok = $this->sql->request($r);
				$r = "SELECT * FROM larmes_items_list WHERE item_id = '".$new_item_id."'";
				$count = $this->sql->get_array($r);
				if (empty($count))
					$this->add_loot($new_item_id);
				$this->get_slots();
				$return .= $this->main_profil_admin();
			}
		} else
			$return .= $this->account_list();
		$this->loot->content_general = $return;
	}
	
	private function account_list(){
		$return = '';
		if ($this->get['valid'] && $this->get['valid'] == 'ok'){
			$return .= $this->valide_text('Le compte a bien ?t? cr??/modifi?');
		}
		$r = "SELECT * FROM larmes_identifiants ORDER BY user_statut DESC, user_perso";
		$accounts = $this->sql->get_array($r);
		$return .= '<form method="post" action="index.php?page=accounts&action=edit">
						&nbsp;<input type="submit" class="submit" value="Cr?er un compte" />
					</form>';
		$return .= '<table border="0" cellspacing="5" cellpadding="0" width="100%" class="stat_list">
						<tr class="head_list">
							<td>ID</td>
							<td>Identifiant</td>
							<td>Email</td>
							<td>Personnage</td>
							<td>Grade</td>
							<td>Note</td>
							<td>Actions</td>
						</tr>';
		foreach ($accounts as $account){
			$return .= '<tr>
							<td width="30" align="center">'.$account['user_id'].'</td>
							<td width="130">'.$account['user_log'].'</td>
							<td width="200">'.$account['user_mail'].'</td>
							<td width="130">'.$account['user_perso'].'</td>
							<td width="110" align="center">';
			switch ($account['user_statut']){
				case '0': $return .= 'Nouvel utilisateur'; break;
				case '1': $return .= 'Profil complet'; break;
				case '2': $return .= 'Raid Lead'; break;
				case '3': $return .= 'Administrateur'; break;
			}
			$return .= '	</td>
							<td>'.$account['user_note'].'</td>
							<td width="100" align="center">
								<a href="index.php?page=accounts&action=see&id='.$account['user_id'].'">
									<img src="styles/imgs/See.png" height="22" />
								</a>
								<a href="index.php?page=accounts&action=edit&id='.$account['user_id'].'">
									<img src="styles/imgs/Edit.png" height="22" />
								</a>&nbsp;
								<a href="index.php?page=accounts&action=delete&id='.$account['user_id'].'">
									<img src="styles/imgs/Error.png" height="22" />
								</a>
							</td>
						</tr>';
		}
		$return .= '</table>';
		return $return;
	}
	
	private function delete_account(){
		$user_id = $this->post['id_to_delete'];
		$r1 = "DELETE FROM larmes_identifiants WHERE user_id = '".$user_id."'";
		$r2 = "DELETE FROM larmes_user_slots WHERE user_id = '".$user_id."'";
		$r3 = "DELETE FROM larmes_historique WHERE user_id = '".$user_id."'";
		$ok1 = $this->sql->request($r1);
		$ok2 = $this->sql->request($r2);
		$ok3 = $this->sql->request($r3);
		return $this->valide_text("Le compte a bien ?t? supprim?");
	}
	
	private function form_account($id = false){
		$statuts = array(
			'0'=>'Nouvel utilisateur',
			'1'=>'Profil complet',
			'2'=>'Raid Lead',
			'3'=>'Administrateur');
		$sub = 'Cr?er';
		$action = 'add_confirm';
		if ($id === false){
			$formvars = array(
				'identifiant'=>'',
				'statut'=>'0',
				'note'=>'',
				'email'=>'');
		} else {
			$r = "SELECT * FROM larmes_identifiants WHERE user_id = '".$id."'";
			$res = $this->sql->get_array($r);
			$user = $res[0];
			$formvars = array(
				'identifiant'=>$user['user_log'],
				'statut'=>$user['user_statut'],
				'note'=>$user['user_note'],
				'email'=>$user['user_mail']);
			$sub = 'Modifier';
			$action = 'edit_confirm';
		}
		$return = '	<div id="params_identifiants">
						<form style="padding:0px; margin:0px;" action="index.php?page=accounts&action=edit" method="post">
							<input type="hidden" value="'.$action.'" name="action_form">';
		if ($id !== false){
			$return .= '	<input type="hidden" name="user_id" value="'.$id.'" />';
		}
		$return .= '		<label for="identifiant">Identifiant :</label>
							<input id="identifiant" class="text" type="text" value="'.$formvars['identifiant'].'" name="identifiant" /><br />
							<label for="grade">Grade :</label>';
		if ($id !== false){
			$return .= '	<select name="statut" id="grade" class="text">';
			foreach ($statuts as $statut=>$libel){
				$return .= '		<option value="'.$statut.'" ';
				if ($formvars['statut'] == $statut)
					$return .= '			selected="selected"';
				$return .= '	>'.$libel.'</option>';
			}
			$return .= '		</select><br />';
		} else {
			$return .= '		<input type="hidden" name="statut" value="0" />
								<input type="text" name="false_statut" class="text" disabled="disabled" value="Nouvel utilisateur" /><br />';
		}
		$return .= '		<label for="note">Note personnelle:</label>
							<input id="note" class="text" type="text" value="'.$formvars['note'].'" name="note" /><br />
							<label>&nbsp;</label>
							<input class="submit" type="submit" value="'.$sub.'" />
						</form>
					</div>';
		if ($formvars['email'] != ''){
			$return .= '
					<div id="params_identifiants" style="margin-left:10px;>
						<form style="padding:0px; margin:0px;" action="index.php?page=accounts" method="post">
							<input type="hidden" value="send_identifiants" name="action_form">
							<input type="hidden" value="'.$formvars['user_id'].'" name="user_id">
							<center><input class="submit" type="submit" style="width:330px; text-align:center; height:25px; line-height:25px;" value="Renvoyer les identifiants"></center>
							<center><i>? l\'adresse '.$formvars['email'].'</i></center>
						</form>
					</div>';
		}
		return $return;
	}
	
	private function edit_acount(){
		$r = "UPDATE larmes_identifiants SET user_log = '".trim($this->post['identifiant'])."', user_note = '".trim($this->post['note'])."', user_statut = '".$this->post['statut']."' WHERE user_id = '".$this->post['user_id']."'";
		$ok = $this->sql->request($r);
		echo '<script type="text/javascript">document.location.href="index.php?page=accounts&valid=ok"</script>';
	}
	
	private function create_acount(){
		$pass = $this->get_new_pass(5);
		$r = "INSERT INTO larmes_identifiants VALUES ('', '".trim($this->post['identifiant'])."', '".$pass."', '".trim($this->post['note'])."', '', '', '0', '0', '', '')";
		$ok = $this->sql->request($r);
		$return = '	<div id="params_identifiants" style="width:100%;">
						<b>Compte cr?? !<br />
						Copiez le texte ci-dessous et envoyez-le ? la personne concern?e :</b><br /><br /><br />
						Compte cr?? sur le Raid Lead Manager.<br /><br />
						Identifiants :<br />
						Login : <strong>'.trim($this->post['identifiant']).'</strong><br />
						Mot de passe : <strong>'.$pass.'</strong><br /><br />
						<strong>N\'oubliez pas que pour utiliser ce syst?me, vous devez dans un premier temps modifier votre mot de passe et associer une adresse Email ? votre compte.<br />
						Les identifiants ne sont pas crypt?s, et donc accessible relativement facilement, prennez donc des identifiants diff?rents de ceux de votre compte BattleNet !<br /><br />
						Pour acc?der au Raid Lead Manager, cliquez sur le lien suivant : http://www.larmes-nebuleuses.fr/Portail/RLM/ .</strong>
					</div>
					<div style="clear:both; height:20px;">&nbsp;</div>';
		return $return;
	}
	
	private function get_new_pass($nb) {
		$list = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		mt_srand((double)microtime()*1000000);
		$newstring = '';
		while( strlen( $newstring )< $nb ) {
			$newstring .= $list[mt_rand(0, strlen($list)-1)];
		}
		return $newstring;
	}
	
	private function add_loot($id){
		$this->armory->UTF8(true);
		$this->armory->setLocale('fr_FR');
		$item = $this->armory->getItem($id);
		$itemdatas = $item->getData();
		$gems = (isset($itemdatas['socketInfo'])) ? serialize($itemdatas['socketInfo']['sockets']) : '';
		$gem_bonus = (isset($itemdatas['socketInfo'])) ? $itemdatas['socketInfo']['socketBonus'] : '';
		$r = "	INSERT INTO larmes_items_list 
				VALUES ('',
						'".$itemdatas['id']."',
						'".$itemdatas['itemLevel']."',
						'".$itemdatas['itemClass']."',
						'".$itemdatas['itemSubClass']."',
						'".$itemdatas['inventoryType']."',
						'".$itemdatas['maxDurability']."',
						'".$itemdatas['quality']."',
						'".$itemdatas['requiredLevel']."',
						'".$gems."',
						'".addslashes($gem_bonus)."',
						'".$itemdatas['itemSource']['sourceId']."',
						'".$itemdatas['itemSource']['sourceType']."',
						'".$itemdatas['baseArmor']."',
						'".$item->getIcon()."',
						'".utf8_decode($itemdatas['name'])."')";
		$result = $this->sql->request($r);
		foreach ($itemdatas['bonusStats'] as $stat){
			$r = "INSERT INTO larmes_items_stats VALUES ('', '".$itemdatas['id']."', '".$stat['stat']."', '".$stat['amount']."')";
			$result = $this->sql->request($r);
		}
		if (isset($itemdatas['itemSpells']) && !empty($itemdatas['itemSpells'])){
			foreach ($itemdatas['itemSpells'] as $spell){
				$r = "INSERT INTO larmes_items_spells VALUES ('', '".$itemdatas['id']."', '".utf8_decode($spell['spell']['name'])."', '".utf8_decode($spell['spell']['description'])."', '".$spell['trigger']."')";
				$result = $this->sql->request($r);
			}
		}
	}
	
	private function get_content_stats(){
		$return = '';
		$return .= $this->get_avancee_members();
		$return .= $this->get_accomplissement_members();
		$return .= $this->get_loots_by_raid_members();
		$return .= '<div style="clear:both;">&nbsp;</div>';
		$return .= $this->get_nomails_members();
		$return .= $this->get_absences_members();
		$this->loot->content_general = $return;
	}
	
	private function get_content_stats_lfr(){
		$return = '';
		$r = "SELECT user_id, user_perso FROM larmes_identifiants WHERE user_perso != '' ORDER BY user_perso";
		$users = $this->sql->get_array($r);
		$return .= '	<table border="1" width="100%">';
		$first = true;
		$normal_downs = array();
		foreach ($users as $key=>$user){
			$this->armory->UTF8(true);
			$this->armory->setLocale('fr_FR');
			$character = $this->armory->getCharacter($user['user_perso']);
			$raidprogress  = $character->getRaidStats();
			foreach ($raidprogress as $raid){
				if ($raid['id'] == '6622'){
					if ($first === true){
						$first = false;
						$return .= '
							<tr>
								<td><strong>Pseudo</strong></td>';
						for ($i = 0; $i < 12; $i++){
							$return .= '
								<td align="center"><strong>'.str_replace('?', '\'', utf8_decode($raid['bosses'][$i]['name'])).'</strong></td>';
							if ($raid['bosses'][$i]['lfrTimestamp'] != 0){
								$dif = time() - substr($raid['bosses'][$i]['lfrTimestamp'], 0, (strlen($raid['bosses'][$i]['lfrTimestamp'])-3));
								$dif = $dif / 60;
								$dif = $dif / 60;
								$dif = $dif / 24;
								$dif = $dif / 7;
								$dif = ceil($dif) + 1;
								$normal_downs[$raid['bosses'][$i]['name']] = $dif;
							} else
								$normal_downs[$raid['bosses'][$i]['name']] = 0;
						}
						$return .= '
							</tr>
							<tr>
								<td><strong>Maximum</strong></td>';
						foreach ($normal_downs as $base){
							$return .= '
								<td align="center"><strong>'.$base.'</strong></td>';
						}
						$return .= '</tr>';
					}
					$return .= '
							<tr>
								<td><strong>'.$user['user_perso'].'</strong></td>';
					for ($i = 0; $i < 12; $i++){
							$return .= '
								<td align="center" style="color:'.(($raid['bosses'][$i]['lfrKills'] < $normal_downs[$raid['bosses'][$i]['name']]) ? 'red':'green').';">'.$raid['bosses'][$i]['lfrKills'].'</td>';
					}
					$return .= '
							</tr>';
				}
			}
		}
		$return .= '	</table>';
		$this->loot->content_general = $return;
	}
	
	private function get_avancee_members(){
		$r = "SELECT us.*, i.user_perso FROM larmes_user_slots us, larmes_identifiants i WHERE us.user_id = i.user_id AND i.user_statut > 0 ORDER BY i.user_perso";
		$slots = $this->sql->get_array($r);
		$nb_by_perso = array();
		$nb_prov_by_perso = array();
		$nb_spe2_by_perso = array();
		$is_one_hand = array();
		foreach ($slots as $slot){
			if (!isset($nb_by_perso[$slot['user_perso']])){
				$nb_by_perso[$slot['user_perso']] = 0;
				$nb_prov_by_perso[$slot['user_perso']] = 0;
				$nb_spe2_by_perso[$slot['user_perso']] = 0;
			}
			if (($slot['wich_id'] != '0'))
				$nb_by_perso[$slot['user_perso']]++;
			if (($slot['wich_prov_id'] != '0'))
				$nb_prov_by_perso[$slot['user_perso']]++;
			if (($slot['wish_spe_2_id'] != '0'))
				$nb_spe2_by_perso[$slot['user_perso']]++;
			if ($slot['slot_id'] == 'mainHand'){
				$this->loot->loot_id = $slot['wich_id'];
				$loot = $this->loot->get_loot_by_id();
				if (in_array($loot['item_subclass'], $this->loot->two_hands))
					$nb_by_perso[$slot['user_perso']]++;
				
				$this->loot->loot_id = $slot['wich_prov_id'];
				$loot = $this->loot->get_loot_by_id();
				if (in_array($loot['item_subclass'], $this->loot->two_hands))
					$nb_prov_by_perso[$slot['user_perso']]++;
				
				$this->loot->loot_id = $slot['wish_spe_2_id'];
				$loot = $this->loot->get_loot_by_id();
				if (in_array($loot['item_subclass'], $this->loot->two_hands))
					$nb_spe2_by_perso[$slot['user_perso']]++;
				
			}
		}
		$return = '	<div id="stats_avancement">
						<table width="100%" border="0" cellpadding="2" cellspacing="0">
							<tr>
								<td align="center"><strong>Choix de la wish list</strong></td>
							</tr>
						</table>';
		natsort($nb_by_perso);
		$nb_by_perso = array_reverse($nb_by_perso);
		foreach ($nb_by_perso as $perso=>$nb){
			$pur = ($nb*100) / 16;
			$width = (189 / 100) * $pur;
			$return .= '<div class="global">
							<div class="perso">'.$perso.'</div>
							<div class="avancement" style="width:'.(int)$width.'px;'.(($pur < 100) ? 'background-color:orange;' : '').(($pur < 50) ? 'background-color:red;' : '').'">'.(($pur > 25) ? round($pur, 2).' %' : '').'</div>'.(($pur <= 25) ? round($pur, 2).' %' : '').'
						</div>';
		}
		$return .= '</div>';
		
		$return .= '	<div id="stats_avancement">
						<table width="100%" border="0" cellpadding="2" cellspacing="0">
							<tr>
								<td align="center"><strong>Choix de la wish list provisoire</strong></td>
							</tr>
						</table>';
		natsort($nb_prov_by_perso);
		$nb_prov_by_perso = array_reverse($nb_prov_by_perso);
		foreach ($nb_prov_by_perso as $perso=>$nb){
			$pur = ($nb*100) / 16;
			$width = (189 / 100) * $pur;
			$return .= '<div class="global">
							<div class="perso">'.$perso.'</div>
							<div class="avancement" style="width:'.(int)$width.'px;'.(($pur < 100) ? 'background-color:orange;' : '').(($pur < 50) ? 'background-color:red;' : '').'">'.(($pur > 25) ? round($pur, 2).' %' : '').'</div>'.(($pur <= 25) ? round($pur, 2).' %' : '').'
						</div>';
		}
		$return .= '</div>';
		
		$return .= '	<div id="stats_avancement">
						<table width="100%" border="0" cellpadding="2" cellspacing="0">
							<tr>
								<td align="center"><strong>Choix de la wish list sp? 2</strong></td>
							</tr>
						</table>';
		natsort($nb_spe2_by_perso);
		$nb_spe2_by_perso = array_reverse($nb_spe2_by_perso);
		foreach ($nb_spe2_by_perso as $perso=>$nb){
			$pur = ($nb*100) / 16;
			$width = (189 / 100) * $pur;
			$return .= '<div class="global">
							<div class="perso">'.$perso.'</div>
							<div class="avancement" style="width:'.(int)$width.'px;'.(($pur < 100) ? 'background-color:orange;' : '').(($pur < 50) ? 'background-color:red;' : '').'">'.(($pur > 25) ? round($pur, 2).' %' : '').'</div>'.(($pur <= 25) ? round($pur, 2).' %' : '').'
						</div>';
		}
		$return .= '</div><div style="clear:both;">&nbsp;</div>';
		return $return;
	}
	
	private function get_accomplissement_members(){
		$r = "SELECT us.*, i.user_perso FROM larmes_user_slots us, larmes_identifiants i WHERE us.user_id = i.user_id AND i.user_statut > 0 ORDER BY i.user_perso";
		$slots = $this->sql->get_array($r);
		$slots_by_perso = array();
		$total_by_perso = array();
		$is_one_hand = array();
		foreach ($slots as $slot){
			if (!isset($total_by_perso[$slot['user_perso'].'_j'])){
				$slots_by_perso[$slot['user_perso'].'_i'] = 0;
				$total_by_perso[$slot['user_perso'].'_j'] = 0;
			}
			$total_by_perso[$slot['user_perso'].'_j']++;
			if ($slot['item_id'] == $slot['wich_id'] && $slot['wich_id'] != 0){
				$slots_by_perso[$slot['user_perso'].'_i']++;
			}
		}
		$return = '	<div id="stats_accomplissement">
						<table width="100%" border="0" cellpadding="2" cellspacing="0">
							<tr>
								<td align="center"><strong>Accomplissement de la wish list</strong></td>
							</tr>
						</table>';
		natsort($slots_by_perso);
		$slots_by_perso = array_reverse($slots_by_perso);
		foreach ($slots_by_perso as $perso=>$i){
			$perso = str_replace ('_i', '', $perso);
			$purcent = ($i * 100) / $total_by_perso[$slot['user_perso'].'_j'];
			$width = (189 / 100) * $purcent;
			$return .= '<div class="global">
							<div class="perso">'.$perso.'</div>
							<div class="avancement" style="width:'.(int)$width.'px;'.(($purcent < 25) ? 'background-color:orange;' : '').(($purcent < 10) ? 'background-color:red;' : '').'">'.(($purcent > 25) ? round($purcent, 2).' %' : '').'</div>'.(($purcent <= 25) ? round($purcent, 2).' %' : '').'
						</div>';
		}
		$return .= '</div>';
		return $return;
	}
	
	private function get_nomails_members(){
		$r = "SELECT * FROM larmes_identifiants WHERE user_mail = '' OR user_perso = '' ORDER BY user_log";
		$users = $this->sql->get_array($r);
		$return = '	<div id="stats_accomplissement">
						<table width="100%" border="0" cellpadding="2" cellspacing="0">
							<tr>
								<td align="center"><strong>Profils incomplets</strong></td>
							</tr>
						</table>
						<div class="global">
							<div class="cell" style="text-align:center;">Identifiant</div>
							<div class="cell" style="text-align:center;">Personnage</div>
							<div class="cell" style="text-align:center;">Email</div>
						</div>';
		foreach ($users as $user){
			$return .= '<div class="global">
							<div class="cell">'.$user['user_log'].'</div>
							<div class="cell" style="text-align:center;">';
			if ($user['user_perso'] == '')
				$return .= '	<span style="color:red;">Aucun</span>';
			else
				$return .= '	<span style="color:green;">OK</span>';
			$return .= '	</div>
							<div class="cell" style="text-align:center;">';
			if ($user['user_mail'] == '')
				$return .= '	<span style="color:red;">Aucun</span>';
			else
				$return .= '	<span style="color:green;">OK</span>';
			$return .= '	</div>
						</div>';
		}
		$return .= '</div>';
		return $return;
	}
	
	private function get_loots_by_raid_members(){
		$return = '	<div id="stats_accomplissement">
						<table width="100%" border="0" cellpadding="2" cellspacing="0">
							<tr>
								<td align="center"><strong>Loots / Raid + Ilvl Equip?</strong></td>
							</tr>
						</table>
						<div class="global">
							<div class="cell" style="text-align:center;">Identifiant</div>
							<div class="cell" style="text-align:center;">Loots/raid</div>
							<div class="cell" style="text-align:center;">Ilvl</div>
						</div>';
		$r = "SELECT user_id, user_perso, ilvl_moy FROM larmes_identifiants WHERE user_perso != '' AND user_statut > 0 ORDER BY ilvl_moy";
		$users = $this->sql->get_array($r);
		foreach ($users as $key=>$user){
		
			/*$this->armory->UTF8(true);
			$this->armory->setLocale('fr_FR');
			$character = $this->armory->getCharacter($user['user_perso']);
			$datas = $character->getData();*/
			$ilvl = $user['ilvl_moy'];
			
			$this->id_user = $user['user_id'];
			$loots_by_raid = $this->loots_by_raid();
			$return .= '<div class="global">
							<div class="cell" style="text-align:center;">'.$user['user_perso'].'</div>
							<div class="cell" style="text-align:center;">'.$loots_by_raid.'</div>
							<div class="cell" style="text-align:center;'.(($ilvl < 540) ? 'background-color:yellow;' : '').(($ilvl < 535) ? 'background-color:orange;' : '').(($ilvl < 530) ? 'background-color:red;' : '').(($ilvl >= 540) ? 'background-color:green;' : '').'"">'.$ilvl.'</div>
						</div>';
		}
		$return .= '</div>';
		return $return;
	}
	
	private function get_absences_members(){
		$return = '';
		$r = "SELECT a.*, i.user_perso FROM larmes_absents a, larmes_identifiants i WHERE i.user_id = a.user_id AND i.user_statut > 0";
		$infos = $this->sql->get_array($r);
		$players = array();
		foreach ($infos as $info){
			if (!isset($players[$info['user_perso']]))
				$players[$info['user_perso']] = 0;
			$players[$info['user_perso']]++;
		}
		$return .= '<div id="stats_accomplissement" style="width:200px;">
						<table width="100%" border="0" cellpadding="2" cellspacing="0">
							<tr>
								<td align="center"><strong>Nombre d\'absences non justifi?es</strong></td>
							</tr>
						</table>
						<div class="global" style="width:200px;">
							<div class="cell" style="text-align:center;">Pseudo</div>
							<div class="cell" style="text-align:center;">Nombre</div>
						</div>';
		foreach ($players as $pseudo=>$nb){
			$return .= '<div class="global" style="width:200px;">
							<div class="cell" style="text-align:center;">'.$pseudo.'</div>
							<div class="cell" style="text-align:center; color:red;">'.$nb.'</div>
						</div>';
		}
		$return .= '</div>';
		return $return;
	}
	
	private function main_profil_admin(){
		$r = "SELECT * FROM larmes_identifiants WHERE user_id = '".$this->id_user."'";
		$result = $this->sql->get_array($r);
		$false_session = $result[0];
		$loots_by_raid = $this->loots_by_raid();
		$this->armory->UTF8(true);
		$this->armory->setLocale('fr_FR');
		$character = $this->armory->getCharacter($false_session['user_perso']);
		$class = utf8_decode($character->getClassName());
		$spe = $character->getActiveTalents();
		$datas = $character->getData();
		$img = $character->getProfileInsetURL();
		$professions = $character->getProfessions();
		$ilvl = $datas['items']['averageItemLevelEquipped'];
		$ilvlwish = $false_session['user_ilvl_wish'];
	
		$i = 0;
		$j = 0;
		foreach($this->user_slots as $slot){
			$j++;
			if ($slot['item_id'] == $slot['wich_id']){
				$i++;
			}
		}
		$purcent = ($i * 100) / $j;
		if ($purcent == 0)
			$span = '<span style="color:#FFFFFF;">';
		else if ($purcent < 20)
			$span = '<span style="color:#1EFF00;">';
		else if ($purcent < 40)
			$span = '<span style="color:#0081FF;">';
		else if ($purcent < 60)
			$span = '<span style="color:#C600FF;">';
		else if ($purcent >= 80)
			$span = '<span style="color:#FF8000;">';
		$purcent = $span.$purcent.'</span>';
		if ($ilvlwish == 0)
			$ilvlwish = '<span style="color:red;">Non d?fini</span>';
		else
			$ilvlwish = '<span style="color:#0081FF;">'.$ilvlwish.'</span>';
		$return = '	<div class="profil">
						<table border="0" cellpadding="0" cellspacing="5" width="100%">
							<tr valign="top">
								<td style="background-color:#D1B285; padding:5px;" width="230" >
									<span class="perso_name">'.$false_session['user_perso'].'</span>
									<img src="'.$img.'" style="display:block; border:none;"  />
									<img class="talent_img" src="http://eu.media.blizzard.com/wow/icons/36/'.$spe['spec']['icon'].'.jpg"/>
								</td>
								<td style="background-color:#D1B285; font-weight:bold; padding:10px;">
									'.$class.' '.utf8_decode($spe['spec']['name']).'<br /><br />
									Niveau d\'objet : <span style="color:#0081FF;">'.$ilvl.'</span><br />
									Niveau souhait? : '.$ilvlwish.'<br />
									Accomplissement : '.$purcent.'%<br /><br />
									Metiers :<br />';
									foreach ($professions['primary'] as $profession){
										if ($profession['rank'] >= $profession['max'])
											$return .= '<span style="color:#0081FF;">';
										else
											$return .= '<span style="color:#FFFFFF;">';
										$return .= utf8_decode($profession['name']).' : '.$profession['rank'].'/'.$profession['max'].'</span> &nbsp; ';
									}
		$return .= '			</td>
								<td style="background-color:#D1B285; font-weight:bold; padding:10px;" width="200">
									'.$loots_by_raid.' loots / raid<br /><br />
									Derniers loots obtenus : <br />
									'.$this->last_loots().'
								</td>
							</tr>
						</table>
					</div>';
		$return .= '
			<div id="stuff">
				<table border="0" align="left" cellpadding="0" cellspacing="1" bgcolor="#D1B285">
					<tr class="head_list">
						<td colspan="2">
							Equipement obtenu
						</td>
						<td>
							Equipement souhait?
						</td>
						<td>
							Etat
						</td>
					</tr>';
		$all_wishes = true;
		$wishes_lvl = array();
		foreach ($this->user_slots as $gear){
			$this->loot->loot_id = $gear['item_id'];
			$loot = $this->loot->get_loot_by_id();
			$loot['item_name'] = str_replace('?', '\'', $loot['item_name']);
			$this->loot->loot_id = $gear['wich_id'];
			$wloot = $this->loot->get_loot_by_id();
			$ok = true;
			if($gear['wich_id'] == '0'){
				$all_wishes = false;
				$wloot['item_img'] = 'styles/imgs/Warning.png';
				$wloot['item_quality'] = '1';
				$wloot['item_name'] = 'Non d?finie';
				$wloot['item_lvl'] = '0';
				if ($gear['slot_id'] == 'offHand'){
					$r = "SELECT i.item_subclass FROM larmes_user_slots s, larmes_items_list i WHERE s.slot_id = 'mainHand' AND s.user_id = '".$this->id_user."' AND s.wich_id = i.item_id";
					$result = $this->sql->get_array($r);
					if (in_array($result[0]['item_subclass'], $this->loot->two_hands)){
						$wloot['item_img'] = '';
						$wloot['item_quality'] = '1';
						$wloot['item_name'] = '';
						$wloot['item_lvl'] = '';
						$ok = false;
					}						
				}
			} else {
				$wishes_lvl[] = $wloot['item_lvl'];
			}
			$wloot['item_name'] = str_replace('?', '\'', $wloot['item_name']);
			if ($ok === false){
					$etat = '';
			} else {
				if ($gear['item_id'] == $gear['wich_id'] && $gear['wich_id'] != '0'){
					$etat = '<img src="styles/imgs/Tick.png" width="32" /><br />Equipement obtenu !';
				} else if ($gear['wich_id'] != 0){
					$etat = '<img src="styles/imgs/Error.png" width="32" /><br />Equipement non obtenu';
				} else{ 
					$etat = '<img src="styles/imgs/Warning.png" width="32" /><br />Wish list non d?finie';
				}
			}
			$return .= '
					<tr>
						<td width="40" align="center">
							<a href="index.php?page=accounts&action=refresh&id='.$gear['id'].'&user_id='.$this->id_user.'"><img src="styles/imgs/Refresh.png" width="32" /></a>
						</td>
						<td align="left" class="general" style="border:solid 1px #3A2718;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
										<img src="'.$loot['item_img'].'" />
										<span class="frame frame_'.$loot['item_quality'].'"> </span>
									</td>
									<td align="left" width="245">
										<span class="color-'.$loot['item_quality'].'">'.$loot['item_name'].'</span><br />
										<span style="color:#999999;">'.
											$loot['item_lvl'].'<br />
										</span>
									</td>
								</tr>
							</table>
							<a href="#" rel="item='.$loot['item_id'].'&amp;domain=fr" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>
						</td>
						<td align="left" class="general" style="border:solid 1px #3A2718;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
										<img src="'.$wloot['item_img'].'" />
										<span class="frame frame_'.$wloot['item_quality'].'"> </span>
									</td>
									<td align="left" width="245">
										<span class="color-'.$wloot['item_quality'].'">'.$wloot['item_name'].'</span><br />
										<span style="color:#999999;">'.
											$wloot['item_lvl'].'<br />
										</span>
									</td>
								</tr>
							</table>
							<a href="#" rel="item='.$wloot['item_id'].'&amp;domain=fr" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>
						</td>
						<td align="center" style="border:solid 1px #3A2718;">
							'.$etat.'
						</td>
					</tr>';
		}
		$w_lvl_m = 0;
		if (!empty($wishes_lvl)){
			foreach ($wishes_lvl as $lvl)
				$w_lvl_m += $lvl;
			$w_lvl_m = $w_lvl_m / count($wishes_lvl);
			$w_lvl_m = (int)$w_lvl_m;
			$r = "UPDATE larmes_identifiants SET user_ilvl_wish = '".$w_lvl_m."' WHERE user_id = '".$this->id_user."'";
			$ok = $this->sql->request($r);
			$_SESSION['wish_ilvl'] = $w_lvl_m;
		}
		$return .= '
				</table>
			</div>';
		return $return;
	}
	
	private function get_content_majs(){
		$return = '';
		if (isset($this->action_form)){
			if ($this->action_form == 'create' && trim($this->post['note']) != ''){
				$r = "INSERT INTO larmes_maj VALUES ('', '".$this->post['user_id']."', '".trim(addslashes($this->post['note']))."', NOW())";
				$ok = $this->sql->request($r);
				$return .= $this->valide_text("Votre note de mise ? jour a bien ?t? cr??e.");
			} else if ($this->action_form == 'edit' && trim($this->post['note']) != ''){
				$r = "UPDATE larmes_maj SET  maj_content = '".trim(addslashes($this->post['note']))."' WHERE maj_id = '".$this->post['id']."'";
				$ok = $this->sql->request($r);
				$return .= $this->valide_text("Votre note de mise ? jour a bien ?t? modifi?e.");
			}else if ($this->action_form == 'delete' && $this->post['action_form_valide'] == 'oui'){
				$r = "DELETE FROM larmes_maj WHERE maj_id = '".$this->post['id']."'";
				$ok = $this->sql->request($r);
				$return .= $this->valide_text("Votre note de mise ? jour a bien ?t? supprim?e.");
			}
		}
		$r = "SELECT * FROM larmes_maj ORDER BY maj_id DESC";
		$majs = $this->sql->get_array($r);
		$r = "SELECT user_log, user_id FROM larmes_identifiants WHERE user_statut = '3'";
		$users = array();
		$temp_users = $this->sql->get_array($r);
		foreach ($temp_users as $temp)
			$users[$temp['user_id']] = $temp['user_log'];
		$action = 'create';
		$value = 'Cr?er';
		$note = '';
		$more = '';
		if ($this->action != '' && $this->action == 'edit'){
			$r = "SELECT maj_content FROM larmes_maj WHERE maj_id = '".$this->get['id']."'";
			$result = $this->sql->get_array($r);
			$note = stripslashes($result[0]['maj_content']);
			$action = 'edit';
			$value = 'Modifier';
			$more = '<input type="hidden" name="id" value="'.$this->get['id'].'" />';
		} else if ($this->action != '' && $this->action == 'delete'){
			$this->action_form = 'delete';
			$return .= $this->warning_text('Etes-vous s?r de vouloir supprimer cette note ?', true, array('id'=>$this->get['id']));
		}
		$return .= '<div id="params_identifiants">
						<form style="padding:0px; margin:0px;" action="index.php?page=majs" method="post">
							<label for="note">Note de mise ? jour :</label>
							<input id="note" class="text" type="text" value="'.$note.'" name="note" /><br />
							<input type="hidden" value="'.$action.'" name="action_form">
							<input type="hidden" value="'.$this->id_user.'" name="user_id">
							'.$more.'
							<label>&nbsp;</label><input class="submit" type="submit" value="'.$value.'" />
						</form>
					</div>
					<div style="clear:both;">&nbsp;</div>
					<table border="0" align="left" cellpadding="0" cellspacing="1" class="stat_list">
						<tr class="head_list">
							<td colspan="3"> notes de mise ? jour </td>
							<td> Actions </td>
						</tr>';
		foreach ($majs as $maj){
			$date_array = explode('-', $maj['maj_date']);
			$date = $date_array[2].'/'.$date_array[1].'/'.$date_array[0];
			$return .= '<tr>
							<td>'.$users[$maj['user_id']].'</td>
							<td>'.$date.'</td>
							<td>'.stripslashes($maj['maj_content']).'</td>
							<td align="center">
								<a href="index.php?page=majs&action=edit&id='.$maj['maj_id'].'"><img src="styles/imgs/Edit.png" width="20" /></a>
								<a href="index.php?page=majs&action=delete&id='.$maj['maj_id'].'"><img src="styles/imgs/Error.png" width="20" /></a>
							</td>
						</tr>';
		}
		$return .= '</table>';
		$this->loot->content_general = $return;
	}
	
	private function get_content_import(){
		$r = "SELECT item_id FROM larmes_items_list ORDER BY item_id DESC LIMIT 0, 1";
		$result = $this->sql->get_array($r);
		$last_insert_item_id = $result[0]['item_id'];
		$this->loot->loot_id = $last_insert_item_id;
		$loot = $this->loot->get_loot_by_id();
		$return = '	<strong>Dernier objet import? :</strong>
					<div id="stuff">
						<table cellspacing="1" cellpadding="0" border="0" bgcolor="#D1B285">
							<tr>
								<td class="general" align="left" style="border:solid 1px #3A2718;">
									<table width="100%" cellspacing="0" cellpadding="0" border="0">
										<tr>
											<td class="equipement_icon" width="56" style="width:56px; padding-left:5px;">
												<img src="'.$loot['item_img'].'">
												<span class="frame frame_'.$loot['item_quality'].'"> </span>
											</td>
											<td width="245" align="left">
												<span class="color-'.$loot['item_quality'].'">'.$loot['item_name'].'</span>
												<br>
												<span style="color:#999999;">
													'.$loot['item_lvl'].'
													<br>
												</span>
											</td>
										</tr>
									</table>
									<a style="position:absolute; width:250px; height:57px; margin-top:-50px;" rel="item='.$loot['item_id'].'&domain=fr" href="#"> </a>
								</td>
							</tr>
						</table>
					</div>
					<div style="cleat:both;">
						<br />
						<span id="import_stuff" onclick="import_stuff(\''.$loot['item_id'].'\', \''.$loot['item_id'].'\', 0);">Importer de nouveaux objets</span>
						<div id="content_import">
							
						</div>
					</div>';
		$this->loot->content_general = $return;
	}
	
	private function search_player_view(){
		$return = '';
		$pseudo = trim($this->post['player_search']);
		if (empty($pseudo)){
			$return .= $this->error_text('Merci de saisir un pseudo');
			$return .= $this->main_profil_view();
		} else {
			$r = "SELECT * FROM larmes_identifiants WHERE user_perso = '".$pseudo."'";
			$result = $this->sql->get_array($r);
			if (!empty($result)){
				$this->id_user = $result[0]['user_id'];
				$this->get_slots();
				$return .= $this->main_profil_see();
			} else {
				$return .= $this->error_text('Ce personnage n\'existe pas');
				$return .= $this->main_profil_view();
			}
		}
		return $return;
	}
	private function main_profil_see(){
		$r = "SELECT * FROM larmes_identifiants WHERE user_id = '".$this->id_user."'";
		$result = $this->sql->get_array($r);
		$false_session = $result[0];

		$this->tpl_vars = array();
		$i = 0;
		$this->tpl_vars['items_list'] = '<table class="table-condensed" width="100%"><thead><th>Equipement obtenu</th><th>Equipement souhait?</th><th>Etat</th></thead>';
		$all_wishes = true;
		$wishes_lvl = array();
		foreach ($this->user_slots as $gear){
			$gems_ench = explode('[||]', $gear['gems_ench']);
			$gemmes = explode('_', $gems_ench[0]);
			$enchant = $gems_ench[1];
			$this->loot->loot_id = $gear['item_id'];
			$loot = $this->loot->get_loot_by_id();
			$loot['item_name'] = str_replace('?', '\'', $loot['item_name']);
			$this->loot->loot_id = $gear['wich_id'];
			$wloot = $this->loot->get_loot_by_id();
			$ok = true;
			if($gear['wich_id'] == '0'){
				$all_wishes = false;
				$wloot['item_img'] = 'styles/imgs/Warning.png';
				$wloot['item_quality'] = '1';
				$wloot['item_name'] = 'Non d?finie';
				$wloot['item_lvl'] = '0';
				if ($gear['slot_id'] == 'offHand'){
					$r = "SELECT i.item_subclass FROM larmes_user_slots s, larmes_items_list i WHERE s.slot_id = 'mainHand' AND s.user_id = '".$this->id_user."' AND s.wich_id = i.item_id";
					$result = $this->sql->get_array($r);
					if (in_array($result[0]['item_subclass'], $this->loot->two_hands)){
						$wloot['item_img'] = '';
						$wloot['item_quality'] = '1';
						$wloot['item_name'] = '';
						$wloot['item_lvl'] = '';
						$ok = false;
					}						
				}
			} else {
				$wishes_lvl[] = $wloot['item_lvl'];
			}
			$wloot['item_name'] = str_replace('?', '\'', $wloot['item_name']);
			if ($ok === false){
					$etat = '';
			} else {
				if ($gear['item_id'] == $gear['wich_id'] && $gear['wich_id'] != '0'){
					$etat = '<div class="panel panel-success" style="margin:0px;"><div class="panel-heading">Equipement obtenu !</div></div>';
				} else if ($gear['wich_id'] != 0){
					$etat = '<div class="panel panel-danger" style="margin:0px;"><div class="panel-heading">Equipement non obtenu</div></div>';
				} else{ 
					$etat = '<div class="panel panel-warning" style="margin:0px;"><div class="panel-heading">Wish list non d?finie</div></div>';
				}
			}
			$this->tpl_vars['items_list'] .= '
					<tr>
						<td align="left" class="general">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
										<img src="'.$loot['item_img'].'" />
									</td>
									<td>
										<span class="color-'.$loot['item_quality'].'">'.$loot['item_name'].'</span><br />
										<span style="color:#999999;">'.
											$loot['item_lvl'].'<br />
										</span>
									</td>
								</tr>
							</table>
							<a href="#" rel="item='.$loot['item_id'].'&amp;domain=fr&amp;gems='.implode(':', $gemmes).'&amp;ench='.$enchant.'" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>
						</td>
						<td align="left" class="general">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
										<img src="'.$wloot['item_img'].'" />
									</td>
									<td align="left">
										<span class="color-'.$wloot['item_quality'].'">'.$wloot['item_name'].'</span><br />
										<span style="color:#999999;">'.
											$wloot['item_lvl'].'<br />
										</span>
									</td>
								</tr>
							</table>
							<a href="#" rel="item='.$wloot['item_id'].'&amp;domain=fr" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>
						</td>
						<td align="center">
							'.$etat.'
						</td>
					</tr>';
		}
		$this->tpl_vars['items_list'] .= '</table>';
		return $this->load_template('main_profil_view', $false_session);
	}
	
	private function get_content_emails(){
		$return = '';
		$r = "SELECT COUNT(*) as nb FROM larmes_identifiants WHERE user_mail != ''";
		$count = $this->sql->get_array($r);
		if ($this->action_form != '' && $this->action_form == 'send_email'){
			$r = "SELECT user_mail, user_perso FROM larmes_identifiants WHERE user_mail != ''";
			$users = $this->sql->get_array($r);
			foreach ($users as $user){
				$this->send_mail($user);
			}
			$return .= $this->valide_text('Votre mail a bien ?t? envoy?');
		}
		$return .= '<strong>* '.$count[0]['nb'].' personnes concern?es par cet email.</strong><br /><br />
		<form method="post" action="index.php?page=emails">
			<input type="hidden" name="action_form" value="send_email" />
			<label>Titre du mail</label><input type="text" name="titre_mail" /><br />
			<label>Contenu du mail</label>
			<textarea cols="100" rows="20" name="mail_content"></textarea><br /><br />
			<label>&nbsp;</label><input type="submit" class="submit" value="Envoyer le mail" />
		</form>';
		$this->loot->content_general = $return;
	}
	
	private function send_mail($user, $not_personal = false){
		$fichier='mail_tpl.html';
		$search = array('guilde_name', 'contenu_mail');	
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Raid Lead Manager - Larmes Nebuleuses <no-reply@larmes-nebuleuses.fr>' . "\r\n";	
		$contenu = fread(fopen($fichier, "r"), filesize($fichier));
		$this->contenu_mail = '';
		if ($not_personal === false){
			$this->contenu_mail .= '<strong>'.$this->post['titre_mail'].'</strong><br /><br />';
			$this->contenu_mail .= 'Bonjour, '.$user['user_perso'].'!<br /><br />';
			$this->contenu_mail .= nl2br(stripslashes($this->post['mail_content']));
			$this->contenu_mail .= '<br /><br /><strong><u>'.$this->session['personnage'].'</u></strong><br /><br />';
			$this->contenu_mail .= '<center><a href="http://www.larmes-nebuleuses.fr/Portail/RML">Raid Lead Manager</a></center>';
			foreach ($search as $word){
				if (isset($this->{$word}))
					$contenu = str_replace('<'.$word.'>', $this->{$word}, $contenu);
			}
			mail($user['user_mail'] , $this->post['titre_mail'], $contenu, $headers);
		} else {
			$this->contenu_mail .= '<strong>'.$not_personal['titre_mail'].'</strong><br /><br />';
			$this->contenu_mail .= 'Bonjour, '.$user['user_perso'].'!<br /><br />';
			$this->contenu_mail .= stripslashes($not_personal['mail_content']);
			$this->contenu_mail .= '<br /><br /><strong><u>'.$this->session['personnage'].'</u></strong><br /><br />';
			$this->contenu_mail .= '<center><a href="http://www.larmes-nebuleuses.fr/Portail/RML">Raid Lead Manager</a></center>';
			foreach ($search as $word){
				if (isset($this->{$word}))
					$contenu = str_replace('<'.$word.'>', $this->{$word}, $contenu);
			}
			mail($user['user_mail'] , $not_personal['titre_mail'], $contenu, $headers);
		}		
	}
	
	private function get_content_calendar(){		
		$return = '';
		if ($this->action_form != '' && $this->action_form == 'add_abs'){
			if ($this->post['id']){
				$return .= $this->valide_text('Absence modifi?e');
				$r = "UPDATE larmes_calendar SET evenement_date = '".$this->post['date_debut_year']."-".$this->post['date_debut_month']."-".$this->post['date_debut_day']."', eventement_fin = '".$this->post['date_fin_year']."-".$this->post['date_fin_month']."-".$this->post['date_fin_day']."', evenement_comment = '".$this->post['player_name']."' WHERE evenement_id = '".$this->post['id']."'";
			} else {
				$return .= $this->valide_text('Absence ajout?e');
				$r = "INSERT INTO larmes_calendar VALUES('', '".$this->post['date_debut_year']."-".$this->post['date_debut_month']."-".$this->post['date_debut_day']."', '".$this->post['date_fin_year']."-".$this->post['date_fin_month']."-".$this->post['date_fin_day']."', '".$this->post['player_name']."')";
			}
			$this->sql->request($r);
		}
		if ($this->action != '' && $this->action == 'delete'){
			$other_vars = array('id'=>$this->get['id']);
			$this->action_form = 'delete';
			$return .= $this->warning_text('Etes-vous s?r de vouloir supprimer cette absence ?', true, $other_vars).'<div style="clear:both;">&nbsp;</div>';
		}
		if ($this->action_form != '' && $this->action_form == 'delete'){
			if ($this->action_form_valide == 'oui'){
				$r = "DELETE FROM larmes_calendar WHERE evenement_id = '".$this->post['id']."'";
				$this->sql->request($r);
				$return .= $this->valide_text('Absence supprim?e');
			}
		}
		$return .= Calendar(array("PREFIX" => "cal2_", "PRESERVE_URL" => false, "USE_SESSION" => true), $this);
		$r = "SELECT user_perso FROM larmes_identifiants WHERE user_perso != '' ORDER BY user_perso";
		$persos = $this->sql->get_array($r);
		$formvars = array(	'date_debut'=>'',
							'date_fin'=>'',
							'player_name'=>'');
		if ($this->action != '' && $this->action == 'change'){
			$r = "SELECT * FROM larmes_calendar WHERE evenement_id = '".$this->get['id']."'";
			$infos = $this->sql->get_array($r);
			$formvars['date_debut'] = $infos[0]['evenement_date'];
			$formvars['date_fin'] = $infos[0]['eventement_fin'];
			$formvars['player_name'] = $infos[0]['evenement_comment'];
			$formvars['id'] = $this->get['id'];
		}
		$return .= '
		<div style="clear:both;">&nbsp;</div>
		<div id="params_identifiants">
			<strong><center>Ajouter/modifier une absence</center></strong><br />
			<form method="post" action="index.php?page=calendar">
				<input type="hidden" name="action_form" value="add_abs" />';
		if ($formvars['id'])
			$return .= '<input type="hidden" name="id" value="'.$formvars['id'].'" />';
		$return .= '
				<label style="width:120px;">Personnage</label>
				<select name="player_name">';
		foreach ($persos as $perso_pseudo){
			$sel = '';
			if ($perso_pseudo['user_perso'] == $formvars['player_name'])
				$sel = 'selected="selected"';
			$return .= '<option value="'.$perso_pseudo['user_perso'].'" '.$sel.'>'.$perso_pseudo['user_perso'].'</option>';
		}
		$return .= '
				</select><br /><br />
				<label style="width:120px;">Date de d?but</label>'.$this->get_select_date('date_debut', $formvars).'<br /><br />
				<label style="width:120px;">Date de fin</label>'.$this->get_select_date('date_fin', $formvars).'<br /><br />
				<label style="width:120px;">&nbsp;</label><input type="submit" class="submit" value="Valider" />
			</form>
		</div>';
				
		$this->loot->content_general = $return;
	}
	
	private function get_content_crafts(){
		$r = "SELECT il.*, us.user_id, i.user_perso 
		FROM larmes_items_list il, larmes_user_slots us, larmes_identifiants i  
		WHERE il.item_id = us.wich_id 
		AND us.wich_id != us.item_id
		AND us.user_id = i.user_id
		AND il.source_type = 'CREATED_BY_SPELL'";
		$crafts = $this->sql->get_array($r);
		$return = '
		<div id="stuff">
		<table class="stat_list" width="100%" cellspacing="5" cellpadding="0" border="0">
			<tr class="head_list">
				<td width="150">Personnage</td>
				<td>Objet</td>
			</tr>';
		foreach ($crafts as $craft){
			$return .= '
			<tr>
				<td align="center">'.$craft['user_perso'].'</td>
				<td align="left">
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
								<img src="'.$craft['item_img'].'" />
								<span class="frame frame_'.$craft['item_quality'].'"> </span>
							</td>
							<td align="left">
								<span class="color-'.$craft['item_quality'].'">'.$craft['item_name'].'</span><br />
								<span style="color:#999999;">'.
									$craft['item_lvl'].'<br />
								</span>
							</td>
						</tr>
					</table>
					<a style="position:absolute; width:250px; height:57px; margin-top:-50px;" rel="item='.$craft['item_id'].'&domain=fr" href="#"> </a>
			</tr>';
		}
		$return .= '
		</table>
		</div>';
		$this->loot->content_general = $return;
	}
	
	private function get_select_date($name, $formvars){
		$date = explode('-', $formvars[$name]);
		$return = '<select name="'.$name.'_day">';
		for ($i = 1; $i < 32; $i++){
			$sel = '';
			if ($date[2] == $i)
				$sel = 'selected="selected"';
			$j = $i;
			if (strlen($j) < 2)
				$j = '0'.$j;
			$return .= '<option value="'.$j.'" '.$sel.'>'.$i.'</option>';
		}
		$return .= '</select>
					<select name="'.$name.'_month">';
		foreach ($this->loot->months as $key=>$month){
			$sel = '';
			if ($date[1] == $key)
				$sel = 'selected="selected"';
			$return .= '<option value="'.$key.'" '.$sel.'>'.$month.'</option>';
		}
		$return .= '</select>
					<select name="'.$name.'_year">';
		$year = date('Y');
		for ($i = $year; $i < ($year+10); $i++){
			$sel = '';
			if ($date[0] == $i)
				$sel = 'selected="selected"';
			$return .= '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
		}
		$return .= '</select>';
		//$return = '<input type="text" name="date_debut" value="'.$formvars['date_debut'].'" />';
		return $return;
	}
	
	private function add_objet_manquant(){
		$objet = trim($this->post['objet_manquant']);
		$r = "INSERT INTO larmes_objets_manquants VALUES ('', '".$objet."', '".$this->id_user."', NOW())";
		if ($ok = $this->sql->request($r))
			$this->loot->content_general = $this->valide_text('Votre demande d\'objet ? bien ?t? enregistr?e.').$this->loot->content_general;
	}
	
	private function get_content_objets_manquants(){
		$return = '';
		if ($this->action && $this->action == 'add'){
			$r = "SELECT om.*, i.user_perso, i.user_mail FROM larmes_objets_manquants om, larmes_identifiants i WHERE i.user_id = om.user_id AND om.id = '".$this->get['id']."'";
			$infos = $this->sql->get_array($r);
			if (isset($infos[0])){
				$return .= $this->valide_text('Objet ajout? et mail envoy?.');
				$user = array(	'user_perso'=>$infos[0]['user_perso'],
								'user_mail'=>$infos[0]['user_mail']);
				$not_personal = array(	'titre_mail'=>"Ajout d'un objet ? la base de donn?e",
										'mail_content'=>'Un objet a ?t? ajout? ? votre demande. Nom de l\'objet : <strong>'.$infos[0]['objet_name'].'</strong>.<br/>Cette objet est maintenant disponible dans la wish list.');
				
				$this->send_mail($user, $not_personal);
				$r = "DELETE FROM larmes_objets_manquants WHERE id = '".$this->get['id']."'";
				$this->sql->request($r);
			} else {
				$return .= $this->error_text('Une erreur c\'est produite.');
			}
		} else if ($this->action && $this->action == 'refuse'){
			$r = "SELECT om.*, i.user_perso, i.user_mail FROM larmes_objets_manquants om, larmes_identifiants i WHERE i.user_id = om.user_id AND om.id = '".$this->get['id']."'";
			$infos = $this->sql->get_array($r);
			if (isset($infos[0])){
				$return .= $this->valide_text('Objet refus? et mail envoy?.');
				$user = array(	'user_perso'=>$infos[0]['user_perso'],
								'user_mail'=>$infos[0]['user_mail']);
				$not_personal = array(	'titre_mail'=>"Refus de l'ajout d'un objet ? la base de donn?e",
										'mail_content'=>'Nom de l\'objet concern? : <strong>'.$infos[0]['objet_name'].'</strong>.<br/>Cette objet a ?t? concid?r? comme non pertinant, d?j? existant ou est introuvable. Merci de v?rifier le nom exacte de celui-ci ou d\'arr?ter de troller !!!');
				
				$this->send_mail($user, $not_personal);
				$r = "DELETE FROM larmes_objets_manquants WHERE id = '".$this->get['id']."'";
				$this->sql->request($r);
			} else {
				$return .= $this->error_text('Une erreur c\'est produite.');
			}
		}
		$r = "SELECT om.*, i.user_perso FROM larmes_objets_manquants om, larmes_identifiants i WHERE i.user_id = om.user_id ORDER BY om.id";
		$objets = $this->sql->get_array($r);
		$return .= '<table border="0" cellspacing="5" cellpadding="0" width="100%" class="stat_list">
						<tr class="head_list">
							<td>ID</td>
							<td>Date de la demande</td>
							<td>Pseudo</td>
							<td>Nom de l\'objet</td>
							<td>Actions</td>
						</tr>';
		if (!empty($objets)){
			foreach ($objets as $objet){
				$date = explode('-', $objet['date_demande']);
				$return .= '<tr>
								<td width="30" align="center">'.$objet['id'].'</td>
								<td width="130" align="center">'.$date[2].'/'.$date[1].'/'.$date[0].'</td>
								<td width="130" align="center">'.$objet['user_perso'].'</td>
								<td>'.$objet['objet_name'].'</td>
								<td><a href="index.php?page=manquants&action=add&user_id='.$objet['user_id'].'&id='.$objet['id'].'"><img src="styles/imgs/Tick.png" height="32" /></a> <a href="index.php?page=manquants&action=refuse&user_id='.$objet['user_id'].'&id='.$objet['id'].'"><img src="styles/imgs/Error.png" height="32" /></a></td>
							</tr>';
			}
		} else {
			$return .= '	<tr>
								<td colspan="5" align="center">Aucun objet manquant</td>
							</tr>';
		}
		$return .= '</table>';
		$this->loot->content_general = $return;
	}
	
	private function get_content_compare(){
		$r = "SELECT user_id FROM larmes_identifiants WHERE user_statut > 0";
		$result = $this->sql->get_array($r);
		$return = '<script type="text/javascript">';
		$return .= ' var users_id = new Array();';
		foreach ($result as $user){
			$return .= 'users_id[(users_id.length)] = \''.$user['user_id'].'\';';
		}
		$return .= '	$(document).ready(function(){
							show_user_stats(0, users_id);
						});';
		$return .= '</script>';
		$return .= '<div id="chargement_stats">Merci de patienter...</div>';
		$return .= '<div id="content_temp"></div>';
		$this->loot->content_general = $return;
	}
}
?>