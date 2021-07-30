<?php
if(!$pxdoc = px_new()) {
  /* Error handling */
}
$fp = fopen("test.db", "w+");
$fields = array(array("col1", "S"), array("col2", "I"));
if(!px_create_fp($pxdoc, $fp, $fields)) {
  /* Error handling */
}
px_set_parameter($pxdoc, "tablename", "testtable");
for($i=-50; $i<50; $i++) {  
  $rec = array($i, -$i);
  px_put_record($pxdoc, $rec);
}   
px_close($pxdoc);
px_delete($pxdoc);
fclose($fp);
?>
