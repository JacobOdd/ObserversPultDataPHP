<?php

use \PDO;


$myDb = new PDO("mysql:host=localhost;dbname=example",'root','',
	  	  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
	  	 );

$stmt = $myDb->prepare("SELECT * FROM ppk");

$stmt->execute();

   $listPPK = $stmt->fetchAll();	
   $stmt->closeCursor();
   print_r($listPPK);
