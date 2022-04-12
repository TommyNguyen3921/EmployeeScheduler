<h2>Set up Schedule</h2>


<?php if ($day == 1) { ?>
    <h1><b>Sunday</b> </h1>
<?php } else if ($day == 2) { ?>
    <h1><b>Monday</b></h1>
<?php } else if ($day == 3) { ?>
    <h1><b>Tuesday</b></h1>
<?php } else if ($day == 4) { ?>
    <h1><b>Wednesday</b></h1>
<?php } else if ($day == 5) { ?>
    <h1><b>Thursday</b></h1>
<?php } else if ($day == 6) { ?>
    <h1><b>Friday</b></h1>
<?php } else { ?>
    <h1><b>Saturday</b></h1>
<?php } ?>



<h1 class="weekdays"><b>Week Start Date:</b> <?= $weekdate[0]['startdate'] ?> <b>Week End Date:</b> <?= $weekdate[0]['enddate'] ?></h1>
<ul class="nav navbar-light bg-light justify-content-center">
    <li class="nav-item">
        <a class="nav-link " href=" <?= base_url() ?>index.php?/Setupschedule/moreinfo/<?= $weekID ?>">default</a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href=" <?= base_url() ?>index.php?/Setupschedule/dayinfo/<?= $weekID ?>/1">Sunday</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href=" <?= base_url() ?>index.php?/Setupschedule/dayinfo/<?= $weekID ?>/2">Monday</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href=" <?= base_url() ?>index.php?/Setupschedule/dayinfo/<?= $weekID ?>/3">Tuesday</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href=" <?= base_url() ?>index.php?/Setupschedule/dayinfo/<?= $weekID ?>/4">Wednesday</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href=" <?= base_url() ?>index.php?/Setupschedule/dayinfo/<?= $weekID ?>/5">Thursday</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href=" <?= base_url() ?>index.php?/Setupschedule/dayinfo/<?= $weekID ?>/6">Friday</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href=" <?= base_url() ?>index.php?/Setupschedule/dayinfo/<?= $weekID ?>/7">Saturday</a>
    </li>
</ul>

<div class=" bg-secondary sticky-top">
    <h1><b>Schedule Employee into Shift</b> </h1>
    <div class="row " id="divborder">

        <div class="col-md-4 ">
            <div id="sizescheduler" class="overflow-auto">
                <h1>Available Employees</h1>
                <input id="myInput" type="text" placeholder="Search..">
                <table class="tablefilter " id="table">



                    <?php foreach ($load as $row) { ?>
                        <tr>



                            <td><?= $row['name'] ?></td>
                            <td style="visibility:hidden" class="divOne"><?= $row['memberID'] ?></td>




                        </tr>
                    <?php } ?>


                </table>
            </div>
        </div>
        <div class="col-md-4 ">
            <h1>Shifts</h1>
            <input id="Inputshift" type="text" placeholder="Search..">
            <table class="tablefilter" id="tableshift">



                <?php foreach ($weekinfo as $row) { ?>
                    <tr>
                        <td><?= $row['start'] ?><?= $row['startampm'] ?>-<?= $row['end'] ?><?= $row['endampm'] ?></td>
                        <td style="visibility:hidden" class="divOne"><?= $row['builtshiftID'] ?></td>
                    </tr>
                <?php } ?>


            </table>

        </div>
        <div class="col-md-4">
            <div id="wrapper">
                <h1>Modify time?</h1>
                <p>
                    <input type="radio" name="yes_no" value="yes">Yes</input>
                </p>
                <p>
                    <input type="radio" name="yes_no" value="no" checked>No</input>
                </p>
            </div>


            <div class="form-group" id="modifytimefield">
                <div class="form-group datepicker">
                    <label for="formGroupExampleInput2">Starting time</label>
                    <select name="start" id="start">


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

                <div class="form-group datepicker">

                    <select name="startampm" id="startampm">


                        <option value="am">am</option>
                        <option value="pm">pm</option>


                    </select>
                </div>

                <div class="form-group datepicker">
                    <label for="formGroupExampleInput2">End time</label>
                    <select name="end" id="end">


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

                <div class="form-group datepicker">

                    <select name="endampm" id="endampm">



                        <option value="am">am</option>
                        <option value="pm">pm</option>


                    </select>
                </div>
            </div>
            <input type="button" id="shiftaddbutton" name="OK" class="btn btn-lg btn-primary btn-block" value="Add To Shift" />


        </div>
    </div>
    <h1><b>Shift Stat</b> </h1>
    <div class="row " id="divborder">
        <div class="col-md-6 ">
            <h1>Schedule Employee</h1>
            <input id="Inputscheduleemployee" type="text" placeholder="Search..">
            <table class="tableemployeefilled">

                <th>Employee</th>
                <th>Schedule</th>
                <th>Modified Time</th>
                <th>Remove</th>

                <tbody id="employeefill">

                    <?php foreach ($loadscheduleemployee as $row) { ?>
                        <tr>
                            <td><?= $row['name']  ?></td>
                            <td><?= $row['shifttime']  ?></td>
                            <td><?= $row['modtime']  ?></td>
                            <td><a class="btn btn-danger" href="<?= base_url() ?>index.php?/Setupschedule/deleteshift/<?= $row['scheduleinfoID']  ?>/<?= $weekID  ?>/<?= $day  ?>">X</a></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>

        </div>
        <div class="col-md-6">
            <h1>Shift slot</h1>
            <input id="Inputshiftslot" type="text" placeholder="Search..">
            <table id="shiftvalue">

                <th>Shift</th>
                <th>Slots Available</th>


                <tbody id="shiftfilter">

                    <?php foreach ($loadshiftslot as $row) { ?>
                        <tr <?php if ($row['amtpeople'] - $row['count'] > 0) { ?>class="notfullshift" <?php } else { ?>class="fullshift" <?php } ?>>
                            <td><?= $row['start'] ?><?= $row['startampm'] ?>-<?= $row['end'] ?><?= $row['endampm'] ?></td>
                            <td><?= ($row['amtpeople'] - $row['count'])  ?></td>

                        </tr>
                    <?php } ?>

                </tbody>
            </table>

        </div>
    </div>
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Scroll to section
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <?php foreach ($shiftstables as $row) { ?>
                <a class="dropdown-item" href='#table<?= $row['start'] ?><?= $row['startampm'] ?>-<?= $row['end'] ?><?= $row['endampm'] ?>'><?= $row['start'] ?><?= $row['startampm'] ?>-<?= $row['end'] ?><?= $row['endampm'] ?></a>

            <?php } ?>
        </div>
    </div>

</div>

<?php foreach ($shiftstables as $row) { ?>
    <h1 class="titlecenter"><?= $row['start'] ?><?= $row['startampm'] ?>-<?= $row['end'] ?><?= $row['endampm'] ?></h1>
    <table class="table table-striped" id='table<?= $row['start'] ?><?= $row['startampm'] ?>-<?= $row['end'] ?><?= $row['endampm'] ?>'>
        <thead>
            <tr>
                <th>Employee</th>
                <th>modify time</th>
                <th>Remove</th>
            </tr>
        </thead>


        <tbody id=<?= $row['start'] ?><?= $row['startampm'] ?>-<?= $row['end'] ?><?= $row['endampm'] ?>>
            <?php $value = $row['name'];
            $modtime = $row['gmodtime'];
            $gscheduleinfoID = $row['gscheduleinfoID'];
            $modtimes = explode(",", $modtime);
            $values = explode(",", $value);
            $gscheduleinfoIDs = explode(",", $gscheduleinfoID);
            for ($i = 0; $i < count($values); $i++) { ?>
                <tr>
                    <td><?= $values[$i] ?></td>
                    <td><?= $modtimes[$i] ?></td>
                    <td><?php if ($gscheduleinfoIDs[$i] != "") { ?>
                            <a class="btn btn-danger" href="<?= base_url() ?>index.php?/Setupschedule/deleteshift/<?= $gscheduleinfoIDs[$i]  ?>/<?= $weekID  ?>/<?= $day  ?>">X</a><?php } ?>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type='text/javascript'>
    $(document).ready(function() {

        var employee;
        var shift;
        var shiftid;
        //hide and show the modify time option
        $('#modifytimefield').hide();

        /**
         *show our hide selectore if the manager wants to modify the time 
         */
        $(function() {
            $("input[name=yes_no]").on("change", function() {


                if (document.querySelector('input[name=yes_no]:checked').value == "yes") {
                    $('#modifytimefield').show();

                } else {
                    $('#modifytimefield').hide();

                }

            });
        });

        /**
         * allow the employee table to be selectable
         */
        $("#table tr").click(function() {
            $(this).addClass('selected').siblings().removeClass('selected');

            employee = $(this).find('td:nth-child(2)').html();


        });

        /**
         * allow shift table to be selectable
         */
        $("#tableshift tr").click(function() {
            $(this).addClass('selected').siblings().removeClass('selected');
            shift = $(this).find('td:first').html();
            shiftid = $(this).find('td:nth-child(2)').html();

        });


        /**
         *button to submit shift after employee and shift has been selected 
         */
        $('#shiftaddbutton').on('click', function(e) {
            var t = $('#shiftvalue');
            var date1;
            var resultdate;
            var v = 0;
            while (date1 != shift) {
                date1 = $(t[0].rows[v].cells[0]).text();
                v++;
            }

            resultdate = $(t[0].rows[v - 1].cells[1]).text();
            //check if shift is full
            if (resultdate == 0) {
                $('#Modalsent').modal('show')
            } else {


                //check if modify time is added    
                var modifytime;
                if (document.querySelector('input[name=yes_no]:checked').value == "yes") {

                    modifytime = $("#start").val() + $("#startampm").val() + "-" + $("#end").val() + $("#endampm").val();
                } else {
                    modifytime = "";

                }

                //data to send to ajax
                var formData = {
                    member: employee,
                    day: <?= $day ?>,
                    time: shift,
                    weekID: <?= $weekID ?>,
                    modtime: modifytime,
                    shiftID: shiftid
                };

                //ajax to add user to shift
                $.ajax({
                    url: '<?php echo base_url(); ?>index.php/Setupschedule/addshift',
                    method: 'post',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {

                        //remove highlighted selectselection from shift
                        $("#tableshift tr").removeClass('selected');
                        //remove selected emplyoee after added to table
                        $("#table .selected").remove();

                        //add employee to employee fill table
                        var Html = "<tr><td>" + response[0].name + "</td><td>" + response[0].shifttime + "</td><td>" + response[0].modtime + "</td><td><a class='btn btn-danger' href='<?= base_url() ?>index.php?/Setupschedule/deleteshift/" + response[0].scheduleinfoID + "/<?= $weekID  ?>/<?= $day  ?>'>X</a></td></tr>";
                        $('#employeefill').append(Html);

                        //add employee to 2nd table
                        var Html = "<tr><td>" + response[0].name + "</td><td>" + response[0].modtime + "</td><td><a class='btn btn-danger' href='<?= base_url() ?>index.php?/Setupschedule/deleteshift/" + response[0].scheduleinfoID + "/<?= $weekID  ?>/<?= $day  ?>'>X</a></td></tr>";
                        $('#' + response[0].shifttime).append(Html);

                        var date;
                        var s = 0;
                        while (date != shift) {
                            date = $(t[0].rows[s].cells[0]).text();
                            s++;
                        }

                        getvalue = $(t[0].rows[s - 1].cells[1]).text();
                        truevalue = parseInt(getvalue) - 1
                        $(t[0].rows[s - 1].cells[1]).html(truevalue);

                        //if shift slot is full change the color to green else its red
                        if (truevalue == 0) {
                            $(t[0].rows[s - 1].cells[0]).addClass("fullshift");
                            $(t[0].rows[s - 1].cells[1]).addClass("fullshift");
                        } else {
                            $(t[0].rows[s - 1].cells[1]).addClass("notfullshift");
                        }

                    }
                });
            }
        });

        /**
         *filter employees 
         */
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#table tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        /**
         *filter shifts
         */
        $("#Inputshift").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tableshift tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        /**
         *filter schedule employee
         */
        $("#Inputscheduleemployee").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#employeefill tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        /**
         *filter shift slots
         */
        $("#Inputshiftslot").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#shiftfilter tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

    });
</script>

<div class="modal fade" id="Modalsent" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                SHIFT IS FULL
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>