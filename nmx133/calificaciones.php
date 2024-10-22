<?	include "mb_cab.php";

	if(	$usu_prf==1 ){
		$Nuevo=1;
		if(isset($_GET['id'])){
			$IDT=$_GET['id'];
			$Nuevo=0;
			$sql="SELECT Des FROM TS_Calificacion WHERE CalificaId=$IDT ";
			$rsl=mysql_query($sql,$link) or die("Error : $sql");
			$D =mysql_result($rsl,0,"Des");
			mysql_freeresult($rsl);
		}
	}
	$sq3 = "SELECT CalificaId,Des,DATE_format(FC,'%d-%m-%Y') as FEC,DATE_format(FM,'%d-%m-%Y') as FEM ";
	$sq3.= "FROM TS_Calificacion ORDER BY Des,CalificaId";
	$rs3 = mysql_query($sq3,$link) or die("Error 3: <b>$sq3</b>");
?>
	<table width="100%" border="0" cellspacing="3" cellpadding="3">
	<tr><td valign=top>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr><td><h1>CALIFICACIONES</h1></td>	</tr>
		<tr><td valign="top" align="center">
			<table class="tablelista" border=0 cellpadding=3 cellspacing=1>
			<tr bgcolor="<?=CLR_CAB_DET?>">
				<td align="center"><font class="textcampo">#</td>
				<td align="center"><font class="textcampo">Descripci&oacute;n</td>
				<td align="center"><font class="textcampo">Creado</td>
				<td align="center"><font class="textcampo">Modificado</td>
<?	if(	$usu_prf==1 ){ ?>
				<td align="center" ><font class="textcampo">Acci&oacute;n</td>
<?	} ?>
			</tr>
			<?	$i=0;
				$y=0;
				while($row=mysql_fetch_object($rs3)){
					$i++;
					$idt=$row->CalificaId;
					$nom=$row->Des;
					$fc=$row->FEC;
					$fm=$row->FEM;
					$y=(($y==0)?1:0);
			?>
			<tr bgcolor="<?=(($y==1)?'#c0fa92':'#d7ffb7')?>">
				<td align="right"><font class="textdetalle"><?=$i?></td>
				<td><font class="textdetalle"><?=$nom?></td>
				<td align="center"><font class="textdetalle"><?=$fc?></td>
				<td align="center"><font class="textdetalle"><?=$fm?></td>
<?	if(	$usu_prf==1 ){ ?>
				<td align="center"><a href="calificaciones.php?id=<?=$idt?>"><img border="0" src="img/btn_edi.png"></a></td>
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
<?	if(	$usu_prf==1 ){ ?>
		<tr><td align="center">
			<table border=0 cellspacing=1 cellpadding=3>
			<tr><td colspan="2" height="5"></td></tr>
			<tr><td colspan="2"><font class="textdetalle"><u>LEYENDA :</u></font></td></tr>
			<tr><td><img border="0" src="<?=NOM_DIR_IMG.NOM_IMG_EDI?>"></td>
				<td><font class="textdetalle">Modificar</font></td>
			</tr>
		    </table>
			</td>
		</tr>
<?	} ?>
		</table>
		</td>
<?	if(	$usu_prf==1 ){ ?>
<?	if($Nuevo==1){ ?>
        <td valign=top width="50%">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>AGREGAR NUEVA CALIFICACI&Oacute;N</h1></td></tr>
			<tr><td valign="top">
				<form method="post" action="calificaciones_agregar2.php" name="frmtemas">
					<table class="tablelista" border=0 cellpadding=3 cellspacing=1>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Descripci&oacute;n :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="d" type="text" class="caja03" maxlength="150"></td>
					</tr>
					<tr><td valign="top" align="center" colspan="2">
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
			<tr><td><h1>MODIFICAR CALIFICACI&Oacute;N</h1></td></tr>
			<tr><td valign="top">
				<form method="post" action="calificaciones_modificar2.php" name="frmtemas">
					<input type="hidden" name="id" value="<?=$IDT?>">
					<table class="tablelista" border=0 cellpadding=3 cellspacing=1>
					<tr><td align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="textcampo">Descripci&oacute;n :&nbsp;</font></td>
						<td bgcolor="<?=BG1_FIL_DET?>"><input name="d" value="<?=$D?>" type="text" class="caja03" maxlength="150"></td>
					</tr>
					<tr><td valign="top" align="center" colspan="2">
							<input name="agregar" type="submit" value="Actualizar" class="btn00">
							<input type="button" class="btn00" value="Cancelar" onClick="window.navigate('calificaciones.php')">
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