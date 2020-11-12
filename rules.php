<?php
require_once "includes/config.php";
const PAGE_TITLE = "Rules - Phasmophobia Randomizer";
?>
<!DOCTYPE html>
<html lang="en">

<?php require_once "includes/head.php"; ?>

<body>
  <header>
    <h1><?php _e("Rules of Phasmophobia Randomizer", "lang") ?></h1>
    <p><?php _e("Generate a game of investigation and ghost hunting in a totally random way.", "lang") ?></p>
  </header>
  <main>
    <section class="table_game">
      <h2><?php _e("Classic game", "lang") ?></h2>
      <h4><?php _e("Objectives", "lang") ?></h4>
      <p>
        <?php _e("The objectives to take at least <strong> a picture of the entity</strong> and <strong> to determine its nature</strong> using the objects acquired by the randomizer. <strong>The player(s)</strong> can be mistaken about the nature of the entity but <strong> must imperatively take its photo (validated in the journal)</strong> before leaving the game.", "lang") ?><br>
        <?php _e("You get a randomly chosen light source before the game starts. The team will have ONE photo camera (others need to be dropped on the randomizer), a front camera in multiplayer for each players.", "lang") ?><br>
      </p>
      <h4><?php _e("Items per players", "lang") ?></h4>
      <p>
        <?php _e("Objects are chosen randomly before the start of the game according to the number of players as follows:", "lang") ?><br>
        <i class="fa fa-chevron-right"></i> <?php _e("1 player = 5 items", "lang") ?><br>
        <i class="fa fa-chevron-right"></i> <?php _e("2 players = 3 items/players", "lang") ?><br>
        <i class="fa fa-chevron-right"></i> <?php _e("3 players = 2 items/players", "lang") ?><br>
        <i class="fa fa-chevron-right"></i> <?php _e("4 players = 1 item/players", "lang") ?><br>
        <?php _e("A photo camera for the whole team is provided at the beginning of the game in order to validate the entity's photo objective. A lighter is available as standard to avoid making the incense and candle unusable. In multiplayer, the players will each have to have a front camera.", "lang") ?><br><br>
        <span class="t-red"><?php _e("It is forbidden to take any objects other than those assigned or to take those of other players.", "lang") ?></span>
      </p>
    </section>
    <section class="table_game">
      <h2><?php _e("Safari photo Game", "lang") ?></h2>
      <h4><?php _e("Objectives", "lang") ?></h4>
      <p>
        <?php _e("The objectives to take at least <strong> a picture of the entity</strong> and <strong> to determine its nature</strong> using the objects acquired by the randomizer. <strong>The player(s)</strong> can be mistaken about the nature of the entity but <strong> must imperatively take its photo (validated in the journal)</strong> before leaving the game.", "lang") ?><br>
        <?php _e("You get a randomly chosen light source before the game starts. The player(s) will have a camera, a lighter and a go pro in multiplayer.", "lang") ?><br>
        <?php _e("To unlock the right to obtain a random object, the player must succeed in taking a photo validated in the diary (interaction, ghost, dirty water, print, bone...) and/or pass a secondary objective of the board in the truck. Each additional validated photo or secondary objective gives the player the right to obtain a new random object while respecting these restrictions:", "lang") ?>
      </p>
      <h4><?php _e('Items per players', 'lang') ?></h4>
      <p>
        <i class="fa fa-chevron-right"></i> <?php _e("1 player = 5 items", "lang") ?><br>
        <i class="fa fa-chevron-right"></i> <?php _e("2 players = 3 items/players", "lang") ?><br>
        <i class="fa fa-chevron-right"></i> <?php _e("3 players = 2 items/players", "lang") ?><br><br>
        <span class="t-red"><?php _e("It is forbidden to take any objects other than those assigned or to take those of other players.", "lang") ?></span>
      </p>
      <p class="info-box">
        <i class="fa fa-info-circle"></i> <?php _e("This game mode is not suitable for 4-player multiplayer because it is impossible to have 4 photo cameras in a game at the moment.", "lang") ?>
      </p>
      <p class="info-box">       
      <i class="fa fa-info-circle"></i> <?php _e("Special cases: Solo, the player has the right to one object to be randomized before the start of the game on High School, and two objects on Asylum.", "lang") ?>
      </p>
    </section>
  </main>
  <?php require_once "./includes/footer.php"; ?>
  <script>
  /**
   * Preloading page
   */
  document.addEventListener("DOMContentLoaded", function preload() {
    var $links = document.querySelectorAll("link[rel=preload]");
    $links.forEach(link => {
      link.rel = "stylesheet"
    });
  });
  </script>
</body>

</html>