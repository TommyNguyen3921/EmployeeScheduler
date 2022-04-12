<h2>Pending Employee Shift</h2>




<h1 class="titlespacing">Pending Shifts</h1>
<div class="reportbox">
  <?php foreach ($loadweeks as $row) { ?>
    <div class="report">
      <div class="row">

        <div class="col-md-9">
          <div class="solid">






            <a id="reportboxinfo" href=" <?= base_url() ?>index.php?/Admpendshift/moreinfo/<?= $row['weekID'] ?>">
              <div>
                <p class="reporttitle">Week start Date: <?= $row['startdate'] ?></p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p class="reporttitle">Week End Date: <?= $row['enddate'] ?></p>
              </div>
            </a>




          </div>
        </div>
        <div class="col-md-2">
          <div class="solid">
            <?= $row['Shiftcount'] ?>

          </div>
        </div>
      </div>
    </div>
  <?php } ?>

</div>