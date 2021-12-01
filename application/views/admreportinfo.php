<h2>Report Bug</h2>



<div class="reportbox">
<div class="form-group ">
  <label for="exampleFormControlInput1"><b>Send By</b> </label>
  <p class="reportboxinfo1"><?= $reportsinfo[0]['name'] ?></p>
</div>

<div class="form-group">
  <label for="exampleFormControlInput1"><b>Topic</b> </label>
  <p class="reportboxinfo1"><?= $reportsinfo[0]['topic'] ?></p>
</div>


<div class="form-group">
  <label for="exampleFormControlInput1"><b>Description</b> </label>
  <p class="reportboxinfodescription"><?= $reportsinfo[0]['message'] ?></p>
</div>

<a class="btn btn-primary buttonright" href="<?= base_url(); ?>index.php?/Admreport">Back</a>
<a class="btn btn-success buttonright" href=" <?= base_url() ?>index.php?/Admreport/bugsolve/<?= $reportsinfo[0]['reportID'] ?>">
  completed
</a>
</div>
