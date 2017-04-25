<?php

function currencyConverter($from_Currency,$to_Currency,$amount) {
$from_Currency = urlencode($from_Currency);
$to_Currency = urlencode($to_Currency);

$encode_amount = 1;
$get = file_get_contents("http://www.xe.com/currencyconverter/convert/?Amount=1&From=$from_Currency&To=$to_Currency");
$get = explode("uccResultAmount'>",$get);

    $get = explode("</span>",$get[1]);
$converted_currency=$get[0];
return $converted_currency;
}
$currency="AED:AED,AED:EUR,AED:GBP,AED:QAR,AED:SEK,AED:SAR,AED:KWD,AED:MAD,AED:USD,EUR:AED,EUR:EUR,EUR:GBP,EUR:QAR,EUR:SEK,EUR:SAR,EUR:KWD,EUR:MAD,EUR:USD,GBP:AED,GBP:EUR,GBP:GBP,GBP:QAR,GBP:SEK,GBP:SAR,GBP:KWD,GBP:MAD,GBP:USD,SEK:AED,SEK:EUR,SEK:GBP,SEK:QAR,SEK:SEK,SEK:SAR,SEK:KWD,SEK:MAD,SEK:USD,SAR:AED,SAR:EUR,SAR:GBP,SAR:QAR,SAR:SEK,SAR:SAR,SAR:KWD,SAR:MAD,SAR:USD,KWD:AED,KWD:EUR,KWD:GBP,KWD:QAR,KWD:SEK,KWD:SAR,KWD:KWD,KWD:MAD,KWD:USD,MAD:AED,MAD:EUR,MAD:GBP,MAD:QAR,MAD:SEK,MAD:SAR,MAD:KWD,MAD:MAD,MAD:USD,USD:AED,USD:EUR,USD:GBP,USD:QAR,USD:SEK,USD:SAR,USD:KWD,USD:MAD,USD:USD";
$cur=explode(",",$currency);

$size=count($cur);



$filename = "export_".date("Y.m.d").".csv";
	$csv_file = fopen('php://output', 'w');
	
	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename="'.$filename.'"');
$header_row = array("Source", "ConvertedTo", "Value");
	fputcsv($csv_file,$header_row,',','"');
for ($i=0;$i<=$size-1;$i++)
{
    $amount ="1";
// change From Currency according to your needs
    $value=explode(":",$cur[$i]);

    $from_Curr =$value[0];
   
// change To Currency according to your needs
$to_Curr =$value[1];
    if($from_Curr!=$to_Curr)
$converted_currency=currencyConverter($from_Curr, $to_Curr, $amount);
else
   $converted_currency=1; 
    // Print outout
 //   echo $converted_currency;
 
    $row = array("$value[0]" , "$value[1]" ,"$converted_currency");
    fputcsv($csv_file,$row,',','"');

}
fclose($csv_file);

?>
