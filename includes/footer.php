<footer>
  <div class="row m-auto w-80">
    <div class="col-4 o-2">
      <h4><?php _e("Site navigation", "lang"); ?></h4>
      <nav class="menu">
        <ul>
          <li class="menu-item"><a href="./"><i class="fa fa-home"></i> <?php _e('Home page', 'lang'); ?></a></li>
          <li class="menu-item"><a href="./rules.php"><i class="fa fa-scroll"></i> <?php _e('Rules of randomizer', 'lang'); ?></a></li>
          <li class="menu-item"><a href="./tracker.php"><i class="fa fa-search"></i> <?php _e('Ghost (Un)Tracker', 'lang'); ?></a></li>
          <li class="menu-item"><a href="https://mantis.phasmo-randomizer.site/"><i class="fa fa-bug"></i> <?php _e('Report an issue', 'lang'); ?></a></li>
          <li class="menu-item"><a href="#" onclick="openWind(this);return false;"><i class="fa fa-external-link-alt"></i> <?php _e('Open in external window', 'lang'); ?></a></li>
        </ul>
      </nav>
    </div>
    <div class="col-2 o-1">
      <p>Version <?php echo $version; ?><br><strong>Phasmophobia Randomizer</strong> © 2020, all rights reserved to tristantheb Production.</p>
      <hr>
      <p>
        <?php _e("All content coming from the game Phasmophobia and being used on the site belongs to Kinetic Game.<br>\nThe idea for the randomizer comes from Insym and has been edited by GuzzLIVE.<br>\nThe conception and realization of the site and its scripts are done by tristantheb Production.", "lang"); ?>
      </p>
    </div>
    <div class="col-4 o-3">
      <nav class="menu">
        <h4><?php _e("Social medias", "lang"); ?></h4>
        <ul>
          <li class="menu-item"><a href="https://twitter.com/PhasmoRando"><i class="fab fa-twitter"></i> <?php _e('Phasmophobia Ranzomizer Twitter', 'lang'); ?></a></li>
          <li class="menu-item"><a href="https://discord.gg/5ft7rEkRUP"><i class="fab fa-discord"></i> <?php _e('Phasmophobia Ranzomizer Discord', 'lang'); ?></a></li>
          <li class="menu-item"><a href="https://discord.gg/phasmophobia"><i class="fab fa-discord"></i> <?php _e('Phasmophobia Official Discord', 'lang'); ?></a></li>
        </ul>
      </nav>
    </div>
  </div>
</footer>
<script>
  function openWind() {
    window.open(window.location.href, "<?php echo PAGE_TITLE; ?>", "height=700px,toolbar=0,width=1300px");
  }
</script>
