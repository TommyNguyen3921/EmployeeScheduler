<h1><?= $weekID ?></h1>

<h2>Employee Stat</h2>

<h1><b>Week Start Date:</b> <?= $weekinfo[0]['startdate'] ?> <b>Week End Date:</b> <?= $weekinfo[0]['enddate'] ?></h1>
<p>Select user</p>
<select class="js-example-basic-single" name="state" id="sel_user">
  <option value="default">Default</option>
  <?php foreach ($member as $row) { ?>

    <option value=<?= $row['memberID'] ?>><?= $row['name'] ?></option>

  <?php } ?>
</select>
<br />
<br />

<p>Edit Table</p>
<input type="radio" id="editvalue" name="editvalue" value="yes">
<label for="age1">Yes</label><br>
<input type="radio" id="editvalue" name="editvalue" value="no" checked="checked">
<label for="age2">No</label><br>


<h2>User Table</h2>

<p id="updatelabel">Successfully Updated</p>
<table class="table table-striped">

  <tr>

    <th>Day</th>

    <th>Late to shift</th>
    <th>Pay</th>
    <th>Hours</th>




  </tr>




  <tbody id="tbody">

  </tbody>

  <tbody id="tbody2">

  </tbody>



</table>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type='text/javascript'>
   $("#updatelabel").hide();
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
    var username

    $('#sel_user').change(function() {
      username = $(this).val();

      if (username != "default") {
        $.ajax({
          url: '<?php echo base_url(); ?>index.php/Admanalysis/EmployeeDetails',
          method: 'post',
          data: {
            memberID: username,
            weekID: <?= $weekID ?>
          },
          dataType: 'json',
          success: function(response) {


            $("#tbody").empty();


            if (response == "") {
              var Html = "<td colspan='4'><b>No Shift For This Week</b></td>"
              $('#tbody').append(Html);

            } else {
              var totalpay = 0;
              var hours = 0;
              var day;


              for (var i = 0; i < response.length; i++) {

                if (response[i].timeofday == 1) {
                  day = "Sunday";
                } else if (response[i].timeofday == 2) {
                  day = "Monday";
                } else if (response[i].timeofday == 3) {
                  day = "Tuesday";
                } else if (response[i].timeofday == 4) {
                  day = "Wednesday";
                } else if (response[i].timeofday == 5) {
                  day = "Thursday";
                } else if (response[i].timeofday == 6) {
                  day = "Friday";
                } else {
                  day = "Saturday";
                }
                totalpay = totalpay + parseFloat(response[i].pay);
                hours = hours + parseFloat(response[i].hours);
                var Html = "<tr><td>" + day + "</td><td>" + response[i].latetoshift + "</td><td>$" + response[i].pay + "</td><td>" + response[i].hours + "</td></tr>";

                $('#tbody').append(Html);

              }
              var Html = "<tr><td colspan='2'><b>Total Hours and Pay</b></td><td >$" + totalpay + "</td><td>" + hours + "</td></tr>";


              $('#tbody').append(Html);


            }
          }
        });
      } else {
        $("#tbody").empty();
      }
    });

    $('input:radio[name="editvalue"]').change(
      function() {



        if ($(this).val() == "yes") {

          $.ajax({
            url: '<?php echo base_url(); ?>index.php/Admanalysis/EmployeeDetails',
            method: 'post',
            data: {
              memberID: username,
              weekID: <?= $weekID ?>
            },
            dataType: 'json',
            success: function(response) {


              $("#tbody").empty();


              if (response == "") {
                var Html = "<td colspan='4'><b>No Shift For This Week</b></td>"
                $('#tbody').append(Html);

              } else {
                var totalpay = 0;
                var hours = 0;
                var day;


                for (var i = 0; i < response.length; i++) {

                  if (response[i].timeofday == 1) {
                    day = "Sunday";
                  } else if (response[i].timeofday == 2) {
                    day = "Monday";
                  } else if (response[i].timeofday == 3) {
                    day = "Tuesday";
                  } else if (response[i].timeofday == 4) {
                    day = "Wednesday";
                  } else if (response[i].timeofday == 5) {
                    day = "Thursday";
                  } else if (response[i].timeofday == 6) {
                    day = "Friday";
                  } else {
                    day = "Saturday";
                  }
                  totalpay = totalpay + parseFloat(response[i].pay);
                  hours = hours + parseFloat(response[i].hours);
                  var Html = "<tr><td>" + day + "</td><td><input type='text' id='fname' name='fname' value=" + response[i].latetoshift + "></td><td>$<input type='text' id='fname' name='fname' value=" + response[i].pay + "></td><td><input type='text' id='fname' name='fname' value=" + response[i].hours + "> <button id='editchanges' value=" + response[i].scheduleinfoID + " type='button'>Submit Change</button </td></tr>";

                  $('#tbody').append(Html);

                }
                var Html = "<tr><td colspan='2'><b>Total Hours Pay</b></td><td >$" + totalpay + "</td><td>" + hours + "</td></tr>";


                $('#tbody').append(Html);


              }
            }
          });
        } else if ($(this).val() == "no") {
          $.ajax({
            url: '<?php echo base_url(); ?>index.php/Admanalysis/EmployeeDetails',
            method: 'post',
            data: {
              memberID: username,
              weekID: <?= $weekID ?>
            },
            dataType: 'json',
            success: function(response) {


              $("#tbody").empty();


              if (response == "") {
                var Html = "<td colspan='4'><b>No Shift For This Week</b></td>"
                $('#tbody').append(Html);

              } else {
                var totalpay = 0;
                var hours = 0;
                var day;


                for (var i = 0; i < response.length; i++) {

                  if (response[i].timeofday == 1) {
                    day = "Sunday";
                  } else if (response[i].timeofday == 2) {
                    day = "Monday";
                  } else if (response[i].timeofday == 3) {
                    day = "Tuesday";
                  } else if (response[i].timeofday == 4) {
                    day = "Wednesday";
                  } else if (response[i].timeofday == 5) {
                    day = "Thursday";
                  } else if (response[i].timeofday == 6) {
                    day = "Friday";
                  } else {
                    day = "Saturday";
                  }
                  totalpay = totalpay + parseFloat(response[i].pay);
                  hours = hours + parseFloat(response[i].hours);
                  var Html = "<tr><td>" + day + "</td><td>" + response[i].latetoshift + "</td><td>$" + response[i].pay + "</td><td>" + response[i].hours + "</td></tr>";

                  $('#tbody').append(Html);

                }
                var Html = "<tr><td colspan='2'><b>Total Hours and Pay</b></td><td >$" + totalpay + "</td><td>" + hours + "</td></tr>";


                $('#tbody').append(Html);


              }
            }
          });
        }
      });


    $(document).on('click', '#editchanges', function(e) {
      e.preventDefault();
      let tr = $(this).closest('tr');
      let late = tr.find('td:eq(1) input').val();
      let pay = tr.find('td:eq(2) input').val();
      let hours = tr.find('td:eq(3) input').val();
      var scheduleID = $(this).val();


      $.ajax({
        url: '<?php echo base_url(); ?>index.php/Admanalysis/UpdateEmployeeDetails',
        method: 'post',
        data: {
          memberID: username,
          weekID: <?= $weekID ?>,
          Late: late,
          Pay: pay,
          Hours: hours,
          ScheduleinfoID: scheduleID

        },
        dataType: 'json',
        success: function(response) {


          $("#tbody").empty();


          if (response == "") {
            var Html = "<td colspan='4'><b>No Shift For This Week</b></td>"
            $('#tbody').append(Html);

          } else {
            var totalpay = 0;
            var hours = 0;
            var day;


            for (var i = 0; i < response.length; i++) {

              if (response[i].timeofday == 1) {
                day = "Sunday";
              } else if (response[i].timeofday == 2) {
                day = "Monday";
              } else if (response[i].timeofday == 3) {
                day = "Tuesday";
              } else if (response[i].timeofday == 4) {
                day = "Wednesday";
              } else if (response[i].timeofday == 5) {
                day = "Thursday";
              } else if (response[i].timeofday == 6) {
                day = "Friday";
              } else {
                day = "Saturday";
              }
              totalpay = totalpay + parseFloat(response[i].pay);
              hours = hours + parseFloat(response[i].hours);
              var Html = "<tr><td>" + day + "</td><td><input type='text' id='fname' name='fname' value=" + response[i].latetoshift + "></td><td>$<input type='text' id='fname' name='fname' value=" + response[i].pay + "></td><td><input type='text' id='fname' name='fname' value=" + response[i].hours + "> <button id='editchanges' value=" + response[i].scheduleinfoID + " type='button'>Submit Change</button </td></tr>";

              $('#tbody').append(Html);

            }
            var Html = "<tr><td colspan='2'><b>Total Hours and Pay</b></td><td >$" + totalpay + "</td><td>" + hours + "</td></tr>";


            $('#tbody').append(Html);
            $("#updatelabel").show();
            setInterval(function() {
              $("#updatelabel").hide();
            
            }, 2000);

          }
        }
      });

    });

  });
</script>