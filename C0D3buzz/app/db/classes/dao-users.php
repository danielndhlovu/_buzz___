<?php

// ------------------------------------------------------------------------------------------------
// 
// The file contains Data Access Object
// Based on MySQL Database 'buzz' and table 'users'
// 
// 
// 
// ------------------------------------------------------------------------------------------------


class UsersDaoBase{
	public $conn;


	//Default contructor, uses config to get connection settings
	public function __construct($conn=null) {
		if($conn==null){
			try {
				$configFile = realpath(dirname( __FILE__ ) )."/../config/connection.ini";
				$ini = parse_ini_file($configFile);
				$this->conn = new PDO($ini['pcb.db.dsn'], $ini['pcb.db.user'], $ini['pcb.db.password']);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}
		}else{
			$this->conn = $conn;
		}
	}



	//Find a record based on a custom criteria
	//eg $dao->find('dbfieldname = :par1' or dbfieldx like :par2, ['par1'=>'somevalue','par2'=>'%somevalue%',]);
	public function find($SQLCriteria, $keyValueArray)
	{
		$SQLCriteria = trim($SQLCriteria);
		if(!is_array($keyValueArray)) $keyValueArray = [];
		if(strtolower(substr($SQLCriteria, 0, 5)) !== 'where' && $SQLCriteria != '' && $SQLCriteria != null){
			$SQLCriteria = ' where ' . $SQLCriteria;
		}
		$stmt = $this->conn->prepare('SELECT  `Idusers`,`FirstName`,`LastName`  FROM users '.$SQLCriteria);
		$stmt->execute($keyValueArray);
		return $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
	}


	//Retrieves the corresponding row for the specified Idusers.
	public function getByIdusers($fparam_Idusers) {
		$stmt = $this->conn->prepare("SELECT  `Idusers`,`FirstName`,`LastName`  FROM users WHERE `Idusers` = :Idusers");
		$stmt->bindParam(':Idusers' , $fparam_Idusers,PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if($stmt->rowCount() > 0) {
			$row = $result[0];
			$UserVO = new User();
			$UserVO->setIdusers($row['Idusers']);
			$UserVO->setFirstName($row['FirstName']);
			$UserVO->setLastName($row['LastName']);
			return $UserVO;
		}
		return null;
	}

	//Saves the User to the database.
	public function save($User) {
		$affectedRows = 0;
		$currentUser = null;
		if(!is_object($User)) return 0;
		if($User->getIdusers() != ""){
			$currentUser = $this->getByIdusers($User->getIdusers());
		}
		//If the query returned a row then update,
		//otherwise insert a new User.
		if(is_object($currentUser) ) {
			$sqlUpdate = "UPDATE users SET ".
			"`FirstName` = :FirstName,".
			"`LastName` = :LastName".
			" WHERE `Idusers`= :Idusers";
			$stmtUpdate = $this->conn->prepare($sqlUpdate);
			$tmpup_FirstName = $User->getFirstName();
			$stmtUpdate->bindParam(':FirstName' , $tmpup_FirstName , PDO::PARAM_STR);
			$tmpup_LastName = $User->getLastName();
			$stmtUpdate->bindParam(':LastName' , $tmpup_LastName , PDO::PARAM_STR);
			$tmpUp_Idusers = $User->getIdusers();
			$stmtUpdate->bindParam(':Idusers' ,$tmpUp_Idusers , PDO::PARAM_INT);


			$stmtUpdate->execute();
			$affectedRows = $stmtUpdate->rowCount();
		}
		else{
			$sqlInsert = "INSERT INTO users(".
				"`Idusers`,".
				"`FirstName`,".
				"`LastName`".
			")".
			"VALUES(".
				":Idusers,".
				":FirstName,".
				":LastName".
			")";
			$stmtInsert = $this->conn->prepare($sqlInsert);

			$tmpi_Idusers = $User->getIdusers();
			$stmtInsert->bindParam(':Idusers' , $tmpi_Idusers, PDO::PARAM_INT);
			$tmpi_FirstName = $User->getFirstName();
			$stmtInsert->bindParam(':FirstName' , $tmpi_FirstName, PDO::PARAM_STR);
			$tmpi_LastName = $User->getLastName();
			$stmtInsert->bindParam(':LastName' , $tmpi_LastName, PDO::PARAM_STR);

			$stmtInsert->execute();
			$affectedRows = $stmtInsert->rowCount();
		}
		return $affectedRows;
	}

	//Deletes the User from the database.
	public function delete($User) {
		$affectedRows = 0;
		$currentUser = null;
		if(!is_object($User)) return 0;
		if($User->getIdusers() != "") {
			$currentUser = $this->getByIdusers($User->getIdusers());
		}
		//If the query returned a row then delete the User
		if(is_object($currentUser) ) {
			$stmtDelete = $this->conn->prepare("DELETE FROM users WHERE `Idusers` = :Idusers");
			$tmpdel_Idusers = $User->getIdusers();
			$stmtDelete->bindParam(':Idusers' , $tmpdel_Idusers , PDO::PARAM_INT);

			$stmtDelete->execute();
			$affectedRows = $stmtDelete->rowCount();
		}
		return $affectedRows;
	}
}

?>