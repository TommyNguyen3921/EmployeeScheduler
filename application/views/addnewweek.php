<h2>Add New week</h2>
<h1 class="datepicker">Week start Date: <?= $startdatepicker ?></h1>
<h1 class="datepicker">Week End Date: <?= $Enddatepicker ?></h1>


<div class="sticky-top">
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Scroll to week
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#Sunday">Sunday</a>
    <a class="dropdown-item" href="#Monday">Monday</a>
    <a class="dropdown-item" href="#Tuesday">Tuesday</a>
    <a class="dropdown-item" href="#Wednesday">Wednesday</a>
    <a class="dropdown-item" href="#Thursday">Thursday</a>
    <a class="dropdown-item" href="#Friday">Friday</a>
    <a class="dropdown-item" href="#Saturday">Saturday</a>
  </div>
</div>
<form id="formshift">

<div class="form-group">
    <label for="formGroupExampleInput2">Day</label>
    <select name="date" id="date">


      <option value="1">Sunday</option>
      <option value="2">Monday</option>
      <option value="3">Tuesday</option>
      <option value="4">Wednesday</option>
      <option value="5">Thursday</option>
      <option value="6">Friday</option>
      <option value="7">Saturday</option>

    </select>
  </div>

  <div class="form-group">
    <label for="formGroupExampleInput2">People on Shift</label>
    <select name="date" id="people">


      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
     

    </select>
  </div>


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

  
  <button type="submit" class="btn btn-lg btn-primary btn-block" id="add" value="add"> Add</button>

</form>
</div>
<h1>Sunday</h1>
<table class="table table-striped" id="Sunday">

  <tr>

    <th>Shift</th>
    <th>Start Time</th>
    <th>End Time</th>
    <th>people on shift</th>





  </tr>
  <tbody id="tbody">

</table>

<h1>Monday</h1>
<table class="table table-striped" id="Monday">

  <tr>

    <th>Shift</th>
    <th>Start Time</th>
    <th>End Time</th>
    <th>people on shift</th>





  </tr>
  <tbody id="tbody1">

</table>

<h1>Tuesday</h1>
<table class="table table-striped" id="Tuesday">

  <tr>

    <th>Shift</th>
    <th>Start Time</th>
    <th>End Time</th>
    <th>people on shift</th>





  </tr>
  <tbody id="tbody2">

</table>

<h1>Wednesday</h1>
<table class="table table-striped" id="Wednesday">

  <tr>

    <th>Shift</th>
    <th>Start Time</th>
    <th>End Time</th>
    <th>people on shift</th>





  </tr>
  <tbody id="tbody3">

</table>

<h1>Thursday</h1>
<table class="table table-striped" id="Thursday">

  <tr>

    <th>Shift</th>
    <th>Start Time</th>
    <th>End Time</th>
    <th>people on shift</th>





  </tr>
  <tbody id="tbody4">

</table>

<h1>Friday</h1>
<table class="table table-striped" id="Friday">

  <tr>

    <th>Shift</th>
    <th>Start Time</th>
    <th>End Time</th>
    <th>people on shift</th>





  </tr>
  <tbody id="tbody5">

</table>


<h1>Saturday</h1>
<table class="table table-striped" id="Saturday">

  <tr>

    <th>Shift</th>
    <th>Start Time</th>
    <th>End Time</th>
    <th>people on shift</th>





  </tr>
  <tbody id="tbody6">

</table>




<form >
<button type="submit" id="send"> Add</button>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type='text/javascript'>
 var startdate = "<?= $startdatepicker ?>";
  var enddate = "<?= $Enddatepicker ?>";
  let allitem = [];
  
  $(document).ready(function() {

    
    $("#add").click(function(event) {

      var createdshift = {};
      createdshift['start'] = $( "select#start" ).val();
      createdshift['startampm'] = $( "select#startampm" ).val();
      createdshift['end'] = $( "select#end" ).val();
      createdshift['endampm'] = $( "select#endampm" ).val();
      createdshift['date'] = $( "select#date" ).val();
      createdshift['people'] = $( "select#people" ).val();
      allitem.push(createdshift);

      var Html="<tr><td>"+$( "select#start" ).val()+$( "select#startampm" ).val()+"-"+ $( "select#end" ).val()+$( "select#endampm" ).val()+"</td><td>"+$( "select#start" ).val()+$( "select#startampm" ).val()+"</td><td>"+$( "select#end" ).val()+$( "select#endampm" ).val()+"</td><td>"+$( "select#people" ).val()+"</td></tr>";
      if($( "select#date" ).val()==1){
        $('#tbody').append(Html);
      }else if($( "select#date" ).val()==2){
        $('#tbody1').append(Html);
      }else if($( "select#date" ).val()==3){
        $('#tbody2').append(Html);
      }else if($( "select#date" ).val()==4){
        $('#tbody3').append(Html);
      }else if($( "select#date" ).val()==5){
        $('#tbody4').append(Html);
      }else if($( "select#date" ).val()==6){
        $('#tbody5').append(Html);
      }else{
        $('#tbody6').append(Html);
      }
            
      event.preventDefault();
    
    });

    $("#send").click(function(event) {
      event.preventDefault();
      $.ajax({
     url:'<?php echo base_url(); ?>index.php/Setupschedule/submitshift',
     method: 'post',
     data: {allitem: allitem,
      startdate: startdate,
      enddate: enddate},
     dataType: 'text', 
     success: function(){
        
      window.location="<?= base_url(); ?>index.php?/Setupschedule";
       
       }
   });
   
     
    });


  
  });
</script>