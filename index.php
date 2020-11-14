<?php
require_once "includes/config.php";
const PAGE_TITLE = "Randomizer - Phasmophobia Randomizer";
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<?php require_once "includes/head.php"; ?>

<body>
  <header>
    <h1>Phasmophobia Randomizer</h1>
    <p><?php _e('Generate a game of investigation and ghost hunting in a totally random way.', 'lang') ?></p>
  </header>
  <main>
    <section class="table_game">
      <noscript class="error-box"><?php _e('Javascript is disabled on your browser. To use this site, you need to have Javascript enabled and running or active it.', 'lang') ?></noscript>
      <p id="errBlock" class="error-box">&nbsp;</p>
      <p class="row">
        <button><label for="game_classic" class="m-0"><i class="fa fa-users"></i>&nbsp;<?php _e('Classic game', 'lang') ?></label></button>
        <button><label for="game_safari" class="m-0"><i class="fa fa-camera"></i>&nbsp;<?php _e('Safari photo game', 'lang') ?></label></button>
      </p>
      <p class="t-center"><button id="gen_map"><i class="fa fa-dice"></i> <?php _e('Roll map', 'lang') ?></button></p>
      <p class="t-center"><label class="check" for="wheelAnim"><?php _e('Enable wheel animation?', 'lang') ?></label><input id="wheelAnim" type="checkbox"></p>
    </section>
    <input type="radio" id="game_classic" name="game_style" checked>
    <section class="table_game">
      <h2><?php _e('Classic game - Randomize the hunt', 'lang') ?></h2>
      <form id="huntForm">
        <label for="hunterOne">
          <span><?php _e('First hunter:', 'lang') ?></span>
          <input id="hunterOne" name="hunterOne" type="text" autocomplete="off">
        </label>
        <label for="hunterTwo">
          <span><?php _e('Second hunter:', 'lang') ?></span>
          <input id="hunterTwo" name="hunterTwo" type="text" autocomplete="off">
        </label>
        <label for="hunterThree">
          <span><?php _e('Third hunter:', 'lang') ?></span>
          <input id="hunterThree" name="hunterThree" type="text" autocomplete="off">
        </label>
        <label for="hunterFour">
          <span><?php _e('Fourth hunter:', 'lang') ?></span>
          <input id="hunterFour" name="hunterFour" type="text" autocomplete="off">
        </label>
        <label for="itemsNumber">
          <span><?php _e('Number of items to generate:', 'lang') ?></span>
          <select id="itemsNumber" autocomplete="off">
            <option><?php _e('Choose number of items (default 3)', 'lang') ?></option>
            <option value="1">1 <?php _e('item', 'lang') ?></option>
            <option value="2">2 <?php _e('items', 'lang') ?></option>
            <option value="3" selected>3 <?php _e('items', 'lang') ?></option>
            <option value="4">4 <?php _e('items', 'lang') ?></option>
            <option value="5">5 <?php _e('items', 'lang') ?></option>
          </select>
        </label>
        <input type="submit" value="<?php _e('Generate the game', 'lang') ?>">
      </form>
    </section>
    <input type="radio" id="game_safari" name="game_style">
    <section class="table_game">
      <h2><?php _e('Safari photo Game - Randomize the hunt', 'lang') ?></h2>
      <form id="safari_form">
        <div class="row">
          <div class="col-1">
            <label for="safariOne">
              <span><?php _e('First hunter:', 'lang') ?></span>
              <input id="safariOne" name="safariOne" type="text" autocomplete="off">
            </label>
          </div>
          <div class="col-4">
            <p class="t-center mt-0"><input type="button" data-itemAdd="1" value="<?php _e('Add item to hunter one', 'lang') ?>"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-1">
            <label for="safariTwo">
              <span><?php _e('Second hunter:', 'lang') ?></span>
              <input id="safariTwo" name="safariTwo" type="text" autocomplete="off">
            </label>
          </div>
          <div class="col-4">
            <p class="t-center mt-0"><input type="button" data-itemAdd="2" value="<?php _e('Add item to hunter two', 'lang') ?>"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-1">
            <label for="safariThree">
              <span><?php _e('Third hunter:', 'lang') ?></span>
              <input id="safariThree" name="safariThree" type="text" autocomplete="off">
            </label>
          </div>
          <div class="col-4">
            <p class="t-center mt-0"><input type="button" data-itemAdd="3" value="<?php _e('Add item to hunter three', 'lang') ?>"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-1">
            <label for="safariFourth">
              <span><?php _e('Fourth hunter:', 'lang') ?></span>
              <input id="safariFourth" name="safariFourth" type="text" autocomplete="off">
            </label>
          </div>
          <div class="col-4">
            <p class="t-center mt-0"><input type="button" data-itemAdd="4" value="<?php _e('Add item to hunter fourth', 'lang') ?>"></p>
          </div>
        </div>
        <input type="submit" value="<?php _e('Generate the game', 'lang') ?>">
      </form>
    </section>
    <section class="table_game">
      <h2><?php _e('Results', 'lang') ?></h2>
      <h3 id="map_name"></h3>
      <div class="row">
        <div class="col-4" id="hunter-1">
          <p class="hunter_name t-center"><?php _e('Hunter name', 'lang') ?></p>
          <ul>
            <li><?php _e('Item list', 'lang') ?></li>
          </ul>
        </div>
        <div class="col-4" id="hunter-2">
          <p class="hunter_name t-center"><?php _e('Hunter name', 'lang') ?></p>
          <ul>
            <li><?php _e('Item list', 'lang') ?></li>
          </ul>
        </div>
        <div class="col-4" id="hunter-3">
          <p class="hunter_name t-center"><?php _e('Hunter name', 'lang') ?></p>
          <ul>
            <li><?php _e('Item list', 'lang') ?></li>
          </ul>
        </div>
        <div class="col-4" id="hunter-4">
          <p class="hunter_name t-center"><?php _e('Hunter name', 'lang') ?></p>
          <ul>
            <li><?php _e('Item list', 'lang') ?></li>
          </ul>
        </div>
      </div>
    </section>
  </main>
  <div id="animated_block">
    <h2 id="wheel_hunter">&nbsp;</h2>
    <div class="wheel_block table_game">
      <img id="wheel" src="img/wheel.svg" alt="Wheel of fortune">
      <p id="animated_text" class="t-center">&nbsp;</p>
    </div>
  </div>
  <div class="orb">&nbsp;</div>
  <?php require_once "./includes/footer.php"; ?>
  <!-- start:Scripts -->
  <script defer src="js/jquery.min.js?v3.5.1"></script>
  <script defer src="js/utils.min.js?v=<?php echo $version; ?>"></script>
  <script defer src="js/safari_items.js?v=<?php echo $version; ?>"></script>
  <script defer src="js/lang/items_<?php echo $lang; ?>.js?v=<?php echo $version; ?>"></script>
  <script defer src="js/maps.js?v=<?php echo $version; ?>"></script>
  <script defer src="js/Hunter.min.js?v=<?php echo $version; ?>"></script>
  <script defer src="js/AppHunt.min.js?v=<?php echo $version; ?>"></script>
  <script defer src="js/AppSafari.min.js?v=<?php echo $version; ?>"></script>
  <script defer src="js/index.min.js?v=<?php echo $version; ?>"></script>
  <!-- end:Scripts -->
</body>

</html>