<h2>foruminfo</h2>
<h1><?= $foruminfo[0]['topic']?></h1>

<div class="solid">
<?php foreach ($foruminfo as $row) { ?>
    <div><?= $row['name']?></div>
    
    
    <div><?= $row['messageforum']?></div>
  
<?php } ?>
</div>

<form method="POST" action="<?php echo base_url(); ?>index.php/Forum/addmessage" >


  <div class="form-group">
  
    <textarea  name="message" rows="4" cols="50"></textarea>
  </div>
  <button type="submit" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-log-in"></span> Send</button>
</form>