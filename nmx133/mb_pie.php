		</td>
	</tr>
	</table>
	</td>
</tr>
<tr><td bgcolor="#6c4615" height="65px">
	<table width="100%" border="0" cellspacing="1" cellpadding="2">
	<tr><td>
		<? include "mb_menu.php"; ?>
		</td>
		<td>
	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr><!--td align="left" bgcolor="#ffffff" ><a href="home.php"><img border="0" src="img/CDI_logo.jpg"></a></td-->
<?	if(	$usu_prf==1 ){
		$sql ="SELECT Est FROM TS_Eventos WHERE Est=0 ORDER BY FC desc ";
		$rsl =mysql_query($sql,$link) or die("Error : <b>$sql</b>");
		$TTLEVE=mysql_num_rows($rsl);
		mysql_freeresult($rsl);
		if($TTLEVE>0){
?>
		<td align="left"><a href="eventos.php"><img border="0" src="img/alerta.png"></a></td>
<?		}
	}
?>
		<td align="right" ><a href="home.php"><img border="0" src="img/DAI_logo.jpg"></a></td>
	</tr>
	</table>

		</td>
	</tr>
	</table>
	</td>
</tr>
</table>
</body></html>
<?	mysql_close ($link); ?>
