<?php
use Goutte\Client;

$crawler = $client->request('GET', $editlink);
$html = $crawler->html();

$firststring='42986856712';


// Delete...

$pos = strpos($html, '$firststring');
$pos2 = strpos($html, "delete.php", $pos);
$pos3 = strpos($html, '"', $pos2);
if ( $pos < 1 || $pos2 < 1 || $pos3 < 1 ) {
    echo "Could not find delete.php link";
    return;
}

?>