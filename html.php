<?php

$myfile = fopen("mail-list.txt", "w") or die("Unable to open file!");


$emails = array();

$dom = new DOMDocument();

$cont = 1;
for ($i = 1; $i <= 44; $i++) {
    $page = "DE-Info pages/pag".$i.".html";
    if($page == ("DE-Info pages/pag7.html"))
            continue;
    else {
    $html = file_get_contents($page);
    $dom->validateOnParse = true; //<!-- this first
    @$dom->loadHTML($html);        //'cause 'load' == 'parse
    $dom->preserveWhiteSpace = false;
    $xpath = new DOMXPath($dom);
    $filtered = $xpath->query("//input[@name='user']");

    for($j=0;$j<$filtered->length;$j++)
    {
        $emails[$cont]=$mail = urldecode($filtered->item($j)->getAttribute('value'));
        $mail = urldecode($filtered->item($j)->getAttribute('value'))."\r\n";
        //$mail = str_replace("@"," at ", $mail);
        fwrite($myfile, $mail);
        //echo ($cont++).")".$mail."<br/>";
        echo ($cont++).")".$mail."<br/>";
    }
   

    }
 // echo "<br/>"; 
}
fclose($myfile);
$emails = array_unique($emails);
//$emails2 = str_replace("@"," at ", $emails);
print_r($emails2);