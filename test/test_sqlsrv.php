<?php

use \PDO;


$myDb = new PDO("sqlsrv:Server=COMPUTER;Database=master",'iDeath','1',
	  	  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
	  	 );

$stmt = $myDb->prepare("SELECT * FROM ppk");

$stmt->execute();

$listPPK = $stmt->fetchAll();	
$stmt->closeCursor();
print_r($listPPK);
