<?php 
/*
 *  ПРОЧТИТЕ ЭТО ВАЖНО !!!
 * как установить значение и не повредить проекту !!!
 * функция define("НЕ МЕНЯТЬ","МЕНЯТЬ"); 1 ПАРАМЕТР НЕ МЕНЯТЬ 2 ПАРАМЕТР МЕНЯТЬ
 *
 *
 *
*/

// CONNECT DB ДАННЫЕ ДЛЯ ПОДКЛЮЧЕНИЯ
define("NAME_DB", "master"); // ИМЯ БАЗЫ ДАННЫХ
define("HOST", "COMPUTER"); // ХОСТ
define("ADMIN_DB", "iDeath"); // ЛОГИН
define("PASSWORD_DB", "1"); // ПАРОЛЬ

// CHARACTERS DB (TABLE,COLUMN). ДАННЫЕ НАЗВАНИЕ ТАБЛИЦЫ И СТРУКТУРЫ (СТОЛБЦЫ) ДЛЯ ТОГО ЧТОБЫ ЗАБИРАТЬ ДАННЫЕ
// СТОЛБЦЫ КОТОРЫЕ НУЖНЫ, ЕСЛИ ЖЕ НЕКОТОРЫХ СТОЛБЦОВ НЕТ, ТО ИГНОРИРУЙТЕ ИХ.
define("NAME_TABLE_DB","ppk");
define("PPK_ID_COLUMN_DB","ppk_id");
define("ADDRESS_COLUMN_DB","address");
define("IS_ON_COLUMN_DB","isOn");
define("NUMBER_OBJECT_COLUMN_DB","number_object");
define("LATITUDE_COLUMN_DB", "latitude");
define("LONGITUDE_COLUMN_DB", "longitude");

// CHARACTERS DB REQUEST (COLUMN) Example: SELECT * FROM $nameTableDB WHERE requestIsOn = true;
// Если же такого столбца нет то пропишите 'UNKNOWN' или 'unknown'
define("IS_EXISTS_IS_ON_COLUMN_DB","isOn");
// Вообщем над вытягивать данные у которых включена тревога НО эт если IS_EXISTS_IS_ON_COLUMN_DB cуществует в таблице. 
// По какому параметру boolean,string,double,integer.Example:"1","1.0","true",1,1.0,true
define("IS_ON_VALUE", 1);

// УНИКАЛЬНЫЙ ПРЕФИКС ЕЛЕМЕНТА СООТВЕТСТВИЮ PPK ПУЛЬТУ ДЛЯ БАЗЫ ДАННЫХ FIREBASE (ЧТОБЫ ОПРЕДЕЛЯТЬ НА FIREBASE УНИКАЛЬНЫЙ ППК) 
// (НЕ МЕНЯТЬ ЭТОТ ПАРАМЕТР)
define("TYPE_PULT_FIREBASE", "kaskad_one");

?>