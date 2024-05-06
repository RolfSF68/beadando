<?php session_start(); ?>
<?php if (file_exists('./logicals/' . $keres['fajl'] . '.php')) {
	include("./logicals/{$keres['fajl']}.php");
} ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title><?= $ablakcim['cim'] . ((isset($ablakcim['mottó'])) ? ('|' . $ablakcim['mottó']) : '') ?></title>
	<link rel="stylesheet" href="./styles/stilus.css" type="text/css">
	<?php if (file_exists('./styles/' . $keres['fajl'] . '.css')) { ?>
		<link rel="stylesheet" href="./styles/<?= $keres['fajl'] ?>.css" type="text/css"><?php } ?>
</head>

<body>
	<header>
		<!-- írtam bele id-t -->
		<img id="fejlecImg1" src="./images/<?= $fejlec['kepforras'] ?>" alt="<?= $fejlec['kepalt'] ?>">
		<!-- hozzáadtam -->
		<img id="fejlecImg2" src="./images/<?= $fejlec['kepforras2'] ?>" alt="<?= $fejlec['kepalt'] ?>">

		<div id="bejelentkezve">

			<?php if (isset($_SESSION['login'])) { ?> Bejlentkezve: <?= $_SESSION['csn'] . " " . $_SESSION['un'] . " (" . $_SESSION['login'] . ")" ?></p><?php } ?>
		</div>
	</header>
	<div id="wrapper">
		<aside>
			<nav>
				<ul>
					<?php foreach ($oldalak as $url => $oldal) { ?>
						<?php if (!isset($_SESSION['login']) && $oldal['menun'][0] || isset($_SESSION['login']) && $oldal['menun'][1]) { ?>
							<li>
								<!-- LI-BŐL KIMÁSOLTAM EZT <?= (($oldal == $keres) ? ' class="active"' : '') ?>
							AMI UGYE ARRA JÓ, HOGY ACTIVE- OSZTÁLYT VÁLTOZTASSA DINAMIKUSAN, MERT A 
						BORDERT ÍGY A TETEJÉRE LI-HEZ ÉS NEM A-HOZ IGAZÍTOTTA, DE NEKEM LI KÖZÉ
					KÉNE PADDING IS, HOGY NE EGYMÁS MELLETT LEGYENEK A MENÜK, ez amúgy feltételes operátor -->
								<a id="menuOpciok" <?= (($oldal == $keres) ? ' class="active"' : '') ?> href="<?= ($url == '/') ? '.' : ('?oldal=' . $url) ?>">
									<?= $oldal['szoveg'] ?></a>
							</li>
						<?php } ?>
					<?php } ?>
				</ul>
			</nav>
		</aside>
		<div id="content">
			<?php include("./templates/pages/{$keres['fajl']}.tpl.php"); ?>
		</div>
	</div>
	<footer>
		<!-- kiegészítettem ezt a sort a ceg-gel és a p paragrafussal -->
		<div id="doboz1">
			<?php if (isset($lablec['copyright'])) { ?> <?= '<p>' ?>&copy;&nbsp;<?= $lablec['copyright'] ?> <?= $lablec['ceg'] . '</p>' ?> <?php } ?>
			<!-- &nbsp; -->
			<!-- ezt is átjavítottam meg br-t és p-t is visszaechozok neki -->
			<?php if (isset($lablec['poweredBy'])) { ?> <?= '<p>' . $lablec['poweredBy'] . '<p>' ?><?php } ?>
		</div>
		<div id="doboz2">
			<?= '<p>' . $lablec['szoveg'] . '</p>' ?>
			<img id="kepforras" src="./images/<?= $lablec['kepforras'] ?>">
			<img id="kepforras2" src="./images/<?= $lablec['kepforras2'] ?>">
			<img id="kepforras3" src="./images/<?= $lablec['kepforras3'] ?>">
		</div>
	</footer>
</body>

</html>