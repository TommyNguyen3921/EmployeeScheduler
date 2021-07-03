<h2>Report Bug</h2>


   
<form method="POST" action="<?php echo base_url(); ?>index.php/Empreport/report">

<div class="form-group">
    <label for="exampleFormControlInput1">Email address</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="user"value="1">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Topic</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="topic" >
  </div>
  
  
  <div class="form-group">
  <label for="exampleFormControlInput1">Description</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="description"></textarea>
  </div>
  <button type="submit" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-log-in"></span> Submit</button>
</form>
