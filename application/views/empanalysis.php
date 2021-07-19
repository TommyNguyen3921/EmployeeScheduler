<h2>Analysis</h2>

<h2>User Table</h2>


      <table class="table table-striped">

 <tr>
 
 <th>Date</th>
 <th>Shift Change</th>
 <th>Late to shift</th>
 <th>Pay</th>
 <th>Hours</th>

 
 </tr>
 

 
 
 <?php foreach ($analysis as $row) { ?>
 <tr>
 

 <td><?= $row['Date']?></td>
 <td><?= $row['shiftchanges']?></td>
 <td><?= $row['latetoshift']?></td>
 <td><?= $row['pay']?></td>
 <td><?= $row['hours']?></td>



 </tr>
<?php } ?>


 

</table>