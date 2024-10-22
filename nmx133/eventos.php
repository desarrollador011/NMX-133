<?	include "mb_cab.php";

	$sq3 ="SELECT A.Nom ASE,E.Nom N,V.Numeral NUM,DATE_format(V.FC,'[%H:%i] %d-%m-%Y') as FCR ";
	$sq3.="FROM (TS_Empresas E INNER JOIN TS_Admin A ON A.AdminId=E.AdminId) ";
	$sq3.="INNER JOIN TS_Eventos V ON V.EmpresaId=E.EmpresaId ";
	$sq3.="WHERE V.Est=0 ";
	$sq3.="ORDER BY V.FC desc ";
	$rs3 =mysql_query($sq3,$link) or die("Error 8 : $sq3 ");
?>
	<table width="100%" border="0" cellspacing="3" cellpadding="3">
	<tr><td valign=top width="50%">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr><td><h1>ACTIVIDADES ACTIVAS</h1></td>	</tr>
		<tr><td valign="top" align="center">
				<table border="0" cellpadding=5 cellspacing=1>
				<tr bgcolor="<?=CLR_CAB_DET?>">
					<td align="center"><font class="textcampo">#</td>
					<td align="center"><font class="textcampo">Asesor</td>
					<td align="center"><font class="textcampo">Empresa</td>
					<td align="center"><font class="textcampo">Actividad</td>
					<td align="center"><font class="textcampo">Creado</td>
				</tr>
				<?	$i=0;
					$y=0;
					while($row=mysql_fetch_object($rs3)){
						$i++;
						$eva=$row->ASE;
						$nom=$row->N;
						$NUM=$row->NUM;
						$fch=$row->FCR;
						if($y==0){	$y=1;	}
						else{		$y=0;	}
				?>
				<tr bgcolor="<?=(($y==1)?'#c0fa92':'#d7ffb7')?>">
					<td align="right"><font class="textdetalle"><?=$i?></td>
					<td><font class="textdetalle"><?=$eva?></td>
					<td><b><font class="textdetalle"><?=$nom?></b></td>
					<td><font class="textdetalle">Adjunto un documento a la disposici&oacute;n <b><?=$NUM?></b></td>
					<td align="center"><font class="textdetalle"><?=$fch?></td>
				</tr>
				<?	}
					mysql_free_result($rs3);
				?>
				</table>
			</td>
		</tr>
		<tr><td align="center"><font class="textdetalle">Total : <?=$i?></font></td>
		</tr>
		</table>
		</td>
	</tr>
    </table>
<? include "mb_pie.php" ?>