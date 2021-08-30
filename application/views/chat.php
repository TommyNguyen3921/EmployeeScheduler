<h2>Chat Messages</h2>

<div class="chatbox" id="chatbox">
<?php foreach ($chat as $row) { ?>
  
<div class="container message">
  <h2><?= $row['name']?></h2>
  <p><?= $row['messagedata']?></p>
  
</div>

<?php } ?>
</div>
<form method="POST" action="<?php echo base_url(); ?>index.php/Chat/sendmessage" >


  
  <textarea class="form-control" id="myInput" name="message" placeholder="type a message"></textarea>
  <button type="submit" id="myBtn" class="pull-right btn btn-success"><span class="glyphicon glyphicon-log-in"></span> Send</button>
</form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type='text/javascript'>
  $(document).ready(function() {

    var element = document.getElementById("chatbox");
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

