<?	include "mb_cab.php";
	$NUM=$_GET['n'];
	$EMP=$usu_idu;

	$sql ="SELECT Nom FROM TS_Empresas WHERE EmpresaId=$EMP";
	$rsl =mysql_query($sql,$link) or die("Error : <b>$sql</b>");
	$CLIE=mysql_result($rsl,0,"Nom");
	mysql_freeresult($rsl);

	$sq3 = "SELECT EP.Doc DO,EP.CalificaId CA,P.Numeral ID,P.Des PRE,P.Puntaje PUN,Cerrado CER ";
	$sq3.= "FROM (TS_Preguntas P INNER JOIN ";
	$sq3.= "TS_EmpresaPreguntas EP ON P.Numeral=EP.Numeral) INNER JOIN  ";
	$sq3.= "TS_Empresas E ON EP.EmpresaId=E.EmpresaId ";
	$sq3.= "WHERE EP.EmpresaId=$EMP AND EP.Numeral LIKE '$NUM.%'";
	$sq3.= "ORDER BY P.Numeral,P.Des ";
	$rs3 = mysql_query($sq3,$link) or die("Error 18 : <b>$sq3</b>");
?>
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
	<tr><td>
			<table width="100%" border="0" cellpadding="3" cellspacing="0">
			<tr><td valign="top"><h1>ANEXO DE EVIDENCIAS A PREGUNTAS : <?=$CLIE?></h1></td>
			</tr>
			<tr><td valign="top" align="center">

				<table class="tablelista" border=0 cellpadding=3 cellspacing=1>
				<tr bgcolor="<?=CLR_CAB_DET?>">
					<td align="center"><font class="textcampo">#</td>
					<td align="center"><font class="textcampo">Numeral</td>
					<td align="center"><font class="textcampo">Descripci&oacute;n</td>
					<td align="center"><font class="textcampo">Puntaje</td>
					<td align="center" colspan="2"><font class="textcampo">Calificaci&oacute;n</td>
					<td align="center"><font class="textcampo">Evidencia</td>
				</tr>
				<?	$i=0;
					$y=0;
					while($row=mysql_fetch_object($rs3)){
						$i++;
						$DSP=$row->ID;
						$pre=$row->PRE;
						$PUN=$row->PUN;
						$DOC=$row->DO;
						$CAL=$row->CA;
						$CER=$row->CER;
						$y=(($y==0)?1:0);
						$CALIFIMG="calif_sinrevisar.png";
						$CALIF="SIN REVISAR";
						if($CAL<>0){
							if($CAL<>1){
								if($CAL<>4){
									$CALIFIMG="calif_adecuado.png";
								}else{
									$CALIFIMG="calif_inadecuado.png";
								}
								$sql="SELECT Des FROM TS_Calificacion WHERE CalificaId=$CAL ";
								$rsl=mysql_query($sql,$link) or die("Error : $sql");
								$CALIF=strtoupper(mysql_result($rsl,0,"Des"));
								mysql_freeresult($rsl);
							}
						}
				?>
				<tr bgcolor="<?=(($y==1)?'#c0fa92':'#d7ffb7')?>">
					<td align="right"><font class="textdetalle"><?=$i?></td>
					<td><font class="textdetalle"><?=$DSP?></td>
					<td><font class="textdetalle"><?=$pre?></td>
					<td align="right"><font class="textdetalle"><?=$PUN?></td>
					<td align="center" valign="middle"><img src="../img/<?=$CALIFIMG?>" border="0"></td>
					<td align="left"><font class="textdetalle"><?=$CALIF?></td>
					<td align="right" valign="middle"><? if($DOC<>''){ ?><a title="Clic para descargar adjunto" target="_blank" href="../files/<?=$DOC?>"><?=$DOC?></a><? }else{ ?>&nbsp;<? } ?></td>
				</tr>
				<?	}
					mysql_free_result($rs3);
				?>
				</table>
				</td>
			</tr>
			<tr><td align="center">
				<input type="button" class="btn00" value="Cancelar" onClick="window.location='index.php'">
				</td>
			</tr>
			<tr><td align="center">
				<font class="textdetalle">Total Preguntas : <?=$i?></font>
				</td>
			</tr>
			</table>
		</td>
	</tr>
    </table>
<? include "mb_pie.php" ?>