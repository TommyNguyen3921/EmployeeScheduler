<h2>Employee Stat</h2>

<h1 class="weekdays"><b>Week Start Date:</b> <?= $weekinfo[0]['startdate'] ?> <b>Week End Date:</b> <?= $weekinfo[0]['enddate'] ?></h1>

<h2>User Table</h2>


<table class="table table-dark">

    <tr>

        <th>Date</th>
        <th>Late to shift</th>
        <th>Pay</th>
        <th>Hours</th>


    </tr>


    <?php $totalpay = 0;
    $totalhours = 0; ?>

    <?php foreach ($statinfo as $row) { ?>
        <tr class="table-light">

            <?php if ($row['timeofday'] == 1) { ?>
                <td>Sunday</td>
            <?php } else if ($row['timeofday'] == 2) { ?>
                <td>Monday</td>
            <?php } else if ($row['timeofday'] == 3) { ?>
                <td>Tuesday</td>
            <?php } else if ($row['timeofday'] == 4) { ?>
                <td>Wednesday</td>
            <?php } else if ($row['timeofday'] == 5) { ?>
                <td>Thursday</td>
            <?php } else if ($row['timeofday'] == 6) { ?>
                <td>Friday</td>
            <?php } else { ?>
                <td>Saturday</td>
            <?php } ?>



            <td><?= $row['latetoshift'] ?></td>

            <?php $totalpay = $totalpay + $row['pay'] ?>
            <td>$<?= $row['pay'] ?></td>
            <?php $totalhours = $totalhours + $row['hours'] ?>
            <td><?= $row['hours'] ?></td>



        </tr>


    <?php } ?>
    <tr class="table-light">
        <td colspan='2'><b>Total Hours and Pay</b></td>
        <td>$<?php echo $totalpay ?></td>
        <td><?php echo $totalhours ?></td>
    </tr>



</table>