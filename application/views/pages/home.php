<?php
/*
$numero = "12345";

$prefijos = "/\b[1-3]+\b/";

$prefijos = ("/^[1-3]+$|^123[4-8]+$/");

if (preg_match($prefijos, $numero)) :
      print "Match found!";
      endif;
*/

// Numero, Valor
$prefijos = array
  (
  array("CNT","0[2-8][0-9]+","0.5"),
  array("CLARO","09[6-9][0-9]+","0.5"),
  array("MOVI","09[1-5][0-9]+","0.5")
  );
print "<pre>";
print_r($prefijos);
print "</pre>";

print $prefijos[0][0];
print $prefijos[0][1];
print $prefijos[0][2];


?>
