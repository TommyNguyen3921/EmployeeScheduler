<h2>foruminfo</h2>
<h1><?= $foruminfo[0]['topic']?></h1>


<div class="forumbox" id="forumbox">
<?php foreach ($foruminfo as $row) { ?>
  <div class="foruminfobox">
    <b><?= $row['name']?></b>
    
    
    <div><?= $row['messageforum']?></div>
    </div>
<?php } ?>
</div>



<form method="POST" action="<?php echo base_url(); ?>index.php/Forum/addmessage" >


  
  <textarea class="form-control" id="myInput" name="message" placeholder="type a message"></textarea>
  <button type="submit" id="myBtn" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-log-in"></span> Send</button>
</form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type='text/javascript'>
  $(document).ready(function() {


    var element = document.getElementById("forumbox");
element.scrollTop = element.scrollHeight;

var input = document.getElementById("myInput");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   document.getElementById("myBtn").click();
  }
});

  });
</script>