<h2>Forum</h2>
<h3 class="error"><?php echo validation_errors(); ?></h3>


<div class="reportbox">
<h1>New Post</h1>
<form id="reportformbox" method="POST" action="<?php echo base_url(); ?>index.php/Forum/submitpost">

<div class="form-group">
    <label for="exampleFormControlInput1">Topic</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="topic">
  </div>
  
  
  
  <div class="form-group">
  <label for="exampleFormControlInput1">Discussion</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="discussion"></textarea>
  </div>
  <button type="submit" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-log-in"></span> Submit</button>
</form>
</div>