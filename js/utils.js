/**
 * Randomize a number in a values fork
 * @param {number} max Get the max number for the random number generator
 * 
 * @returns {number}
 */
function getRandomInt(max) {
  return Math.floor(Math.random() * Math.floor(max));
}

/**
 * Search en number of iteration in a array list of one specific element
 * @param {object} haystack List of elements
 * @param {string|number} needle The searched element on the list
 * 
 * @returns {undefined|number}
 */
function arrayCount(haystack, needle) {
  if (!haystack) return 0;
  haystack.forEach(item => {
    if (item == needle) return 1;
    return 0;
  });
}

/**
 * Seaech the name of item.
 * @param {string} needle The searched element.
 * @param {object} haystack The dual deep list with needle inner
 * 
 * @since 0.1.0
 */
function checkOnDualList(needle, haystack) {
  for (let i = 0; i < haystack.length; i++) {
    if (needle === haystack[i][0]) return haystack[i][2];
  }
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

/**
 * 
 */
function throwError(errText) {
  playAudio("GhostSpook", 0.4);
  $('#errBlock').html('<i class="fa fa-exclamation-triangle"></i> ' + errText);
  $('#errBlock').fadeIn(500).delay(5000).fadeOut(500, () => { $('#errBlock').html('&nbsp;'); });
}

/**
 * XSS Security
 */
function htmlEncode(str) {
  return String(str).replace(/[^\w. ]/gi, function (c) {
    return '&#' + c.charCodeAt(0) + ';';
  });
}
