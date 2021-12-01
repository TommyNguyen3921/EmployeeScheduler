<h2>Employee Schedule</h2>

<table class="table table-dark" id="employeeshift">

  <tr>

    <th>Name</th>
    <th>Sunday</th>
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wednesday</th>

    <th>Thursday</th>
    <th>Friday</th>
    <th>Saturday</th>

  </tr>

  <tbody >



    <tr class="table-warning">


      <td><?= $tableinfo[0]['name'] ?></td>

      <?php if ($tableinfo[0]['days']) { ?>
        <td><?= $tableinfo[0]['days'] ?> <br/> <?php if($tableinfo[0]['mdays'] != "") { ?> <b class="red"> (Changed to <?= $tableinfo[0]['mdays'] ?>)</b> <?php } ?></td>

      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($tableinfo[0]['days1']) { ?>
        <td><?= $tableinfo[0]['days1'] ?> <br/> <?php if($tableinfo[0]['mdays1'] != "") { ?> <b class="red"> (Changed to <?= $tableinfo[0]['mdays1'] ?>)</b> <?php } ?> </td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($tableinfo[0]['days2']) { ?>
        <td><?= $tableinfo[0]['days2'] ?> <br/> <?php if($tableinfo[0]['mdays2'] != "") { ?> <b class="red"> (Changed to <?= $tableinfo[0]['mdays2'] ?>)</b> <?php } ?></td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($tableinfo[0]['days3']) { ?>
        <td><?= $tableinfo[0]['days3'] ?> <br/> <?php if($tableinfo[0]['mdays3'] != "") { ?> <b class="red"> (Changed to <?= $tableinfo[0]['mdays3'] ?>)</b> <?php } ?></td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($tableinfo[0]['days4']) { ?>
        <td><?= $tableinfo[0]['days4'] ?> <br/> <?php if($tableinfo[0]['mdays4'] != "") { ?> <b class="red"> (Changed to <?= $tableinfo[0]['mdays4'] ?>)</b> <?php } ?></td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($tableinfo[0]['days5']) { ?>
        <td><?= $tableinfo[0]['days5'] ?> <br/> <?php if($tableinfo[0]['mdays5'] != "") { ?> <b class="red"> (Changed to <?= $tableinfo[0]['mdays5'] ?>)</b> <?php } ?></td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($tableinfo[0]['days6']) { ?>
        <td><?= $tableinfo[0]['days6'] ?> <br/> <?php if($tableinfo[0]['mdays6'] != "") { ?> <b class="red"> (Changed to <?= $tableinfo[0]['mdays6'] ?>)</b> <?php } ?> </td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>


    </tr>
   
 

  </tbody>


</table>

<input id="myInput" type="text" placeholder="Search..">
<table class="table table-dark" id="employeeshift">

  <tr>

    <th>Name</th>
    <th>Sunday</th>
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wednesday</th>

    <th>Thursday</th>
    <th>Friday</th>
    <th>Saturday</th>

  </tr>

  <tbody id="tbody">



  <?php $nm = 0; 
  foreach ($tableinfo as $row) { 
    if($nm == 1){?>
    <tr class="table-light">


      <td><?= $row['name'] ?></td>

      <?php if ($row['days']) { ?>
        <td><?= $row['days'] ?> <br/> <?php if($row['mdays'] != "") { ?> <b class="red"> (Changed to <?= $row['mdays'] ?>)</b> <?php } ?></td>

      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($row['days1']) { ?>
        <td><?= $row['days1'] ?> <br/> <?php if($row['mdays1'] != "") { ?> <b class="red"> (Changed to <?= $row['mdays1'] ?>)</b> <?php } ?> </td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($row['days2']) { ?>
        <td><?= $row['days2'] ?> <br/> <?php if($row['mdays2'] != "") { ?> <b class="red"> (Changed to <?= $row['mdays2'] ?>)</b> <?php } ?></td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($row['days3']) { ?>
        <td><?= $row['days3'] ?> <br/> <?php if($row['mdays3'] != "") { ?> <b class="red"> (Changed to <?= $row['mdays3'] ?>)</b> <?php } ?></td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($row['days4']) { ?>
        <td><?= $row['days4'] ?> <br/> <?php if($row['mdays4'] != "") { ?> <b class="red"> (Changed to <?= $row['mdays4'] ?>)</b> <?php } ?></td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($row['days5']) { ?>
        <td><?= $row['days5'] ?> <br/> <?php if($row['mdays5'] != "") { ?> <b class="red"> (Changed to <?= $row['mdays5'] ?>)</b> <?php } ?></td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($row['days6']) { ?>
        <td><?= $row['days6'] ?> <br/> <?php if($row['mdays6'] != "") { ?> <b class="red"> (Changed to <?= $row['mdays6'] ?>)</b> <?php } ?> </td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>


    </tr>
   
  <?php }$nm=1; } ?>

  </tbody>


</table>
<h1>Employee Shift Info</h1>
<?php if ($fail) { ?>
  <h3 class="error">Already schedule for that day.</h3>
<?php }?>
<?php if ($success) { ?>
  <h3 class="success">Shifted Added</h3>
<?php }?>
<?php if ($full) { ?>
  <h3 class="error">Shift already Filled</h3>
<?php }?>

<div style=" float:left; width:50%; background:white; border: 1px solid black; ">

<table class="table table-primary">

<tr>

  <th colspan="16">My Shift</th>



</tr>

<tr>
<th colspan="4">Day</th>
  <th colspan="4">Shift Time</th>
  <th colspan="4">Modtime</th>
  <th colspan="4">Request Shift Off</th>
 




</tr>

<?php foreach ($empshift as $row) { ?>
  <tr class="table-light">


  <?php if ($row['timeofday']==1){ ?>
            <td colspan="4"> Sunday</td>
            <?php } else if ($row['timeofday']==2) { ?>
              <td colspan="4">Monday</td>
              <?php } else if ($row['timeofday']==3){ ?>
                <td colspan="4">Tuesday</td>
                <?php } else if ($row['timeofday']==4){ ?>
                <td colspan="4">Wednesday</td>
                <?php } else if ($row['timeofday']==5){ ?>
                <td colspan="4">Thursday</td>
                <?php } else if ($row['timeofday']==6){ ?>
                <td colspan="4">Friday</td>
                <?php } else { ?>
                <td colspan="4">Saturday</td>
                <?php }  ?>
    <td colspan="4"><?= $row['shifttime'] ?></td>
    <td colspan="4"><?= $row['modtime'] ?></td>


    <td><button type='submit'  class='like btn btn-secondary' id='request' data-id=<?= $row['weekID'] ?> value=<?= $row['scheduleinfoID'] ?>>Request Shift Off</button></td>

  </tr>
<?php } ?>

<tbody id="tbody">

</tbody>
</table>
</div>

<div style=" float:left;  width:50%; background:white; border: 1px solid black; ">

  <table class="table table-primary">

    <tr>

      <th colspan="6">Available shift</th>




    </tr>



    <?php foreach ($avail as $row) { ?>
      <tr class="table-light">


      <?php if ($row['timeofday']==1){ ?>
            <td colspan="4"> Sunday</td>
            <?php } else if ($row['timeofday']==2) { ?>
              <td colspan="4">Monday</td>
              <?php } else if ($row['timeofday']==3){ ?>
                <td colspan="4">Tuesday</td>
                <?php } else if ($row['timeofday']==4){ ?>
                <td colspan="4">Wednesday</td>
                <?php } else if ($row['timeofday']==5){ ?>
                <td colspan="4">Thursday</td>
                <?php } else if ($row['timeofday']==6){ ?>
                <td colspan="4">Friday</td>
                <?php } else { ?>
                <td colspan="4">Saturday</td>
                <?php }  ?>
        
        <td><?= $row['start'] ?><?= $row['startampm'] ?>-<?= $row['end'] ?><?= $row['endampm'] ?> </td>
        <td><a  class="btn btn-primary" href="<?= base_url() ?>index.php?/Empshiftweek/acceptopenshift/<?= $row['openshiftID']?>/<?= $row['weekID']?>">Accept Shift</a></td>
        
      </tr>
    <?php } ?>
  </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type='text/javascript'>
    $(document).ready(function() {




        //filter employee
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

  
        $(function() {
      $(document).on("click", '#request', function() {
        var shiftid = $(this).val();
        
        var weekid = $(this).data('id');
        
        $.ajax({
          url: '<?php echo base_url(); ?>index.php/Empshiftweek/pendingusershift',
          method: 'post',
          data: {
            shiftID: shiftid,
            weekID: weekid
          },
          dataType: 'text',
          success: function(response) {
            
            if (response == false){
              $('#Modalpending').modal('show')
            }else{
              $('#Modalsent').modal('show')
            }
            
          }
        });

      

      });
    });

    });
</script>

<!-- Modal -->
<div class="modal fade" id="Modalpending" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        Request Already Sent and Pending
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Modalsent" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        Request Sent 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>