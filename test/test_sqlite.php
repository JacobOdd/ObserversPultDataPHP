<?php

namespace ZOV;

use \SQLite3;
/**
 * Простой пример расширения класса SQLite3 и изменения параметров конструктора.
 * После чего использование метода open для инициализации БД.
 */
$db = new SQLite3('sqlite.db');

$results = $db->query('SELECT * FROM Events.DB');
while ($row = $results->fetchArray()) {	
    print_r($row);
}