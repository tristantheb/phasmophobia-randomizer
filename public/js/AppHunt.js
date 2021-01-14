/**
 * @constructor App The app construction, it's the main controller of all entities
 */
function AppHunt() {
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
     * @property {number} maxItems The number of items allowed to get
     * @private
     */
    var maxItems = 3;

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
     * Generate an string of all hunters and their elements
     * @return {string}
     * @public
     *
     * @since 1.0
     */
    this.getAll = function getAll() {
        let huntersList = {};
        hunters.forEach((hunter, key) => {
            huntersList["hunter-" + key] = hunter.getAsObject();
        });
        return JSON.stringify(huntersList);
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
        generateItems(maxItems, hunter);
        hunters.push(hunter);
    }

    /**
     * Set the max number of items needed by players
     * @param {number} value The number of items par players
     *
     * @returns {undefined}
     * @public
     */
    this.setMaxItems = function setMaxItems(value) {
        value = Number(value);
        if (typeof value === 'number') {
            if (isValidValue(value)) {
                maxItems = value;
            }
        }
    }

    /**
     * Set the max number of items needed by players
     * @returns {number}
     * @public
     */
    this.getMaxItems = function getMaxItems() {
        return maxItems;
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
    function generateItems(max, targeted_hunter) {
        if (!targeted_hunter || typeof max != "number") {
            throwError("No player was set to execute this command.");
            return;
        }
        generateLight(targeted_hunter);
        for (let i = 0; i < max; i++) {
            if (targeted_hunter.getItems().length >= 7) {
                throwError("Limit of items by players is reached.");
                return;
            }
            let u = null;
            while (u === null) {
                u = getRandomInt(items.length);
            }
            // Check that the maximum number of times the object appears has not been reached
            let v = 0;
            if (hunters.length > 0) {
                hunters.forEach(hunter => {
                    hunter.getItems().forEach(item => {
                        if (item[0] === items[u][0]) v++;
                    });
                });
            }

            if (v < items[u][1] && !targeted_hunter.getItems().includes(items[u])) {
                // Push the picked item on the hunter items list
                targeted_hunter.setItem(items[u]);
            } else {
                i--;
            }
        }
    }

    this.generateMap = function generateMap() {
        map = maps[getRandomInt(maps.length)];
    }

    /**
     * Check if the value is in the range
     * @param {number} number The given number by the user
     *
     * @returns {boolean}
     * @private
     */
    function isValidValue(number) {
        return number > 0;
    }

    /**
     *
     * @param {Hunter} targeted_hunter The Hunter who is to receive the object(s)
     */
    function generateLight(targeted_hunter) {
        let u = null;
        while (u === null) {
            u = getRandomInt(itemsLights.length);
        }
        targeted_hunter.setItem(itemsLights[u]);
    }
}