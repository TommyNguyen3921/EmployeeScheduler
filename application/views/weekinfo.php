<h2>Set up Schedule</h2>

<h1 class=" weekdays"><b>Week Start Date:</b> <?= $weekinfo[0]['startdate'] ?> <b>Week End Date:</b> <?= $weekinfo[0]['enddate'] ?></h1>
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


<h1>Search</h1>
<input class="sticky-top" id="myInput" type="text" placeholder="Search..">


<table class="table table-striped" id="employeeshift">

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



    <?php foreach ($tableinfo as $row) { ?>
      <tr>


        <td><?= $row['name'] ?></td>

        <?php if ($row['days']) { ?>
          <td><?= $row['days'] ?> <br /> <?php if ($row['mdays'] != "") { ?> <b class="red"> (Changed to <?= $row['mdays'] ?>)</b> <?php } ?></td>

        <?php } else { ?>
          <td>OFF</td>
        <?php } ?>

        <?php if ($row['days1']) { ?>
          <td><?= $row['days1'] ?> <br /> <?php if ($row['mdays1'] != "") { ?> <b class="red"> (Changed to <?= $row['mdays1'] ?>)</b> <?php } ?> </td>
        <?php } else { ?>
          <td>OFF</td>
        <?php } ?>

        <?php if ($row['days2']) { ?>
          <td><?= $row['days2'] ?> <br /> <?php if ($row['mdays2'] != "") { ?> <b class="red"> (Changed to <?= $row['mdays2'] ?>)</b> <?php } ?></td>
        <?php } else { ?>
          <td>OFF</td>
        <?php } ?>

        <?php if ($row['days3']) { ?>
          <td><?= $row['days3'] ?> <br /> <?php if ($row['mdays3'] != "") { ?> <b class="red"> (Changed to <?= $row['mdays3'] ?>)</b> <?php } ?></td>
        <?php } else { ?>
          <td>OFF</td>
        <?php } ?>

        <?php if ($row['days4']) { ?>
          <td><?= $row['days4'] ?> <br /> <?php if ($row['mdays4'] != "") { ?> <b class="red"> (Changed to <?= $row['mdays4'] ?>)</b> <?php } ?></td>
        <?php } else { ?>
          <td>OFF</td>
        <?php } ?>

        <?php if ($row['days5']) { ?>
          <td><?= $row['days5'] ?> <br /> <?php if ($row['mdays5'] != "") { ?> <b class="red"> (Changed to <?= $row['mdays5'] ?>)</b> <?php } ?></td>
        <?php } else { ?>
          <td>OFF</td>
        <?php } ?>

        <?php if ($row['days6']) { ?>
          <td><?= $row['days6'] ?> <br /> <?php if ($row['mdays6'] != "") { ?> <b class="red"> (Changed to <?= $row['mdays6'] ?>)</b> <?php } ?> </td>
        <?php } else { ?>
          <td>OFF</td>
        <?php } ?>






      </tr>

    <?php } ?>

  </tbody>





</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type='text/javascript'>
  $(document).ready(function() {

    /**
     *filter schedule employee table 
     */
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#tbody").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });


  });
</script>