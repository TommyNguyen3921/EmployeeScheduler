<h2>Report Bug</h2>
<?php foreach ($reports as $row) { ?>
<div >
    <div class="row">
        
        <div class="col-md-9">
        <div class="solid">
            <div class="right-description893">
                <div id="que-hedder2983">
                    <h3><a href="post-deatils.html" target="_blank"><td><?= $row['name']?></td></a></h3> </div>
                <div class="ques-details10018">
                    <p><td><?= $row['topic']?></td></p>
                </div>
               

            </div>
        </div>
        </div>
        <div class="col-md-2">
            <div>
                <a href="#">
                    <button type="button" class="q-type238"><i class="fa fa-comment" aria-hidden="true">  completed</i></button>
                </a>
                
            </div>
        </div>
    </div>
</div>
<?php } ?>

