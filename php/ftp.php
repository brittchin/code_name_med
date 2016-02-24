
<?php

class Ftp{

	private $connectionId;
	private $ftpServer = "";
	private $ftpUser = "";
	private $ftpPassword = "";
	$file = fopen("","r");
	$remote_file = fopen("","a");

	public function __construct() {
		if (!$file is_null){
			ftpConnect($ftpServer,$ftpUser,$ftpPassword);
		}
		else{
			echo "No updates since previous upload\n";
		}
	 }

	 public function ftpConnect($server,$user,$password){

	 	$this->connectionId = ftp_connect($server);
			$loginResult = ftplogin($this->connectionId, $user, $password);
		if($this->connectionId){
			echo "Connected\n";
			//upload file 
			ftpUpload($file,$remote_file);
			ftp_close($connectionId);
		}
		else{
			echo " Not connected\n";
		}
				
	 }

	 public function ftpUpload($file,$remote_file){
	 	$upload = ftp_put($this->connectionId, $this->remote_file, $this->file, mode);
			if($upload){
				echo "File uploaded\n";
				}
				else{
					"Failed to upload file\n";
				}
	 }

}
// $ftpServer = "";
// $ftpUser = "";
// $ftpPassword = "";

// $connectionId = ftp_connect($ftpServer);
// 			$loginResult = ftp_login($connectionId, $ftpUser, $ftpPassword);

// 			if($connectionId){
// 				echo "Connected\n";
// 			}
// 			else{
// 				echo "Not connected\n";
// 			}
?>
