<h2>Create Account</h2>

<div class="reportbox">
  <h1>Add Account</h1>

  <?php if ($error) { ?>
    <h3 class="error">Username already Exist.</h3>
  <?php } ?>
  <?php if ($success) { ?>
    <h3 class="success">Successfully Created.</h3>
  <?php } ?>
  <h3 class="error"><?php echo validation_errors(); ?></h3>

  <form method="POST" action="<?php echo base_url(); ?>index.php/Createacc/create">
    <div class="form-group">
      <label for="formGroupExampleInput">Full Name</label>
      <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group">
      <label for="formGroupExampleInput2">Username</label>
      <input type="text" class="form-control" name="user">
    </div>
    <div class="form-group">
      <label for="formGroupExampleInput2">Password</label>
      <input type="text" class="form-control" name="password" id="password" readonly>
      <button class='like btn btn-secondary' id='request' value="">Generate Password</button>
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Access level</label>
      <select class="form-control" name="level">
        <option value="0">Employee</option>
        <option value="1">Manager</option>
        <option value="2">Adminstrator</option>

      </select>
    </div>
    <button type="submit" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-log-in"></span> Add Account</button>
  </form>
</div>

<?php if ($deletecheck) { ?>
  <h3 class="error">Cannot delete if only 1 Manager or Adminstrator</h3>
<?php } ?>

<h2>User Table</h2>
<input class="sticky-top" id="myInput" type="text" placeholder="Search..">
<table class="table table-dark">

  <tr>

    <th>Full Name</th>
    <th>Username</th>
    <th>Access level</th>
    <th>Reset Password</th>
    <th>Delete</th>


  </tr>

  <?php foreach ($accounts as $row) { ?>
    <tr class='table-light filterbox'>


      <td><?= $row['name'] ?></td>
      <td><?= $row['username'] ?></td>
      
      <?php if ($row['level'] == 0) { ?>
        <td>Employee</td>
      <?php } else if ($row['level'] == 1) { ?>
        <td>Manager</td>
      <?php } else { ?>
        <td>Adminstrator</td>
      <?php } ?>
      <td><button class='like btn btn-secondary' id='reset' value="<?= $row['memberID'] ?>">Reset Password</button></td>
      <td><a class="btn btn-danger" href="<?= base_url() ?>index.php?/Createacc/delete/<?= $row['memberID'] ?>">X</a></td>

    </tr>
  <?php } ?>
</table>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type='text/javascript'>
  $(document).ready(function() {








    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $(".filterbox").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });


    $(function() {
      $(document).on("click", '#request', function() {
        
        event.preventDefault();

        

        
          var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
          var passwordLength = 6;
          var password = "";
          for (var i = 0; i <= passwordLength; i++) {
            var randomNumber = Math.floor(Math.random() * chars.length);
            password += chars.substring(randomNumber, randomNumber + 1);
          }
          $("#password").val(password);
          

      });
    });

    $(function() {
      $(document).on("click", '#reset', function() {
        var memberID = $(this).val();
        event.preventDefault();

        var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
          var passwordLength = 6;
          var password = "";
          for (var i = 0; i <= passwordLength; i++) {
            var randomNumber = Math.floor(Math.random() * chars.length);
            password += chars.substring(randomNumber, randomNumber + 1);
          }

        
        

        $.ajax({
          url: '<?php echo base_url(); ?>index.php/Createacc/resetpass',
          method: 'post',
          data: {
            memberID: memberID,
            temppass: password
          },
          dataType: 'json',
          success: function(response) {
            $( "#personname" ).html("<b>For user:</b> "+response[0].username);
            $( "#resetpass" ).html("<b>Temporary Password:</b> "+password);
            $('#Modalsent').modal('show')
            
          }
        });
          

      });
    });


  });
</script>


<!-- Modal -->
<div class="modal fade" id="Modalsent" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
      <div id="personname"></div>
        <div id="resetpass"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>