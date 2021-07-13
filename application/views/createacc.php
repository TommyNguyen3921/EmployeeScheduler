
<h1>Create Account</h1>

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
  <button type="submit" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-log-in"></span> Submit</button>
</form>
<h2>User Table</h2>
<table class="table table-striped">

 <tr>
 
 <th>Full Name</th>
 <th>Username</th>
 <th>Password</th>
 <th>Access level</th>
 
 <th >Delete</th>
 
 
 </tr>
 
<?php foreach ($accounts as $row) { ?>
 <tr>
 

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

 <td><a href="<?= base_url() ?>index.php?/Createacc/delete/<?= $row['memberID']?>">Delete</a></td>

 </tr>
<?php } ?>
</table>








