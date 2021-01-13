/**
 * @constructor App The app construction, it's the main controller of all entities
 */
function AppSafari() {
  /**
   * @property {object} hunters The list of hunters
   * @private
   */
  var hunters = [];

  /**
   * @property {string} map The map name
   * @private
   */
  var map;

  /**
   * Generate a new hunter
   * @returns {object}
   * @public
   */
  this.getHunters = function getHunters() {
    return hunters;
  }

  /**
   * Generate the map name
   * @returns {object}
   * @public
   */
  this.getMapName = function getMapName() {
    return map;
  }

  /**
   * Generate a new hunter
   * @param {string} name The name of the player
   * 
   * @returns {undefined}
   * @public
   */
  this.setHunter = function setHunter(name) {
    var hunter = new Hunter();
    hunter.setName(name);
    generateLight(hunter);
    hunters.push(hunter);
  }

  /**
   * Generate a new hunter
   * @param {string} name The name of the player
   * 
   * @returns {undefined}
   * @public
   */
  this.setHunterLight = function setHunterLight(name) {
    var hunter = new Hunter();
    hunter.setName(name);
    let u = null;
    while (u === null) {
      u = getRandomInt(safariLights.length);
    }
    hunter.setItem(safariLights[u]);
    hunters.push(hunter);
  }

  /**
   * Generate a new hunter
   * @param {string} name The name of the player
   * 
   * @returns {undefined}
   * @public
   */
  this.setHunterPhoto = function setHunterPhoto(name) {
    var hunter = new Hunter();
    hunter.setName(name);
    hunter.setItem(safariItems[7]);
    hunters.push(hunter);
  }

  /**
   * Generate a new hunter
   * @returns {object}
   * @public
   */
  this.getHunterById = function getHunterById(id) {
    return hunters[id];
  }

  /**
   * Reset the hunters list
   */
  this.reset = function reset() {
    hunters = [];
  }

  /**
   * 
   * @param {number} max The number of objects to generate
   * @param {Hunter} targeted_hunter The Hunter who is to receive the object(s)
   */
  this.generateItem = function generateItem(targeted_hunter) {
    if (targeted_hunter.getItems().length >= 7) {
      throwError("Limit of items by players is reached.");
      return;
    }
    for (let i = 0; i < 1; i++) {
      let u = null;
      while (u === null) {
        u = getRandomInt(safariItems.length);
      }
      
      let v = 0;
      if (hunters.length > 0) {
        hunters.forEach(hunter => {
          hunter.getItems().forEach(item => {
            if (item[0] == items[u][0]) v++;
          });
        });
      }

      if (v < items[u][1] && !targeted_hunter.getItems().includes(items[u])) {
        // Push the picked item on the hunter items list
        targeted_hunter.setItem(safariItems[u]);
        return true;
      } else {
        i--;
      }
    }
  }

  /**
   * 
   * @param {number} max The number of objects to generate
   * @param {Hunter} targeted_hunter The Hunter who is to receive the object(s)
   */
  function generateLight(targeted_hunter) {
    let u = null;
    while (u === null) {
      u = getRandomInt(safariLights.length);
    }
    targeted_hunter.setItem(safariLights[u]);
    targeted_hunter.setItem(safariItems[7]);
  }

  this.generateMap = function generateMap() {
    map = maps[getRandomInt(maps.length)];
  }
}