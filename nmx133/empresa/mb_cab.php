<?	include "mb_config.php";
	include "mb_session.php";
	include "mb_paginado.php";
	include "conexion.php";
	$link = Conectarse();
	$sqMN="SELECT * FROM TS_Empresas WHERE EmpresaId=$usu_idu";
	$rsMN=mysql_query($sqMN,$link) or die("Error Menu : <b>$sqMN</b>");
	$usu_log=mysql_result($rsMN,0,"Usu");
	$usu_nom=mysql_result($rsMN,0,"Nom");
	$usu_img=mysql_result($rsMN,0,"Img");
	$usu_ase=mysql_result($rsMN,0,"AdminId");
	mysql_freeresult($rsMN);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head><title>.: Proyecto CDI :.</title>
<meta http-equiv="Content-Style-Type" content="text/css">
<meta name="robots" content="noindex, nofollow">
<link type="text/css" rel="stylesheet" href="../css/estilos.css">
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
