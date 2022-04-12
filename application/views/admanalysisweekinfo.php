<h2>Employee Stat</h2>

<h1 class="weekdays"><b>Week Start Date:</b> <?= $weekinfo[0]['startdate'] ?> <b>Week End Date:</b> <?= $weekinfo[0]['enddate'] ?></h1>
<p><b>Select user</b> </p>
<select class="js-example-basic-single" name="state" id="sel_user">
  <option value="default">Default</option>
  <?php foreach ($member as $row) { ?>

    <option value=<?= $row['memberID'] ?>><?= $row['name'] ?></option>

  <?php } ?>
</select>
<br />
<br />

<div id="edittable">
  <p><b>Edit Table</b> </p>
  <input type="radio" id="editvalue" name="editvalue" value="yes">
  <label for="age1">Yes</label><br>
  <input type="radio" class="editvalue1" name="editvalue" value="no" checked="checked">
  <label for="age2">No</label><br>
</div>

<h2>User Table</h2>

<p class="success" id="updatelabel">Successfully Updated</p>
<table class="table table-dark">

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
  //hide decision for the edit radio options
  $("#edittable").hide();

  //hide table to update values
  $("#updatelabel").hide();


  $(document).ready(function() {
    $('.js-example-basic-single').select2();
    var username;

    /**
     * get employe detail if selector changes
     */
    $('#sel_user').change(function() {
      //get username
      username = $(this).val();
      //set the edit radiob utton to no
      $("INPUT[name=editvalue]").val(['no']);

      //check if username is default
      if (username != "default") {

        //show editable radio button
        $("#edittable").show();

        //ajax to get selected employee stats
        $.ajax({
          url: '<?php echo base_url(); ?>index.php/Admanalysis/EmployeeDetails',
          method: 'post',
          data: {
            memberID: username,
            weekID: <?= $weekID ?>
          },
          dataType: 'json',
          success: function(response) {

            //empty table
            $("#tbody").empty();

            //display if employee does not have any stats for the week
            if (response == "") {
              var Html = "<td colspan='4'><b>No Shift For This Week</b></td>"
              $('#tbody').append(Html);

            } else {
              var totalpay = 0;
              var hours = 0;
              var day;

              //loop through each stat data and add tot able
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
                var Html = "<tr class='table-light'><td>" + day + "</td><td>" + response[i].latetoshift + "</td><td>$" + response[i].pay + "</td><td>" + response[i].hours + "</td></tr>";

                $('#tbody').append(Html);

              }
              var Html = "<tr class='table-light'><td colspan='2'><b>Total Hours and Pay</b></td><td >$" + totalpay + "</td><td>" + hours + "</td></tr>";


              $('#tbody').append(Html);

            }
          }
        });
        //if selector is default show nothing
      } else {
        $("#tbody").empty();
        $("#edittable").hide();

        $("INPUT[name=editvalue]").val(['no']);
      }
    });


    /***
     * if edit radio button changes
     */
    $('input:radio[name="editvalue"]').change(
      function() {


        //check if radio button is yes
        if ($(this).val() == "yes") {

          //get employee detail if the radio button is yes
          $.ajax({
            url: '<?php echo base_url(); ?>index.php/Admanalysis/EmployeeDetails',
            method: 'post',
            data: {
              memberID: username,
              weekID: <?= $weekID ?>
            },
            dataType: 'json',
            success: function(response) {

              //empty tbody
              $("#tbody").empty();

              //display no shift for the week if no data
              if (response == "") {
                var Html = "<td colspan='4'><b>No Shift For This Week</b></td>"
                $('#tbody').append(Html);

              } else {
                var totalpay = 0;
                var hours = 0;
                var day;

                //loop through all data for table
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

                  //display edit table values
                  var yesorno;
                  if (response[i].latetoshift == "no") {
                    yesorno = "<select><option value='yes'>yes</option><option selected='selected' value='no'>no</option></select>";
                  } else {
                    yesorno = "<select><option selected='selected' value='yes'>yes</option><option  value='no'>no</option></select>";
                  }


                  var Html = "<tr class='table-light'><td>" + day + "</td><td>" + yesorno + "</td><td>$<input type='text' id='fname' name='fname' value=" + response[i].pay + "></td><td><input type='text' id='fname' name='fname' value=" + response[i].hours + "> <button id='editchanges' value=" + response[i].scheduleinfoID + " type='button' class='btn btn-primary'>Submit Change</button </td></tr>";

                  $('#tbody').append(Html);

                }
                var Html = "<tr class='table-light'><td colspan='2'><b>Total Hours Pay</b></td><td >$" + totalpay + "</td><td>" + hours + "</td></tr>";


                $('#tbody').append(Html);


              }
            }
          });
          //if value is no show non editable table
        } else if ($(this).val() == "no") {
          //run ajax to get table values
          $.ajax({
            url: '<?php echo base_url(); ?>index.php/Admanalysis/EmployeeDetails',
            method: 'post',
            data: {
              memberID: username,
              weekID: <?= $weekID ?>
            },
            dataType: 'json',
            success: function(response) {

              //empty table
              $("#tbody").empty();

              //display if employee has no stat data for week
              if (response == "") {
                var Html = "<td colspan='4'><b>No Shift For This Week</b></td>"
                $('#tbody').append(Html);

              } else {
                var totalpay = 0;
                var hours = 0;
                var day;

                //loop table row data for employee
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
                  var Html = "<tr class='table-light'><td>" + day + "</td><td>" + response[i].latetoshift + "</td><td>$" + response[i].pay + "</td><td>" + response[i].hours + "</td></tr>";

                  $('#tbody').append(Html);

                }
                var Html = "<tr class='table-light'><td colspan='2'><b>Total Hours and Pay</b></td><td >$" + totalpay + "</td><td>" + hours + "</td></tr>";

                //add to table
                $('#tbody').append(Html);


              }
            }
          });
        }
      });

    /***
     * add edit change once user submits changes
     */
    $(document).on('click', '#editchanges', function(e) {
      e.preventDefault();

      let tr = $(this).closest('tr');
      //get input value to update employee stas
      let late = tr.find('td:eq(1) select').val();
      let pay = tr.find('td:eq(2) input').val();
      let hours = tr.find('td:eq(3) input').val();
      var scheduleID = $(this).val();

      //ajax to update employee stats
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

          //reset table
          $("#tbody").empty();

          //display if employee has no data
          if (response == "") {
            var Html = "<td colspan='4'><b>No Shift For This Week</b></td>"
            $('#tbody').append(Html);

          } else {
            var totalpay = 0;
            var hours = 0;
            var day;

            //loop through data to display to table
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

              var yesorno;
              if (response[i].latetoshift == "no") {
                yesorno = "<select><option value='yes'>yes</option><option selected='selected' value='no'>no</option></select>";
              } else {
                yesorno = "<select><option selected='selected' value='yes'>yes</option><option  value='no'>no</option></select>";
              }

              var Html = "<tr class='table-light'><td>" + day + "</td><td>" + yesorno + "</td><td>$<input type='text' id='fname' name='fname' value=" + response[i].pay + "></td><td><input type='text' id='fname' name='fname' value=" + response[i].hours + "> <button id='editchanges' value=" + response[i].scheduleinfoID + " type='button ' class='btn btn-primary'>Submit Change</button </td></tr>";
              $('#tbody').append(Html);

            }
            var Html = "<tr class='table-light'><td colspan='2'><b>Total Hours and Pay</b></td><td >$" + totalpay + "</td><td>" + hours + "</td></tr>";

            //add to table
            $('#tbody').append(Html);

            //show successfully updated
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