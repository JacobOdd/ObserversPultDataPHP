<?php

namespace ZOV;

use \PDO;

class TypePDO {

	 private $myDb;
	  
	 public function __construct($type="",$nameDB="",$host="",$adminDB="",$passwordDB="") {
	 	  $this->initDB($type,$nameDB,$host,$adminDB,$passwordDB);
	 }


	 public function getPPK($nameTable = "ppk") {
       	 $stmt = $this->myDb->prepare("SELECT * FROM $nameTable");

      	 $stmt->execute();

         if($stmt->rowCount() > 0) {
           	$listPPK = $stmt->fetchAll();
           	$stmt->closeCursor();
           	return $listPPK;
         } else {
            $stmt->closeCursor();
            return false;
        }
    }


      public function getPPKWhere($nameTable,$requestColumnIsOn,$requestValueColumnIsOn) {
       	 $stmt = $this->myDb->prepare("SELECT * FROM $nameTable WHERE $requestColumnIsOn = :requestValueColumnIsOn");
         $stmt->bindParam(":requestValueColumnIsOn",$requestValueColumnIsOn);

      	 $stmt->execute();

         if($stmt->rowCount() > 0) {
           	$listPPK = $stmt->fetchAll();
           	$stmt->closeCursor();
           	return $listPPK;
         } else {
            $stmt->closeCursor();
            return false;
        }
    }


	 private function initDB($type="mysql",$nameDB = "laravel",$host = "localhost",$adminDB = "root",$passwordDB = "") {
	  	 $this->myDb = new PDO("{$type}:host={$host};dbname={$nameDB}",$adminDB,$passwordDB,
	  	  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
	  	 );
	 }


}