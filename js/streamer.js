var interval;

document.addEventListener("DOMContentLoaded", function pageLoaded() {
  interval = setInterval(reloadLocalData, 5000);
  $hunters = document.querySelectorAll(".hunterItems");
  reloadLocalData();
  
  function reloadLocalData() {
    for (let i = 0; i < $hunters.length; i++) {
      let name = localStorage.getItem("hunterName" + i);
      let items = localStorage.getItem("hunterItems" + i);
      // If content exist, show strings
      if (name && items) {
        $hunters[i].innerHTML = name + ": " + items;
      } else {
        $hunters[i].innerHTML = "";
      }
    }
  }
});