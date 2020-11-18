<?php
require_once "includes/config.php";
const PAGE_TITLE = "Tracker - Phasmophobia Randomizer";
const PAGE_DESCRIPTION = "Do you want to eliminate ghosts with the clues you don't have, and the ones you do have? This ghost tracker is here to help you in your investigation!";

// JS file check
$fileGhosts = "js/lang/ghosts_$lang.js";
if (!file_exists($fileGhosts)) {
  $fileGhosts = "js/lang/ghosts_en.js";
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<?php require_once "includes/head.php"; ?>

<body>
  <header>
    <h1><?php _e("Tracker of Phasmophobia", "lang") ?></h1>
    <p><?php _e("Find the ghost with the founded or rejected evidences.", "lang") ?></p>
  </header>
  <main>
    <section class="table_game">
      <div class="row">
        <table class="col-2">
          <tr>
            <th scope="row"><?php _e("Evidences", "lang") ?></th>
            <td><label for="evidEmf"><img src="./img/emf_5.png" alt="<?php _e("Emf 5", "lang") ?>"></label></td>
            <td><label for="evidFinger"><img src="./img/fingerprint.png" alt="<?php _e("Fingerprints", "lang") ?>"></label></td>
            <td><label for="evidFeeze"><img src="./img/freezing_temp.png" alt="<?php _e("Freezing Temperature", "lang") ?>"></label></td>
            <td><label for="evidOrb"><img src="./img/orbs.png" alt="<?php _e("Ghost Orbs", "lang") ?>"></label></td>
            <td><label for="evidWriting"><img src="./img/ghost_writing.png" alt="<?php _e("Ghost Writing", "lang") ?>"></label></td>
            <td><label for="evidSpirit"><img src="./img/spirit_talk.png" alt="<?php _e("Spirit Box", "lang") ?>"></label></td>
          </tr>
          <tr>
            <th scope="row"><?php _e("Yes", "lang") ?></th>
            <td><input data-evidCheck="emf" id="evidEmf" type="checkbox" class="checkEvid has_evid"></td>
            <td><input data-evidCheck="fingerprints" id="evidFinger" type="checkbox" class="checkEvid has_evid"></td>
            <td><input data-evidCheck="freezing-temp" id="evidFeeze" type="checkbox" class="checkEvid has_evid"></td>
            <td><input data-evidCheck="ghost-orbs" id="evidOrb" type="checkbox" class="checkEvid has_evid"></td>
            <td><input data-evidCheck="ghost-writing" id="evidWriting" type="checkbox" class="checkEvid has_evid"></td>
            <td><input data-evidCheck="spirit-box" id="evidSpirit" type="checkbox" class="checkEvid has_evid"></td>
          </tr>
          <tr>
            <th scope="row"><?php _e("No", "lang") ?></th>
            <td><input data-evidCheck="emf" id="evidEmfNo" type="checkbox" class="checkEvid hasnt_evid"></td>
            <td><input data-evidCheck="fingerprints" id="evidFingerNo" type="checkbox" class="checkEvid hasnt_evid"></td>
            <td><input data-evidCheck="freezing-temp" id="evidFeezeNo" type="checkbox" class="checkEvid hasnt_evid"></td>
            <td><input data-evidCheck="ghost-orbs" id="evidOrbNo" type="checkbox" class="checkEvid hasnt_evid"></td>
            <td><input data-evidCheck="ghost-writing" id="evidWritingNo" type="checkbox" class="checkEvid hasnt_evid"></td>
            <td><input data-evidCheck="spirit-box" id="evidSpiritNo" type="checkbox" class="checkEvid hasnt_evid"></td>
          </tr>
          <tr>
            <td colspan="7">
              <button id="btnClear"><?php _e("Clear All", "lang") ?></button>
            </td>
          </tr>
        </table>
        <div id="ghostInfo" class="col-2">
          <p class="t-center"><?php _e('Click on one ghost line to get information', 'lang'); ?></p>
        </div>
      </div>
    </section>
    <section class="table_game">
      <table id="evidences">
        <tr id="spirit" class="evid_row">
          <th><?php _e("Spirit", "lang") ?></th>
          <td></td>
          <td data-evidence="fingerprints"><?php _e("Fingerprints", "lang") ?></td>
          <td></td>
          <td></td>
          <td data-evidence="ghost-writing"><?php _e("Ghost Writing", "lang") ?></td>
          <td data-evidence="spirit-box"><?php _e("Spirit Box", "lang") ?></td>
        </tr>
        <tr id="wraith" class="evid_row">
          <th><?php _e("Wraith", "lang") ?></th>
          <td></td>
          <td data-evidence="fingerprints"><?php _e("Fingerprints", "lang") ?></td>
          <td data-evidence="freezing-temp"><?php _e("Freezing Temperature", "lang") ?></td>
          <td></td>
          <td></td>
          <td data-evidence="spirit-box"><?php _e("Spirit Box", "lang") ?></td>
        </tr>
        <tr id="phantom" class="evid_row">
          <th><?php _e("Phantom", "lang") ?></th>
          <td data-evidence="emf"><?php _e("Emf 5", "lang") ?></td>
          <td></td>
          <td data-evidence="freezing-temp"><?php _e("Freezing Temperature", "lang") ?></td>
          <td data-evidence="ghost-orb"><?php _e("Ghost Orbs", "lang") ?></td>
          <td></td>
          <td></td>
        </tr>
        <tr id="poltergeist" class="evid_row">
          <th><?php _e("Poltergeist", "lang") ?></th>
          <td></td>
          <td data-evidence="fingerprints"><?php _e("Fingerprints", "lang") ?></td>
          <td></td>
          <td data-evidence="ghost-orb"><?php _e("Ghost Orbs", "lang") ?></td>
          <td></td>
          <td data-evidence="spirit-box"><?php _e("Spirit Box", "lang") ?></td>
        </tr>
        <tr id="banshee" class="evid_row">
          <th><?php _e("Banshee", "lang") ?></th>
          <td data-evidence="emf"><?php _e("Emf 5", "lang") ?></td>
          <td data-evidence="fingerprints"><?php _e("Fingerprints", "lang") ?></td>
          <td data-evidence="freezing-temp"><?php _e("Freezing Temperature", "lang") ?></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr id="jinn" class="evid_row">
          <th><?php _e("Jinn", "lang") ?></th>
          <td data-evidence="emf"><?php _e("Emf 5", "lang") ?></td>
          <td></td>
          <td></td>
          <td data-evidence="ghost-orb"><?php _e("Ghost Orbs", "lang") ?></td>
          <td></td>
          <td data-evidence="spirit-box"><?php _e("Spirit Box", "lang") ?></td>
        </tr>
        <tr id="mare" class="evid_row">
          <th><?php _e("Mare", "lang") ?></th>
          <td></td>
          <td></td>
          <td data-evidence="freezing-temp"><?php _e("Freezing Temperature", "lang") ?></td>
          <td data-evidence="ghost-orb"><?php _e("Ghost Orbs", "lang") ?></td>
          <td></td>
          <td data-evidence="spirit-box"><?php _e("Spirit Box", "lang") ?></td>
        </tr>
        <tr id="revenant" class="evid_row">
          <th><?php _e("Revenant", "lang") ?></th>
          <td data-evidence="emf"><?php _e("Emf 5", "lang") ?></td>
          <td data-evidence="fingerprints"><?php _e("Fingerprints", "lang") ?></td>
          <td></td>
          <td></td>
          <td data-evidence="ghost-writing"><?php _e("Ghost Writing", "lang") ?></td>
          <td></td>
        </tr>
        <tr id="shade" class="evid_row">
          <th><?php _e("Shade", "lang") ?></th>
          <td data-evidence="emf"><?php _e("Emf 5", "lang") ?></td>
          <td></td>
          <td></td>
          <td data-evidence="ghost-orb"><?php _e("Ghost Orbs", "lang") ?></td>
          <td data-evidence="ghost-writing"><?php _e("Ghost Writing", "lang") ?></td>
          <td></td>
        </tr>
        <tr id="demon" class="evid_row">
          <th><?php _e("Demon", "lang") ?></th>
          <td></td>
          <td></td>
          <td data-evidence="freezing-temp"><?php _e("Freezing Temperature", "lang") ?></td>
          <td></td>
          <td data-evidence="ghost-writing"><?php _e("Ghost Writing", "lang") ?></td>
          <td data-evidence="spirit-box"><?php _e("Spirit Box", "lang") ?></td>
        </tr>
        <tr id="yurei" class="evid_row">
          <th><?php _e("Yurei", "lang") ?></th>
          <td></td>
          <td></td>
          <td data-evidence="freezing-temp"><?php _e("Freezing Temperature", "lang") ?></td>
          <td data-evidence="ghost-orb"><?php _e("Ghost Orbs", "lang") ?></td>
          <td data-evidence="ghost-writing"><?php _e("Ghost Writing", "lang") ?></td>
          <td></td>
        </tr>
        <tr id="oni" class="evid_row">
          <th><?php _e("Oni", "lang") ?></th>
          <td data-evidence="emf"><?php _e("Emf 5", "lang") ?></td>
          <td></td>
          <td></td>
          <td></td>
          <td data-evidence="ghost-writing"><?php _e("Ghost Writing", "lang") ?></td>
          <td data-evidence="spirit-box"><?php _e("Spirit Box", "lang") ?></td>
        </tr>
      </table>
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
  <script defer src="js/indexTrack.min.js?v=<?php echo $version; ?>"></script>
<<<<<<< HEAD
=======
  <script defer src="<?php echo $fileGhosts; ?>?v=<?php echo $version; ?>"></script>
>>>>>>> dev
</body>

</html>