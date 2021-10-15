<h2>Chat Messages</h2>


<div class="flex-container">
  <div id="chatflex">
  <?php foreach ($chatuser as $row) { ?>

<div class="solid reportbox">
<a class="chatboxstyle" style="display:block" href="#" data-value="<?= $row['memberID']?>"  >
<?= $row['name']?>
</a>
</div>
<?php } ?>

</div>


   <div>
    
    <div class="chatbox1" id="chatbox1 ">
    <div  id="messages">

  </div>

</div>
<form>


  
  <textarea class="form-control" id="mymessage" name="message" placeholder="type a message"></textarea>
  <button type="submit" id="send" class="pull-right btn btn-success"><span class="glyphicon glyphicon-log-in"></span> Send</button>
</form>



</div> 

</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type='text/javascript'>
  $(document).ready(function() {
/*
    var element = document.getElementById("chatbox");
element.scrollTop = element.scrollHeight;

var input = document.getElementById("myInput");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   document.getElementById("myBtn").click();
  }
});
*/

let val = '';

$( ".chatboxstyle" ).click(function() {
  val = $(this).data('value');
  
  //$("#chatbox").empty(); 
  /*
  $(".active").attr("class", "chatboxstyle ");
  $(this).attr("class", "active");
  */
  $.ajax({
     url:'<?php echo base_url(); ?>index.php/Chat/messagehistory',
     method: 'post',
     data: {senduser: val},
     dataType: 'json',
     success: function(response){
      $("#messages").empty(); 
      for(var i=0;i<response.length;i++)
           {
            
             var Html="<h2><strong>" + response[i].user +"</strong></h2><p>"+response[i].messagedata+"</p>";
            $('#messages').append(Html);

           }
           $('.chatbox1').scrollTop($('.chatbox1')[0].scrollHeight);
     }
   });
});


var input = document.getElementById("mymessage");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   document.getElementById("send").click();
  }
});

$("#send").click(function (event) {
    event.preventDefault();
    if(val != ""){
      
    
    
   
    $.ajax({
     url:'<?php echo base_url(); ?>index.php/Chat/messagesend',
     method: 'post',
     data: {senduser: val,
            message: $("#mymessage").val()},
     dataType: 'json',
     success: function(response){
      for(var i=0;i<response.length;i++)
           {
            document.getElementById("mymessage").value = "";
             var Html="<h2><strong>" + response[i].user +"</strong></h2><p>"+response[i].messagedata+"</p>";
            $('#messages').append(Html);

           }
           $('.chatbox1').scrollTop($('.chatbox1')[0].scrollHeight);
     }
   });
  }
  });

  });
</script>

