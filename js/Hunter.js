/**
 * @constructor Hunter
 */
function Hunter() {
  /**
   * @property {string} username The name of the hunter
   * @private
   */
  var username;

  /**
   * @property {object} itemList The list of given items to the player
   * @private
   */
  var itemList = [];

  this.getName = function getName() {
    return username;
  }

  this.setName = function setName(name) {
    if (!isValidName(name)) return;
    username = name;
  }

  this.getItems = function getItems() {
    return itemList;
  }

  this.setItem = function setItem(item) {
    itemList.push(item);
  }

  /**
   * Generate a new hunter
   * @returns {object}
   * @public
   */
  this.getLastItem = function getLastItem() {
    return itemList[itemList.length-1][0];
  }

  this.getAsObject = function getAsObject() {
    return {
      username,
      itemList
    };
  }

  /**
   * Check if username is a valid text
   * @param {*} value Any value to be checked
   * 
   * @returns {undefined} True if good text, false if wrong text
   * @private
   */
  function isValidName(value) {
    if (typeof value != "string") return false;
    return true;
  }
}