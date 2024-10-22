<?	include "mb_cab.php";

	$ID=0;
	if(isset($_GET['id'])){
		$ID=$_GET['id'];
		$sql ="SELECT * FROM TS_Empresas WHERE EmpresaId=$ID";
		$rsl =mysql_query($sql,$link) or die("Error : <b>$sql</b>");
		$CLIE=mysql_result($rsl,0,"Nom");
		mysql_freeresult($rsl);
	}
	$sq3 = "SELECT T.Des TEMA,S.Des SUBT,PreguntaId ID,P.Des PRE,P.Puntaje PUN, ";
	$sq3.= "DATE_format(P.FC,'%d-%m-%Y') as FEC,DATE_format(P.FM,'%d-%m-%Y') as FEM ";
	$sq3.= "FROM (TS_Pregunta P INNER JOIN TS_Tema T ON P.TemaId=T.TemaId) INNER JOIN ";
	$sq3.= "TS_SubTema S ON S.SubTemaId=P.SubTemaId ";
	$sq3.= "ORDER BY P.TemaId,P.SubTemaId,P.Des ";
	$rs3 = mysql_query($sq3,$link) or die("Error 3: <b>$sq3</b>");
?>
	<table width="100%" border="0" cellspacing="3" cellpadding="3">
	<tr><td>
<form method="post" action="Calificacion_guardar.php" name="FrmPreguntas">
<input type="hidden" name="emp" value="<?=$ID?>">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr><td><h1>ANEXO DE DOCUMENTOS A PREGUNTAS : <?=$CLIE?></h1></td>	</tr>
		<tr><td valign="top" align="center">
			<table class="tablelista" border=0 cellpadding=3 cellspacing=1>
			<tr bgcolor="<?=CLR_CAB_DET?>">
				<td align="center"><font class="textcampo">#</td>
				<td align="center" colspan="2"><font class="textcampo">Tema</td>
				<td align="center"><font class="textcampo">SubTema</td>
				<td align="center"><font class="textcampo">Descripci&oacute;n</td>
				<td align="center"><font class="textcampo">Puntaje</td>
			</tr>
			<?	$i=0;
				$y=0;
				while($row=mysql_fetch_object($rs3)){
					$i++;
					$idp=$row->ID;
					$pre=$row->PRE;
					$PUN=$row->PUN;
					$TEM=$row->TEMA;
					$SUB=$row->SUBT;
					$y=(($y==0)?1:0);

					$sqP ="SELECT PreguntaId FROM TS_EmpresaPreguntas WHERE EmpresaId=$ID AND PreguntaId=$idp ";
					$rsP =mysql_query($sqP,$link) or die("Error : $sqP");
					$EXIS=mysql_num_rows($rsP);
					mysql_freeresult($rsP);
			?>
			<tr bgcolor="<?=(($y==1)?'#c0fa92':'#d7ffb7')?>">
				<td align="right"><font class="textdetalle"><?=$i?></td>
				<td><input type="checkbox" name="pre[]" value="<?=$idp?>" <?=(($EXIS==1)?'checked':'')?>></td>
				<td><font class="textdetalle"><?=$TEM?></td>
				<td><font class="textdetalle"><?=$SUB?></td>
				<td><font class="textdetalle"><?=$pre?></td>
				<td align="right"><font class="textdetalle"><?=$PUN?></td>
			</tr>
			<?	}
				mysql_free_result($rs3);
			?>
			</table>
			</td>
		</tr>
		<tr><td align="center" height="30">
			<input name="guardar" type="submit" value="Guardar" class="btn00">
			<input type="button" class="btn00" value="Cancelar" onClick="window.navigate('balotario.php')">
			</td>
		</tr>
		<tr><td align="center" height="30">
			<font class="textdetalle">Total Preguntas : <?=$i?></font>
			</td>
		</tr>
		</table>
</form> 

		</td>
	</tr>
    </table>
<? include "mb_pie.php" ?>