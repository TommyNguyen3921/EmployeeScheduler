<h2>Profile Page</h2>


<h3 class="error"><?php echo validation_errors(); ?></h3>
<?php if ($success) { ?>
  <h3 class="success">Update Successful</h3>
<?php } ?>

<div class="reportbox">
  <h1>Edit Profile</h1>
  <form id="reportformbox" method="POST" action="<?php echo base_url(); ?>index.php/Profile/updateprofile">

    <div class="form-group ">
      <label for="exampleFormControlInput1"><b>Name</b> </label>
      <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="<?= $memberinfo[0]['name'] ?>" readonly>
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1"><b>Username</b> </label>
      <input type="text" class="form-control" id="exampleFormControlInput1" name="username" value="<?= $memberinfo[0]['username'] ?>">
    </div>



    <button type="submit" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-log-in"></span> Submit</button>
  </form>

</div>

<div class="reportbox">
  <h1>Change Password</h1>
  <form id="reportformbox" method="POST" action="<?php echo base_url(); ?>index.php/Profile/updatepassword">


    <div class="form-group">
      <label for="exampleFormControlInput1"><b>New Password</b> </label>
      <input type="text" class="form-control" id="exampleFormControlInput1" name="password">
    </div>



    <button type="submit" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-log-in"></span> Submit</button>
  </form>

</div>