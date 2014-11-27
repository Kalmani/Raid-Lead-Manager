var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-19865981-4']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
var wowhead_tooltips = { "colorlinks": false, "iconizelinks": false, "renamelinks": false }

function show_user_stats(id, users){
	jQuery.ajax({
		type:"POST",
		url: "action.php",
		data: "act=get_stats_array&id_user="+users[id],
		dataType: "html",
		success: function(data) {
			$('#content_temp').html($('#content_temp').html()+data);
			id = id+1;
			if (users[id])
				show_user_stats(id, users);
			else
				$('#chargement_stats').html('Les statistiques présentent sont celles du stuff équipé, hors gemmes/enchantements/retouches.');
		}
	});
}
function get_wich_view(id_item, old_item, id_to_change){
	$('#wish_new').html('<table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#D1B285" align="left"><tr class="head_list"><td>Chargement...</td></tr></table>');
	jQuery.ajax({
		type:"POST",
		url: "action.php",
		data: "act=get_item&id_item="+id_item+"&old_item="+old_item+"&id_to_change="+id_to_change,
		dataType: "html",
		success: function(data) {
			$('#wish_new').html(data);
		}
	});
}

function get_wich_view_prov(id_item, old_item, id_to_change){
	$('#wish_new').html('<table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#D1B285" align="left"><tr class="head_list"><td>Chargement...</td></tr></table>');
	jQuery.ajax({
		type:"POST",
		url: "action.php",
		data: "act=get_item_prov&id_item="+id_item+"&old_item="+old_item+"&id_to_change="+id_to_change,
		dataType: "html",
		success: function(data) {
			$('#wish_new').html(data);
		}
	});
}

function get_wich_view_spe2(id_item, old_item, id_to_change){
	$('#wish_new').html('<table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#D1B285" align="left"><tr class="head_list"><td>Chargement...</td></tr></table>');
	jQuery.ajax({
		type:"POST",
		url: "action.php",
		data: "act=get_item_spe2&id_item="+id_item+"&old_item="+old_item+"&id_to_change="+id_to_change,
		dataType: "html",
		success: function(data) {
			$('#wish_new').html(data);
		}
	});
}
function get_wich_players(id_item, raid_id, mode, boss_id){
	$('#wish_player').css('display', 'block');
	$('#wish_player').html('<fieldset><legend>Joueur(s) interessé(s) :</legend>Chargement des données...</fieldset>');
	jQuery.ajax({
		type:"POST",
		url: "action.php",
		data: "act=get_item_wish&id_item="+id_item+"&raid_id="+raid_id+"&mode="+mode+"&boss_id="+boss_id,
		dataType: "html",
		success: function(data) {
			$('#wish_player').html(data);
		}
	});
}
function close_box(){
	$('#wish_player').css('display', 'none');
}
function import_stuff(first_id, last_id, nb){
	var diff = parseInt(last_id) - parseInt(first_id);
	$('#content_import').html(nb+" items importés<br />"+diff+" items scannés<br />Dernier item scanné : "+last_id);
}	
function take_user(elem){
	$('#force_user_select').val(elem.options[elem.options.selectedIndex].value);
	var test = '';
	for (var i = 0; i < players_id.length; i++){
		if (players_id[i]['user_id'] == elem.options[elem.options.selectedIndex].value){
			$('#select_player_form').attr('action', 'index.php?page=wish&action=change_valide_getting&id='+players_id[i]['id']+"&bis=non");
		}
	}
}	
function take_user_foudr(elem){
	$('#force_user_select_foudr').val(elem.options[elem.options.selectedIndex].value);
	var test = '';
	for (var i = 0; i < players_id.length; i++){
		if (players_id[i]['user_id'] == elem.options[elem.options.selectedIndex].value){
			$('#select_player_form_foudr').attr('action', 'index.php?page=wish&action=change_valide_getting&id='+players_id[i]['id']+"&bis=non");
		}
	}
}
function get_choice_players(item_id, two_id, id, user_id){
	for (var i = 1; i < 3; i++){
		if (i == two_id)
			$('#two_choices_'+user_id+'_'+i).css('border', 'solid 2px #FF0000');
		else
			$('#two_choices_'+user_id+'_'+i).css('border', 'solid 2px #3A2718');
	}
	$('#form_to_change_1_'+user_id).attr('action', 'index.php?page=wish&action=change_valide_getting&id='+id);
	$('#form_to_change_2_'+user_id).attr('action', 'index.php?page=wish&action=change_valide_getting&id='+id);
}
function add_stat(elem){
	var stat = elem.options[elem.options.selectedIndex].value;
	document.location.href = document.location.href+'&add_stat='+stat;
}
function add_gemme(elem){
	var gemme = elem.options[elem.options.selectedIndex].value;
	document.location.href = document.location.href+'&add_gemme='+gemme;
}	
function add_spell(elem){
	var spell = elem.options[elem.options.selectedIndex].value;
	document.location.href = document.location.href+'&add_spell='+spell;
}	
function delete_stat(url, stats, stat){
	var stats_array = stats.split(',');
	var stats_str = '';
	for (var i = 0; i < stats_array.length; i++){
		if (stats_array[i] != stat)
			stats_str += stats_array[i]+',';
	}
	if (stats_str.length > 0){
		url += '&stats='+stats_str.substring(0, (stats_str.length - 1));
	}
	document.location.href = url;
}	
function delete_gemme(url, gemmes, gemme){
	var gemmes_array = gemmes.split(',');
	var gemmes_str = '';
	for (var i = 0; i < gemmes_array.length; i++){
		if (gemmes_array[i] != gemme)
			gemmes_str += gemmes_array[i]+',';
	}
	if (gemmes_str.length > 0){
		url += '&gemmes='+gemmes_str.substring(0, (gemmes_str.length - 1));
	}
	document.location.href = url;
}	
function delete_spell(url, spells, spell){
	var spells_array = spells.split(',');
	var spells_str = '';
	for (var i = 0; i < spells_array.length; i++){
		if (spells_array[i] != spell)
			spells_str += spells_array[i]+',';
	}
	if (spells_str.length > 0){
		url += '&spells='+spells_str.substring(0, (spells_str.length - 1));
	}
	document.location.href = url;
}

function show_players(type){
	$('#players_bis').css('display', 'none');
	$('#players_prov').css('display', 'none');
	$('#players_spe2').css('display', 'none');
	$('#players_'+type).css('display', 'block');
}