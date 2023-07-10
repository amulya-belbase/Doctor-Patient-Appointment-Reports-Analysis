
const selectDepart = document.querySelector("#bydept");   // getting selected values
const heading = document.querySelector(".doctor-list h1");  // geting heading elements

selectDepart.addEventListener("change",function(){    // adding event listener to select menu for any changes
  let categoryName = this.value;
  heading.innerHTML = this[this.selectedIndex].text;    // displaying selection option in the heading part of html
});
