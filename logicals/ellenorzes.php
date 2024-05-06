<!-- ---------------SZERVER OLDALI ELLENŐRZÉS, AZ ŰRLAP ADATAIRA VONATKOZÓAN----------------- -->
<?php
//globális változók, ezeket zh-ban ilyenre átjavítani
$FlagTargy = "Hibás";
$FlagEmail = "Hibás";
$FlagSzoveg = "Hibás";

//egy plusz if-et beletettem, hogy ha üresen az oldalra kattintok, akkor ne adjon hibát, hogy nincsen 
//tárgy megadva
if (isset($_POST['targy'])) {
    if (!isset($_POST['targy']) || strlen($_POST['targy']) < 5 && strlen($_POST['targy']) > 30) {
        exit("<p class=hiba> Hibás a tárgy, túl rövid vagy nincs megadva.</p>" . $_POST['targy']);
        $FlagTargy = "Hibás";
    } else {
        $FlagTargy = "Helyes";
    }

    $re = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/';
    if (!isset($_POST['email']) || !preg_match($re, $_POST['email'])) {
        exit("<p class=hiba> Hibás e-mail címet adott meg.</p>" . $_POST['email']);
        $FlagEmail = "Hibás";
    } else {
        $FlagEmail = "Helyes";
    }

    if (!isset($_POST['szoveg']) || empty($_POST['szoveg']) || strlen($_POST['szoveg']) > 500) {
        exit("<p class=hiba> Nem adott meg szöveget!</p>" . $_POST['szoveg']);
        $FlagSzoveg = "Hibás";
    } else {
        $FlagSzoveg = "Helyes";
    }
} else {
    echo "<p class=hiba> Nem küldött üzenetet!</p>";
} ?>