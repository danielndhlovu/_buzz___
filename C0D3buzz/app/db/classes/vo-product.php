<?php

// ------------------------------------------------------------------------------------------------
// 
// The file contains Value Object(s)
// Based on MySQL Database 'buzz' and table 'products'
// 
// 
// 
// ------------------------------------------------------------------------------------------------

class ProductBase implements \JsonSerializable{
	protected $ID; //ID int(11)
	protected $ProductsName; //ProductsName varchar(45)
	protected $ProductImage; //ProductImage varchar(45)


	//Sets value of ID
	public function setID($new_ID){
		$this->ID = $new_ID;
	}

	//Gets value of ID
	public function getID(){
		return $this->ID;
	}

	//Sets value of ProductsName
	public function setProductsName($new_ProductsName){
		$this->ProductsName = $new_ProductsName;
	}

	//Gets value of ProductsName
	public function getProductsName(){
		return $this->ProductsName;
	}

	//Sets value of ProductImage
	public function setProductImage($new_ProductImage){
		$this->ProductImage = $new_ProductImage;
	}

	//Gets value of ProductImage
	public function getProductImage(){
		return $this->ProductImage;
	}



	//Implements the JsonSerializable Interface
	public function jsonSerialize(){
		return get_object_vars($this);
	}

}

?>