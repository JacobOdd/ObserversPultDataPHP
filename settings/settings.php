<?php 
/*
 *  ПРОЧТИТЕ ЭТО ВАЖНО !!!
 * как установить значение и не повредить проекту !!!
 * функция define("НЕ МЕНЯТЬ","МЕНЯТЬ"); 1 ПАРАМЕТР НЕ МЕНЯТЬ 2 ПАРАМЕТР МЕНЯТЬ
 *
 *
 *
*/

// CHARACTERS DB (TABLE,COLUMN). ДАННЫЕ НАЗВАНИЕ ТАБЛИЦЫ И СТРУКТУРЫ (СТОЛБЦЫ) ДЛЯ ТОГО ЧТОБЫ ЗАБИРАТЬ ДАННЫЕ
// СТОЛБЦЫ КОТОРЫЕ НУЖНЫ, ЕСЛИ ЖЕ НЕКОТОРЫХ СТОЛБЦОВ НЕТ, ТО ИГНОРИРУЙТЕ ИХ.
// ДЛЯ ВСЕХ БАЗ ДАННЫХ 
define("NAME_TABLE_DB","Events.DB");
define("PPK_ID_COLUMN_DB","ACCOUNT");
define("ADDRESS_COLUMN_DB","EVENT");
define("IS_ON_COLUMN_DB","isOn");
define("NUMBER_OBJECT_COLUMN_DB","number_object");
define("LATITUDE_COLUMN_DB", "latitude");
define("LONGITUDE_COLUMN_DB", "longitude");

// CHARACTERS DB REQUEST (COLUMN) Example: SELECT * FROM $nameTableDB WHERE requestIsOn = true;
// Если же такого столбца нет то пропишите 'UNKNOWN' или 'unknown'
// ДЛЯ ВСЕХ БАЗ ДАННЫХ 
define("IS_EXISTS_IS_ON_COLUMN_DB","isOnSSS");
// Вообщем над вытягивать данные у которых включена тревога НО эт если IS_EXISTS_IS_ON_COLUMN_DB cуществует в таблице. 
// По какому параметру boolean,string,double,integer.Example:"1","1.0","true",1,1.0,true
// ДЛЯ ВСЕХ БАЗ ДАННЫХ КРОМЕ PARADOX
define("IS_ON_VALUE", 1);

// УНИКАЛЬНЫЙ ПРЕФИКС ЕЛЕМЕНТА СООТВЕТСТВИЮ PPK ПУЛЬТУ ДЛЯ БАЗЫ ДАННЫХ FIREBASE (ЧТОБЫ ОПРЕДЕЛЯТЬ НА FIREBASE УНИКАЛЬНЫЙ ППК) 
// (НЕ МЕНЯТЬ ЭТОТ ПАРАМЕТР)
// ДЛЯ ВСЕХ БАЗ ДАННЫХ 
define("TYPE_PULT_FIREBASE", "grifon_one");

?>