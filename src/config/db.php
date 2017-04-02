<?
	class db{
		// Properties
		private $dbhost = "localhost:8889";
		private $dbname = "mysdu";
		private $dbuser = "root";
		private $dbpass = "root";
		// Connect
		public function connect(){
		    $conn = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", 
		    							$this->dbuser, $this->dbpass);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    return $conn;
		}
		public function doLogin($login){
			try{
			    $connect = $this->connect();
			    $sql  = "select password from student where sdu_id = ".$login;
			    //return $sql;
			    $stmtt = $connect->query($sql);
			 	$pass = $stmtt->fetchAll(PDO::FETCH_COLUMN, 0);
			 	$connect = null; 
			    return $pass[0];
			}catch(PDOException $e){
		 	//echo 'heelo';
		 	return '{"error":{"text": '.$e->getMessage().'}';
		  }
		}
	}
?>