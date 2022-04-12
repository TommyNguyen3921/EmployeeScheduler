<h2>Chat Messages</h2>


<div class="flex-container">

  <div id="chatflex" class="overflow-auto">
    <input class="sticky-top" id="myInput" type="text" placeholder="Search..">
    <?php foreach ($chatuser as $row) { ?>

      <div class="solid reportbox ">
        <a class="chatboxstyle" style="display:block" href="#" data-value="<?= $row['memberID'] ?>">
          <?= $row['name'] ?>
        </a>
      </div>
    <?php } ?>

  </div>


  <div>

    <div class="chatbox1" id="chatbox1 ">
      <div id="messages">
        <h1>Select a User to Chat</h1>
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


    let val = '';

    /**
     *get selected user to chat with detail 
     */
    $(".chatboxstyle").click(function() {
      val = $(this).data('value');

      //ajax to get message history with user
      $.ajax({
        url: '<?php echo base_url(); ?>index.php/Chat/messagehistory',
        method: 'post',
        data: {
          senduser: val
        },
        dataType: 'json',
        success: function(response) {
          //empty chat box
          $("#messages").empty();

          //add all cuurennt chat message with user into chat box
          for (var i = 0; i < response.length; i++) {

            var Html = "<h2><strong>" + response[i].user + "</strong></h2><p>" + response[i].messagedata + "</p>";
            $('#messages').append(Html);

          }
          //scroll to bottom of chat box
          $('.chatbox1').scrollTop($('.chatbox1')[0].scrollHeight);
        }
      });
    });

    /**
     *allow user to submit message pressing the enter key 
     */
    var input = document.getElementById("mymessage");
    input.addEventListener("keyup", function(event) {
      if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("send").click();
      }
    });

    /**
     *filter for list of user to chat with 
     */
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $(".reportbox").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });

    /**
     *button to send message to server to save in chathistory 
     */
    $("#send").click(function(event) {
      event.preventDefault();

      //do ajax if chatmessage is not empty
      if (val != "") {

        $.ajax({
          url: '<?php echo base_url(); ?>index.php/Chat/messagesend',
          method: 'post',
          data: {
            senduser: val,
            message: $("#mymessage").val()
          },
          dataType: 'json',
          success: function(response) {
            //display sent message on success
            for (var i = 0; i < response.length; i++) {
              document.getElementById("mymessage").value = "";
              var Html = "<h2><strong>" + response[i].user + "</strong></h2><p>" + response[i].messagedata + "</p>";
              $('#messages').append(Html);

            }
            //scroll to the bottom
            $('.chatbox1').scrollTop($('.chatbox1')[0].scrollHeight);
          }
        });
      }
    });

  });
</script>