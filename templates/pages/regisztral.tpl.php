<!DOCTYPE html>
<html>

<head>
    <title>Regisztráció</title>
    <meta charset="utf-8">
</head>

<body>
    <?php if (isset($uzenet)) { ?>
        <h1><?= $uzenet ?></h1>
        <?php if ($ujra) { ?>
            <!-- ezt is átírtam, ha sikertelen a regisztráció, erre az oldalra dobjon mert amúgy a pelda.html-re
            dobott -->
            <a href="index.php?oldal=belepes">Próbálja újra!</a>
        <?php } ?>
    <?php } ?>
</body>

</html>