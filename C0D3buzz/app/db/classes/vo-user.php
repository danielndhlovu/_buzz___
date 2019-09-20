<?php

// ------------------------------------------------------------------------------------------------
// 
// The file contains Value Object(s)
// Based on MySQL Database 'buzz' and table 'users'
// 
// 
// 
// ------------------------------------------------------------------------------------------------

class UserBase implements \JsonSerializable{
	protected $Idusers; //Idusers int(11)
	protected $FirstName; //FirstName varchar(45)
	protected $LastName; //LastName varchar(45)


	//Sets value of Idusers
	public function setIdusers($new_Idusers){
		$this->Idusers = $new_Idusers;
	}

	//Gets value of Idusers
	public function getIdusers(){
		return $this->Idusers;
	}

	//Sets value of FirstName
	public function setFirstName($new_FirstName){
		$this->FirstName = $new_FirstName;
	}

	//Gets value of FirstName
	public function getFirstName(){
		return $this->FirstName;
	}

	//Sets value of LastName
	public function setLastName($new_LastName){
		$this->LastName = $new_LastName;
	}

	//Gets value of LastName
	public function getLastName(){
		return $this->LastName;
	}



	//Implements the JsonSerializable Interface
	public function jsonSerialize(){
		return get_object_vars($this);
	}

}

?>