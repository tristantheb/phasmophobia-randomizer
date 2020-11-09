/**
 * Randomize a number in a values fork
 * @param {number} min Get the min number for the random number generator
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