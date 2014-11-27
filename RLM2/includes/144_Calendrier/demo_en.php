<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <link rel="stylesheet" href="calendar.css" type="text/css" />
 <title>Calendar demo</title>
</head>

<body>
<p>Note: URL preservation has been disabled and the dates are not clickable.</p>

<?php require_once("calendar.php"); ?>

<h1>Calendar without session</h1>
<?php Calendar(array("LANGUAGE_CODE" => "en", "PREFIX" => "cal1_", "PRESERVE_URL" => false)); ?>

<h1>Calendar with session</h1>
<?php Calendar(array("LANGUAGE_CODE" => "en", "PREFIX" => "cal2_", "PRESERVE_URL" => false, "USE_SESSION" => true)); ?>

<h1>JavaScript calendar (without session)</h1>
<script type="text/javascript" src="calendar_js.php?LANGUAGE_CODE=en&PREFIX=cal3_&PRESERVE_URL=false"></script>

</body>
</html>
