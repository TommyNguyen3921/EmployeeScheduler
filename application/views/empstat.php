<h2>Stat</h2>

<div class="reportbox">
  <?php foreach ($loadweeks as $row) { ?>
    <div class="report">

      <div class="solid">

        <a id="reportboxinfo" href=" <?= base_url() ?>index.php?/Empstat/moreinfo/<?= $row['weekID'] ?>">
          <div>
            <p class="reporttitle">Week start Date: <?= $row['startdate'] ?></p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p class="reporttitle">Week End Date: <?= $row['enddate'] ?></p>
          </div>
        </a>

      </div>

    </div>
  <?php } ?>

</div>