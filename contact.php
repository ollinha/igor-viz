<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>IGOR 2+ Search Tree Viewer</title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
	<div id="header">
		<div id="logo">
			<h1><a href="#">igor2</a><br /><p>search tree viewer</p></h1>
		</div>
	</div>
	<!-- end #header -->
	<div id="menu">
	</div>
	<!-- end #menu -->
	<div id="page">
		<div id="content">
			<h2 class="title">Contact</h2>
            <p>Please leave a message if you have some questions or suggestions about the project.</p>
<?php

// Email-Adresse
$mail_to = 'olga@yanenko.de';

// Parameter
$from_name = GetParam('fromname');
$from_mail = strtolower(GetParam('frommail'));
$mail_subject = GetParam('mailsubject');
$mail_text = GetParam('mailtext');
$send = GetParam('s');

$err_text = '';
if (trim($from_name) == '') {
	$err_text .= 'Please enter your name.<br />';
}
if (trim($from_mail) == '') {
  	$err_text .= 'Please enter your email address.<br />';
}
else {
  	if (!ereg('^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,6})$', $from_mail)) {
    	$err_text .= 'Please specify a valid email address.<br />';
	}
	if (trim($mail_subject) == '') {
		$err_text.='Please specify a subject.<br />';
	}
	if (trim($mail_text) == '') {
		$err_text.='Please enter a message.<br />';
	}
}

// Text abschneiden
if (strlen($mail_text) > 1000) {
  	$mail_text = substr($mail_text,0,1000).'... (Text wurde gekürzt!)';
}
$from_name = str_replace(chr(34), "''", $from_name);
$mail_subject = str_replace(chr(34), "''", $mail_subject);
$from_name = stripslashes($from_name);
$from_mail = stripslashes($from_mail);
$mail_subject = stripslashes($mail_subject);
$mail_text = stripslashes($mail_text);

if (($send == '1') && ($err_text != '')) {
  	echo '<p>Error:<br />';
  	echo $err_text.'</p>';
}

if (($send != '1') || ($err_text != '')) {
?>

<form action="<?=GetParam('PHP_SELF','S')?>" method="POST">
<dl>
  <dt>Name *:&nbsp;</dt>
  <dd><input type="text" name="fromname" size=50 maxlength=120 value="<?=$from_name?>"></dd>
  <dt>Email *:&nbsp;</dt>
  <dd><input type="text" name="frommail" size=50 maxlength=120 value="<?=$from_mail?>"></dd>
  <dt>Subject *:&nbsp;</dt>
  <dd><input type="text" name="mailsubject" size=50 maxlength=120 value="<?=$mail_subject?>"></dd>
  <dt>Message *:&nbsp;</dt>
  <dd><textarea cols=40 rows=10 name="mailtext"><?=$mail_text?></textarea>
  <br />* Fields must be filled in.</dd>
  <dt>&nbsp;</dt>
  <dd><input type="hidden" value="1" name="s"><input type="submit" value="send message" name="submit"></dd>
</dl>
</form>

<?php
} else {
	$header = "From: $from_name <$from_mail>\n";
	$header .= "Reply-To: $from_mail\n";
	$header .= "X-Mailer: PHP-ContactForm-Script\n";
	$header .= "Content-Type: text/plain";
	$mail_date = gmdate('D, d M Y H:i:s').' +0000';
	$send = 0;
	if (@mail($mail_to, $mail_subject, $mail_text, $header)) {
    	echo "<p>Thank you. Your message was sent successfully.</p><br /><br /><br /><br /><br /><br />";
	} else {
    	echo "<p>Sorry, an error occured while sending the message.</p>";
    	echo "<p><a href=\"".GetParam('PHP_SELF','S')."?from_name=$from_name&from_mail=$from_mail&mail_subject=$mail_subject&mail_text=";
    	echo urlencode($mail_text)."\">Back to the mail form.</a><br /><br /><br /><br /><br /></p>";
  	}
}

function GetParam($ParamName, $Method = 'P', $DefaultValue = '') {
  	if ($Method == 'P') {
    	if (isset($_POST[$ParamName])) return $_POST[$ParamName]; else return $DefaultValue;
  	} else if ($Method == 'G') {
    	if (isset($_GET[$ParamName])) return $_GET[$ParamName]; else return $DefaultValue;
  	} else if ($Method == 'S') {
    	if (isset($_SERVER[$ParamName])) return $_SERVER[$ParamName]; else return $DefaultValue;
  	}
}
?>   
		</div>
		<!-- end #content -->
		<div id="sidebar">
			<ul>
				<li>
					<ul>
						<li><a href="index.html">Home</a></li>
						<li><a href="demo.html">Demo</a></li>
						<li><a href="doc/index.html">Documentation</a></li>
						<li><a href="manual.html">User Manual</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- end #sidebar -->
	</div>
	<!-- end #page -->
	<div id="footer">
		<p><a href="contact.php">contact</a><a href="imprint.html">imprint</a><a href="http://www.yanenko.de">&copy; 2010 olga yanenko</a></p>
	</div>
	<!-- end #footer -->
</body>
</html>
