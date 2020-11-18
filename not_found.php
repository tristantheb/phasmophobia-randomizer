<?php
require_once "includes/config.php";
const PAGE_TITLE = "Page not found - Phasmophobia Randomizer";
const PAGE_DESCRIPTION = "This is an error 404, that significate that url searched was not found !";
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<?php require_once "includes/head.php"; ?>

<body>
  <header>
    <h1><?php _e("Page not found", "lang") ?></h1>
    <p><?php _e("You arrive in a room, but except for a very frightening painting of a man watching you, there is nothing...", "lang") ?></p>
  </header>
  <main>
    <section class="table_game">
        <p>Sorry, but the page you were looking for is not here! You should take another look around with your thermometer to make sure you didn't miss the page!</p>
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