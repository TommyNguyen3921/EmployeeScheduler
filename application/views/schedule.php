<h2>Scheduler</h2>

<table class="table table-striped" id="tabletest">

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



  <?php foreach ($schedule as $row) { ?>
    <tr>


      <td><?= $row['name'] ?></td>

      <?php if ($row['days']) { ?>
        <td><?= $row['days'] ?>/<?= $row['edays'] ?></td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($row['days1']) { ?>
        <td><?= $row['days1'] ?>/<?= $row['edays1'] ?></td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($row['days2']) { ?>
        <td><?= $row['days2'] ?>/<?= $row['edays2'] ?></td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($row['days3']) { ?>
        <td><?= $row['days3'] ?>/<?= $row['edays3'] ?></td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($row['days4']) { ?>
        <td><?= $row['days4'] ?>/<?= $row['edays4'] ?></td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($row['days5']) { ?>
        <td><?= $row['days5'] ?>/<?= $row['edays5'] ?></td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>

      <?php if ($row['days6']) { ?>
        <td><?= $row['days6'] ?>/<?= $row['edays6'] ?></td>
      <?php } else { ?>
        <td>OFF</td>
      <?php } ?>






    </tr>
  <?php } ?>







</table>

<div style=" float:left; width:50%; background:white; border: 1px solid black; ">
  <table class="table table-striped">

    <tr>

      <th colspan="4">My shift</th>




    </tr>

    <?php foreach ($schedule1 as $row) { ?>
      <tr>


        <td><?= $row['timeofday'] ?></td>
        <td><?= $row['startdatetime'] ?></td>
        <td><?= $row['enddatetime'] ?></td>


        <td><button type='submit' class='like' id='request' value=<?= $row['scheduleID'] ?>>Request Shift Off</button></td>

      </tr>
    <?php } ?>

    <tbody id="tbody">

    </tbody>
  </table>
</div>

<div style=" float:left;  width:50%; background:white; border: 1px solid black; ">

  <table class="table table-striped">

    <tr>

      <th colspan="4">My shift</th>




    </tr>



    <?php foreach ($open as $row) { ?>
      <tr>



        <td><?= $row['timeofday'] ?></td>
        <td><?= $row['startdatetime'] ?>/<?= $row['enddatetime'] ?></td>
        <td><button type='submit' class='like' id='openshiftaccept' value=<?= $row['openshiftID'] ?>>Accept Shift</button></td>

      </tr>
    <?php } ?>
  </table>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type='text/javascript'>
  $(document).ready(function() {

    $(function() {
      $(document).on("click", '#request', function() {
        var shiftid = $(this).val();

        $.ajax({
          url: '<?php echo base_url(); ?>index.php/Schedule/pending',
          method: 'post',
          data: {
            shiftID: shiftid
          },
          dataType: 'json',
          success: function() {

          }
        });

        alert("request sent");

      });
    });

    $(function() {
      $(document).on("click", '#openshiftaccept', function() {
        var openshiftid = $(this).val();
        var getvalue;
        var date;

        var t = $('#tabletest');
        var e = 0;
        var s = 0;
        $.ajax({
          url: '<?php echo base_url(); ?>index.php/Schedule/openshiftaccept',
          method: 'post',
          data: {
            openshiftID: openshiftid
          },
          dataType: 'json',
          success: function(response) {
            for (var i = 0; i < response.length; i++) {

              var Html = "<tr><td>" + response[i].name + "</td><td>" + response[i].timeofday + "</td><td>" + response[i].startdatetime + "/" + response[i].enddatetime + "</td><td><button type='submit' class='like' id='request' value=" + response[i].scheduleID + ">Request Shift Off</button></td></tr>";
              $('#tbody').append(Html);


              
             
              var namearray = response[i].name;
             
              while (getvalue != namearray) {
                getvalue = $(t[0].rows[e].cells[0]).text();
                e++;
              }

              
              
              while (date != response[i].timeofday) {
                date = $(t[0].rows[0].cells[s]).text();
                s++;
              }

            
               var val1 = $(t[0].rows[e-1].cells[s-1]).html(response[i].startdatetime + "/" + response[i].enddatetime);  
               var val2 = $(t[0].rows[e-1].cells[s-1]).text();  
            }


          }

        });

        $(this).closest('tr').remove();

      });
    });



  });
</script>