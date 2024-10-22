<?	include "mb_cab.php";

	$sq3 ="SELECT A.Nom EVA,E.EmpresaId ID,E.Nom N,E.Usu U,E.Ema EM,E.Est ES,E.Site SIT,DATE_format(E.FC,'%d-%m-%Y') as FCR ";
	$sq3.="FROM TS_Empresas E INNER JOIN TS_Admin A ON A.AdminId=E.AdminId ";
	$sq3.="WHERE E.AdminId=$usu_idu ";
	$sq3.="ORDER BY E.AdminId,E.Nom ";
	$rs3 =mysql_query($sq3,$link) or die("Error 16 : $sq3 ");
?>
	<table width="100%" border="0" cellspacing="3" cellpadding="3">
	<tr><td valign=top width="50%">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr><td><h1>EMPRESAS</h1></td>	</tr>
		<tr><td valign="top" align="center">
				<table border="0" cellpadding="3" cellspacing="1">
				<tr bgcolor="<?=CLR_CAB_DET?>">
					<td align="center" width="30" height="30"><font class="textcampo">#</td>
					<td align="center"><font class="textcampo">Cliente</td>
					<td align="center"><font class="textcampo">Usuario</td>
					<td align="center"><font class="textcampo">E-mail</td>
					<td align="center"><font class="textcampo">Creado</td>
					<td align="center" width="60" colspan="2"><font class="textcampo">Acci&oacute;n</td>
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
						$est=$row->ES;
						if($y==0){	$y=1;	}
						else{		$y=0;	}
				?>
				<tr bgcolor="<?=(($y==1)?'#c0fa92':'#d7ffb7')?>">
					<td align="right"><font class="textdetalle"><?=$i?></td>
					<td><font class="textdetalle"><?=$nom?></td>
					<td><font class="textdetalle"><?=$usu?></td>
					<td><font class="textdetalle"><?=$ema?></td>
					<td align="center"><font class="textdetalle"><?=$fch?></td>
					<td align="center"><img border="0" src="../img/<?=$esta[$est]?>"></td>
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
			<tr><td><img border="0" src="../<?=NOM_DIR_IMG?>off.gif"></td>
				<td><font class="textdetalle">Bloqueado</font></td>
			</tr>
			<tr><td><img border="0" src="../<?=NOM_DIR_IMG?>on.gif"></td>
				<td><font class="textdetalle">Activo</font></td>
			</tr>
		    </table>
			</td>
		</tr>
		</table>
		</td>
	</tr>
    </table>
<? include "mb_pie.php" ?>