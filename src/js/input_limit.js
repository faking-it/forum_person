// Compteur caractères titre

let monInput = document.getElementById("saisieTitre");
let textTapper;

monInput.addEventListener("input", () => {
  if (monInput.value.length <= 20) {
    let nombreDeLettre = monInput.value;
    textTapper = monInput.value;
    nombreDeLettre = nombreDeLettre.length; // Nombre de caractères...
    document.getElementById("counterGeo").innerHTML = nombreDeLettre + "/40";
    document.getElementById("counterGeo").style.color = "#757595";
  } else if (monInput.value.length <= 35) {
    let nombreDeLettre = monInput.value;
    textTapper = monInput.value;
    nombreDeLettre = nombreDeLettre.length; // Nombre de caractères...
    document.getElementById("counterGeo").innerHTML = nombreDeLettre + "/40";
    document.getElementById("counterGeo").style.color = "f89c0f";
  } else if (monInput.value.length <= 40) {
    let nombreDeLettre = monInput.value;
    textTapper = monInput.value;
    nombreDeLettre = nombreDeLettre.length; // Nombre de caractères...
    document.getElementById("counterGeo").innerHTML = nombreDeLettre + "/40";
    document.getElementById("counterGeo").style.color = "ee262e";
  } else {
    monInput.value = textTapper;
    document.getElementById("counterGeo").style.color = "ee262e";
  }
});

// Compteur caractères commentaire

let monInput2 = document.getElementById("saisieTitre2");
let textTapper2;

monInput2.addEventListener("input", () => {
  if (monInput2.value.length <= 400) {
    let nombreDeLettre = monInput2.value;
    textTapper2 = monInput2.value;
    nombreDeLettre = nombreDeLettre.length; // Nombre de caractères...
    document.getElementById("counterGeo2").innerHTML = nombreDeLettre + "/800";
    document.getElementById("counterGeo2").style.color = "#757595";
  } else if (monInput2.value.length <= 700) {
    let nombreDeLettre = monInput2.value;
    textTapper2 = monInput2.value;
    nombreDeLettre = nombreDeLettre.length; // Nombre de caractères...
    document.getElementById("counterGeo2").innerHTML = nombreDeLettre + "/800";
    document.getElementById("counterGeo2").style.color = "f89c0f";
  } else if (monInput2.value.length <= 800) {
    let nombreDeLettre = monInput2.value;
    textTapper2 = monInput2.value;
    nombreDeLettre = nombreDeLettre.length; // Nombre de caractères...
    document.getElementById("counterGeo2").innerHTML = nombreDeLettre + "/800";
    document.getElementById("counterGeo2").style.color = "ee262e";
  } else {
    monInput2.value = textTapper2;
    document.getElementById("counterGeo2").style.color = "ee262e";
  }
});

// Verification champs non remplis!
