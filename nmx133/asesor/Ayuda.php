<?	include "mb_cab.php";

	$sq3 ="SELECT DocId ID,Des N,Doc D,Obs O,DATE_format(FC,'%d-%m-%Y') as FCR ";
	$sq3.="FROM TS_Documentos ";
	$sq3.="ORDER BY Des ";
	$rs3 =mysql_query($sq3,$link) or die("Error 6 : $sq3 ");
?>
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
	<tr><td valign=top>
			<table width="100%" border="0" cellpadding="3" cellspacing="1">
			<tr><td><h1>CAJA DE HERRAMIENTAS</h1></td>	</tr>
			<tr><td valign="top" align="center">
					<table border="0" cellpadding="3" cellspacing="1">
					<tr bgcolor="<?=CLR_CAB_DET?>">
						<td align="center" width="30" height="30"><font class="textcampo">#</td>
						<td align="center"><font class="textcampo">Descripci&oacute;n</td>
						<td align="center"><font class="textcampo">Documento</td>
						<td align="center"><font class="textcampo">Publicado</td>
						<td align="center"><font class="textcampo">Descargar</td>
					</tr>
					<?	$i=0;
						$y=0;
						while($row=mysql_fetch_object($rs3)){
							$i++;
							$ide=$row->ID;
							$des=$row->N;
							$doc=$row->D;
							$fch=$row->FCR;
							if($y==0){	$y=1;	}
							else{		$y=0;	}
					?>
					<tr bgcolor="<?=(($y==1)?'#fff842':'#fffcb2')?>">
						<td align="right"><font class="textdetalle"><?=$i?></td>
						<td><font class="textdetalle"><?=$des?></td>
						<td><font class="textdetalle"><?=$doc?></td>
						<td align="center"><font class="textdetalle"><?=$fch?></td>
						<td align="center" valign="middle"><? if($doc<>''){ ?><a target="_blank" href="../download/<?=$doc?>"><img src="../img/descargar.gif" border="0"></a><? } ?></td>
					</tr>
					<?	}
						mysql_free_result($rs3);
					?>
					</table>
				</td>
			</tr>
			<tr><td align="center"><font class="textdetalle">Total documentos : </font><font class="textdetalle"><?=$i?></font></td>
			</tr>
			</table>
		</td>
	</tr>
    </table>
<? include "mb_pie.php" ?>