<h1><?= $weekID ?></h1>

<h2>Set up Schedule</h2>

<h1><b>Week Start Date:</b> <?= $weekinfo[0]['startdate'] ?> <b>Week End Date:</b> <?= $weekinfo[0]['enddate'] ?></h1>
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



<h2>Filter by name</h2>

<select name="member" id="sel_user">
  <option value="default">default</option>
  <?php foreach ($member as $row) { ?>
    <option value=<?= $row['memberID'] ?>><?= $row['name'] ?></option>
  <?php } ?>
</select>
<!--
<h2>Filter by days Available</h2>

<select name="member" id="fil_day">
  <option value="1">Sunday</option>
  <option value="2">Monday</option>
  <option value="3">Tuesday</option>
  <option value="4">Wednesday</option>
  <option value="5">Thursday</option>
  <option value="6">Friday</option>
  <option value="7">Saturday</option>
</select>
-->

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
   
  <?php } ?>

  </tbody>





</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type='text/javascript'>
  $(document).ready(function() {

    $('#modifytimefield').hide();
    $(function() {
      $("input[name=yes_no]").on("change", function() {


        if (document.querySelector('input[name=yes_no]:checked').value == "yes") {
          $('#modifytimefield').show();

        } else {
          $('#modifytimefield').hide();

        }

      });
    });
    $('#sel_user').change(function(){
    var username = $(this).val();
    $.ajax({
     url:'<?php echo base_url(); ?>index.php/Setupschedule/filtername',
     method: 'post',
     data: {memberID: username,
            weekID: <?= $weekID ?>
          },
     dataType: 'json',
     success: function(response){
      $("#tbody").empty(); 
      
      
       for(var i=0;i<response.length;i++)
           {
           
            var sun;
            if(response[i].days == null){
              sun = "OFF";
            }else{
              if(response[i].mdays == ""){
                sun = response[i].days;
              }else{
                sun = response[i].days+'<br/><b class="red"> (Changed to '+response[i].mdays+')</b>'
              
              }
            }

            var mon;
            if(response[i].days1 == null){
              mon = "OFF";
            }else{
              if(response[i].mdays1 == ""){
                mon = response[i].days1;
              }else{
                mon = response[i].days1+'<br/><b class="red"> (Changed to '+response[i].mdays1+')</b>'
              
              }
            }

            var tue;
            if(response[i].days2 == null){
              tue = "OFF";
            }else{
              if(response[i].mdays2 == ""){
                tue = response[i].days2;
              }else{
                tue = response[i].days2+'<br/><b class="red"> (Changed to '+response[i].mdays2+')</b>'
              
              }
            }

            var wed;
            if(response[i].days3 == null){
              wed = "OFF";
            }else{
              if(response[i].mdays3 == ""){
                wed = response[i].days3;
              }else{
              wed = response[i].days3+'<br/><b class="red"> (Changed to '+response[i].mdays3+')</b>'
              
              }
            }

            var thu;
            if(response[i].days4 == null){
              thu = "OFF";
            }else{
              if(response[i].mdays4 == ""){
                thu = response[i].days4;
              }else{
                thu = response[i].days4+'<br/><b class="red"> (Changed to '+response[i].mdays4+')</b>'
              
              }
            }

            var fri;
            if(response[i].days5 == null){
              fri = "OFF";
            }else{
              if(response[i].mdays5 == ""){
                fri = response[i].days5;
              }else{
                fri = response[i].days5+'<br/><b class="red"> (Changed to '+response[i].mdays5+')</b>'
              
              }
            }

            var sat;
            if(response[i].days6 == null){
              sat = "OFF";
            }else{
              if(response[i].mdays6 == ""){
                sat = response[i].days6;
              }else{
                sat = response[i].days6+'<br/><b class="red"> (Changed to '+response[i].mdays6+')</b>'
              
              }
            }
          

             var Html="<tr><td>"+response[i].name+"</td><td>"+sun+"</td><td>"+mon+"</td><td>"+tue+"</td><td>"+wed+"</td><td>"+thu+"</td><td>"+fri+"</td><td>"+sat+"</td></tr>";
            $('#tbody').append(Html);

           }
     }
   });
  });

  $('#fil_day').change(function(){
    var date = $(this).val();
    $.ajax({
     url:'<?php echo base_url(); ?>index.php/Setupschedule/filterdate',
     method: 'post',
     data: {date: date,
            weekID: <?= $weekID ?>
          },
     dataType: 'json',
     success: function(response){
      $("#tbody").empty(); 
      
      
       for(var i=0;i<response.length;i++)
           {
           
            var sun;
            if(response[i].days == null){
              sun = "OFF";
            }else{
              if(response[i].mdays == ""){
                sun = response[i].days;
              }else{
                sun = response[i].days+'<br/><b class="red"> (Changed to '+response[i].mdays+')</b>'
              
              }
            }

            var mon;
            if(response[i].days1 == null){
              mon = "OFF";
            }else{
              if(response[i].mdays1 == ""){
                mon = response[i].days1;
              }else{
                mon = response[i].days1+'<br/><b class="red"> (Changed to '+response[i].mdays1+')</b>'
              
              }
            }

            var tue;
            if(response[i].days2 == null){
              tue = "OFF";
            }else{
              if(response[i].mdays2 == ""){
                tue = response[i].days2;
              }else{
                tue = response[i].days2+'<br/><b class="red"> (Changed to '+response[i].mdays2+')</b>'
              
              }
            }

            var wed;
            if(response[i].days3 == null){
              wed = "OFF";
            }else{
              if(response[i].mdays3 == ""){
                wed = response[i].days3;
              }else{
              wed = response[i].days3+'<br/><b class="red"> (Changed to '+response[i].mdays3+')</b>'
              
              }
            }

            var thu;
            if(response[i].days4 == null){
              thu = "OFF";
            }else{
              if(response[i].mdays4 == ""){
                thu = response[i].days4;
              }else{
                thu = response[i].days4+'<br/><b class="red"> (Changed to '+response[i].mdays4+')</b>'
              
              }
            }

            var fri;
            if(response[i].days5 == null){
              fri = "OFF";
            }else{
              if(response[i].mdays5 == ""){
                fri = response[i].days5;
              }else{
                fri = response[i].days5+'<br/><b class="red"> (Changed to '+response[i].mdays5+')</b>'
              
              }
            }

            var sat;
            if(response[i].days6 == null){
              sat = "OFF";
            }else{
              if(response[i].mdays6 == ""){
                sat = response[i].days6;
              }else{
                sat = response[i].days6+'<br/><b class="red"> (Changed to '+response[i].mdays6+')</b>'
              
              }
            }
          

             var Html="<tr><td>"+response[i].name+"</td><td>"+sun+"</td><td>"+mon+"</td><td>"+tue+"</td><td>"+wed+"</td><td>"+thu+"</td><td>"+fri+"</td><td>"+sat+"</td></tr>";
            $('#tbody').append(Html);

           }
     }
   });
  });
  
    $(function() {
      $(document).on("click", '#addschedule', function() {

        var modifytime;
        if (document.querySelector('input[name=yes_no]:checked').value == "yes") {
          
          modifytime= $("#start").val() + $("#startampm").val() +"-"+ $("#end").val() + $("#endampm").val();
        } else {
          modifytime = "";

        }

        
        var formData = {
          member: $("#member").val(),
          day: $("#date").val(),
          time: $("#time").val(),
          weekID: <?= $weekID ?>,
          modtime: modifytime
        };

        
        var getvalue;
        var t = $('#employeeshift');
        var e = 0;
        var s = 0;


        $.ajax({
          url: '<?php echo base_url(); ?>index.php/Setupschedule/addshift',
          method: 'post',
          data: formData,
          dataType: 'json',
          success: function(response) {





            var namearray = response[0].name;

            while (getvalue != namearray) {
              getvalue = $(t[0].rows[e].cells[0]).text();
              e++;
            }
            var dateresult;
            if (response[0].timeofday == 1) {
              dateresult = "Sunday";
            } else if (response[0].timeofday == 2) {
              dateresult = "Monday";
            } else if (response[0].timeofday == 3) {
              dateresult = "Tuesday";
            } else if (response[0].timeofday == 4) {
              dateresult = "Wednesday";
            } else if (response[0].timeofday == 5) {
              dateresult = "Thursday";
            } else if (response[0].timeofday == 6) {
              dateresult = "Friday";
            } else {
              dateresult = "Saturday";
            }

            var date;
            while (date != dateresult) {
              date = $(t[0].rows[0].cells[s]).text();
              s++;
            }

            var value;
            if(response[0].modtime != "")
            {
              html = response[0].shifttime +'<br/><b class="red">(Changed to' +response[0].modtime +')<b/>';
            }else{
              html = response[0].shifttime ;
            }
            //var Html = 
            $(t[0].rows[e - 1].cells[s - 1]).html(html);
            $(t[0].rows[e - 1].cells[s - 1]).text();




          }
        });

        event.preventDefault();
      });
    });

  });
</script>