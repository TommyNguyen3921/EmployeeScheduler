<h2>Set up Schedule</h2>

<form form method="POST" action="<?php echo base_url(); ?>index.php/Setup/Addschedule">
  <div class="form-group">
  <label for="formGroupExampleInput2">Employee</label>
  <select name="member" id="sel_user">
  <option value="default">default</option>
  <?php foreach ($member as $row) { ?>
    <option value=<?= $row['memberID']?>><?= $row['name']?></option>
    <?php } ?>
  </select>
  </div>
  <div class="form-group">
  <label for="formGroupExampleInput2">Day</label>
  <select name="date" id="sel_user">
  <option value="default">default</option>
  
    <option value="Sunday">Sunday</option>
    <option value="Monday">Monday</option>
    <option value="Tuesday">Tuesday</option>
    <option value="Wednesday">Wednesday</option>
    <option value="Thursday">Thursday</option>
    <option value="Friday">Friday</option>
    <option value="Saturday">Saturday</option>
   
  </select>
  </div>
  <div class="form-group">
  <label for="formGroupExampleInput2">Starting time</label>
  <select name="start" id="sel_user">
  <option value="default">default</option>
  
    <option value=1>1</option>
    <option value=2>2</option>
    <option value=3>3</option>
    <option value=4>4</option>
    <option value=5>5</option>
    <option value=6>6</option>
    <option value=7>7</option>
    <option value=8>8</option>
    <option value=9>9</option>
    <option value=10>10</option>
    <option value=11>11</option>
    <option value=12>12</option>
   
  </select>
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">End time</label>
    <select name="end" id="sel_user">
  <option value="default">default</option>
  
  <option value=1>1</option>
    <option value=2>2</option>
    <option value=3>3</option>
    <option value=4>4</option>
    <option value=5>5</option>
    <option value=6>6</option>
    <option value=7>7</option>
    <option value=8>8</option>
    <option value=9>9</option>
    <option value=10>10</option>
    <option value=11>11</option>
    <option value=12>12</option>
   
  </select>
  </div>
 
  <button type="submit" class="btn btn-lg btn-primary btn-block" id="add"  value="add"> Add</button>
  <button type="submit" class="btn btn-lg btn-primary btn-block" id="update" value="update"> Update</button>
</form>


<table class="table table-striped">

<tr>

<th>Name</th>
<th>Sunday</th>
<th>Monday</th>
<th>Tuesday</th>
<th>Wednesday</th>

<th >Thursday</th>
<th >Friday</th>
<th >Saturday</th>

</tr>


 
<?php foreach ($schedule as $row) { ?>
 <tr>
 

 <td><?= $row['name']?></td>

 <?php if ($row['days']) { ?>
 <td><?= $row['days']?>/<?= $row['edays']?></td>
 <?php }else{ ?>
 <td>OFF</td>
 <?php } ?>

 <?php if ($row['days1']) { ?>
 <td><?= $row['days1']?>/<?= $row['edays1']?></td>
 <?php }else{ ?>
 <td>OFF</td>
 <?php } ?>
 
 <?php if ($row['days2']) { ?>
 <td><?= $row['days2']?>/<?= $row['edays2']?></td>
 <?php }else{ ?>
 <td>OFF</td>
 <?php } ?>

 <?php if ($row['days3']) { ?>
 <td><?= $row['days3']?>/<?= $row['edays3']?></td>
 <?php }else{ ?>
 <td>OFF</td>
 <?php } ?>

 <?php if ($row['days4']) { ?>
 <td><?= $row['days4']?>/<?= $row['edays4']?></td>
 <?php }else{ ?>
 <td>OFF</td>
 <?php } ?>
 
 <?php if ($row['days5']) { ?>
 <td><?= $row['days5']?>/<?= $row['edays5']?></td>
 <?php }else{ ?>
 <td>OFF</td>
 <?php } ?>

 <?php if ($row['days6']) { ?>
 <td><?= $row['days6']?>/<?= $row['edays6']?></td>
 <?php }else{ ?>
 <td>OFF</td>
 <?php } ?>
 
 
 

 

 </tr>
<?php } ?>







</table>

<form form method="POST" action="<?php echo base_url(); ?>index.php/Setup/reset">
<button type="submit">Click Me!</button> 
</form>