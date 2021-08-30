<h2>Report Bug</h2>




<div class="form-group ">
  <label for="exampleFormControlInput1">Send By</label>
  <p class="reportboxinfo1"><?= $reportsinfo[0]['name'] ?></p>
</div>

<div class="form-group">
  <label for="exampleFormControlInput1">Topic</label>
  <p class="reportboxinfo1"><?= $reportsinfo[0]['topic'] ?></p>
</div>


<div class="form-group">
  <label for="exampleFormControlInput1">Description</label>
  <p class="reportboxinfo1"><?= $reportsinfo[0]['message'] ?></p>
</div>

<a class="btn btn-primary buttonright" href="<?= base_url(); ?>index.php?/Admreport">Back</a>
<a class="btn btn-success buttonright" href=" <?= base_url() ?>index.php?/Admreport/bugsolve/<?= $reportsinfo[0]['reportID'] ?>">
  completed
</a>