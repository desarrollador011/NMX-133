<?	function Conectarse(){
		$db_host="localhost";
		$db_nombre="daimex_cdi";
		$db_user="daimex_usercdi";
		$db_pass="1aP3lan60ch@";
		$link=mysql_connect($db_host, $db_user, $db_pass) or die ("Error conectando a la BD.");
		mysql_select_db($db_nombre ,$link) or die("Error seleccionando la BD.");
		return $link;
	}
?>