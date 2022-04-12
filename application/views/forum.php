<h2>Forum</h2>
<div class="reportbox">
    <form method="POST" action="<?php echo base_url(); ?>index.php/Forum/search">

        <div class="form-group">
            <label for="exampleFormControlInput1">Search</label>
            <input type="text" class="form-control" name="search">
        </div>

        <button type="submit" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-log-in"></span>&#128269;</button>
    </form>
</div>
<h1>Feed</h1>
<div class="reportbox">
    <div>
        <div class="row">

            <div class="col-md-9">
                <div class="solid">

                    <h1>Add a post</h1>


                </div>
            </div>
            <div class="col-md-2">

                <h1>
                    <a class="btn btn-success " id='addbutton' style="display:block" href=" <?= base_url() ?>index.php?/Forum/addpost">
                        ADD
                    </a>
                </h1>

            </div>
        </div>
    </div>
</div>

<h1>Forum Topics</h1>
<div class="reportbox">
    <?php foreach ($posts as $row) { ?>

        <div class="solid reportbox">
            <a id="reportboxinfo" style="display:block" href=" <?= base_url() ?>index.php?/Forum/foruminfo/<?= $row['topicID'] ?>">
                <?= $row['topic'] ?>
            </a>
        </div>
    <?php } ?>
</div>