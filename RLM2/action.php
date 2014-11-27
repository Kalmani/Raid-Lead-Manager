<?php
	session_start();
	include('includes/config.php');
	include('includes/class/loots.class.php');
	$loot = new loots($guilde_name);
	$action = $_POST['act'];
	switch ($action){
		case 'get_item_prov':
			$item_id = (int)$_POST['id_item'];
			
			$old_id = (int)$_POST['old_item'];
			$id_to_change = (int)$_POST['id_to_change'];
			$loot->loot_id = $item_id;
			$itemdatas = $loot->get_loot_by_id();
			$itemdatas['bonusStats'] = $loot->get_stats_by_id();
			/*$armory->UTF8(true);
			$armory->setLocale('fr_FR');
			$item = $armory->getItem($item_id);
			$itemdata = $item->getData();
			$itemdatas['bonusStats'] = $itemdata['bonusStats'];
			$old_item = $armory->getItem($old_id);
			$old_item_datas = $old_item->getData();*/
			$loot->loot_id = $old_id;
			$old_item_datas = $loot->get_loot_by_id();
			$old_item_datas['bonusStats'] = $loot->get_stats_by_id();
			$return = '<div id="stuff">
							<table border="0" align="left" cellpadding="0" cellspacing="1" bgcolor="#D1B285" width="100%">
								<tr class="head_list">
									<td> Equipement souhait? </td>
								</tr>
								<tr>
									<td align="left" class="general" style="border:solid 1px #3A2718; width:250px;">
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
													<img src="'.$itemdatas['item_img'].'" /></a>
													<span class="frame frame_'.$itemdatas['item_quality'].'"> </span>
												</td>
												<td align="left">
													<span class="color-'.$itemdatas['item_quality'].'">'.str_replace('?', '\'', $itemdatas['item_name']).'</span><br />
													<span style="color:#999999;">'.
														$itemdatas['item_lvl'].'<br />
													</span>
												</td>
											</tr>
										</table>
										<a href="#" rel="item='.$itemdatas['item_id'].'&amp;domain=fr" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>
									</td>
								</tr>
								<tr>
									<td valign="top">
										<table border="0" align="left" cellpadding="0" cellspacing="1" class="stat_list">';
					$old_finded = array();
					foreach ($itemdatas['bonusStats'] as $stat){
						$find = false;
						if (isset($old_item_datas['id'])){
							foreach ($old_item_datas['bonusStats'] as $old_stat){
								if ($stat['stat_id'] == $old_stat['stat_id']){
									$dif = $stat['stat_value'] - $old_stat['stat_value'];
									$find = true;
									$old_finded[] = $stat['stat_id'];
								}
							}
						}
						if ($find === false){
							$dif = $stat['stat_value'];
							$old_finded[] = $stat['stat_id'];
						}
						$return .= 	'		<tr>
												<td align="left" width="140">
													'.$loot->stats[$stat['stat_id']].' : 
												</td>
												<td align="center" width="90">
													'.$stat['stat_value'].' ';
						if ($dif > 0)
							$return .= '(<span style="color:#1EFF00">+'.$dif.'</span>)';
						else if ($dif < 0)
							$return .= '(<span style="color:red">'.$dif.'</span>)';
						$return .= '				
												</td>
											</tr>';
					}
					if (isset($old_item_datas['id'])){
						foreach ($old_item_datas['bonusStats'] as $old_stat){
							if (!in_array($old_stat['stat_id'], $old_finded)){
								$dif = '0 (<span style="color:red;">'.($old_stat['stat_value'] * (-1)).'</span>)';
								$return .= 	'		<tr>
														<td align="left" width="140">
															'.$loot->stats[$old_stat['stat_id']].' : 
														</td>
														<td align="center" width="90">
															'.$dif.'
														</td>
													</tr>';
							}
						}
					}
					if ($itemdatas['armor'] != 0){
						$return .= '		<tr>
												<td align="left">Armure : </td>
												<td align="center">'.$itemdatas['armor'].'</td>
											</tr>';
					}
					$return .= '		</table>
									</td>
								</tr>
							</table>
							<form method="post" action="index.php?page=wish_prov&action=change_valide&id='.$id_to_change.'">
								<input type="hidden" name="item_id" value="'.$item_id.'" />
								<center><input type="submit" value="Choisir cet objet" style="margin-top:10px;" /></center>
							</form>
							<br />
						</div>';
				echo utf8_encode($return);
		break;
		case 'get_item_spe2':
			$item_id = (int)$_POST['id_item'];
			
			$old_id = (int)$_POST['old_item'];
			$id_to_change = (int)$_POST['id_to_change'];
			$loot->loot_id = $item_id;
			$itemdatas = $loot->get_loot_by_id();
			$itemdatas['bonusStats'] = $loot->get_stats_by_id();
			/*$armory->UTF8(true);
			$armory->setLocale('fr_FR');
			$item = $armory->getItem($item_id);
			$itemdata = $item->getData();
			$itemdatas['bonusStats'] = $itemdata['bonusStats'];
			$old_item = $armory->getItem($old_id);
			$old_item_datas = $old_item->getData();*/
			$loot->loot_id = $old_id;
			$old_item_datas = $loot->get_loot_by_id();
			$old_item_datas['bonusStats'] = $loot->get_stats_by_id();
			$return = '<div id="stuff">
							<table border="0" align="left" cellpadding="0" cellspacing="1" bgcolor="#D1B285" width="100%">
								<tr class="head_list">
									<td> Equipement souhait? </td>
								</tr>
								<tr>
									<td align="left" class="general" style="border:solid 1px #3A2718; width:250px;">
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
													<img src="'.$itemdatas['item_img'].'" /></a>
													<span class="frame frame_'.$itemdatas['item_quality'].'"> </span>
												</td>
												<td align="left">
													<span class="color-'.$itemdatas['item_quality'].'">'.str_replace('?', '\'', $itemdatas['item_name']).'</span><br />
													<span style="color:#999999;">'.
														$itemdatas['item_lvl'].'<br />
													</span>
												</td>
											</tr>
										</table>
										<a href="#" rel="item='.$itemdatas['item_id'].'&amp;domain=fr" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>
									</td>
								</tr>
								<tr>
									<td valign="top">
										<table border="0" align="left" cellpadding="0" cellspacing="1" class="stat_list">';
					$old_finded = array();
					foreach ($itemdatas['bonusStats'] as $stat){
						$find = false;
						if (isset($old_item_datas['id'])){
							foreach ($old_item_datas['bonusStats'] as $old_stat){
								if ($stat['stat_id'] == $old_stat['stat_id']){
									$dif = $stat['stat_value'] - $old_stat['stat_value'];
									$find = true;
									$old_finded[] = $stat['stat_id'];
								}
							}
						}
						if ($find === false){
							$dif = $stat['stat_value'];
							$old_finded[] = $stat['stat_id'];
						}
						$return .= 	'		<tr>
												<td align="left" width="140">
													'.$loot->stats[$stat['stat_id']].' : 
												</td>
												<td align="center" width="90">
													'.$stat['stat_value'].' ';
						if ($dif > 0)
							$return .= '(<span style="color:#1EFF00">+'.$dif.'</span>)';
						else if ($dif < 0)
							$return .= '(<span style="color:red">'.$dif.'</span>)';
						$return .= '				
												</td>
											</tr>';
					}
					if (isset($old_item_datas['id'])){
						foreach ($old_item_datas['bonusStats'] as $old_stat){
							if (!in_array($old_stat['stat_id'], $old_finded)){
								$dif = '0 (<span style="color:red;">'.($old_stat['stat_value'] * (-1)).'</span>)';
								$return .= 	'		<tr>
														<td align="left" width="140">
															'.$loot->stats[$old_stat['stat_id']].' : 
														</td>
														<td align="center" width="90">
															'.$dif.'
														</td>
													</tr>';
							}
						}
					}
					if ($itemdatas['armor'] != 0){
						$return .= '		<tr>
												<td align="left">Armure : </td>
												<td align="center">'.$itemdatas['armor'].'</td>
											</tr>';
					}
					$return .= '		</table>
									</td>
								</tr>
							</table>
							<form method="post" action="index.php?page=wish_spe2&action=change_valide&id='.$id_to_change.'">
								<input type="hidden" name="item_id" value="'.$item_id.'" />
								<center><input type="submit" value="Choisir cet objet" style="margin-top:10px;" /></center>
							</form>
							<br />
						</div>';
				echo utf8_encode($return);
		break;
		case 'get_item':
			$item_id = (int)$_POST['id_item'];
			
			$old_id = (int)$_POST['old_item'];
			$id_to_change = (int)$_POST['id_to_change'];
			$loot->loot_id = $item_id;
			$itemdatas = $loot->get_loot_by_id();
			$itemdatas['bonusStats'] = $loot->get_stats_by_id();
			$loot->loot_id = $old_id;
			$old_item_datas = $loot->get_loot_by_id();
			$old_item_datas['bonusStats'] = $loot->get_stats_by_id();
			$return = '
							<table border="0" align="left" cellpadding="0" cellspacing="1" bgcolor="#D1B285" width="100%">
								<tr>
									<td align="left" class="general">
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td width="56" class="equipement_icon" style="width:56px; padding-left:5px;">
													<img src="'.$itemdatas['item_img'].'" /></a>
													<span class="frame frame_'.$itemdatas['item_quality'].'"> </span>
												</td>
												<td align="left">
													<span class="color-'.$itemdatas['item_quality'].'">'.str_replace('?', '\'', $itemdatas['item_name']).'</span><br />
													<span style="color:#999999;">'.
														$itemdatas['item_lvl'].'<br />
													</span>
												</td>
											</tr>
										</table>
										<a href="#" rel="item='.$itemdatas['item_id'].'&amp;domain=fr" style="position:absolute; width:250px; height:57px; margin-top:-50px;">&nbsp;</a>
									</td>
								</tr>
								<tr>
									<td valign="top">
										<br />
										<table class="table table-striped table-condensed">';
					$old_finded = array();
					foreach ($itemdatas['bonusStats'] as $stat){
						$find = false;
						if (isset($old_item_datas['id'])){
							foreach ($old_item_datas['bonusStats'] as $old_stat){
								if ($stat['stat_id'] == $old_stat['stat_id']){
									$dif = $stat['stat_value'] - $old_stat['stat_value'];
									$find = true;
									$old_finded[] = $stat['stat_id'];
								}
							}
						}
						if ($find === false){
							$dif = $stat['stat_value'];
							$old_finded[] = $stat['stat_id'];
						}
						$return .= 	'		<tr>
												<td align="left" width="140">
													'.$loot->stats[$stat['stat_id']].' : 
												</td>
												<td align="center" width="90">
													'.$stat['stat_value'].' ';
						if ($dif > 0)
							$return .= '(<span style="color:#1EFF00">+'.$dif.'</span>)';
						else if ($dif < 0)
							$return .= '(<span style="color:red">'.$dif.'</span>)';
						$return .= '				
												</td>
											</tr>';
					}
					if (isset($old_item_datas['id'])){
						foreach ($old_item_datas['bonusStats'] as $old_stat){
							if (!in_array($old_stat['stat_id'], $old_finded)){
								$dif = '0 (<span style="color:red;">'.($old_stat['stat_value'] * (-1)).'</span>)';
								$return .= 	'		<tr>
														<td align="left" width="140">
															'.$loot->stats[$old_stat['stat_id']].' : 
														</td>
														<td align="center" width="90">
															'.$dif.'
														</td>
													</tr>';
							}
						}
					}
					if ($itemdatas['armor'] != 0){
						$return .= '		<tr>
												<td align="left">Armure : </td>
												<td align="center">'.$itemdatas['armor'].'</td>
											</tr>';
					}
					$return .= '		</table>
									</td>
								</tr>
							</table>
							<form method="post" action="index.php?page=wish&action=change_valide&id='.$id_to_change.'">
								<input type="hidden" name="item_id" value="'.$item_id.'" />
								<center><button type="submit" class="btn btn-success form-control">Choisir cet objet</button></center>
							</form>';
				echo utf8_encode($return);
		break;
		case 'get_item_wish':
			$item_id = (int)$_POST['id_item'];
			$loot->loot_id = $item_id;
			$itemdatas = $loot->get_loot_by_id();
			$itemfoud = $loot->get_loot_foudroyant($itemdatas);
			$raid_id = (int)$_POST['raid_id'];
			$mode = $_POST['mode'];
			$boss_id = (int)$_POST['boss_id'];
			$slot_name = '';
			$players = $loot->get_interested_players($boss_id);
			$players_prov = $loot->get_interested_players_prov($boss_id);
			$players_spe2 = $loot->get_interested_players_spe2($boss_id);
			echo '<legend style="color:#3A2718;">Joueur(s) interess&eacute;(s) :</legend>';
			echo '<table border="1" cellpadding="2" cellspacing="0" width="100%" style="font-weight:bold; margin-bottom:5px;">
					<tr>
						<td align="center" width="34%" style="cursor:pointer;" onclick="javascript:show_players(\'bis\');">BIS</td>
						<td align="center" width="33%" style="cursor:pointer;" onclick="javascript:show_players(\'prov\');">Provisoir</td>
						<td align="center" width="33%" style="cursor:pointer;" onclick="javascript:show_players(\'spe2\');">Sp&eacute; 2</td>
					</tr>
				  </table>';
			echo '<div id="players_bis">';
			if (!empty($players)){
				foreach ($players as $player){
					$is_switchable = false;
					$slot_name = $player['slot_id'];
					if ($slot_name == 'trinket1' || $slot_name == 'trinket2' || $slot_name == 'finger1' || $slot_name == 'finger2'){
						$is_switchable = true;
						$slot_base = substr($slot_name, 0, (strlen($slot_name)-1));
						$two_slots = $loot->get_two_slots($slot_base, $player['user_id']);
						$already_has = $loot->check_other_slot($slot_base, $player['user_id'], $item_id);
					}
					if (($is_switchable === true && $already_has === false) || $is_switchable === false){
						$loot->loot_id = $player['item_id'];
						$itemdatas = $loot->get_loot_by_id();
						$player_infos = $loot->get_infos_player($player['user_id']);
						$slots = $loot->get_player_slots($player['user_id']);
						$ilvl = $player_infos[0]['ilvl_moy'];
						$i = 0;
						$j = 0;
						foreach($slots as $slot){
							$j++;
							if ($slot['item_id'] == $slot['wich_id'] && $slot['wich_id'] != 0){
								$i++;
							}
						}
						$purcent = ($i * 100) / $j;
						echo '	<table id="inter_players" cellpadding="2" cellspacing="0" border="0" width="100%" style="border:solid 2px #FFF;">';
						echo '
								<tr>
									<td align="center" rowspan="2" style="border-right:solid 2px #FFF; border-bottom:solid 2px #FFF;">
										<strong><span class="color_class_'.$player_infos[0]['perso_class'].'">'.utf8_encode($player_infos[0]['user_perso']).'</span></strong>
									</td>
									<td align="center" width="50" style=" border-right:solid 2px #FFF;">
										<strong>MOYEN</strong>
									</td>
									<td align="center" width="50" style=" border-right:solid 2px #FFF;">
										<strong>&Eacute;QUIP&Eacute;</strong>
									</td>
									<td align="center" width="70" style=" border-right:solid 2px #FFF;">
										<strong>LOOTS/RAID</strong>
									</td>
									<td align="center" width="55">
										<strong>'.(($purcent == 0) ? '<span style="color:red;">' : '').'ACCOMP.'.(($purcent == 0) ? '</span>' : '').'</strong>
									</td>
								</tr>
								<tr>
									<td align="center" style="border-bottom:solid 2px #FFF; border-right:solid 2px #FFF;">'.$ilvl.'</td>
									<td align="center" style="border-bottom:solid 2px #FFF; border-right:solid 2px #FFF;">'.$itemdatas['item_lvl'].'</td>
									<td align="center" style="border-bottom:solid 2px #FFF; border-right:solid 2px #FFF;">'.$player['loots_by_raid'].'</td>
									<td align="center" style="border-bottom:solid 2px #FFF;">'.(($purcent == 0) ? '<span style="color:red;">' : '').$purcent.'%'.(($purcent == 0) ? '</span>' : '').'</td>
								</tr>';
						if ($is_switchable === true){
							echo '<tr>
									<td colspan="5" style="border-bottom:solid 2px #FFF;">
										<div id="stuff" style="margin:auto; width:216px;">';
							$two_id = 1;
							foreach ($two_slots as $two_slot){
								$loot->loot_id = $two_slot['item_id'];
								$loot_temp = $loot->get_loot_by_id();
								$loot_temp['item_name'] = str_replace('?', '\'', $loot_temp['item_name']);
								echo '		<div class="item_to_chose" id="two_choices_'.$player['user_id'].'_'.$two_id.'" style="height:50px; width:100px;" onclick="get_choice_players(\''.$loot_temp['item_id'].'\', \''.$two_id.'\', \''.$two_slot['id'].'\', \''.$player['user_id'].'\');">
												<table width="100%" cellspacing="0" cellpadding="0" border="0">
													<tr>
														<td class="equipement_icon" width="56" style="width:56px; padding-left:5px;">
															<img src="'.$loot_temp['item_img'].'" />
															<span class="frame frame_'.$loot_temp['item_quality'].'"></span>
														</td>
														<td valign="top">
															<span style="color:#999999;">'.$loot_temp['item_lvl'].'<br /></span>
														</td>
													</tr>
												</table>
												<a href="#" rel="item='.$loot_temp['item_id'].'&amp;domain=fr" style="position:absolute; width:100px; height:57px; margin-top:-50px;">&nbsp;</a>
											</div>';
								$two_id++;
							}
							echo '		</div>
									</td>
								</tr>';
						}
						echo '	<tr>
									<td colspan="5" align="center">
										<form method="post" id="form_to_change_1_'.$player['user_id'].'" action="index.php?page=wish&action=change_valide_getting&id='.$player['id'].'">
											<input type="hidden" name="item_id" value="'.$player['wich_id'].'">
											<input type="hidden" name="mode" value="'.$mode.'">
											<input type="hidden" name="boss_id" value="'.$boss_id.'">
											<input type="hidden" name="raid_id" value="'.$raid_id.'">
											<input type="hidden" name="force_user_id" value="'.$player['user_id'].'">
											<input type="submit" value="Attribuer &agrave; '.utf8_encode($player_infos[0]['user_perso']).'" style="margin-top:1px;">
										</form>';
						if ($itemfoud != false){
							echo '
										<form method="post" id="form_to_change_2_'.$player['user_id'].'" action="index.php?page=wish&action=change_valide_getting&id='.$player['id'].'">
											<input type="hidden" name="item_id" value="'.$itemfoud['item_id'].'">
											<input type="hidden" name="mode" value="'.$mode.'">
											<input type="hidden" name="boss_id" value="'.$boss_id.'">
											<input type="hidden" name="raid_id" value="'.$raid_id.'">
											<input type="hidden" name="force_user_id" value="'.$player['user_id'].'">
											<input type="submit" value="Attribuer &agrave; '.utf8_encode($player_infos[0]['user_perso']).' (Foudroyant)" style="margin-top:1px;">
										</form>';
						}
						echo '		</td>
								</tr>';
						echo '	</table><br />';
					}
				}
			} else {
				echo 'Aucun';
				$loot->loot_id = $item_id;
				$itemdatas = $loot->get_loot_by_id();
				$r = "	SELECT us.slot_id 
						FROM larmes_user_slots us, larmes_items_list il 
						WHERE us.item_id = il.item_id 
						AND il.item_class = '".$itemdatas['item_class']."'
						AND il.item_subclass = '".$itemdatas['item_subclass']."' 
						AND il.item_type = '".$itemdatas['item_type']."'
						AND il.item_id != '".$itemdatas['item_id']."'
						LIMIT 0, 1";
				$result = $loot->get_item_slot($r);
				$slot_name = $result[0]['slot_id'];
			}
			echo '</div>';
			
			
			echo '<div id="players_prov" style="display:none;">';
			if (!empty($players_prov)){
				foreach ($players_prov as $player){
					$is_switchable = false;
					$slot_name = $player['slot_id'];
					if ($slot_name == 'trinket1' || $slot_name == 'trinket2' || $slot_name == 'finger1' || $slot_name == 'finger2'){
						$is_switchable = true;
						$slot_base = substr($slot_name, 0, (strlen($slot_name)-1));
						$two_slots = $loot->get_two_slots($slot_base, $player['user_id']);
						$already_has = $loot->check_other_slot($slot_base, $player['user_id'], $item_id);
					}
					if (($is_switchable === true && $already_has === false) || $is_switchable === false){
						$loot->loot_id = $player['item_id'];
						$itemdatas = $loot->get_loot_by_id();
						$player_infos = $loot->get_infos_player($player['user_id']);
						$slots = $loot->get_player_slots($player['user_id']);
						$ilvl = $player_infos[0]['ilvl_moy'];
						$i = 0;
						$j = 0;
						foreach($slots as $slot){
							$j++;
							if ($slot['item_id'] == $slot['wich_id'] && $slot['wich_id'] != 0){
								$i++;
							}
						}
						$purcent = ($i * 100) / $j;
						echo '	<table id="inter_players" cellpadding="2" cellspacing="0" border="0" width="100%" style="border:solid 2px #FFF;">';
						echo '
								<tr>
									<td align="center" rowspan="2" style="border-right:solid 2px #FFF; border-bottom:solid 2px #FFF;">
										<strong><span class="color_class_'.$player_infos[0]['perso_class'].'">'.utf8_encode($player_infos[0]['user_perso']).'</span></strong>
									</td>
									<td align="center" width="50" style=" border-right:solid 2px #FFF;">
										<strong>MOYEN</strong>
									</td>
									<td align="center" width="50" style=" border-right:solid 2px #FFF;">
										<strong>&Eacute;QUIP&Eacute;</strong>
									</td>
									<td align="center" width="70" style=" border-right:solid 2px #FFF;">
										<strong>LOOTS/RAID</strong>
									</td>
									<td align="center" width="55">
										<strong>'.(($purcent == 0) ? '<span style="color:red;">' : '').'ACCOMP.'.(($purcent == 0) ? '</span>' : '').'</strong>
									</td>
								</tr>
								<tr>
									<td align="center" style="border-bottom:solid 2px #FFF; border-right:solid 2px #FFF;">'.$ilvl.'</td>
									<td align="center" style="border-bottom:solid 2px #FFF; border-right:solid 2px #FFF;">'.$itemdatas['item_lvl'].'</td>
									<td align="center" style="border-bottom:solid 2px #FFF; border-right:solid 2px #FFF;">'.$player['loots_by_raid'].'</td>
									<td align="center" style="border-bottom:solid 2px #FFF;">'.(($purcent == 0) ? '<span style="color:red;">' : '').$purcent.'%'.(($purcent == 0) ? '</span>' : '').'</td>
								</tr>';
						if ($is_switchable === true){
							echo '<tr>
									<td colspan="5" style="border-bottom:solid 2px #FFF;">
										<div id="stuff" style="margin:auto; width:216px;">';
							$two_id = 1;
							foreach ($two_slots as $two_slot){
								$loot->loot_id = $two_slot['item_id'];
								$loot_temp = $loot->get_loot_by_id();
								$loot_temp['item_name'] = str_replace('?', '\'', $loot_temp['item_name']);
								echo '		<div class="item_to_chose" id="two_choices_'.$player['user_id'].'_'.$two_id.'" style="height:50px; width:100px;" onclick="get_choice_players(\''.$loot_temp['item_id'].'\', \''.$two_id.'\', \''.$two_slot['id'].'\', \''.$player['user_id'].'\');">
												<table width="100%" cellspacing="0" cellpadding="0" border="0">
													<tr>
														<td class="equipement_icon" width="56" style="width:56px; padding-left:5px;">
															<img src="'.$loot_temp['item_img'].'" />
															<span class="frame frame_'.$loot_temp['item_quality'].'"></span>
														</td>
														<td valign="top">
															<span style="color:#999999;">'.$loot_temp['item_lvl'].'<br /></span>
														</td>
													</tr>
												</table>
												<a href="#" rel="item='.$loot_temp['item_id'].'&amp;domain=fr" style="position:absolute; width:100px; height:57px; margin-top:-50px;">&nbsp;</a>
											</div>';
								$two_id++;
							}
							echo '		</div>
									</td>
								</tr>';
						}
						echo '	<tr>
									<td colspan="5" align="center">
										<form method="post" id="form_to_change_1_'.$player['user_id'].'" action="index.php?page=wish&action=change_valide_getting_prov&id='.$player['id'].'">
											<input type="hidden" name="item_id" value="'.$player['wich_prov_id'].'">
											<input type="hidden" name="mode" value="'.$mode.'">
											<input type="hidden" name="boss_id" value="'.$boss_id.'">
											<input type="hidden" name="raid_id" value="'.$raid_id.'">
											<input type="hidden" name="force_user_id" value="'.$player['user_id'].'">
											<input type="submit" value="Attribuer &agrave; '.utf8_encode($player_infos[0]['user_perso']).'" style="margin-top:1px;">
										</form>';
						if ($itemfoud != false){
							echo '
										<form method="post" id="form_to_change_2_'.$player['user_id'].'" action="index.php?page=wish&action=change_valide_getting_prov&id='.$player['id'].'">
											<input type="hidden" name="item_id" value="'.$itemfoud['item_id'].'">
											<input type="hidden" name="mode" value="'.$mode.'">
											<input type="hidden" name="boss_id" value="'.$boss_id.'">
											<input type="hidden" name="raid_id" value="'.$raid_id.'">
											<input type="hidden" name="force_user_id" value="'.$player['user_id'].'">
											<input type="submit" value="Attribuer &agrave; '.utf8_encode($player_infos[0]['user_perso']).' (Foudroyant)" style="margin-top:1px;">
										</form>';
						}
						echo '		</td>
								</tr>';
						echo '	</table><br />';
					}
				}
			} else {
				echo 'Aucun';
				$loot->loot_id = $item_id;
				$itemdatas = $loot->get_loot_by_id();
				$r = "	SELECT us.slot_id 
						FROM larmes_user_slots us, larmes_items_list il 
						WHERE us.item_id = il.item_id 
						AND il.item_class = '".$itemdatas['item_class']."'
						AND il.item_subclass = '".$itemdatas['item_subclass']."' 
						AND il.item_type = '".$itemdatas['item_type']."'
						AND il.item_id != '".$itemdatas['item_id']."'
						LIMIT 0, 1";
				$result = $loot->get_item_slot($r);
				$slot_name = $result[0]['slot_id'];
			}
			echo '</div>';
			
			
			echo '<div id="players_spe2" style="display:none;">';
			if (!empty($players_spe2)){
				foreach ($players_spe2 as $player){
					$is_switchable = false;
					$slot_name = $player['slot_id'];
					if ($slot_name == 'trinket1' || $slot_name == 'trinket2' || $slot_name == 'finger1' || $slot_name == 'finger2'){
						$is_switchable = true;
						$slot_base = substr($slot_name, 0, (strlen($slot_name)-1));
						$two_slots = $loot->get_two_slots($slot_base, $player['user_id']);
						$already_has = $loot->check_other_slot($slot_base, $player['user_id'], $item_id);
					}
					if (($is_switchable === true && $already_has === false) || $is_switchable === false){
						$loot->loot_id = $player['item_id'];
						$itemdatas = $loot->get_loot_by_id();
						$player_infos = $loot->get_infos_player($player['user_id']);
						$slots = $loot->get_player_slots($player['user_id']);
						$ilvl = $player_infos[0]['ilvl_moy'];
						$i = 0;
						$j = 0;
						foreach($slots as $slot){
							$j++;
							if ($slot['item_id'] == $slot['wich_id'] && $slot['wich_id'] != 0){
								$i++;
							}
						}
						$purcent = ($i * 100) / $j;
						echo '	<table id="inter_players" cellpadding="2" cellspacing="0" border="0" width="100%" style="border:solid 2px #FFF;">';
						echo '
								<tr>
									<td align="center" rowspan="2" style="border-right:solid 2px #FFF; border-bottom:solid 2px #FFF;">
										<strong><span class="color_class_'.$player_infos[0]['perso_class'].'">'.utf8_encode($player_infos[0]['user_perso']).'</span></strong>
									</td>
									<td align="center" width="50" style=" border-right:solid 2px #FFF;">
										<strong>MOYEN</strong>
									</td>
									<td align="center" width="50" style=" border-right:solid 2px #FFF;">
										<strong>&Eacute;QUIP&Eacute;</strong>
									</td>
									<td align="center" width="70" style=" border-right:solid 2px #FFF;">
										<strong>LOOTS/RAID</strong>
									</td>
									<td align="center" width="55">
										<strong>'.(($purcent == 0) ? '<span style="color:red;">' : '').'ACCOMP.'.(($purcent == 0) ? '</span>' : '').'</strong>
									</td>
								</tr>
								<tr>
									<td align="center" style="border-bottom:solid 2px #FFF; border-right:solid 2px #FFF;">'.$ilvl.'</td>
									<td align="center" style="border-bottom:solid 2px #FFF; border-right:solid 2px #FFF;">'.$itemdatas['item_lvl'].'</td>
									<td align="center" style="border-bottom:solid 2px #FFF; border-right:solid 2px #FFF;">'.$player['loots_by_raid'].'</td>
									<td align="center" style="border-bottom:solid 2px #FFF;">'.(($purcent == 0) ? '<span style="color:red;">' : '').$purcent.'%'.(($purcent == 0) ? '</span>' : '').'</td>
								</tr>';
						if ($is_switchable === true){
							echo '<tr>
									<td colspan="5" style="border-bottom:solid 2px #FFF;">
										<div id="stuff" style="margin:auto; width:216px;">';
							$two_id = 1;
							foreach ($two_slots as $two_slot){
								$loot->loot_id = $two_slot['item_id'];
								$loot_temp = $loot->get_loot_by_id();
								$loot_temp['item_name'] = str_replace('?', '\'', $loot_temp['item_name']);
								echo '		<div class="item_to_chose" id="two_choices_'.$player['user_id'].'_'.$two_id.'" style="height:50px; width:100px;" onclick="get_choice_players(\''.$loot_temp['item_id'].'\', \''.$two_id.'\', \''.$two_slot['id'].'\', \''.$player['user_id'].'\');">
												<table width="100%" cellspacing="0" cellpadding="0" border="0">
													<tr>
														<td class="equipement_icon" width="56" style="width:56px; padding-left:5px;">
															<img src="'.$loot_temp['item_img'].'" />
															<span class="frame frame_'.$loot_temp['item_quality'].'"></span>
														</td>
														<td valign="top">
															<span style="color:#999999;">'.$loot_temp['item_lvl'].'<br /></span>
														</td>
													</tr>
												</table>
												<a href="#" rel="item='.$loot_temp['item_id'].'&amp;domain=fr" style="position:absolute; width:100px; height:57px; margin-top:-50px;">&nbsp;</a>
											</div>';
								$two_id++;
							}
							echo '		</div>
									</td>
								</tr>';
						}
						echo '	<tr>
									<td colspan="5" align="center">
										<form method="post" id="form_to_change_1_'.$player['user_id'].'" action="index.php?page=wish&action=change_valide_getting_spe2&id='.$player['id'].'">
											<input type="hidden" name="item_id" value="'.$player['wish_spe_2_id'].'">
											<input type="hidden" name="mode" value="'.$mode.'">
											<input type="hidden" name="boss_id" value="'.$boss_id.'">
											<input type="hidden" name="raid_id" value="'.$raid_id.'">
											<input type="hidden" name="force_user_id" value="'.$player['user_id'].'">
											<input type="submit" value="Attribuer &agrave; '.utf8_encode($player_infos[0]['user_perso']).'" style="margin-top:1px;">
										</form>';
						if ($itemfoud != false){
							echo '
										<form method="post" id="form_to_change_2_'.$player['user_id'].'" action="index.php?page=wish&action=change_valide_getting_spe2&id='.$player['id'].'">
											<input type="hidden" name="item_id" value="'.$itemfoud['item_id'].'">
											<input type="hidden" name="mode" value="'.$mode.'">
											<input type="hidden" name="boss_id" value="'.$boss_id.'">
											<input type="hidden" name="raid_id" value="'.$raid_id.'">
											<input type="hidden" name="force_user_id" value="'.$player['user_id'].'">
											<input type="submit" value="Attribuer &agrave; '.utf8_encode($player_infos[0]['user_perso']).' (Foudroyant)" style="margin-top:1px;">
										</form>';
						}
						echo '		</td>
								</tr>';
						echo '	</table><br />';
					}
				}
			} else {
				echo 'Aucun';
				$loot->loot_id = $item_id;
				$itemdatas = $loot->get_loot_by_id();
				$r = "	SELECT us.slot_id 
						FROM larmes_user_slots us, larmes_items_list il 
						WHERE us.item_id = il.item_id 
						AND il.item_class = '".$itemdatas['item_class']."'
						AND il.item_subclass = '".$itemdatas['item_subclass']."' 
						AND il.item_type = '".$itemdatas['item_type']."'
						AND il.item_id != '".$itemdatas['item_id']."'
						LIMIT 0, 1";
				$result = $loot->get_item_slot($r);
				$slot_name = $result[0]['slot_id'];
			}
			echo '</div>';
			
			
			
			
			
			$all_players = $loot->get_all_players($slot_name);
			echo '	<script type="text/javascript">
						var players_id = new Array();
						var i = 0;
					</script>';
			foreach ($all_players as $pl){
				echo '<script type="text/javascript">
						players_id[i] = new Array();
						players_id[i][\'user_id\'] = \''.$pl['user_id'].'\';
						players_id[i][\'id\'] = \''.$pl['id'].'\';
						i++;
					</script>';
			}
			echo $loot->get_all_players_attrib($itemfoud);
			echo '<img src="styles/imgs/Error.png" onclick="close_box();" width="40" style="display:block;position:absolute;cursor:pointer; top:2px; right:0px;" />';
		break;
		case 'get_stats_array':
			if ($_POST['id_user'] == $_SESSION['id_user']){
				$r_perso = "SELECT user_perso FROM larmes_identifiants WHERE user_id = '".$_SESSION['id_user']."'";
				$perso = $loot->get_array_action($r_perso);
				$r = "SELECT item_id FROM larmes_user_slots WHERE user_id = '".$_SESSION['id_user']."'";
				$result = $loot->get_array_action($r);
				$stats = array();
				foreach ($result as $slot){
					$r = "SELECT stat_id, stat_value FROM larmes_items_stats WHERE item_id = '".$slot['item_id']."'";
					$result_stats = $loot->get_array_action($r);
					foreach ($result_stats as $stat){
						if (!$stats[$stat['stat_id']])
							$stats[$stat['stat_id']] = 0;
						$stats[$stat['stat_id']] += $stat['stat_value'];
					}
				}
				echo '<table border="0" cellpadding="0" cellspacing="2" class="stats_compare" style="border:solid 2px #FF0000;">
						<tr>
							<td colspan="2" class="stat_value">'.utf8_encode($perso[0]['user_perso']).'</td>
						</tr>';
				foreach ($loot->stats as $stat_id=>$stat_name){
					if ($stat_id != 35 && $stat_id != 57){
						echo '<tr>
									<td class="stat_name">'.utf8_encode($stat_name).'</td>
									<td class="stat_value">';
						if ($stats[$stat_id])
							echo		$stats[$stat_id];
						else
							echo '0';
						echo '		</td>
								  </tr>';
					}
				}
				echo '</table>';
			} else {
				$r_perso = "SELECT user_perso FROM larmes_identifiants WHERE user_id = '".$_POST['id_user']."'";
				$perso = $loot->get_array_action($r_perso);
				$r = "SELECT perso_class FROM larmes_identifiants WHERE user_id = '".$_POST['id_user']."'";
				$result = $loot->get_array_action($r);
				$r = "SELECT perso_class FROM larmes_identifiants WHERE user_id = '".$_SESSION['id_user']."'";
				$result2 = $loot->get_array_action($r);
				if ($result[0]['perso_class'] == $result2[0]['perso_class']){
					$r = "SELECT item_id FROM larmes_user_slots WHERE user_id = '".$_POST['id_user']."'";
					$result = $loot->get_array_action($r);
					$stats = array();
					foreach ($result as $slot){
						$r = "SELECT stat_id, stat_value FROM larmes_items_stats WHERE item_id = '".$slot['item_id']."'";
						$result_stats = $loot->get_array_action($r);
						foreach ($result_stats as $stat){
							if (!$stats[$stat['stat_id']])
								$stats[$stat['stat_id']] = 0;
							$stats[$stat['stat_id']] += $stat['stat_value'];
						}
					}
					echo '<table border="0" cellpadding="0" cellspacing="2" class="stats_compare" style="border:solid 2px #3A2718;">
						<tr>
							<td colspan="2" class="stat_value">'.utf8_encode($perso[0]['user_perso']).'</td>
						</tr>';
					foreach ($loot->stats as $stat_id=>$stat_name){
						if ($stat_id != 35 && $stat_id != 57){
							echo '<tr>
										<td class="stat_name">'.utf8_encode($stat_name).'</td>
										<td class="stat_value">';
							if ($stats[$stat_id])
								echo		$stats[$stat_id];
							else
								echo '0';
							echo '		</td>
									  </tr>';
						}
					}
					echo '</table>';
				}
			}
		break;
	}
?>