<h2>Report Bug</h2>

<?php if (empty($reports)){ ?>
    <h2>No Bugs reported</h2>
<?php } ?>
<?php foreach ($reports as $row) { ?>
<div >
    <div class="row">
        
        <div class="col-md-9">
        <div class="solid">
          
            
                
                
                    
                
                    <a style="display:block" href=" <?= base_url() ?>index.php?/Admreport/moreinfo/<?= $row['reportID']?>">
  <div class="xyz"><?= $row['name']?><p><td><?= $row['topic']?></div>
</a>

               
               

            
        </div>
        </div>
        <div class="col-md-2">
            <div>
                <a href=" <?= base_url() ?>index.php?/Admreport/bugsolve/<?= $row['reportID']?>">
                    completed
                </a>
                
            </div>
        </div>
    </div>
</div>
<?php } ?>

