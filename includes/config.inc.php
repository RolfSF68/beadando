<!-- itt vannak az adatok, változók, ezen az egész oldalon -->
<?php
$ablakcim = array(
    'cim' => 'Hornyák alapítvány', //átírtam
);

$fejlec = array(
    'kepforras' => 'header1.png', //átírtam
    'kepforras2' => 'header2.jpg', //hozzáadtam
    'kepalt' => 'logo',
    // 'cim' => 'Mini honlap',
    'motto' => ''
);

$lablec = array(
    // belejavítok, hogy ne csak azt írja a copyright után, hogy 2022, de a kezdetét is
    'copyright' => 'Copyright ' . '1991-' . date("Y") . '.',
    'ceg' => 'Hornyák Alapítvány',
    // én írtam hozzá innentől
    'poweredBy' => 'Powered by HA',
    'kepforras' => 'magyarelelmiszer.png',
    'kepforras2' => 'magnet.png',
    'kepforras3' => 'ETA.png',
    'szoveg' => 'TÁMOGATÓINK'
);

$oldalak = array(
    '/' => array('fajl' => 'cimlap', 'szoveg' => 'Címlap', 'menun' => array(1, 1)),
    // ezeket átírtam foglalkoztatóra
    'foglalkoztato' => array('fajl' => 'foglalkoztato', 'szoveg' => 'Foglalkoztató', 'menun' => array(1, 1)),
    //átírtam galériára
    'galeria' => array('fajl' => 'galeria', 'szoveg' => 'Galéria', 'menun' => array(1, 1)),
    //átírtam a cikkeket uzenetkuldesre
    'uzenetkuldes' => array('fajl' => 'uzenetkuldes', 'szoveg' => 'Üzenetküldés', 'menun' => array(1, 1)),
    //ezt én írtam bele
    'uzenetmegtekintes' => array('fajl' => 'uzenetmegtekintes', 'szoveg' => 'Üzenetmegtekintés', 'menun' => array(1, 1)),

    'tablazat' => array('fajl' => 'tablazat', 'szoveg' => 'Táblázat', 'menun' => array(1, 1)),
    'belepes' => array('fajl' => 'belepes', 'szoveg' => 'Belépés', 'menun' => array(1, 0)),
    'kilepes' => array('fajl' => 'kilepes', 'szoveg' => 'Kilépés', 'menun' => array(0, 1)),
    'belep' => array('fajl' => 'belep', 'szoveg' => '', 'menun' => array(0, 0)),
    'regisztral' => array('fajl' => 'regisztral', 'szoveg' => '', 'menun' => array(0, 0))
);

$hiba_oldal = array('fajl' => '404', 'szoveg' => 'A keresett oldal nem található!');

// ezt én csináltam végig
$mappa = 'galeriakepek/';
$fajltipusok = array('.jpg', '.png');
$mediatipusok = array('image/jpeg', 'image/png');
$datumforma = "Y.m.d. H:i";
$maxmeret = 500 * 1024;
?>