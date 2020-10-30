var slider = document.getElementById("myRange");
var factor = document.getElementById("factor");
var reduceminutes = document.getElementById("reduceminutes");
var cost1 = document.getElementById("cost1");
var cost2 = document.getElementById("cost2");

factor.innerHTML = slider.value; // Display the default slider value

// Update the current slider value (each time you drag the slider handle)
slider.oninput = function() {
  factor.innerHTML = this.value;
  reduceminutes.innerHTML = this.value * 10;
  cost1.innerHTML = this.value * 100;
  cost2.innerHTML = this.value * 100;

}