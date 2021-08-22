<?php

include "Hijri_GregorianConvert.php";
include "../hijri.php";
$DateConv=new Hijri_GregorianConvert;


echo "<br>";



$format="YYYY-MM-DD";
$date="1442-10-05";
echo "src: $date<br>";
$result=$DateConv->HijriToGregorian($date,$format);

echo "Hijri to Gregorian Result: ".$result."<br> gre to hijri:<br>";
echo((new hijri\datetime($result." 23:45:57", NULL,"ar" ))->format("D _j _F _Y هـ"));
echo "</br>" ;


$format="YYYY/MM/DD";
$date="2021-05-17";
echo "src: $date<br>";

echo $DateConv->GregorianToHijri($date,$format);



?>