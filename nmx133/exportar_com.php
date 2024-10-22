<?	include "conexion.php";
	$link = Conectarse();

	$sql ="SELECT *,DATE_FORMAT(FC,'%H:%i %d-%m-%Y') AS f FROM TS_Comentarios ORDER BY IdCom ";

	$rsl=mysql_query($sql, $link) or die("Error 9 : <b>$sql</b>");
	$c=0;

	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition:  filename=\"CDI_REPORTE_COMENTARIOS.XLS\";");
?>
		<table border="1">
		<tr bgcolor="<?=GRILLA_CLR_CAB?>">
			<td align="center" height="30"><font color="white"><b>Item</b></font></td>
			<td align="center"><font color="white"><b>Numeral</b></font></td>
			<td align="center"><font color="white"><b>Contenido Original</b></font></td>
			<td align="center"><font color="white"><b>Debe decir</b></font></td>
			<td align="center"><font color="white"><b>Justificacion</b></font></td>
			<td align="center"><font color="white"><b>Nombre</b></font></td>
			<td align="center"><font color="white"><b>Apellido</b></font></td>
			<td align="center"><font color="white"><b>E-mail</b></font></td>
			<td align="center"><font color="white"><b>Telefono</b></font></td>
			<td align="center"><font color="white"><b>Razon Social</b></font></td>
			<td align="center"><font color="white"><b>Registrado</b></font></td>
		</tr>
		<?	while($row=mysql_fetch_object($rsl)){
				$c++;
				$C1=$row->Des;
				$C2=$row->Debe;
				$C3=$row->Just;
				$C4=$row->Nom;
				$C5=$row->Ape;
				$C6=$row->Ema;
				$C7=$row->Tlf;
				$C8=$row->Rso;
				$C9=$row->f;
				$IdN=$row->IdN;

				$sql ="SELECT Numeral FROM TS_Preguntas2 WHERE IdN=$IdN ";
				$rsT =mysql_query($sql,$link) or die("Error : <b>$sql</b>");
				$NUM=mysql_result($rsT,0,"Numeral");
				mysql_freeresult($rsT);

				$y=(($y==0)?1:0);
		?>
		<tr bgcolor="<?=(($y==1)?'#dcdcdc':'#ffffff')?>">
			<td><?=$c?>&nbsp;</td>
			<td align="right">&nbsp;<?=$NUM?></td>
			<td align="left">&nbsp;<?=$C1?></td>
			<td align="left">&nbsp;<?=$C2?></td>
			<td align="left">&nbsp;<?=$C3?></td>
			<td align="left">&nbsp;<?=$C4?></td>
			<td align="left">&nbsp;<?=$C5?></td>
			<td align="left">&nbsp;<?=$C6?></td>
			<td align="left">&nbsp;<?=$C7?></td>
			<td align="left">&nbsp;<?=$C8?></td>
			<td align="center">&nbsp;<?=$C9?></td>
		</tr>
		<?	}
			mysql_free_result($rsl);
		?>
		</table>