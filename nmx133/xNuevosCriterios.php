<?	include "mb_cab2.php";

	if(isset($_POST['BNum'])){
		$_SESSION['BscNum']=trim($_POST['BNum']);
		$_SESSION['BscTxt']=trim($_POST['BTxt']);
	}else{
		if(!isset($_SESSION['BscNum'])){
			$_SESSION['BscNum']="";
			$_SESSION['BscTxt']="";
		}
	}
	$BscNum=$_SESSION['BscNum'];
	$BscTxt=$_SESSION['BscTxt'];

	$tx1="";
	$tx2="";
	$in1="";
	$in2="";
	$in3="";
	$in4="";
	$in5="";

	$ENV=((isset($_GET['s']))?$_GET['s']:0);
	$IDP=0;
	if(isset($_GET['pp'])){
		$IDP=$_GET['pp'];
		$sql ="SELECT Numeral N,Des D FROM TS_Preguntas2 WHERE IdN=$IDP ";
		$rsl =mysql_query($sql,$link) or die("Error : <b>$sql</b>");
		$PNUM=mysql_result($rsl,0,"N");
		$PDES=mysql_result($rsl,0,"D");
		mysql_freeresult($rsl);

		$tx1=$_SESSION['cmp1'];
		$tx2=$_SESSION['cmp2'];
		$in1=$_SESSION['cmp3'];
		$in2=$_SESSION['cmp4'];
		$in3=$_SESSION['cmp5'];
		$in4=$_SESSION['cmp6'];
		$in5=$_SESSION['cmp7'];
	}

	if(isset($_GET['p'])){
		$IDP=$_GET['p'];
		$sql ="SELECT Numeral N,Des D FROM TS_Preguntas2 WHERE IdN=$IDP ";
		$rsl =mysql_query($sql,$link) or die("Error : <b>$sql</b>");
		$PNUM=mysql_result($rsl,0,"N");
		$PDES=mysql_result($rsl,0,"D");
		mysql_freeresult($rsl);

		$_SESSION['cmp1']="";
		$_SESSION['cmp2']="";
		$_SESSION['cmp3']="";
		$_SESSION['cmp4']="";
		$_SESSION['cmp5']="";
		$_SESSION['cmp6']="";
		$_SESSION['cmp7']="";
		$tx1="";
		$tx2="";
		$in1="";
		$in2="";
		$in3="";
		$in4="";
		$in5="";
	}

	$sq3 = "SELECT IdN ID,Numeral N,Des D FROM TS_Preguntas2 ";
	if($BscNum<>""){
		$sq3.= "WHERE Numeral LIKE ('$BscNum%') ";
		if($BscTxt<>""){
			$sq3.= "AND Des LIKE ('%$BscTxt%') ";
		}
	}else{
		if($BscTxt<>""){
			$sq3.= "WHERE Des LIKE ('%$BscTxt%') ";
		}
	}
	$sq3.= "ORDER BY IdN ";
	$rs3 = mysql_query($sq3,$link) or die("Error 3: <b>$sq3</b>");
?>
	<table width="100%" border="0" cellspacing="3" cellpadding="3">
	<tr><td valign="top">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td>
				<table width="100%" border="0" cellpadding="2" cellspacing="0">
				<tr><td><h1>COMENTARIOS AL PROYECTO DE ACTUALIZACION PROY-NMX-AA-133-SCFI-2012</h1></td>
					<td align="right">
					<table border="0" cellpadding="2" cellspacing="0">
					<tr><td><b>DESCARGUE >></b></td>
						<td><a href="Proy-nmx-aa-133-scfi-2012.pdf" target="_blank"><img border=0 src="img/pdf.png"></a></td>
					</tr>
					</table>

					</td>
				</tr>
				</table>
				</td>
			</tr>
			<tr><td>
				<form action="NuevosCriterios.php" method="post" name="FrmBuscador">
				<table border="0" cellpadding="3" cellspacing="1">
				<tr><td bgcolor="maroon"><font class="textcampo">Buscador:</td>
					<td bgcolor="#e5a60e"><font class="textcampo">Numeral</td>
					<td bgcolor="#fed46f"><input name="BNum" maxlength="10" value="<?=$BscNum?>"></td>
					<td bgcolor="#e5a60e"><font class="textcampo">Contenido</td>
					<td bgcolor="#fed46f"><input name="BTxt" maxlength="30" value="<?=$BscTxt?>"></td>
					<td bgcolor="#e5a60e"><input type="submit" class="btn00" value="Buscar"></td>
				</tr>
				</table>
				</form>
				</td>
			</tr>
			<tr><td valign="top" align="left">
				<table class="tablelista" border=0 cellpadding=3 cellspacing=1>
				<tr bgcolor="<?=CLR_CAB_DET?>">
					<td align="center"><font class="textcampo">#</td>
					<td align="center"><font class="textcampo">Numeral</td>
					<td align="center"><font class="textcampo">Contenido</td>
					<td align="center"><font class="textcampo">Comentar</td>
				</tr>
				<?	$i=0;
					$p=0;
					$y=0;
					while($row=mysql_fetch_object($rs3)){
						$i++;
						$ID=$row->ID;
						$NUM=$row->N;
						$PRG=$row->D;
						$y=(($y==0)?1:0);
						$data = explode(".",$NUM);
						$CLR=$data[0];
						if($IDP==$ID){
									$CLR01="#ff0000";
									$CLR02="#ff0000";
						}else{
							switch($CLR){
								case 0:
									$CLR01="#c0fa92";
									$CLR02="#d7ffb7";
									break;
								case 1:
									$CLR01="#92fae0";
									$CLR02="#c4fbed";
									break;
								case 2:
									$CLR01="#c0fa92";
									$CLR02="#d7ffb7";
									break;
								case 3:
									$CLR01="#92fae0";
									$CLR02="#c4fbed";
									break;
								case 4:
									$CLR01="#c0fa92";
									$CLR02="#d7ffb7";
									break;
								case 5:
									$CLR01="#92fae0";
									$CLR02="#c4fbed";
									break;
								case 6:
									$CLR01="#c0fa92";
									$CLR02="#d7ffb7";
									break;
								case 7:
									$CLR01="#92fae0";
									$CLR02="#c4fbed";
									break;
								case 8:
									$CLR01="#c0fa92";
									$CLR02="#d7ffb7";
									break;
								case 9:
									$CLR01="#92fae0";
									$CLR02="#c4fbed";
									break;
								default :
									$CLR01="#c0fa92";
									$CLR02="#d7ffb7";
									break;
							}					
						}
						$EXIS=0;
				?>
				<tr bgcolor="<?=(($y==1)?$CLR01:$CLR02)?>">
					<td align="right"><font class="textdetalle"><?=$i?></td>
					<td><font class="textdetalle"><?=$NUM?></td>
					<td><font class="textdetalle"><?=$PRG?></td>
					<td align="center"><a href="NuevosCriterios.php?p=<?=$ID?>"><img border=0 src="img/comentar.png"></a></td>
				</tr>
				<?	}
					mysql_free_result($rs3);
				?>
				</table>
				</td>
			</tr>
			</table>
		</td>
<?	if($IDP<>0){	?>
		<td valign="top" width="400">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>COMENTANDO :</h1><br><font class="obligatorio">Todos los campos son obligatorios.</font></td>
			</tr>
			<tr><td valign="top" align="center">
<form method="post" action="NuevosCriterios_Guardar.php" name="FrmComentar"onSubmit="return verifica_form();">
		<input type="hidden" name="PREG" value="<?=$IDP?>">

				<table class="tablelista" border=0 cellpadding=3 cellspacing=1>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Numeral :</td>
					<td align="left" colspan=2><b><?=$PNUM?></b></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Dice :</td>
					<td align="left" colspan=2><b><?=$PDES?></b></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Debe decir :</td>
					<td align="left" colspan=2><textarea name="txt1" class="txtp2_400"><?=$tx1?></textarea></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Justificaci&oacute;n :</td>
					<td align="left" colspan=2><textarea name="txt2" class="txtp2_400"><?=$tx2?></textarea></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Nombre del promovente :</td>
					<td colspan=2><input type="text" name="inp1" class="caja03" value="<?=$in1?>" maxlength="80"></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Apellido(s) del promovente :</td>
					<td colspan=2><input type="text" name="inp2" class="caja03" value="<?=$in2?>" maxlength="80"></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Correo electr&oacute;nico del promovente :</td>
					<td colspan=2><input type="text" name="inp3" class="caja03" value="<?=$in3?>" maxlength="80"></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Tel&eacute;fono incluyendo lada :</td>
					<td colspan=2><input type="text" name="inp4" class="caja03" value="<?=$in4?>" maxlength="20"></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">Raz&oacute;n social de la organizaci&oacute;n en que labora :</td>
					<td colspan=2><input type="text" name="inp5" class="caja03" value="<?=$in5?>" maxlength="100"></td>
				</tr>
				<tr><td bgcolor="<?=CLR_CAB_DET?>" align="right"><font class="textcampo">CAPTCHA :</td>
					<td align="right"><input type="text" name="captcha" id="captcha" maxlength="6" size="6"/></td>
					<td align="left"><img src="captcha.php"/> <a href="NuevosCriterios.php?pp=<?=$IDP?>"><img border=0 src="img/refresh30.png"></a></td>
				</tr>
				</table>
				</td>
			</tr>
			<tr><td align="center" height="30">
				<input type="submit" class="btn00" value="Enviar comentario">
</form>
				</td>
			</tr>
<?	if($ENV==999){ ?>
			<tr><td align="center"><br><br>
				<font class="mensajeenv">El c&oacute;digo captcha ingresado es incorrecto.</font>
				</td>
			</tr>
<?	} ?>
			</table>
		</td>
<?	}	?>
<?	if($ENV==1000){ ?>
		<td align="center" valign="top" width="300"><font class="mensajeenv">Su comentario fue enviado con &eacute;xito.</font></td>
<?	}	?>
	</tr>
    </table>
<? include "mb_pie2.php" ?>