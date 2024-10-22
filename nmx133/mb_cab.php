<?	include "mb_config.php";
	include "mb_session.php";
	include "mb_paginado.php";
	include "conexion.php";
	$link = Conectarse();
	$sqMN="SELECT * FROM iusuario WHERE idu=$usu_idu";
	$rsMN=mysql_query($sqMN,$link) or die("Error Menu : <b>$sqMN</b>");
	$usu_log=mysql_result($rsMN,0,"usu");
	$usu_nom=mysql_result($rsMN,0,"nom");
	$usu_ape=mysql_result($rsMN,0,"ape");
	$usu_prf=mysql_result($rsMN,0,"prf"); // 0=Auditor | 1=Administrador

	mysql_freeresult($rsMN);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head><title>.: Proyecto CDI :.</title>
<meta http-equiv="Content-Style-Type" content="text/css">
<meta name="robots" content="noindex, nofollow">
<script language="JavaScript" src="js/miniscript.js" type="text/JavaScript"></script>
<script language="JavaScript" src="js/loadselect.js" type="text/JavaScript"></script>
<script language="JavaScript" src="js/activar.js" type="text/JavaScript"></script>
<script language='javascript' src="js/popcalendar.js"></script> 
<link type="text/css" rel="stylesheet" href="css/estilos.css">
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
<tr><td bgcolor="#afc6d8" height="75px" align="center">
	<span class="txtproy">SISTEMA DE INDICADORES DEL DESEMPE&Ntilde;O AMBIENTAL DE EMPRESAS COMUNITARIAS<BR>
	DE ECOTURISMO EN COMUNIDADES IND&Iacute;GENAS</span>
	</td>
</tr>
<tr><td bgcolor="#6aa94e" height="3px" align="center"></td></tr>
<tr><td bgcolor="#6c4615" height="3px" align="center"></td></tr>
<tr><td valign="top">
		<table width="100%" border="0" cellspacing="3" cellpadding="3">
		<tr><td>
