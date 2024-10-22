<?php	include "mb_cab.php";	?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr><td height="30"><h1>CLAVE > CAMBIAR</h1></td></tr>
	<tr><td align="center" valign="top">
<form method="post" action="clave_modificar.php">
			<table class="tablelista" border="0" cellpadding="1" cellspacing="1">
			<tr><td height="25" colspan="2"></td></tr>
			<tr><td height="25" align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="azulcampo">&nbsp;Usuario :&nbsp;</font></td>
				<td bgcolor="<?=BG1_FIL_DET?>"><font class="textdetalle">&nbsp;<?=$usu_log?>&nbsp;</font></td>
			</tr>
			<tr><td height="25" align="right" bgcolor="<?=CLR_CAB_DET?>"><font class="azulcampo">&nbsp;Nueva Clave :&nbsp;</font></td>
				<td bgcolor="<?=BG1_FIL_DET?>"><input name="c" type="text" class="caja01" maxlength="15"></td>
			</tr>
			<tr><td height="35" valign="middle" align="center" colspan="2">
				<input name="cambiar" type="submit" value="Cambiar" class="btn00">
				</td>
			</tr>
			</table>
</form>
		</td>
	</tr>
	</table>
<?php	include "mb_pie.php" ?>