<?php

try {
    //kapcsolódás az adatbázishoz
    $adatbazisom = new PDO("mysql:host=localhost;dbname=adatb", "root", "");
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $adatbazisom->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
    // adatbázisból lekérem az adatot
    $sqlSelect = "select * from uzenettable order by ido desc;";
    // ezt ki kellett kommenteznem, hogy ne hajtsa simán végre a parancsot, hanem majd fetchelje
    // $adatbazisom->exec($sqlSelect);
    //---------------EZEK AZ ÚJDONSÁGOK, FETCHELEK MERT TÖBB EREDMÉNY VAN---------------------
    $result = $adatbazisom->query($sqlSelect);

    // itt állítom elő, hogy van-e sor a táblázatban, elsőnek kijelölök mindent, majd megszámolom a sorokat
    //és ezt változóba mentem, ami 0-t ad vissza, ha nincsen sor, amúgy azt a számot, ahány sor van
    //ez ahhoz kell, ha üres a táblázatom, ne írja ki a táblázatot, hanem, hogy üres a táblázat
    $seged = $adatbazisom->query('select * from uzenettable');
    $row_count = $seged->rowCount();
    // echo $row_count;  -->ezzel ellenőrzöm, hogy mi van a row_count változóba
    if ($row_count != 0) {
?>
        <div id="cim">
            <caption>Küldött üzenetek</caption>
        </div>
        <table>
            <tr>
                <th>Tárgy</th>
                <th>E-mail cím</th>
                <th>Üzenet</th>
                <th>Küldés időpontja</th>
            </tr>
            <?php
            while ($row = $result->fetch()) { // amíg van sor, addig megy a while ciklus
                // print_r($row);
                // -->ezzel íratom ki a row tömböt, segítség, így láthatom mit milyen indexen
                //érhetek el és mi van benne.
                echo "<tr>";
                echo "<td>" . $row['targy'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['szoveg'] . "</td>";
                echo "<td>" . date('Y/m/d H:i:s', $row['ido']) . "</td>";
                echo "</tr>";
            } ?>
        </table>
<?php
    } else echo " <p id=hiba>Üres a táblázat</p>";
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>