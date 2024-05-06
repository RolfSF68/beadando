<div id="fodoboz">
    <!-- ----------------------------MEGHÍVOM AZ SZERVER OLDALI ELLENŐRZÉST, LOGICALS/ELLENORZES.PHP-T -->
    <?php include('./logicals/ellenorzes.php'); ?>
    <!-- ---------------------------ADATBÁZISBA FELVITEL---------------------------------- -->

    <?php
    if ($FlagTargy == "Helyes" && $FlagEmail == "Helyes" && $FlagSzoveg == "Helyes") { ?>
        <!-- ezt ide teszem, hogy akkor írja ki ezeket, ha minden okés -->
        <?php
        echo "<p class=kiiratas><strong>Tárgy: </strong>. $_POST[targy]</p>";
        echo "<p class=kiiratas><strong>E-mail: </strong>. $_POST[email]</p>";
        echo "<p class=kiiratas><strong>Szöveg: </strong>. $_POST[szoveg]</p>";
        ?>
    <?php
        try {
            //unix idő időzónáját beállítom
            date_default_timezone_set("Europe/Budapest");
            //unix időt elmentem, ami épp aktuális
            $unixido = time();
            //most szépen átalakítom az unix időt a date metódussal év, hónap nap, óra, perc szerint
            //db-ben majd ezt használom fel, év-hónap-nap-óra-perc-mp-re
            // $ido = date("Y-m-d-h-i-s", $unixido);
            // csatlakozás az adatbázishoz
            $adatbazisom = new PDO("mysql:host=localhost;dbname=adatb", "root", "");
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
            $adatbazisom->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
            // adatbázisba beviszem az adatot
            $sqlInsert = "insert into uzenettable (id, targy, email, szoveg, ido) values (0, '$_POST[targy]', '$_POST[email]', '$_POST[szoveg]', '$unixido');";
            $adatbazisom->exec($sqlInsert);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    ?>

    <!-- //-------------------------------------ADATOK KIÍRATÁSA ELLENŐRZÉSKÉP-------------------------------------
// echo "<pre>";
// var_dump($_POST);
// echo "$unixido";
// echo "</pre>"; -->

</div>