const appHunt = new AppHunt();
const appSafari = new AppSafari();
const TIMEOUT_DELAY = 5000;

if(!localStorage.getItem("SHOW_ANIMATION")) {
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
    if(this.checked) {
      SHOW_ANIMATION = true;
      localStorage.setItem("SHOW_ANIMATION", true);
    } else {
      SHOW_ANIMATION = false;
      localStorage.setItem("SHOW_ANIMATION", false);
    }
  }, this)

  /**
   * Hunt mode
   */
  // Select html elements from nodes
  const $formHunt = document.querySelector("#huntForm");
  const $select = document.querySelector("#itemsNumber");
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
    appSafari.reset();
    let form = new FormData($formHunt);
    for (const entry of form.entries()) {
      if (!!entry[1]) {
        appHunt.setHunter(htmlEncode(entry[1]));
        canRender = true;
      }
    }

    if(canRender) {
      SHOW_ANIMATION ? animateRender(htmlRender, appHunt) : htmlRender(appHunt);
    }
  });

  /**
   * Safari mode
   */
  const $formSafari = document.querySelector("#safari_form");
  const $submits = document.querySelectorAll("input[data-itemAdd]");

  // Add item to the hunter and enable the animation
  $submits.forEach(submit => {
    submit.addEventListener('click', () => {addItemAndWheel(submit)});
  });

  // Submit form for Safari mode
  $formSafari.addEventListener("submit", function submitForm(event) {
    event.preventDefault();
    appHunt.reset();
    appSafari.reset();
    let form = new FormData($formSafari), entries = form.entries(), entriesArray = [];
    for (const entry of entries) {
      if (entry[1] !== "") {
        entriesArray.push(entry[1]);
      }
    }
    let randInt = getRandomInt(entriesArray.length);
    entriesArray.forEach((entry, key) => {
      if (!!entry) {
        if (entriesArray.length < 4) {
          // 1-3 players mode
          appSafari.setHunter(htmlEncode(entry));
        } else if (entriesArray.length === 4) {
          // 4 players mode
          if (key === randInt) {
            appSafari.setHunterLight(htmlEncode(entry));
          } else {
            appSafari.setHunterPhoto(htmlEncode(entry));
          }
        } else {
          throwError("Number of player is not possible !");
        }
      }
    });
    SHOW_ANIMATION ? animateRender(htmlRender, appSafari) : htmlRender(appSafari);
  });

  /**
   * Add a new item into a player item list
   * @param {HTMLElement} htmlElement An node html element
   */
  function addItemAndWheel(htmlElement) {
    let id = htmlElement.getAttribute('data-itemadd') - 1, hunter = appSafari.getHunterById(id);
    var canRender = appSafari.generateItem(hunter);

    if(canRender) {
      SHOW_ANIMATION ? animateRender(htmlRender, appSafari, hunter) : htmlRender(appSafari);
    }
  }

  /**
   * Global
   */
  $gen_map.addEventListener("click", function generateMap(event) {
    event.preventDefault(); 
    appHunt.generateMap();

    let audioName = ['Adult', 'Attack', 'Away', 'Baby', 'Behind', 'Child', 'Close', 'Dad', 'Daughter', 'Death', 'Die', 'Far', 'Hate', 'Here', 'Hurt', 'Kid', 'Kill', 'Mum', 'Next', 'Old',  'Son', 'Young'];
    let audioFile = audioName[getRandomInt(audioName.length)];

    
    playAudio(audioFile, 0.2, false);

    const $mapName = document.querySelector("#map_name");
    $mapName.innerHTML = appHunt.getMapName();
  });
});

/**
 * Update the result view
 * @param {Objetc} app The app object
 */
function htmlRender(app) {
  var hunters = app.getHunters();
  for (let i = 0; i < hunters.length; i++) {
    const hunter = hunters[i].getAsObject();
    let hunt = i + 1
    const $hunterList = document.querySelector("#hunter-" + hunt);
    $hunterList.innerHTML = "<p class=\"hunter_name t-center\">" + hunter.username + "</p>";
    let li = "";
    hunter.itemList.forEach(list => {
      let item = checkOnDualList(list[0], items);
      item = !item ? checkOnDualList(list[0], itemsLights) : item;
      li += "<li><img src=\"./img/" + list[0] + ".png\" alt=\"" + item + "\"> " + item + "</li>";
    });
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
 * @param {object} callback A callback function name
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
 * @param {object} callback A callback function name
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
