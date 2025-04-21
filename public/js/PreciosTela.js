document
  .getElementById("incremento-rollo")
  .addEventListener("input", function () {
    document.getElementById("val-incremento-rollo").textContent = this.value;

    document
      .getElementById("precioRealRollo")
      .dispatchEvent(new Event("input"));
  });

document
  .getElementById("incremento-metro")
  .addEventListener("input", function () {
    document.getElementById("val-incremento-metro").textContent = this.value;

    
    document
      .getElementById("precioRealRollo")
      .dispatchEvent(new Event("input"));
  });
