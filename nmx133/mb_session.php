<?	session_start();
	$usu_idu=$_SESSION['ADM_idu'];

	if(!isset($usu_idu)){ header("Location:index.php"); }
/*
	if(isset($_POST['S_SP_ind'])){
		$_SESSION['B_SP_PAG']=1;
		$_SESSION['B_SP_IND']=$_POST['S_SP_ind'];
		$_SESSION['B_SP_IDS']=trim($_POST['S_SP_ids']);
	}else{
		if(isset($_SESSION['B_SP_IND'])){
			if(isset($_GET['pags'])){
				$_SESSION['B_SP_PAG']=$_GET['pags'];
			}
		}else{
			$_SESSION['B_SP_PAG']=1;
			$_SESSION['B_SP_IND']=100;
			$_SESSION['B_SP_IDS']="";
		}
	}
*/
?>