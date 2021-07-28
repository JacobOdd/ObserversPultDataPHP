<?php

namespace ZOV;

use \PDO;

class TypePDO {

	 private $myDb;
	  
	 public function __construct($type="",$nameDB="",$host="",$adminDB="",$passwordDB="") {
	 	  $this->initDB($type,$nameDB,$host,$adminDB,$passwordDB);
	 }


	 public function getPPK($nameTable = "ppk") {
     try{
       	$stmt = $this->myDb->prepare("SELECT * FROM $nameTable");

      	$stmt->execute();

        $listPPK = $stmt->fetchAll();
        $stmt->closeCursor();
        return $listPPK;
      } catch (Throwable $t) {
          return false;
           // Executed only in PHP 7, will not match in PHP 5
      } catch (Exception $e) {
          return false;
           // Executed only in PHP 5, will not be reached in PHP 7
      }
    }


      public function getPPKWhere($nameTable,$requestColumnIsOn,$requestValueColumnIsOn) {
        try{
         	$stmt = $this->myDb->prepare("SELECT * FROM $nameTable WHERE $requestColumnIsOn = :requestValueColumnIsOn");
          $stmt->bindParam(":requestValueColumnIsOn",$requestValueColumnIsOn);

        	$stmt->execute();

          $listPPK = $stmt->fetchAll();
          $stmt->closeCursor();
          return $listPPK;
        } catch (Throwable $t) {
          return false;
           // Executed only in PHP 7, will not match in PHP 5
        } catch (Exception $e) {
          return false;
           // Executed only in PHP 5, will not be reached in PHP 7
        }
    }


	 private function initDB($typeHostNameDB,$adminDB = "root",$passwordDB = "") {
	  	 $this->myDb = new PDO($typeHostNameDB,$adminDB,$passwordDB,
	  	  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
	  	 );
	 }


}