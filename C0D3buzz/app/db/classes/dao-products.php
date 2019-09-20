<?php

// ------------------------------------------------------------------------------------------------
// 
// The file contains Data Access Object
// Based on MySQL Database 'buzz' and table 'products'
// 
// 
// 
// ------------------------------------------------------------------------------------------------


class ProductsDaoBase{
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
		$stmt = $this->conn->prepare('SELECT  `ID`,`ProductsName`,`ProductImage`  FROM products '.$SQLCriteria);
		$stmt->execute($keyValueArray);
		return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
	}


	//Retrieves the corresponding row for the specified ID.
	public function getByID($fparam_ID) {
		$stmt = $this->conn->prepare("SELECT  `ID`,`ProductsName`,`ProductImage`  FROM products WHERE `ID` = :ID");
		$stmt->bindParam(':ID' , $fparam_ID,PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if($stmt->rowCount() > 0) {
			$row = $result[0];
			$ProductVO = new Product();
			$ProductVO->setID($row['ID']);
			$ProductVO->setProductsName($row['ProductsName']);
			$ProductVO->setProductImage($row['ProductImage']);
			return $ProductVO;
		}
		return null;
	}

	//Saves the Product to the database.
	public function save($Product) {
		$affectedRows = 0;
		$currentProduct = null;
		if(!is_object($Product)) return 0;
		if($Product->getID() != ""){
			$currentProduct = $this->getByID($Product->getID());
		}
		//If the query returned a row then update,
		//otherwise insert a new Product.
		if(is_object($currentProduct) ) {
			$sqlUpdate = "UPDATE products SET ".
			"`ProductsName` = :ProductsName,".
			"`ProductImage` = :ProductImage".
			" WHERE `ID`= :ID";
			$stmtUpdate = $this->conn->prepare($sqlUpdate);
			$tmpup_ProductsName = $Product->getProductsName();
			$stmtUpdate->bindParam(':ProductsName' , $tmpup_ProductsName , PDO::PARAM_STR);
			$tmpup_ProductImage = $Product->getProductImage();
			$stmtUpdate->bindParam(':ProductImage' , $tmpup_ProductImage , PDO::PARAM_STR);
			$tmpUp_ID = $Product->getID();
			$stmtUpdate->bindParam(':ID' ,$tmpUp_ID , PDO::PARAM_INT);


			$stmtUpdate->execute();
			$affectedRows = $stmtUpdate->rowCount();
		}
		else{
			$sqlInsert = "INSERT INTO products(".
				"`ID`,".
				"`ProductsName`,".
				"`ProductImage`".
			")".
			"VALUES(".
				":ID,".
				":ProductsName,".
				":ProductImage".
			")";
			$stmtInsert = $this->conn->prepare($sqlInsert);

			$tmpi_ID = $Product->getID();
			$stmtInsert->bindParam(':ID' , $tmpi_ID, PDO::PARAM_INT);
			$tmpi_ProductsName = $Product->getProductsName();
			$stmtInsert->bindParam(':ProductsName' , $tmpi_ProductsName, PDO::PARAM_STR);
			$tmpi_ProductImage = $Product->getProductImage();
			$stmtInsert->bindParam(':ProductImage' , $tmpi_ProductImage, PDO::PARAM_STR);

			$stmtInsert->execute();
			$affectedRows = $stmtInsert->rowCount();
		}
		return $affectedRows;
	}

	//Deletes the Product from the database.
	public function delete($Product) {
		$affectedRows = 0;
		$currentProduct = null;
		if(!is_object($Product)) return 0;
		if($Product->getID() != "") {
			$currentProduct = $this->getByID($Product->getID());
		}
		//If the query returned a row then delete the Product
		if(is_object($currentProduct) ) {
			$stmtDelete = $this->conn->prepare("DELETE FROM products WHERE `ID` = :ID");
			$tmpdel_ID = $Product->getID();
			$stmtDelete->bindParam(':ID' , $tmpdel_ID , PDO::PARAM_INT);

			$stmtDelete->execute();
			$affectedRows = $stmtDelete->rowCount();
		}
		return $affectedRows;
	}
}

?>