<?php

// ------------------------------------------------------------------------------------
// This is a consolidated include file for the Data Access Object and Value Objects
// ------------------------------------------------------------------------------------


//Require all Value Objects
require_once(realpath(dirname( __FILE__ ) )."/classes/vo-product.php");
require_once(realpath(dirname( __FILE__ ) )."/classes/vo-user.php");
if (file_exists(realpath(dirname(__FILE__))."/ext/vo-product.php")){
require_once(realpath(dirname( __FILE__ ) )."/ext/vo-product.php");
}else{
require_once(realpath(dirname( __FILE__ ) )."/ext/(##default##)vo-product.php");
}
if (file_exists(realpath(dirname(__FILE__))."/ext/vo-user.php")){
require_once(realpath(dirname( __FILE__ ) )."/ext/vo-user.php");
}else{
require_once(realpath(dirname( __FILE__ ) )."/ext/(##default##)vo-user.php");
}

//Require all Data Access Objects
require_once(realpath(dirname( __FILE__ ) )."/classes/dao-products.php");
require_once(realpath(dirname( __FILE__ ) )."/classes/dao-users.php");
if (file_exists(realpath(dirname(__FILE__))."/ext/dao-products.php")){
require_once(realpath(dirname( __FILE__ ) )."/ext/dao-products.php");
}else{
require_once(realpath(dirname( __FILE__ ) )."/ext/(##default##)dao-products.php");
}
if (file_exists(realpath(dirname(__FILE__))."/ext/dao-users.php")){
require_once(realpath(dirname( __FILE__ ) )."/ext/dao-users.php");
}else{
require_once(realpath(dirname( __FILE__ ) )."/ext/(##default##)dao-users.php");
}
