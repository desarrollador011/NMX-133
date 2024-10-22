<?	include "mb_cab.php";

	if(	$usu_prf==1 ){
		$Nuevo=1;
		if(isset($_GET['idu'])){
			$Nuevo=0;
			$UID=$_GET['idu'];
			$sql="SELECT * FROM iusuario WHERE idu=$UID";
			$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
			$u=mysql_result($rsl,0,"usu");
			$c=mysql_result($rsl,0,"cla");
			$n=mysql_result($rsl,0,"nom");
			$a=mysql_result($rsl,0,"ape");
			$pf=mysql_result($rsl,0,"prf");
			$nt=mysql_result($rsl,0,"notificar");
			$r=mysql_result($rsl,0,"emp");
			$em=mysql_result($rsl,0,"ema");
			$g=mysql_result($rsl,0,"car");
			$t=mysql_result($rsl,0,"tel");
			mysql_freeresult($rsl);
		}
	}
	$sq3 ="SELECT *,DATE_format(fch,'%d-%m-%Y') as fecha FROM iusuario ORDER BY prf desc,nom";
	$rs3 =mysql_query($sq3,$link) or die("Error : <b>$sq3</b>");
?>
	<table width="100%" border="0" cellspacing="3" cellpadding="3">
	<tr><td valign=top>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr><td><h1>ADMINISTRADORES</h1></td>	</tr>
		<tr><td valign="top" align="center">
				<table border="0" cellpadding="3" cellspacing="1">
				<tr bgcolor="<?=CLR_CAB_DET?>">
					<td align="center" width="30" height="30"><font class="textcampo">#</td>
					<td align="center"><font class="textcampo">Perfil</td>
					<td align="center"><font class="textcampo">Nombres</td>
					<td align="center"><font class="textcampo">Usuario</td>
					<td align="center"><font class="textcampo">E-mail</td>
					<td align="center"><font class="textcampo">Notificar</td>
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
						$idu=$row->idu;
						$nom=$row->nom;
						$ape=$row->ape;
						$usu=$row->usu;
						$prf=$row->prf;
						$notif=$row->notificar;
						$ema=$row->ema;
						$fch=$row->fecha;
						$est=$row->est;
						if($y==0){	$y=1;	}
						else{		$y=0;	}
				?>
				<tr bgcolor="<?=(($y==1)?'#c0fa92':'#d7ffb7')?>">
					<td align="right"><font class="textdetalle"><?=$i?></td>
					<td><font class="textdetalle"><?=(($prf==0)?'Auditor':'Administrador')?></td>
					<td><font class="textdetalle"><?=$nom?> <?=$ape?></td>
					<td><font class="textdetalle"><?=$usu?></td>
					<td><font class="textdetalle"><?=$ema?></td>
					<td align="center"><font class="textdetalle"><?=(($notif==0)?'':'SI')?></td>
<?	if(	$usu_prf==1 ){ ?>
					<td align="center"><a href="usuarios_estado.php?idu=<?=$idu?>&est=<?=$est?>"><img border="0" src="img/<?=$esta[$est]?>"></a></td>
					<td align="center"><a href="usuarios.php?idu=<?=$idu?>"><img border="0" src="img/btn_edi.png"></a></td>
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
			<tr><td><h1>AGREGAR NUEVO ADMINISTRADOR</h1></td></tr>
			<tr><td valign="top">
				<form method="post" action="usuarios_agregar2.php" name="publicar1">
					<table class="tablelista" border="0" cellpadding="3" cellspacing="1">
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Perfil :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>">
							<select name="prf" id="prf" size="1" class="sele02">
								<option value="1" >Administrador</option>
								<option value="0" >Auditor</option>
							</select>
						</td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Nombre :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="nom" type="text" class="caja03" maxlength="75"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Apellido :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="ape" type="text" class="caja03" maxlength="75"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Usuario :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="usu" type="text" class="caja03" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Clave :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="pss" type="password" class="caja03" maxlength="20"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Empresa :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="emp" type="text" class="caja03" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">E-mail :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="ema" type="text" class="caja03" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Notificar por correo :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="noti" type="checkbox" value="1"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Cargo :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="car" type="text" class="caja03" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Tel&eacute;fono :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="tel" type="text" class="caja03" maxlength="80"></td>
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
        <td valign=top width="50%">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>MODIFICAR ADMINISTRADOR</h1></td></tr>
			<tr><td valign="top">
				<form method="post" action="usuarios_modificar2.php" name="publicar2">
					<input type="hidden" name="uid" value="<?=$UID?>">
					<table class="tablelista" border="0" cellpadding="3" cellspacing="1">
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Perfil :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>">
							<select name="prf" id="prf" size="1" class="sele02">
								<option value="1" <?=((1==$pf)?'selected':'')?>>Administrador</option>
								<option value="0" <?=((0==$pf)?'selected':'')?>>Auditor</option>
							</select>
						</td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Nombre :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="nom" value="<?=$n?>" type="text" class="caja03" maxlength="75"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Apellido :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="ape" value="<?=$a?>" type="text" class="caja03" maxlength="75"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Usuario :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><?=$u?></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Nueva Clave :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="pss" value="" type="password" class="caja03" maxlength="20"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Empresa :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="emp" value="<?=$r?>" type="text" class="caja03" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">E-mail :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="ema" value="<?=$em?>" type="text" class="caja03" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Notificar por correo :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="noti" type="checkbox" value="1" <?=((1==$nt)?'checked':'')?>></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Cargo :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="car" value="<?=$g?>" type="text" class="caja03" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Telefono :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="tel" value="<?=$t?>" type="text" class="caja03" maxlength="80"></td>
					</tr>
					<tr><td height="25" valign="top" align="center" colspan="2">
							<input name="agregar" type="submit" value="Actualizar" class="btn00">
							<input type="button" value="Cancelar" class="btn00" onClick="history.go(-1)">
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