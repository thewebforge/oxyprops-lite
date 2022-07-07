import "../sass/backend.scss";

const myFunction = () => {
  console.log("backend.js starting file");
};

const switchTab = (e) => {
  e.preventDefault();
  document.querySelector("ul.nav-tabs li.active").classList.remove("active");
  document.querySelector(".tab-pane.active").classList.remove("active");
  var targetTab = e.currentTarget;
  var anchor = e.target;
  var activePaneID = anchor.getAttribute("href");
  var targetPane = document.querySelector(activePaneID);
  targetTab.classList.add("active");
  targetPane.classList.add("active");
};

const manageTabs = () => {
  var tabs = document.querySelectorAll("ul.nav-tabs > li");
  tabs.forEach((element) => {
    element.addEventListener("click", switchTab);
  });
};

window.addEventListener("load", manageTabs);
myFunction();
