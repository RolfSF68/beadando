 <!-- <!ezen az oldalon vannak azok a dolgok, amik a galéria menüre kattintva előjönnek -->
 <!-- -----------------------------------------MEGJELENÍTÉSE A KÉPEKNEK-------------------------------------- -->

 <?php
    // include('includes/config.inc.php');---FONTOS, EZT NE TEGYEM BELE, MERT MÁR EGYSZER BETÖLTÖTTE EZT AZ
    //INDEX.PHP és onnan eléri minden oldal már így
    // létrehozok egy tömböt
    $kepek = array();
    //könyvtárazonosító, azaz megnyitott könyvtárat az olvaso nevű változóba menti
    $olvaso = opendir($mappa);
    //while-al teszem tömbbe az elemeket, addig olvassa, míg a végére nem ér a könyvtárban lévő elemeknek és
    //fajl változóba teszem a beolvasott fájlnevet vagy könyvtárnevet
    while (($fajl = readdir($olvaso)) !== false)
        //is_file által ellenőrzöm, hogy megfelelő-e a formátuma az éppen beolvasott fájlnak vagy könyvtárnak
        //és $mappa.$fajl által jön ki az ellenőrizendő, konkatenációval
        if (is_file($mappa . $fajl)) {
            //amennyiben jó a formátum, akkor első paraméterben átadom a $fajl tartalmát, majd a hossza-4-től
            //jelenítsen és az eredményt alakítsa kisbetűssé
            $vege = strtolower(substr($fajl, strlen($fajl) - 4));
            if (in_array($vege, $fajltipusok))
                //filemtime paraméterébe konkatenált szöveget teszek, és az elején előkészített asszociatív tömbbe
                //  helyezem amit kapok
                $kepek[$fajl] = filemtime($mappa . $fajl);
        }
    //bezárom a könyvtárat
    closedir($olvaso);

    // Megjelenítés logika:
    ?>

 <h1>Galéria</h1>

 <div id="galeria">

     <?php
        //  rendezem a $kepeket, amikben ugye a kiválogatott képek nevei vannak
        arsort($kepek);
        // most létrehozom a datum változót és a fajl változót, fajl változóba kerül a kulcs, datumba az érték
        foreach ($kepek as $fajl => $datum) {
        ?>
         <div class="kep">
             <!-- most leteszem a képet (img) és a képre mutató hivatkozást (a) -->
             <a href="<?php echo $mappa . $fajl ?>">
                 <img src="<?php echo $mappa . $fajl ?>">
             </a>
             <!-- kiírom a fájl nevét és a módosítás dátumát -->
             <p> <strong>Év: <?php echo $fajl; ?></strong></p>
             <p> <strong>Dátum: <?php echo date($datumforma, $datum); ?></strong></p>
         </div>
     <?php
        }
        ?>
 </div>

 <!--------------------------------------------------- KÉPFELTÖLTÉS------------------------------------ -->
 <?php
    //  include('config.inc.php');---ez most sem kell, hiszen az index.php ezt már megtette
    // elküldés utáni üzeneteket ebben tárolom
    $uzenet = array();
    // az első betöltésnél a $_post tömb még üres, tehát nem fut le
    if (isset($_POST['kuld'])) {
        // $_FILES egy fájlok küldésére alkalmas tömb
        foreach ($_FILES as $fajl) { // Végig megy a feltöltött fájlokon és a $fajl-ba teszi. (max. 3)
            if ($fajl['error'] == 4);
            // Ha csak egy képet választunk ki, ami ugye kötelező az űrlapon, másik kettő tetszőleges, akkor a 
            //másik kettőnél: $fajl['error'] == 4, ilyenkor nem csinál semmit (üres utasítás)
            elseif (!in_array($fajl['type'], $mediatipusok)) // ha a fájl nem jpg vagy png
                $uzenet[] = " Nem megfelelő típus: " . $fajl['name'];
            elseif (
                $fajl['error'] == 1
                // A fájl túllépi a php.ini -ben megadott maximális méretet
                // The configuration file (php.ini) is read when PHP starts up.
                // For the server module versions of PHP, this happens only once when the web server is started.
                // http://php.net/manual/en/configuration.file.php
                or $fajl['error'] == 2
                // A fájl túllépi a HTML űrlapban megadott maximális méretet.
                // Az INPUT-nál így is megadható lenne: (nincs megadva. próbálják ki!)
                // egy külön input elem:
                // pl. <input name="MAX_FILE_SIZE" value="1048576" type="hidden"/>
                or $fajl['size'] > $maxmeret
            )
                $uzenet[] = " Túl nagy állomány: " . $fajl['name'];
            else {
                $vegsohely = $mappa . strtolower($fajl['name']); // kisbetűssé alakítja a fájl nevet
                if (file_exists($vegsohely)) // Ha a fájl már létezik
                    $uzenet[] = " Már létezik: " . $fajl['name'];
                else {
                    move_uploaded_file($fajl['tmp_name'], $vegsohely); // felmásolja
                    // fájl másolása
                    // $_FILES["file"]["tmp_name"]: a szerveren tárolt fájl másolatának átmeneti neve
                    // Azért jó, hogy átmeneti néven másolja először, hogy ha van már a másolandó nevű,
                    // akkor ne írja azt felül.
                    $uzenet[] = ' Ok: ' . $fajl['name'];
                }
            }
        }
    } ?>
 <!-- Megjelenítés logika: -->

 <!-- beleírtam az $_session egy tagját, és így ellenőrzöm beléptek-e, ezt a változót a belep.php-nél találom 
tehát az egész űrlap megjelenést beletettem szépen egy if feltétel blokkba, és akkor jelenik meg, 
ha igaz az ág, ha hamis, akkor meg kiírja, hogy feltöltéshez lépjen be-->

 <?php if (isset($_SESSION['login'])) {

        echo "<div id=kepfeltoltodoboz>";
        echo "<h1>Feltöltés a galériába:</h1>";
        if (!empty($uzenet)) // ha már jártunk az oldalon
        { // Kiírja az üzeneteket Felsorolással
            echo '<ul>';
            foreach ($uzenet as $u)
                echo "<li>$u</li>";
            echo '</ul>';
        }
        //  itt formáztam meg az űrlapom inline, máshogy nem ment
        echo "<div id=urlap>";
        //itt az action-t mivel egy fájlba írtam meg, ennek az oldalnak kell küldenie
        echo "<form method=post enctype=multipart/form-data>";
        // The enctype attribute specifies how the form-data should be encoded when submitting it to the server.
        // The enctype attribute can be used only if method="post".
        // multipart/form-data: This value is required when you are using forms that have a file upload control
        // https://www.w3schools.com/tags/att_form_enctype.asp -->

        //Fontos, hgoy a label tanárinál az input után volt lezárva, én azonban lezártam rögtön
        //és utána kezdtem az inputot, így szépen tudom formázni, hogy adott szélességűek
        //legyenek az input elemek
        echo "<label>Első:</label><input type=file name=elso required> <br>";
        echo "<label>Második:</label><input type=file name=masodik> <br>";
        echo "<label>Harmadik:</label><input type=file name=harmadik><br>";
        //itt a label-t azért tettem bele, hogy a küldés gomb is egy vonalba kerüljön a többi inputtal
        echo "<label></label><input type=submit name=kuld>";
        // ez a hamis ág, ami lefut, ha a session változó login indexű eleme nem létezik
        echo "</form>";
        echo "</div>";
    } else {
        echo "<div id=jelentkezzenbe>";
        echo "<p>Galériába való képfeltöltéshez kérjük jelentkezzen be!</p>";
        echo "</div>";
    } ?>