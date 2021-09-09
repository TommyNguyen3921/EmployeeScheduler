<h2>Scheduler</h2>

<table class="table table-striped" id="table">

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

<div style=" float:left; width:50%; background:white; border: 1px solid black; ">
<table class="table table-striped" >

 <tr>
 
 <th  colspan="4">Pending Shift Off</th>


 
 
 </tr>
 
<?php foreach ($pending as $row) { ?>
 <tr>
 
 <td ><?= $row['name']?></td>
 <td ><?= $row['timeofday']?></td>
 <td><?= $row['startdatetime']?>/<?= $row['enddatetime']?></td>
 


 <td><button type='submit' class='like' id='accept' value=<?= $row['pendingID']?>>Accept</button><button type='submit' class='like' id='decline' value=<?= $row['pendingID']?>>Decline</button></td>

 </tr>
<?php } ?>
</table>
</div>

<div style=" float:left;  width:50%; background:white; border: 1px solid black; ">

<table class="table table-striped">

 <tr>
 
 <th  colspan="5">Available shift</th>


 
 
 </tr>
 

 
<?php foreach ($open as $row) { ?>
 <tr>
 
 
 <td ><?= $row['timeofday']?></td>
 <td><?= $row['startdatetime']?>/<?= $row['enddatetime']?></td>
 <td><button type='submit' class='like' id='delete' value=<?= $row['openshiftID']?>>Delete</button></td>


 

 </tr>
<?php } ?>

<tbody id="tbody">

</tbody>
</table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type='text/javascript'>
  $(document).ready(function(){
 
    $(function() {
    $(document).on("click", '#decline', function() {
      var pendid = $(this).val();
      $.ajax({
     url:'<?php echo base_url(); ?>index.php/Scheduleadm/penddecline',
     method: 'post',
     data: {pendID: pendid},
     dataType: 'json',
     success: function(response){
        
        
     
     }
   });
   $(this).closest('tr').remove();
   
  
    });
});

   $(function() {
    $(document).on("click", '#accept', function() {
      var pendid = $(this).val();
      $.ajax({
     url:'<?php echo base_url(); ?>index.php/Scheduleadm/pendaccept',
     method: 'post',
     data: {pendID: pendid},
     dataType: 'json',
     success: function(response){
        
      for(var i=0;i<response.length;i++)
           {
            
             var Html="<tr><td>"+response[i].timeofday+"</td><td>"+response[i].startdatetime+"/"+response[i].enddatetime+"</td><td><button type='submit' class='like' id='delete' value="+response[i].openshiftID+">Delete</button></td></tr>";
            $('#tbody').append(Html);
            
 
            
   

    var t = $('#table');

// jQuery to get the content of row 4, column 1
var val1 = $(t[0].rows[1].cells[0]).text();  

alert(val1);

while (i != 10) {
  text += "The number is " + i;
  i++;
}

 
           }
     
     }

   });
   $(this).closest('tr').remove();
  
    });
});


$(function() {
    $(document).on("click", '#delete', function() {
      var openshiftid = $(this).val();
    
      $.ajax({
     url:'<?php echo base_url(); ?>index.php/Scheduleadm/openshiftdelete',
     method: 'post',
     data: {openshiftID: openshiftid},
     dataType: 'json',
     success: function(response){
        
        
     
     }
   });
   $(this).closest('tr').remove();
    });
});
});




 </script>