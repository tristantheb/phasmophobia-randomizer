const appHunt = new AppHunt();
const TIMEOUT_DELAY = 5000;

if (!localStorage.getItem("SHOW_ANIMATION")) {
  localStorage.setItem("SHOW_ANIMATION", true);
}
var SHOW_ANIMATION = localStorage.getItem("SHOW_ANIMATION") === "true" ? true : false;

/**
 * Preloading page
 */
document.addEventListener("DOMContentLoaded", function preload() {
  var $links = document.querySelectorAll("link[rel=preload]");
  $links.forEach(link => {
    link.rel = "stylesheet"
  });
});

document.addEventListener("DOMContentLoaded", function pageLoaded() {
  /* When page is loaded, hide error block */
  $('#errBlock').hide();
  const $wheelAnim = document.querySelector("#wheelAnim");
  $wheelAnim.checked = SHOW_ANIMATION;
  $wheelAnim.addEventListener("click", function changeCheck() {
    if (this.checked) {
      SHOW_ANIMATION = true;
      localStorage.setItem("SHOW_ANIMATION", true);
    } else {
      SHOW_ANIMATION = false;
      localStorage.setItem("SHOW_ANIMATION", false);
    }
  }, this);

  /**
   * Hunt mode
   */
  // Select html elements from nodes
  const $formHunt = document.querySelector("#formHunt");
  const $select = document.querySelector("#classic_mode_maxItems");
  const $gen_map = document.querySelector("#gen_map");

  // Check of activity
  $select.addEventListener("change", function changeItems() {
    var val = $select.selectedIndex;
    appHunt.setMaxItems($select[val].value);
  });

  // Submit form for Hunt mode
  $formHunt.addEventListener("submit", function submitForm(event) {
    event.preventDefault();
    let canRender = false;
    appHunt.reset();
    let form = new FormData($formHunt);
    for (const entry of form.entries()) {
      if (!!entry[1]) {
        appHunt.setHunter(htmlEncode(entry[1]));
        canRender = true;
      }
    }

    if (canRender) {
      SHOW_ANIMATION ? animateRender(htmlRender, appHunt) : htmlRender(appHunt);
    }
  });

  /**
   * Global
   */
  $gen_map.addEventListener("click", function generateMap(event) {
    event.preventDefault();
    appHunt.generateMap();

    let audioName = ['Adult', 'Attack', 'Away', 'Baby', 'Behind', 'Child', 'Close', 'Dad', 'Daughter', 'Death', 'Die', 'Far', 'Hate', 'Here', 'Hurt', 'Kid', 'Kill', 'Mum', 'Next', 'Old', 'Son', 'Young'];
    let audioFile = audioName[getRandomInt(audioName.length)];


    playAudio(audioFile, 0.2, false);

    const $mapName = document.querySelector("#map_name");
    $mapName.innerHTML = appHunt.getMapName();
  });
});

/**
 * Update the result view
 * @param {object} app The app object
 */
function htmlRender(app) {
  var hunters = app.getHunters(), data = "";
  localStorage.clear();
  localStorage.setItem("SHOW_ANIMATION", SHOW_ANIMATION);
  for (let i = 0; i < hunters.length; i++) {
    // Get elements
    const hunter = hunters[i].getAsObject();
    let hunt = i + 1;
    const $hunterList = document.querySelector("#hunter-" + hunt);
    $hunterList.innerHTML = "<p class=\"hunter_name t-center\">" + hunter.username + "</p>";
    localStorage.setItem("hunterName" + i, hunter.username);
    let li = "", itemsList = "";
    hunter.itemList.forEach(list => {
      let item = checkOnDualList(list[0], items);
      item = !item ? checkOnDualList(list[0], itemsLights) : item;
      li += "<li><img src=\"./img/" + list[0] + ".png\" alt=\"" + item + "\"> " + item + "</li>";
      itemsList += "<img src=\"./img/" + list[0] + ".png\" alt=\"" + item + "\"> " + item + " ";
    });
    itemsList += "<br>";

    localStorage.setItem("hunterItems" + i, itemsList);
    $hunterList.innerHTML += "<ul class=\"items-list\">" + li + "</ul>";
  }

  for (let i = hunters.length; i < 4; i++) {
    let hunt = i + 1
    const $hunterList = document.querySelector("#hunter-" + hunt);
    $hunterList.innerHTML = "";
  }
}

/**
 * Animate the render of item picker
 * @param {string} callback A callback function name
 * @param {object} app The actual app used
 */
function animateRender(callback, app) {
  var hunters = app.getHunters(), nameHunter = [], finalList = [];
  $('#animated_block').fadeIn(100);

  hunters.forEach(hunter => {
    nameHunter.push(hunter.getName());
    let itemsList = hunter.getItems();
    for (let i = 0; i < itemsList.length; i++) {
      let item = checkOnDualList(itemsList[i][0], items);
      item = !item ? checkOnDualList(itemsList[i][0], itemsLights) : item;
      finalList.push(item);
    }
  });

  let step = 1;
  for (let i = 0; i < nameHunter.length; i++) {
    for (let j = 0; j < hunters[i].getItems().length; j++) {
      window.setTimeout(textRender, TIMEOUT_DELAY * step, nameHunter[i], finalList[step - 1]);
      step++;
    }
  }

  playAudio("Heartbeat", 0.5, true, TIMEOUT_DELAY * step);

  window.setTimeout(() => {
    $('#animated_block').fadeOut(100);
    $('#wheel_hunter').html('&nbsp;');
    $('#animated_text').html('&nbsp;');
    callback(app);
  }, TIMEOUT_DELAY * step);
}

/**
 * Animate the render of item picker
 * @param {string} callback A callback function name
 * @param {object} hunter The targeted hunter
 */
function animateOneItem(callback, app, hunter) {
  $('#animated_block').fadeIn(100);

  let item = checkOnDualList(hunter.getLastItem(), items);
  item = !item ? checkOnDualList(hunter.getLastItem(), itemsLights) : item;
  window.setTimeout(textRender, TIMEOUT_DELAY, hunter.getName(), item);

  playAudio("Heartbeat", 0.5, true, TIMEOUT_DELAY * 2);

  window.setTimeout(() => {
    $('#animated_block').fadeOut(100);
    $('#wheel_hunter').html('&nbsp;');
    $('#animated_text').html('&nbsp;');
    callback(app);
  }, TIMEOUT_DELAY * 2);
}

/**
 * Show specific text on the html
 * @param {string} param1 Text of an element
 * @param {string} param2 Text of an element
 */
function textRender(param1, param2) {
  if (typeof param1 !== "string" || typeof param2 !== "string") {
    return throwError("Wrong parameter detected when the wheel try to who text");
  }

  $('#wheel_hunter').html(param1);
  $('#animated_text').html(param2).fadeIn(500).delay(3000).fadeOut(500);
}
