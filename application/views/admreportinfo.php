<h2>Report Bug</h2>


   

<div class="form-group">
    <label for="exampleFormControlInput1">Send By</label>
    <p><?= $reportsinfo[0]['name']?></p>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Topic</label>
    <p><?= $reportsinfo[0]['topic']?></p>
  </div>
  
  
  <div class="form-group">
  <label for="exampleFormControlInput1">Description</label>
  <p><?= $reportsinfo[0]['message']?></p>
  </div>
  <a href="<?= base_url(); ?>index.php?/Admreport">Back</a>
  <a href=" <?= base_url() ?>index.php?/Admreport/bugsolve/<?= $reportsinfo[0]['reportID']?>">
                    completed
                </a>

