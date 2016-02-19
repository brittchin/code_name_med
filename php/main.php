
<?php





class Data{

	private $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = hostname)(PORT = portnumb)))(CONNECT_DATA=(SID=)))" ;
	private static $_instance; //The single instance
	private $dbuser="";
	private $dbpass="";
	private $conn;


	public static function getInstance() {

		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private function __construct() {	
	
		$this->conn = oci_connect( $this->dbuser, $this->dbpass, $this->db);
		if (!$this->conn) {
		    $e = oci_error();
		    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		
	}

	public function getConnection(){
		return $this->conn;
	}

	public function selectQuery($q){

		$stid = oci_parse($this->conn, $q);
		oci_execute($stid);

        $array=array();   
        while (($row = oci_fetch_array($stid,
		OCI_BOTH)) != false) {
        	$array[]=$row;
			// print_r($row['FIRSTNAME']."  ".$row['LASTNAME']."  ".$row["DOB"]."</br>");

		}
		
		oci_free_statement($stid);
		return  json_encode($array);
	}

	public function updateQuery($update,$table="UWIMONA.UWM_MEDECUS_DATA"){
		//$update = " update TABLENAME SET LASTMOD=current_timestamp WHERE TABLE_NAME=:table;";// update example with table alias
		$stmt = oci_parse($conn, $update);
		oci_bind_by_name($stmt, ':table', $table);
		$result = oci_execute($stmt, OCI_DEFAULT);
		if (!$result) {
		  echo oci_error();   
		}
		return $result;
	}


	public function __destruct() {
		oci_close($this->conn);
	}

}


$d = Data::getInstance();

if($_POST['request'] === 'get'){
	
	$q="query here please";
	$sql=$d->selectQuery($q);

	echo $sql;

}elseif($_POST['request'] === 'update'){


}else{

}


?>
