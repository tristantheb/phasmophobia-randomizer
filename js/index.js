const appHunt = new AppHunt();
const appSafari = new AppSafari();
const TIMEOUT_DELAY = 5000;

document.addEventListener("DOMContentLoaded", function pageLoaded() {
  /**
   * Hunt mode
   */
  // Select html elements from nodes
  const $formHunt = document.querySelector("#hunt_form");
  const $select = document.querySelector("#items_number");
  const $gen_map = document.querySelector("#gen_map");

  // Check of activity
  $select.addEventListener("change", function changeItems() {
    var val = $select.selectedIndex;
    appHunt.setMaxItems($select[val].value);
  });

  $formHunt.addEventListener("submit", function submitForm(event) {
    event.preventDefault();
    let canRender = false;
    appHunt.reset();
    let form = new FormData($formHunt);
    for (const entry of form.entries()) {
      if (!!entry[1]) {
        appHunt.setHunter(entry[1]);
        canRender = true;
      }
    }

    if(canRender) {
      animateRender(htmlRender, appHunt);
    }
  });

  /**
   * Safari mode
   */
  const $formSafari = document.querySelector("#safari_form");
  const $submits = document.querySelectorAll("input[data-itemAdd]");

  $submits.forEach(submit => {
    submit.addEventListener('click', () => {addItemAndWheel(submit)});
  });

  $formSafari.addEventListener("submit", function submitForm(event) {
    event.preventDefault();
    appSafari.reset();
    let form = new FormData($formSafari);
    for (const entry of form.entries()) {
      if (!!entry[1]) {
        appSafari.setHunter(entry[1]);
      }
    }
    animateRender(htmlRender, appSafari);
  });

  /**
   * Add a new item into a player item list
   * @param {HTMLElement} htmlElement An node html element
   */
  function addItemAndWheel(htmlElement) {
    let id = htmlElement.getAttribute('data-itemadd') - 1, hunter = appSafari.getHunterById(id);
    var canRender = appSafari.generateItem(hunter);

    if(canRender) {
      animateOneItem(htmlRender, appSafari, hunter);
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
    $hunterList.innerHTML = "<p class=\"hunter_name\">" + hunter.username + "</p>";
    let li = "";
    hunter.itemList.forEach(list => {
      let item = checkOnDualList(list[0], items);
      item = !item ? checkOnDualList(list[0], itemsLights) : item;
      li += "<li>" + item + "</li>";
    });
    $hunterList.innerHTML += "<ul>" + li + "</ul>";
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
  $('#wheel_hunter').html(param1);
  $('#animated_text').html(param2).fadeIn(500).delay(3000).fadeOut(500);
}

function playAudio(fileName, soundLevel = 0.2, loop = false, endLoopDelay = TIMEOUT_DELAY) {
  let audio = new Audio('sounds/' + fileName + '.wav');
  audio.volume = soundLevel;
  audio.loop = loop;
  audio.muted = false;
  audio.play();

  window.setTimeout(() => {
    audio.muted = true;
    audio.loop = false;
  }, endLoopDelay);
}