<?	session_start();
	include("conexion.php");
	$link = Conectarse();

	if (isset($_POST["usuario"])){
		$usu=trim($_POST["usuario"]);
		$cla=md5($_POST["clave"]);
		$url="index.php";
		$env=0;

		$sql = "SELECT idu FROM iusuario WHERE usu='$usu' AND est=1 ";
		$rsl = mysql_query($sql, $link) or die("Error: <b>$sql</b>");
		$ttu = mysql_num_rows($rsl);
		if($ttu==1){
			$idu =mysql_result($rsl,0,"idu");
			$sql = "SELECT idu FROM iusuario WHERE cla='$cla' AND est=1 AND idu=$idu ";
			$rsl = mysql_query($sql, $link) or die("Error: <b>$sql</b>");
			$ttu2= mysql_num_rows($rsl);
			if($ttu2==1){
				$env=1;
				$_SESSION['ADM_idu']=$idu;
				$url="home.php";				
			}
		}else{
			$sql = "SELECT AdminId FROM TS_Admin WHERE Usu='$usu' AND Est=1 ";
			$rsl = mysql_query($sql, $link) or die("Error: <b>$sql</b>");
			$ttu = mysql_num_rows($rsl);
			if($ttu==1){
				$idu =mysql_result($rsl,0,"AdminId");
				$sql = "SELECT AdminId FROM TS_Admin WHERE Psw='$cla' AND Est=1 AND AdminId=$idu ";
				$rsl = mysql_query($sql, $link) or die("Error: <b>$sql</b>");
				$ttu2= mysql_num_rows($rsl);
				if($ttu2==1){
					$env=1;
					$_SESSION['ASE_idu']=$idu;
					$url="asesor/index.php";				
				}
			}else{
				$sql = "SELECT EmpresaId FROM TS_Empresas WHERE Usu='$usu' AND Est=1 ";
				$rsl = mysql_query($sql, $link) or die("Error: <b>$sql</b>");
				$ttu = mysql_num_rows($rsl);
				if($ttu==1){
					$idu =mysql_result($rsl,0,"EmpresaId");
					$sql = "SELECT EmpresaId FROM TS_Empresas WHERE Psw='$cla' AND Est=1 AND EmpresaId=$idu ";
					$rsl = mysql_query($sql, $link) or die("Error: <b>$sql</b>");
					$ttu2= mysql_num_rows($rsl);

					if($ttu2==1){
						$env=1;
						$_SESSION['EMP_idu']=$idu;
						$url="empresa/index.php";				
					}
				}				
			}
		}		
		mysql_close ($link);
		if($env==1){
			header("Location:$url");
			exit;
		}
	}
?>
<HTML><HEAD><TITLE>.: Proyecto CDI :.</TITLE>
<style type="text/css"><!--
*{	font-family:Arial,Helvetica; font-size:11px;color:#ffffff; }
body{margin: 0px auto;background: #ffffff;}
form{ margin:0px;padding:0px;}
.tablelogin2{ border:1px 1px 1px 0 solid #999999;margin:5px;padding:5px; background-color:#3f3f3f;}
#inputsubmit{ border:1px solid #666666;margin:0;padding:0;font-size:11px;
background-color:#303030;width:80px;height:23px;color:#FEFEFE;}
.selecetperfil{ border:0px solid #999999;margin:0px;padding:0px;font-size:10px;width:120px;height:20px;
color:#000000;background-color:#666666;}
.textdata{ border:1px solid #999999;margin:0px;padding:0px;font-size:10px;background-color:#ffffff;width:120px;height:20px;
color:#000000;}
.allright{font-size:11px;}
.textcmp{font-size:11px;}
.txtproy{color:#000000; font-size:18px;}
--></style>
</head>
<BODY>
<table height="100%" width="100%" cellpadding="0" cellspacing="0" border="0">
<tr><td bgcolor="#afc6d8" height="75px" align="center">
<span class="txtproy">
SISTEMA DE INDICADORES DEL DESEMPE&Ntilde;O AMBIENTAL DE EMPRESAS COMUNITARIAS<BR>
DE ECOTURISMO EN COMUNIDADES IND&Iacute;GENAS
</span>
	</td>
</tr>
<tr><td bgcolor="#6aa94e" height="3px" align="center"></td></tr>
<tr><td bgcolor="#6c4615" height="3px" align="center"></td></tr>
<tr><td align="center" valign="middle">

	<table cellpadding="5" cellspacing="0" border="0">
	<tr><td align="center" valign="middle">
			<a href="NuevosCriterios.php"><img border="0" src="img/btn_NMX_133.jpg"></a>
		</td>
		<td align="center" valign="middle">
			<table cellpadding="3" cellspacing="3" border="0" bgcolor="#a8a8a8">
			<tr><td align="center" valign="middle"><img border="0" src="Galeria/Chiapas_CuevaTejon.jpg"></td>
				<td align="center" valign="middle"><img border="0" src="Galeria/Chiapas_Guacamayas.jpg"></td>
			</tr>
			<tr><td align="center" valign="middle"><img border="0" src="Galeria/Chiapas_Lacandones.jpg"></td>
				<td align="center" valign="middle"><img border="0" src="Galeria/Chiapas_Naha.jpg"></td>
			</tr>
			</table>
		</td>
		<td align="center" valign="middle">
			<table cellpadding="3" cellspacing="3" border="0" bgcolor="#a8a8a8">
			<tr><td align="center" valign="middle"><img border="0" src="Galeria/Chiapas_SiyajChan.jpg"></td>
				<td align="center" valign="middle"><img border="0" src="Galeria/Chiapas_TopChe.jpg"></td>
			</tr>
			<tr><td align="center" valign="middle"><img border="0" src="Galeria/Chiapas_YatochBarum.jpg"></td>
				<td align="center" valign="middle"><img border="0" src="Galeria/Kantemo_Quintana_Roo.jpg"></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr><td align="center" valign="middle" colspan="3">
			<form method="post" action="index.php" name="inicio">
				<table class="tablelogin2" cellpadding="0" cellspacing="0" border="0">
				<tr><td align="center" valign="middle">
							<table border="0" cellpadding="3" cellspacing="1">
							<tr><!--td align="right"><font class="textcmp">Perfil :</font></td>
								<td><select name="perfil" class="selecetperfil">
									<option value="ADM">Administrador</option>
									<option value="ASE">Asesor</option>
									<option value="EMP" selected>Empresa</option>
									</select>
								</td-->
								<td align="right"><font class="textcmp">Usuario :</font></td>
								<td><input class="textdata" name="usuario" type="text" maxlength="15"></td>
								<td align="right"><font class="textcmp">Clave :</font></td>
								<td><input class="textdata" name="clave" type="password" maxlength="15"></td>
								<td align="right"><input id="inputsubmit" type="submit" value="Ingresar"></td>
							</tr>
							</table>
					</td>
				</tr>
				</table>
			</form>
		</td>
	</tr>
	<tr><td align="center" valign="middle" colspan="3">
			<a href="http://www.dai.com/" target="_blank"><img border="0" src="img/DAI_logo.jpg"></a>
		</td>
	</tr>
	</table>
	</td>
</tr>
<tr><td bgcolor="#6c4615" height="75px" align="center"><font class="allright">
WEB desarrollada por DAI.<br>
Copyright © 2012.</font>
	</td>
</tr>
</table>
</BODY></HTML>
