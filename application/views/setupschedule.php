<h2>Set up Schedule</h2>




<form form method="POST" id="newweek" action="<?php echo base_url(); ?>index.php/Setupschedule/addnewweek">
  <div class="newweekbtnborder">

    <p class="datepicker">Start Date: <input type="text" name="startdatepicker" id="startdatepicker" required></p>
    <p class="datepicker">End Date: <input type="text" name="Enddatepicker" id="Enddatepicker" required></p>

    <?php if (!$checkscheduleweek) { ?>
      <button class="btn btn-success newweekbtn">
        ADD NEW WEEK
      </button>
    <?php } else { ?>
      <button class="btn btn-success newweekbtn" id="alertchoice">
        ADD NEW WEEK
      </button>
    <?php } ?>



  </div>
</form>


<form form method="POST" id="oldweek" action="<?php echo base_url(); ?>index.php/Setupschedule/uselastweek">
  <input type="hidden" name="startdatepicker1" id="startdatepicker1">
  <input type="hidden" name="Enddatepicker1" id="Enddatepicker1">
</form>

<div class="reportbox">
  <?php foreach ($loadweeks as $row) { ?>
    <div class="report">

      <div class="solid">

        <a id="reportboxinfo" href=" <?= base_url() ?>index.php?/Setupschedule/moreinfo/<?= $row['weekID'] ?>">
          <div>
            <p class="reporttitle">Week start Date: <?= $row['startdate'] ?></p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p class="reporttitle">Week End Date: <?= $row['enddate'] ?></p>
          </div>
        </a>

      </div>

    </div>
  <?php } ?>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">


<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script>
  $(document).ready(function() {

    /**
     *allow input to be datepicker 
     */
    $(function() {
      $("#startdatepicker").datepicker();
      $("#Enddatepicker").datepicker();
    });

    /**
     *after dat is submitted show popup to use previous schedule week or error message if date have not been selected 
     */
    $("#alertchoice").click(function(event) {

      //check if data value are empty
      if ($('#startdatepicker').val() == "" && ($('#Enddatepicker').val() == "")) {
        //pop up to say fill form
        $('#fillform').modal('show');
      } else {
        //pop up to ask to use previous schedule week
        $('#Modalalert').modal('show');
      }
      event.preventDefault();

    });

    /**
     *no button to not use scheduler previous week on pop up 
     */
    $('.submitdate').on('click', function() {

      $("#newweek").submit();
    });

    /**
     *yes button on pop to use previous week schedule 
     */
    $('.submitolddate').on('click', function() {
      var start = $("#startdatepicker").val();
      var end = $("#Enddatepicker").val();
      $("#startdatepicker1").val(start);
      $("#Enddatepicker1").val(end);
      var start1 = $("#startdatepicker1").val();
      var end1 = $("#Enddatepicker1").val();


      $("#oldweek").submit();
    });
  });
</script>


<div class="modal fade" id="Modalalert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-body">
        Use previous week Scheduler?

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success submitolddate">Yes</button>

        <button type="submit" class="btn btn-danger submitdate">No</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="fillform" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-body">
        Fill out Form

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>