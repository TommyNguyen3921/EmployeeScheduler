
<h2>Create Account</h2>

<div class="reportbox">
  <h1>Add Account</h1>

  <?php if ($error) { ?>
  <h3 class="error">Username already Exist.</h3>
<?php }?>
<?php if ($success) { ?>
  <h3 class="success">Successfully Created.</h3>
<?php }?>
<h3 class="error"><?php echo validation_errors(); ?></h3>

<form method="POST" action="<?php echo base_url(); ?>index.php/Createacc/create">
  <div class="form-group">
    <label for="formGroupExampleInput">Full Name</label>
    <input type="text" class="form-control" name="name" >
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Username</label>
    <input type="text" class="form-control" name="user" >
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Password</label>
    <input type="text" class="form-control" name="password" >
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
<?php }?>

<h2>User Table</h2>
<input class="sticky-top" id="myInput" type="text" placeholder="Search..">
<table class="table table-dark">

 <tr>
 
 <th>Full Name</th>
 <th>Username</th>
 <th>Password</th>
 <th>Access level</th>
 
 <th >Delete</th>
 
 
 </tr >
 
<?php foreach ($accounts as $row) { ?>
 <tr class='table-light filterbox'>
 

 <td><?= $row['name']?></td>
 <td><?= $row['username']?></td>
 <td><?= $row['password']?></td>
 <?php if ($row['level'] == 0) { ?>
 <td>Employee</td>
 <?php } else if ($row['level'] == 1) { ?>
  <td>Manager</td>
  <?php } else  { ?>
    <td>Adminstrator</td>
    <?php } ?>

 <td><a class="btn btn-danger" href="<?= base_url() ?>index.php?/Createacc/delete/<?= $row['memberID']?>">X</a></td>

 </tr>
<?php } ?>
</table>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type='text/javascript'>
  $(document).ready(function() {



  
  



$("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".filterbox").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });



  });
</script>









