<?	include "mb_cab.php";

	$EMP=0;
	if(isset($_GET['id'])){
		$EMP=$_GET['id'];
		$sql ="SELECT * FROM TS_Empresas WHERE EmpresaId=$EMP";
		$rsl =mysql_query($sql,$link) or die("Error : <b>$sql</b>");
		$CLIE=mysql_result($rsl,0,"Nom");
		mysql_freeresult($rsl);
	}
	$sq3 = "SELECT Numeral NUM,Des PRE,Puntaje PUN ";
	$sq3.= "FROM TS_Preguntas ";
	//$sq3.= "WHERE Puntaje>0 ";
	$sq3.= "ORDER BY Numeral ";
	$rs3 = mysql_query($sq3,$link) or die("Error 3: <b>$sq3</b>");
?>
	<table width="100%" border="0" cellspacing="3" cellpadding="3">
	<tr><td>
<?	if(	$usu_prf==1 ){ ?>
<form method="post" action="balotario_guardar.php" name="FrmPreguntas">
<input type="hidden" name="emp" value="<?=$EMP?>">
<?	} ?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr><td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>SELECCIONE LAS PREGUNTAS PARA LA EMPRESA : <?=$CLIE?></h1></td>
<?	if(	$usu_prf==1 ){ ?>
				<td align="right"><a href="javascript:checkAll()">Marcar Todo</a> | <a href="javascript:uncheckAll()">Desmarcar Todo</a></td>
<?	} ?>
			</tr>
			</table>
			</td>
		</tr>
		<tr><td valign="top" align="center">
			<table class="tablelista" border=0 cellpadding=3 cellspacing=1>
			<tr bgcolor="<?=CLR_CAB_DET?>">
				<td align="center"><font class="textcampo">#</td>
				<td align="center" colspan="2"><font class="textcampo">Numeral</td>
				<td align="center"><font class="textcampo">Descripci&oacute;n</td>
				<td align="center"><font class="textcampo">Puntaje</td>
			</tr>
			<?	$i=0;
				$p=0;
				$y=0;
				while($row=mysql_fetch_object($rs3)){
					$i++;
					$NUM=$row->NUM;
					$PRG=$row->PRE;
					$PUN=$row->PUN;
					$y=(($y==0)?1:0);

					$data = explode(".",$NUM);
					$CLR=$data[0];
					switch($CLR){
						case 4:
							$CLR01="#c0fa92";
							$CLR02="#d7ffb7";
							break;
						case 5:
							$CLR01="#fade92";
							$CLR02="#fcdb67";
							break;
						case 6:
							$CLR01="#92fae0";
							$CLR02="#c4fbed";
							break;
					}					
					$EXIS=0;
					if($PUN>0){
						$p++;
						$sqP ="SELECT Numeral FROM TS_EmpresaPreguntas WHERE EmpresaId=$EMP AND Numeral='$NUM' ";
						$rsP =mysql_query($sqP,$link) or die("Error : $sqP");
						$EXIS=mysql_num_rows($rsP);
						mysql_freeresult($rsP);
					}
			?>
			<tr bgcolor="<?=(($y==1)?$CLR01:$CLR02)?>">
				<td align="right"><font class="textdetalle"><?=$i?></td>
				<td><? if($PUN>0){ ?><input type="checkbox" name="pre[]" value="<?=$NUM?>" <?=(($EXIS==1)?'checked':'')?>><? } ?></td>
				<td><font class="textdetalle"><?=$NUM?></td>
				<td><font class="textdetalle"><?=$PRG?></td>
				<td align="right"><? if($PUN>0){ ?><font class="textdetalle"><?=$PUN?><? } ?></td>
			</tr>
			<?	}
				mysql_free_result($rs3);
			?>
			</table>
			</td>
		</tr>
<?	if(	$usu_prf==1 ){ ?>
		<tr><td align="center" height="30">
			<input name="guardar" type="submit" value="Guardar" class="btn00">
			<input type="button" class="btn00" value="Cancelar" onClick="window.navigate('balotario.php')">
			</td>
		</tr>
<?	} ?>
		<tr><td align="center" height="30">
			<font class="textdetalle">Total Preguntas : <?=$p?></font>
			</td>
		</tr>
		</table>
<?	if(	$usu_prf==1 ){ ?>
</form> 
<?	} ?>
		</td>
	</tr>
    </table>
<? include "mb_pie.php" ?>