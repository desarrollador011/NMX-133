<?	include "mb_cab_ayuda.php";
/*
	$EMP=0;
	if(isset($_GET['id'])){
		$EMP=$_GET['id'];
		$sql ="SELECT * FROM TS_Empresas WHERE EmpresaId=$EMP";
		$rsl =mysql_query($sql,$link) or die("Error : <b>$sql</b>");
		$CLIE=mysql_result($rsl,0,"Nom");
		mysql_freeresult($rsl);
	}
*/
	$sq3 = "SELECT Numeral NUM,Des PRE,Ayuda AYU,Puntaje PUN ";
	$sq3.= "FROM TS_Preguntas ";
	$sq3.= "ORDER BY Numeral ";
	$rs3 = mysql_query($sq3,$link) or die("Error 3: <b>$sq3</b>");
?>
	<table width="100%" border="0" cellspacing="3" cellpadding="3">
	<tr><td>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr><td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr><td><h1>AYUDA CONTEXTUAL : </h1></td><!--?=$CLIE?-->
			</tr>
			</table>
			</td>
		</tr>
		<tr><td valign="top" align="center">
			<table class="tablelista" border=0 cellpadding=3 cellspacing=1>
			<tr bgcolor="<?=CLR_CAB_DET?>">
				<!--td align="center"><font class="textcampo">#</td-->
				<td align="center"><font class="textcampo">Numeral</td>
				<td align="center"><font class="textcampo">Descripci&oacute;n</td>
				<td align="center"><font class="textcampo">Ayuda</td>
				<td align="center"><font class="textcampo">Puntaje</td>
			</tr>
			<?	$i=0;
				$p=0;
				$y=0;
				while($row=mysql_fetch_object($rs3)){
					$i++;
					$NUM=$row->NUM;
					$PRG=$row->PRE;
					$AYU=$row->AYU;
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
/*
					if($PUN>0){
						$p++;
						$sqP ="SELECT Numeral FROM TS_EmpresaPreguntas WHERE EmpresaId=$EMP AND Numeral='$NUM' ";
						$rsP =mysql_query($sqP,$link) or die("Error : $sqP");
						$EXIS=mysql_num_rows($rsP);
						mysql_freeresult($rsP);
					}
*/
			?>
			<tr bgcolor="<?=(($y==1)?$CLR01:$CLR02)?>">
				<!--td align="right"><font class="textdetalle"><?=$i?></td-->
				<td><font class="textdetalle"><?=$NUM?></td>
				<td><font class="textdetalle"><?=$PRG?></td>
				<td><font class="textdetalle"><?=$AYU?></td>
				<td align="right"><? if($PUN>0){ ?><font class="textdetalle"><?=$PUN?><? } ?></td>
			</tr>
			<?	}
				mysql_free_result($rs3);
			?>
			</table>
			</td>
		</tr>
		</table>
		</td>
	</tr>
    </table>
<? include "mb_pie_ayuda.php" ?>