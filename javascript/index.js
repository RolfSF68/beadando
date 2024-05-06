// Most érem el így, hogy alapból a küldés gomb inaktív legyen, így jelenjen meg.
//Nem adtam meg a függvénynek nevet, úgyse hívom meg sehonnan, fixen lefut

// window.onload = function x() {
//     var InputKuldes = document.getElementById("InputKuldes");
//     if (InputKuldes) { InputKuldes.disabled = true; }
// }

//Itt írom meg az ellenőriz függvényt, fontnos, hogy fordított sorrendben vizsgálom, hogy a fókusz a
//legelső helyre kerüljön
function ellenoriz() {
    var fokusz = null;
    var rendben = true;

    var InputSzoveg = document.getElementById("szoveg");
    if (InputSzoveg) {
        if (InputSzoveg.value.length <= 0 || InputSzoveg.value.length > 500) {
            rendben = false;
            InputSzoveg.style.background = '#f99';
            fokusz = InputSzoveg;
        }
        else { InputSzoveg.style.background = '#9f9'; }
    }

    var InputEmail = document.getElementById("email");
    var minta = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (InputEmail)
        if (!minta.test(InputEmail.value)) {
            rendben = false;
            InputEmail.style.background = '#f99';
            fokusz = InputEmail;
        }
        else { InputEmail.style.background = '#9f9'; }

    var InputTargy = document.getElementById("targy");
    if (InputTargy) {
        if (InputTargy.value.length <= 4 || InputTargy.value.length > 30) {
            rendben = false;
            InputTargy.style.background = '#f99';
            fokusz = InputTargy;
        } else {
            InputTargy.style.background = '#9f9';
        }
    }

    if (fokusz) { fokusz.focus(); }

    return rendben;
}