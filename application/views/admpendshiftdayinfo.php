



<?php if ($day == 1) { ?>
    <h1>Sunday</h1>
<?php } else if ($day == 2) { ?>
    <h1>Monday</h1>
<?php } else if ($day == 3) { ?>
    <h1>Tuesday</h1>
<?php } else if ($day == 4) { ?>
    <h1>Wednesday</h1>
<?php } else if ($day == 5) { ?>
    <h1>Thursday</h1>
<?php } else if ($day == 6) { ?>
    <h1>Friday</h1>
<?php } else { ?>
    <h1>Saturday</h1>
<?php } ?>



<h1><b>Week Start Date:</b> <?= $weekinfo[0]['startdate'] ?> <b>Week End Date:</b> <?= $weekinfo[0]['enddate'] ?></h1>

<div class=" bg-secondary sticky-top">
    <div class="row ">
        <div class="col-md-4 ">
            <h1>Available Employees</h1>

            <input id="Inputshiftslot" type="text" placeholder="Search..">
            <table id="shiftvalue" >

<th>Shift</th>
<th>Shift Filled</th>


<tbody id="shiftfilter">

    <?php foreach ($loadshiftslot as $row) { ?>
        <tr <?php if($row['amtpeople']-$row['count']> 0) { ?>class="notfullshift"<?php }else{ ?>class="fullshift" <?php } ?>>
            <td><?= $row['start'] ?><?= $row['startampm'] ?>-<?= $row['end'] ?><?= $row['endampm'] ?></td>
            <td><?= ($row['count'])  ?>/<?= ($row['amtpeople'])  ?></td>
            
        </tr>
    <?php } ?>

    </tbody> 
</table>
        </div>


    </div>

    <div class="row ">
        <div class="col-md-6 ">

            <table class="table table-striped">

                <tr>

                    <th colspan="4">Pending Shift Off</th>




                </tr>

                <?php foreach ($pending as $row) { ?>
                    <tr>

                        <td><?= $row['name'] ?></td>
                        <td><?= $row['shifttime'] ?></td>



                        <td> <a type="button" class="btn btn-primary" href="<?= base_url() ?>index.php?/Admpendshift/pendaccept/<?= $row['pendingID']?>/<?= $day ?>/<?= $weekID ?>">Approved</a><button class="btn btn-danger" type='submit' class='like' id='decline' value=<?= $row['pendingID'] ?>>Decline</button></td>

                    </tr>
                <?php } ?>
            </table>

        </div>
        <div class="col-md-6">
            <table class="table table-striped">

                <tr>

                    <th colspan="5">Available shift</th>




                </tr>



                <?php foreach ($open as $row) { ?>
                    <tr>


                        <td><?= $row['start'] ?><?= $row['startampm'] ?>-<?= $row['end'] ?><?= $row['endampm'] ?> </td>
                      
                        <td><button class="btn btn-danger" type='submit' class='like' id='delete' value=<?= $row['openshiftID'] ?>>X</button></td>



                    </tr>
                <?php } ?>

                <tbody id="tbody">

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
                <a class="dropdown-item" href='#table<?= $row['start'] ?><?= $row['startampm'] ?>-<?= $row['end'] ?><?= $row['startampm'] ?>'><?= $row['start'] ?><?= $row['endampm'] ?>-<?= $row['end'] ?><?= $row['startampm'] ?></a>

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


                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type='text/javascript'>
    $(document).ready(function() {

        $(function() {
            $(document).on("click", '#decline', function() {
                var pendid = $(this).val();
                $.ajax({
                    url: '<?php echo base_url(); ?>index.php/Admpendshift/penddecline',
                    method: 'post',
                    data: {
                        pendID: pendid
                    },
                    dataType: 'json',
                    success: function(response) {



                    }
                });
                $(this).closest('tr').remove();


            });
        });

        $(function() {
    $(document).on("click", '#delete', function() {
      var openshiftid = $(this).val();
    
      $.ajax({
     url:'<?php echo base_url(); ?>index.php/Admpendshift/deleteopenshift',
     method: 'post',
     data: {openshiftID: openshiftid},
     dataType: 'json',
     success: function(response){
        
        
     
     }
   });
   $(this).closest('tr').remove();
    });
});


//filter shift slot
$("#Inputshiftslot").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#shiftfilter tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });


    });
</script>

