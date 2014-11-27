<?php
// Usage:
// ------
// You integrate the calendar in a PHP page as follows:
// 
// ...
// require_once("calendar.php");
// ...
// $parameters = array("param1" => value1, "param2" => value2, ...);
// calendar($parameters);
// ...
// 
// Utilisation :
// -------------
// Le calendrier s'integre dans une page PHP en faisant :
// 
// ...
// require_once("calendar.php");
// ...
// $parametres = array("param1" => value1, "param2" => value2, ...);
// calendar($parametres);
// ...
// 
// Parameters:
// -----------
// "PREFIX":
//         prefix of the URL and session parameters of the calendar. Define a
//         different value for each different calendar to display along in the
//         same page. Do not start this prefix by a digit.
//         Default value: "calendar_".
// 
// "CSS_PREFIX":
//         prefix of the CSS classes used for styling the calendar. To be used
//         to render the calendars for different styles.
//         Default value: "calendar_".
// 
// "DATE_URL":
//         if set, indicates a URL to use for making the days clickable. This
//         URL is completed with the URL parameter indicated by the calendar
//         parameter "URL_PARAMETER".
//         Valeur par defaut : "".
// 
// "URL_PARAMETER":
//         if the previous parameter ("DATE_URL") is set, indicates the name of
//         the URL parameter used to complete the URL "DATE_URL" and pass the
//         clicked date. The date is formated as ddmmyyyy for the days and
//         mmyyyy for the month and year (title links).
//         Default value: "date".
// 
// "USE_SESSION":
//         set true to store the calendar rendering data in session. This allows
//         this script to remember the date to be displayed while browsing among
//         various pages.
//         Default value: false.
//         WARNING: if you want to use sessions, you must create the session
//         first at the very beginning of the page, because this script will not
//         do it.
// 
// "PRESERVE_URL":
//         when building the links for the "previous month" and "next month"
//         links, tells if current URL must be preserved (true) and the date
//         appended (?xx=yyy&...&date=...) or if the query string of the current
//         URL must be discarded (false) and just add the date parameter
//         (?date=...).
//         Default value: true.
// 
// "JS":
//         tells if the calendar is integrated as a JavaScript (true) or not.
//         Default value: false.
// 
// "JS_URL":
//         if the calendar is integrated as a JavaScript, this parameter gives
//         the URL of the page that integrates the calendar.
//         Default value: "".
// 
// "FIRST_WEEK_DAY":
//         first day of the week: 1 for Monday, 2 for Tuesday, etc..., 7 or
//         0 for Sunday.
//         Default value: 1 (Monday).
// 
// "LANGUAGE_CODE":
//         2-letter ISO code of the language to use for rendering the calendar.
//         Default value: "fr" (French).
// 
// Parametres :
// ------------
// "PREFIX" :
//         prefixe des parametres d'URL et de session du calendrier. Definissez
//         une valeur differente pour chaque calendrier a afficher sur la meme
//         page. Ne pas commencer le prefixe par un chiffre.
//         Valeur par defaut : "calendar_".
// 
// "CSS_PREFIX" :
//         prefixe des classes CSS utilisees pour le style du calendrier. A
//         utiliser pour afficher des calendriers dans differents styles.
//         Valeur par defaut : "calendar_".
// 
// "DATE_URL" :
//         si defini, indique une URL a utiliser pour rendre les jours du
//         calendrier cliquables. Cette URL est completee par le parametre d'URL
//         indique par le parametre "URL_PARAMETER" du calendrier.
//         Valeur par defaut : "".
// 
// "URL_PARAMETER" :
//         si le parametre precedent ("DATE_URL") est defini, indique le nom du
//         parametre d'URL a utiliser pour completer l'URL "DATE_URL" avec la
//         date cliquee. La date est passee au format jjmmaaaa pour les jours et
//         mmaaaa pour le mois et l'annee (lien du titre du calendrier).
//         Valeur par defaut : "date".
// 
// "USE_SESSION" :
//         mettre a true pour stocker les donnees d'affichage du calendrier en
//         session. Cela permet de memoriser l'affichage lorsqu'on navigue
//         entre plusieurs pages.
//         Valeur par defaut : false.
//         ATTENTION : si vous utilisez les sessions, n'oubliez pas de creer la
//         session au tout debut de votre script, ce script ne le fera pas.
// 
// "PRESERVE_URL" :
//         indique, au moment de constuire les URL des liens "mois precedent"
//         et "mois suivant", s'il faut conserver (true) l'URL actuelle de la
//         page et ajouter la date (?xx=yyy&...&date=...) ou s'il faut supprimer
//         la query string et ne mettre que le parametre de date (?date=...).
//         Valeur par defaut : true.
// 
// "JS" :
//         indique si le calendrier est integre en JavaScript (true) ou non.
//         Valeur par defaut : false.
// 
// "JS_URL" :
//         si l'integration JavaScript est utilisee, doit indiquer l'URL de la
//         page integrant le calendrier.
//         Valeur par defaut : "".
// 
// "FIRST_WEEK_DAY" :
//         premier jour de la semaine : 1 pour lundi, 2 pour mardi, etc..., 7 ou
//         0 pour dimanche.
//         Valeur par defaut : 1 (lundi).
// 
// "LANGUAGE_CODE" :
//         code ISO a 2 lettres de la langue d'affichage du calendrier.
//         Valeur par defaut : "fr" (francais).
// 
function Calendar($params, $stock) {
	// 
	// VARIABLES
	// 
	$r = "SELECT * FROM larmes_calendar";
	$events = $stock->sql->get_array_open($r);
	$current_abs = array();
	$return = '';
	$colors = array('red', 'blue', 'grey', 'yellow', 'pink', 'green', 'orange', 'black', 'white', 'purple');
	// Global variables 
	global $_SESSION;
	global $_SERVER;
	global $_GET;
	
	// Default parameters
	$PREFIX         = "calendar_";
	$CSS_PREFIX     = "calendar_";
	$DATE_URL       = "";
	$URL_PARAMETER  = "date";
	$USE_SESSION    = false;
	$PRESERVE_URL   = true;
	$JS             = false;
	$JS_URL         = "";
	$FIRST_WEEK_DAY = 1;
	$LANGUAGE_CODE  = "fr";
	
	// Overwrite parameters with custom values
	extract($params);
	
	// Translations for month and day
//	include($_SERVER["DOCUMENT_ROOT"]."/".dirname($_SERVER["PHP_SELF"])."/calendar_locales.php");
	include("calendar_locales.php");
	// Month names
	if (isset($MONTHS[$LANGUAGE_CODE])) {
		$month_name = $MONTHS[$LANGUAGE_CODE];
	} else {
		$month_name = $MONTHS["fr"];
	}
	// Short names of days
	if (isset($WEEK_DAYS[$LANGUAGE_CODE])) {
		$day_name = $WEEK_DAYS[$LANGUAGE_CODE];
	} else {
		$day_name = $WEEK_DAYS["fr"];
	}
	// Current month's name
	if (isset($MONTH_HEADER[$LANGUAGE_CODE])) {
		$month_header = $MONTH_HEADER[$LANGUAGE_CODE];
	} else {
		$month_header = $MONTH_HEADER["fr"];
	}
	
	
	// 
	// FUNCTIONS
	// 
	
	// This function displays HTML code: if $JS = true, we do not display line
	// breaks
	if (! function_exists("calendar_display")) {
		function calendar_display($text, $JS) {
			if ($JS) {
				return "document.writeln('".$text."');\n";
			} else {
				return $text."\n";
			}
		}
	}
	
	// This function sets the calendar URL parameter $URL_PARAMETER to $date in
	// the given URL $URL. Used for the previous and next arrows of the calendar
	// title.
	if (! function_exists("calendar_calculate_URL")) {
		function calendar_calculate_URL($URL, $URL_PARAMETER, $date, $PRESERVE_URL, $USE_SESSION) {
			$URL_components = parse_url($URL);
			$new_URL        = 'http://www.larmes-nebuleuses.fr/Portail/RLM/index.php?page=calendar&';
			$add_SID        = $USE_SESSION;
			// We retrieve and preserve the current URL parameters if required
			if ($PRESERVE_URL && isset($URL_components["query"])) {
				parse_str($URL_components["query"], $query_string);
				// We build the query string
				foreach ($query_string as $param => $value) {
					if ($param != $URL_PARAMETER) {
						$new_URL .= $param."=".urlencode($value)."&amp;";
					}
					// If the SID is already there, we do not add it again
					if ($USE_SESSION && $param == session_name()) {
						$add_SID = false;
					}
				}
			}
			
			// We add the date
			$new_URL .= $URL_PARAMETER."=".$date;
			
			// We also add the session ID (SID) if necessary
			if ($add_SID && SID != "") {
				$new_URL .= "&amp;".SID;
			}
			
			return $new_URL;
		}
	}
	
	// This function calculates the date of the previous month with the mmyyyy
	// format
	if (! function_exists("calendar_previous_month")) {
		function calendar_previous_month($month, $year) {
			if ($month == 1) {
				$new_month = "12";
				$new_year  = $year - 1;
			} else {
				$new_month = (($month > 10)?"":"0").($month - 1);
				$new_year  = $year;
			}
			
			return $new_month.$new_year;
		}
	}
	
	// This function calculates the date of the next month with the mmyyyy format
	if (! function_exists("calendar_next_month")) {
		function calendar_next_month($month, $year) {
			if ($month == 12) {
				$new_month = "01";
				$new_year  = $year + 1;
			} else {
				$new_month = (($month < 9)?"0":"").($month + 1);
				$new_year  = $year;
			}
			
			return $new_month.$new_year;
		}
	}
	
	// 
	// MAIN LOOP
	// 
	
	// In the case of JavaScript integration with session, we create the session.
	// We are allowed to do that because in JavaScript integration this PHP script
	// is not included in any custom page.
	if ($JS && $USE_SESSION) {
		session_start();
	}
	
	// Today's date
	$today = date("dmY");
	
	// Month and year to display (gotten from URL)
	if (isset($_GET[$PREFIX."date"])) {
		if ($_GET[$PREFIX."date"] != "") {
			$month = (int)substr($_GET[$PREFIX."date"], 0, 2);
			$year  = substr($_GET[$PREFIX."date"], 2);
		}
	}
	
	// Default month to show (if not found in the URL)
	if (!isset($month)) {
		$month = gmdate("n");
		// In the case of session, we must get the session date
		if ($USE_SESSION && isset($_SESSION[$PREFIX."month"])) {
			$month = $_SESSION[$PREFIX."month"];
		}
	}
	// We put the month in the session if required
	if ($USE_SESSION) {
		$_SESSION[$PREFIX."month"] = $month;
	}
	
	// Default year to show (if not found in the URL)
	if (!isset($year)) {
		$year = gmdate("Y");
		// In the case of session, we must get the session date
		if ($USE_SESSION && isset($_SESSION[$PREFIX."year"])) {
			$year = $_SESSION[$PREFIX."year"];
		}
	}
	// We put the year in the session if required
	if ($USE_SESSION) {
		$_SESSION[$PREFIX."year"] = $year;
	}
	
	// We display the top of the calendar
	if ($JS) {
		$URL_page = $JS_URL;
	} else {
		$URL_page = $_SERVER["REQUEST_URI"];
	}
	$return .= '<div style="width:400px; float:left;">';
	$return .= calendar_display("<table class=\"".$CSS_PREFIX."main\">", $JS);
	$return .= calendar_display("	<tr class=\"".$CSS_PREFIX."title\">", $JS);
	$return .= calendar_display("		<td class=\"".$CSS_PREFIX."title_left_arrow\"><a href=\"".calendar_calculate_URL($URL_page, $PREFIX."date", calendar_previous_month($month, $year), $PRESERVE_URL, $USE_SESSION)."\" class=\"".$CSS_PREFIX."title_left_arrow_clickable\">&lt;&lt;</a></td>", $JS);
	if ($DATE_URL != "") {
		$return .= calendar_display("		<td class=\"".$CSS_PREFIX."title_month\"><a href=\"".calendar_calculate_URL($DATE_URL, $URL_PARAMETER, (($month < 10)?"0":"").$month.$year, true, $USE_SESSION)."\" class=\"".$CSS_PREFIX."title_month_clickable\">".$month_name[$month - 1]." ".$year."</a></td>", $JS);
	} else {
		$return .= calendar_display("		<td class=\"".$CSS_PREFIX."title_month\">".str_replace("%y", $year, str_replace("%m", $month_name[$month - 1], $month_header))."</td>", $JS);
	}
	$return .= calendar_display("		<td class=\"".$CSS_PREFIX."title_right_arrow\"><a href=\"".calendar_calculate_URL($URL_page, $PREFIX."date", calendar_next_month($month, $year), $PRESERVE_URL, $USE_SESSION)."\" class=\"".$CSS_PREFIX."title_right_arrow_clickable\">&gt;&gt;</a></td>", $JS);
	$return .= calendar_display("	</tr>", $JS);
	$return .= calendar_display("	<tr>", $JS);
	$return .= calendar_display("		<td colspan=\"3\">", $JS);
	$return .= calendar_display("			<table class=\"".$CSS_PREFIX."table\">", $JS);
	$return .= calendar_display("				<tr>", $JS);
	for ($counter = 0; $counter < 7; $counter++) {
		$return .= calendar_display("					<th>".$day_name[($FIRST_WEEK_DAY + $counter) % 7]."</th>", $JS);
	}
	$return .= calendar_display("				</tr>", $JS);
	
	// We calculate the first day of the month to show
	$first_month_day = gmmktime(0, 0, 0, $month, 1, $year);
	
	// We calculate the week day of this first day so that we can determine how
	// many days we are far from the first week day
	$offset = (7 - ($FIRST_WEEK_DAY % 7 - gmdate("w", $first_month_day))) % 7;
	
	// First day of the calendar
	$current_day = $first_month_day - 3600 * 24 * $offset;
	
	// We are going to display a table => 2 nested loops
	// How many rows in the calendar?
	$row_number = ceil((gmdate("t", $first_month_day) + $offset) / 7);
	for ($row = 1; $row <= $row_number; $row++) {
		// The first loop displays the rows
		$return .= calendar_display("				<tr>", $JS);
		
		// The second loop displays the days (as columns)
		for ($column = 1; $column <= 7; $column++) {
			// Day currently displayed
			$day = gmdate("j", $current_day);
			$table_cell_cont = '';
			// If it is saturday or sunday, we use the "weekend" style
			if (gmdate("w", $current_day) == 2 || gmdate("w", $current_day) == 3 || gmdate("w", $current_day) == 0) {
				$table_cell = "					<td class=\"".$CSS_PREFIX."weekend\">";
			} else {
				$table_cell = "					<td>";
			}
			
			// We display the current day
			$CSS_class = "";
			// Clickable days?
			if ($DATE_URL != "") {
				if (gmdate("dmY", $current_day) == $today) {
					$CSS_class = $CSS_PREFIX."today_clickable";
				} else {
					// Days not in the current month with CSS clas "other_month"
					if (gmdate("n", $current_day) != $month) {
						$CSS_class = $CSS_PREFIX."other_month_clickable";
					} else {
						$CSS_class = $CSS_PREFIX."day_clickable";
					}
				}
				$table_cell_cont .= "<a href=\"".calendar_calculate_URL($DATE_URL, $URL_PARAMETER, gmdate("dmY", $current_day), true, $USE_SESSION)."\" class=\"".$CSS_class."\">".$day."</a>";
			} else {
				// Days not in the current month with CSS clas "other_month"
				if (gmdate("n", $current_day) != $month) {
					$CSS_class = $CSS_PREFIX."other_month";
				}
				// If we are displaying today's day, CSS class "today"
				if (gmdate("dmY", $current_day) == $today) {
					$CSS_class = $CSS_PREFIX."today";
				}
				if ($CSS_class == "") {
					$table_cell_cont .= $day;
				} else {
					$table_cell_cont .= "<span class=\"".$CSS_class."\">".$day."</span>";
				}
			}
			
			$month_str = gmdate("n", $current_day);
			if (strlen(gmdate("n", $current_day)) == 1)
				$month_str = '0'.gmdate("n", $current_day);
			$day_str = $day;
			if (strlen($day) == 1)
				$day_str = '0'.$day;
			$date_str = $year.'-'.$month_str.'-'.$day_str;
			$abs = '';
			foreach ($events as $event){
				$begin_arr = explode('-', $event['evenement_date']);
				$end_arr = explode('-', $event['eventement_fin']);
				$now_arr = explode('-', $date_str);
				$begin_time = mktime(0, 0, 0, $begin_arr[1], $begin_arr[2], $begin_arr[0]);
				$end_time = mktime(0, 0, 0, $end_arr[1], $end_arr[2], $end_arr[0]);
				$now_time = mktime(0, 0, 0, $now_arr[1], $now_arr[2], $now_arr[0]);
				if ($now_time >= $begin_time && $now_time <= $end_time){
					$find = false;
					foreach ($current_abs as $id=>$temp)
						if ($id == $event['evenement_id'])
							$find = $temp;
					if ($find === false){
						//echo $event['evenement_comment'].'<br />'.$event['evenement_date'].'<br />'.$colors[count($current_abs)];
						$current_abs[$event['evenement_id']]['name'] = $event['evenement_comment'];
						$current_abs[$event['evenement_id']]['begin'] = $event['evenement_date'];
						$current_abs[$event['evenement_id']]['end'] = $event['eventement_fin'];
						$current_abs[$event['evenement_id']]['color'] = $colors[(count($current_abs)-1)];
						$margin = -9;
						if ((count($current_abs)-1) > 0)
							$margin += ((count($current_abs)-1) * 4);
						$current_abs[$event['evenement_id']]['marge'] = $margin;
						$abs .= '<div style="width:53px; height:4px; background-color:'.$colors[(count($current_abs)-1)].'; position:absolute; margin-top:'.$margin.'px; margin-left:-2px;">&nbsp;</div>';
					} else {
						$abs .= '<div style="width:53px; height:4px; background-color:'.$current_abs[$event['evenement_id']]['color'].'; position:absolute; margin-top:'.$current_abs[$event['evenement_id']]['marge'].'px; margin-left:-2px;">&nbsp;</div>';
					}
				}
			}
			// End of day cell
			$return .= calendar_display($table_cell.$abs.$table_cell_cont."</td>", $JS);
			
			// Next day
			$current_day += 3600 * 24 + 1;
		}
		
		// End of rows
		$return .= calendar_display("				</tr>", $JS);
	}
	
	$return .= calendar_display("			</table>", $JS);
	$return .= calendar_display("		</td>", $JS);
	$return .= calendar_display("	</tr>", $JS);
	$return .= calendar_display("</table>", $JS);
	$return .= '</div>';
	if (!empty($current_abs)){
		$return .= '<div style="float:left; width:150px;">
						<strong>LEGENDE :</strong>
							<ul style="padding-left:5px;">';
		foreach ($current_abs as $id=>$current){
			$return .= '		<li><div style="width:50px; height:10px; background-color:'.$current['color'].';">&nbsp;</div>'.$current['name'].'
									<a href="index.php?page=calendar&action=change&id='.$id.'"><img src="styles/imgs/Edit.png" width="15" alt="Modifier" title="Modifier" /></a> 
									<a href="index.php?page=calendar&action=delete&id='.$id.'"><img src="styles/imgs/Error.png" width="15" alt="Supprimer" title="Supprimer" /></a><br /><br /></li>';
		}
		$return .= '		</ul>
					</div>';
	}
	return $return;
}
?>
