<h2>Chat Messages</h2>


<?php foreach ($chat as $row) { ?>
<div class="container">
  <h2><?= $row['name']?></h2>
  <p><?= $row['messagedata']?></p>
  
</div>

<?php } ?>

<form method="POST" action="<?php echo base_url(); ?>index.php/Chat/sendmessage" >


  <div class="form-group">
  
    <textarea  name="message" rows="4" cols="50"></textarea>
  </div>
  <button type="submit" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-log-in"></span> Send</button>
</form>