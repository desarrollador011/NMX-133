<?	include "mb_cab.php";

	if(	$usu_prf==1 ){
		$Nuevo=1;
		if(isset($_GET['id'])){
			$Nuevo=0;
			$idu=$_GET['id'];
			$sql="SELECT * FROM TS_Admin WHERE AdminId=$idu";
			$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
			$Us=mysql_result($rsl,0,"Usu");
			$Ps=mysql_result($rsl,0,"Psw");
			$No=mysql_result($rsl,0,"Nom");
			$Lm=mysql_result($rsl,0,"Lmt");
			$pf=mysql_result($rsl,0,"Prf");
			$em=mysql_result($rsl,0,"Ema");
			$di=mysql_result($rsl,0,"Dir");
			$te=mysql_result($rsl,0,"Tel");
			$ce=mysql_result($rsl,0,"Cel");
			$sk=mysql_result($rsl,0,"Sky");
			mysql_freeresult($rsl);
		}
	}
	$sq3 ="SELECT *,DATE_format(FC,'%d-%m-%Y') as FCR FROM TS_Admin Order by Nom";
	$rs3 =mysql_query($sq3,$link) or die("Error : <b>$sq3</b>");
?>
	<table width="100%" border="0" cellspacing="3" cellpadding="3">
	<tr><td valign=top>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr><td><h1>ASESORES LOCALES</h1></td>	</tr>
		<tr><td valign="top" align="center">
				<table border="0" cellpadding="3" cellspacing="1">
				<tr bgcolor="<?=CLR_CAB_DET?>">
					<td align="center" width="30" height="30"><font class="textcampo">#</td>
					<td align="center"><font class="textcampo">Nombres</td>
					<td align="center"><font class="textcampo">Usuario</td>
					<td align="center"><font class="textcampo">E-mail</td>
					<td align="center"><font class="textcampo">Direcci&oacute;n</td>
					<td align="center"><font class="textcampo">Tel&eacute;fono</td>
					<td align="center"><font class="textcampo">Celular</td>
					<td align="center"><font class="textcampo">Skype</td>
					<td align="center"><font class="textcampo">Creado</td>
<?	if(	$usu_prf==1 ){ ?>
					<td align="center" width="50" colspan="2"><font class="textcampo">Acci&oacute;n</td>
<?	}else{ ?>
					<td align="center" width="50" ><font class="textcampo">Estado</td>
<?	} ?>
				</tr>
				<?	$i=0;
					$y=0;
					$esta=array("off.gif","on.gif");
					while($row=mysql_fetch_object($rs3)){
						$i++;
						$ide=$row->AdminId;
						$nom=$row->Nom;
						$usu=$row->Usu;
						$ema=$row->Ema;
						$dir=$row->Dir;
						$tel=$row->Tel;
						$cel=$row->Cel;
						$sky=$row->Sky;
						$fch=$row->FCR;
						$est=$row->Est;
						if($y==0){	$y=1;	}
						else{		$y=0;	}
				?>
				<tr bgcolor="<?=(($y==1)?'#c0fa92':'#d7ffb7')?>">
					<td align="right"><font class="textdetalle"><?=$i?></td>
					<td><font class="textdetalle"><?=$nom?></td>
					<td><font class="textdetalle"><?=$usu?></td>
					<td><font class="textdetalle"><?=$ema?></td>
					<td><font class="textdetalle"><?=$dir?></td>
					<td><font class="textdetalle"><?=$tel?></td>
					<td><font class="textdetalle"><?=$cel?></td>
					<td><font class="textdetalle"><?=$sky?></td>
					<td><font class="textdetalle"><?=$fch?></td>
<?	if(	$usu_prf==1 ){ ?>
					<td align="center"><a href="evaluadores_estado.php?id=<?=$ide?>&est=<?=$est?>"><img border="0" src="img/<?=$esta[$est]?>"></a></td>
					<td align="center"><a href="evaluadores.php?id=<?=$ide?>"><img border="0" src="img/btn_edi.png"></a></td>
<?	}else{ ?>
					<td align="center"><img border="0" src="img/<?=$esta[$est]?>"></td>
<?	} ?>
				</tr>
				<?	}
					mysql_free_result($rs3);
				?>
				</table>
			</td>
		</tr>
		<tr><td align="center"><font class="textdetalle">Total Registros : </font><font class="textdetalle"><?=$i?></font></td>
		</tr>
		<tr><td align="center">
			<table border=0 cellspacing=1 cellpadding=3>
			<tr><td colspan="2" height="5"></td></tr>
			<tr><td colspan="2"><font class="textdetalle"><u>LEYENDA :</u></font></td></tr>
			<tr><td><img border="0" src="<?=NOM_DIR_IMG?>off.gif"></td>
				<td><font class="textdetalle">Bloqueado</font></td>
			</tr>
			<tr><td><img border="0" src="<?=NOM_DIR_IMG?>on.gif"></td>
				<td><font class="textdetalle">Activo</font></td>
			</tr>
<?	if(	$usu_prf==1 ){ ?>
			<tr><td><img border="0" src="<?=NOM_DIR_IMG.NOM_IMG_EDI?>"></td>
				<td><font class="textdetalle">Modificar</font></td>
			</tr>
<?	} ?>
		    </table>
			</td>
		</tr>
		</table>
		</td>
<?	if(	$usu_prf==1 ){ ?>
<?	if($Nuevo==1){ ?>
        <td valign=top>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>AGREGAR NUEVO ASESOR LOCAL</h1></td></tr>
			<tr><td valign="top">
				<form method="post" action="evaluadores_agregar2.php" name="publicar1">
					<table class="tablelista" border="0" cellpadding="3" cellspacing="1">
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Nombre :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="nom" type="text" class="caja02" maxlength="75"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Usuario :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="usu" type="text" class="caja01" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Clave :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="pss" type="password" class="caja01" maxlength="20"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">E-mail :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="ema" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Direcci&oacute;n :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="dir" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Tel&eacute;fono :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="tel" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Celular :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="cel" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Skype :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="sky" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td height="25" valign="top" align="center" colspan="2">
							<input name="agregar" type="submit" value="Agregar" class="btn00">
						</td>
					</tr>
					</table>
				</form>
				</td>
			</tr>
			</table>
		</td>
<?	}else{ ?>
        <td valign=top>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>MODIFICAR ASESOR LOCAL</h1></td></tr>
			<tr><td valign="top">
				<form method="post" action="evaluadores_modificar2.php" name="publicar2">
					<input type="hidden" name="id" value="<?=$idu?>">
					<table class="tablelista" border="0" cellpadding="3" cellspacing="1">
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Nombre :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="nom" value="<?=$No?>" type="text" class="caja02" maxlength="75"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Usuario :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="usu" value="<?=$Us?>" type="text" class="caja01" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Nueva Clave :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="pss" value="" type="password" class="caja01" maxlength="20"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">E-mail :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="ema" value="<?=$em?>" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Direcci&oacute;n :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="dir" value="<?=$di?>" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Tel&eacute;fono :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="tel" value="<?=$te?>" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Celular :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="cel" value="<?=$ce?>" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Skype :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="sky" value="<?=$sk?>" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td height="25" valign="top" align="center" colspan="2">
							<input name="agregar" type="submit" value="Actualizar" class="btn00">
							<input type="button" value="Cancelar" class="btn00" onClick="window.location.href = 'evaluadores.php';">
						</td>
					</tr>
					</table>
				</form>
				</td>
			</tr>
			</table>
		</td>
<?	}	?>
<?	}	?>
	</tr>
    </table>
<? include "mb_pie.php" ?>