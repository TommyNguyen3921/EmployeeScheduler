<h2>Report Bug</h2>

<?php if (empty($reports)) { ?>
    <h2>No Bugs reported</h2>
<?php } ?>

<?php if (!empty($reports)) { ?>
    <h1 class="reporttitle">Sent by</h1>
    <h1 class="reporttitle">Topic</h1>
<?php } ?>


<div class="reportbox">
    <?php foreach ($reports as $row) { ?>
        <div class="report">
            <div class="row">

                <div class="col-md-9">
                    <div class="solid">






                        <a id="reportboxinfo" href=" <?= base_url() ?>index.php?/Admreport/moreinfo/<?= $row['reportID'] ?>">
                            <div>
                                <p class="reporttitle"><?= $row['name'] ?></p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p class="reporttitle"><?= $row['topic'] ?></p>
                            </div>
                        </a>





                    </div>
                </div>
                <div class="col-md-2">

                    <a href=" <?= base_url() ?>index.php?/Admreport/bugsolve/<?= $row['reportID'] ?>">
                        &#9745;
                    </a>


                </div>
            </div>
        </div>
    <?php } ?>

</div>