<?	include "mb_cab.php";

	if(	$usu_prf==1 ){
		$Nuevo=1;
		if(isset($_GET['id'])){
			$Nuevo=0;
			$idu=$_GET['id'];
			$sql ="SELECT * FROM TS_Empresas WHERE EmpresaId=$idu";
			$rsl=mysql_query($sql,$link) or die("Error : <b>$sql</b>");
			$e =mysql_result($rsl,0,"AdminId");
			$u =mysql_result($rsl,0,"Usu");
			$n =mysql_result($rsl,0,"Nom");
			$m =mysql_result($rsl,0,"Ema");
			$u1=mysql_result($rsl,0,"Ubg1");
			$u2=mysql_result($rsl,0,"Ubg2");
			$u3=mysql_result($rsl,0,"Ubg3");
			$si=mysql_result($rsl,0,"Site");
			mysql_freeresult($rsl);
		}
	}

	$sq3 ="SELECT A.Nom EVA,E.EmpresaId ID,E.Img IMAG,E.Nom N,E.Usu U,E.Ema EM,E.Est ES,E.Site SIT,DATE_format(E.FC,'%d-%m-%Y') as FCR ";
	$sq3.="FROM TS_Empresas E INNER JOIN TS_Admin A ON A.AdminId=E.AdminId ";
	$sq3.="ORDER BY E.AdminId,E.Nom ";
	$rs3 =mysql_query($sq3,$link) or die("Error 16 : $sq3 ");
?>
	<table width="100%" border="0" cellspacing="3" cellpadding="3">
	<tr><td valign=top>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr><td><h1>EMPRESAS</h1></td>	</tr>
		<tr><td valign="top" align="center">
				<table border="0" cellpadding="3" cellspacing="1">
				<tr bgcolor="<?=CLR_CAB_DET?>">
					<td align="center" width="30" height="30"><font class="textcampo">#</td>
					<td align="center"><font class="textcampo">Asesor Local</td>
					<td align="center"><font class="textcampo">Cliente</td>
					<td align="center"><font class="textcampo">Usuario</td>
					<td align="center"><font class="textcampo">Imagen</td>
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
						$ide=$row->ID;
						$eva=$row->EVA;
						$nom=$row->N;
						$sit=$row->SIT;
						$usu=$row->U;
						$ema=$row->EM;
						$fch=$row->FCR;
						$img=$row->IMAG;
						$est=$row->ES;
						if($y==0){	$y=1;	}
						else{		$y=0;	}
				?>
				<tr bgcolor="<?=(($y==1)?'#c0fa92':'#d7ffb7')?>">
					<td align="right"><font class="textdetalle"><?=$i?></td>
					<td><font class="textdetalle"><?=$eva?></td>
					<td><font class="textdetalle"><?=$nom?></td>
					<td><font class="textdetalle"><?=$usu?></td>
					<td align="center"><img border="0" height="25px" src="empresaimg/<?=(($img<>'')?$img:'image.png')?>"></td>
<?	if(	$usu_prf==1 ){ ?>
					<td align="center"><a href="empresas_estado.php?id=<?=$ide?>&est=<?=$est?>"><img border="0" src="img/<?=$esta[$est]?>"></a></td>
					<td align="center"><a href="empresas.php?id=<?=$ide?>"><img border="0" src="img/btn_edi.png"></a></td>
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
			<tr><td><h1>AGREGAR NUEVA EMPRESA</h1></td></tr>
			<tr><td valign="top">
				<form method="post" action="empresas_agregar2.php" enctype="multipart/form-data" name="publicar1">
					<table class="tablelista" border="0" cellpadding="3" cellspacing="1">
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Asesor Local :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>">
							<select name="eval" id="eval" size="1" class="sele02">
							<?	$sql="SELECT AdminId ID,Nom N FROM TS_Admin WHERE Prf=0 ";
								$rsl=mysql_query($sql, $link) or die("Error: <b>$sql</b>");
								while($row=mysql_fetch_object($rsl)){
									$IdE=$row->ID;
							?>	<option value="<?=$IdE?>" <?=(($IdE==$e)?'selected':'')?>><?=$row->N?></option>
							<?	}
								mysql_free_result($rsl);
							?>
							</select>
						</td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Nombre :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="nom" type="text" class="caja02" maxlength="75"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Usuario :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="usu" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Clave :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="pss" type="password" class="caja01" maxlength="20"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">E-mail :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="ema" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Estado :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="ubi1" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Municipio :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="ubi2" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Localidad :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="ubi3" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Site :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="sit" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Imagen :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="img" type="file" class="caja02"></td>
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
			<tr><td><h1>MODIFICAR EMPRESA</h1></td></tr>
			<tr><td valign="top">
				<form method="post" action="empresas_modificar2.php" enctype="multipart/form-data" name="publicar2">
					<input type="hidden" name="id" value="<?=$idu?>">
					<table class="tablelista" border="0" cellpadding="3" cellspacing="1">
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Asesor Local :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>">
							<select name="eval" id="eval" size="1" class="sele02">
							<?	$sql="SELECT AdminId ID,Nom N FROM TS_Admin WHERE Prf=0 ";
								$rsl=mysql_query($sql, $link) or die("Error: <b>$sql</b>");
								while($row=mysql_fetch_object($rsl)){
							?>	<option value="<?=$row->ID?>"><?=$row->N?></option>
							<?	}
								mysql_free_result($rsl);
							?>
							</select>
						</td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Nombre :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="nom" value="<?=$n?>" type="text" class="caja02" maxlength="75"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Usuario :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="usu" value="<?=$u?>" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Nueva Clave :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="pss" value="" type="password" class="caja01" maxlength="20"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">E-mail :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="ema" value="<?=$m?>" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Estado :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="ubi1" value="<?=$u1?>" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Municipio :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="ubi2" value="<?=$u2?>" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Localidad :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="ubi3" value="<?=$u3?>" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Site :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="sit" value="<?=$si?>" type="text" class="caja02" maxlength="80"></td>
					</tr>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Nueva Imagen :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="img" type="file" class="caja02"></td>
					</tr>
					<tr><td height="25" valign="top" align="center" colspan="2">
							<input name="agregar" type="submit" value="Actualizar" class="btn00">
							<input type="button" value="Cancelar" class="btn00" onClick="window.location.href = 'empresas.php';">
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