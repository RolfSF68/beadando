<script type="text/javascript" src="javascript/index.js"> </script>
<div id="uzenetdoboz">
    <h1>Kapcsolat</h1>
    <!-- action-t átírtam, és így adtam meg ? által, és nem simán beírtam a php fjál nevét, hogy
uzenetmegtekintes.tpl.php -->

    <form name="kapcsolat" action="?oldal=uzenetmegtekintes" method="post" onsubmit="return ellenoriz();">
        <div>
            <label><input type="text" id="targy" name="targy" size="40">Tárgy (minimum 5, maximum 30 karakter): </label>
            <!-- minlength="5" maxlength="30" required -->
            <br />
            <label><input type="email" id="email" name="email" size="40">E-mail (kötelező): </label>
            <!-- maxlength="40" required -->
            <br />
            <label> <textarea id="szoveg" name="szoveg" cols="40" rows="10"></textarea> Üzenet (kötelező, maximum 500 karakter): </label>
            <!-- maxlength="500" required -->
            <br />
            <!--küldés gomb elhelyezése, value nélkül nem íródik ki rá semmi és nem látszik-->
            <input id="kuld" type="submit" value="Küldés">
        </div>
    </form>
</div>