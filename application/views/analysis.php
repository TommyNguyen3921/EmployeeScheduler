<h2>Analysis</h2>


<form>
  <div class="form-group">
    <label for="formGroupExampleInput">Date</label>
    <input type="date" class="form-control" name="date" id="date" >
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Shift Change</label>
    <input type="text" class="form-control" name="change" id="change">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Late to shift</label>
    <input type="text" class="form-control" name="lates" id="lates">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Pay</label>
    <input type="text" class="form-control" name="pay" id="pay">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Hours</label>
    <input type="text" class="form-control" name="hours" id="hours">
  </div>
  <button type="submit" class="btn btn-lg btn-primary btn-block" id="add"  value="add"> Add</button>
  <button type="submit" class="btn btn-lg btn-primary btn-block" id="update" value="update"> Update</button>
</form>


  

  <select name="member" id="sel_user">
  <option value="default">default</option>
  <?php foreach ($member as $row) { ?>
    <option value=<?= $row['memberID']?>><?= $row['name']?></option>
    <?php } ?>
  </select>





<h2>User Table</h2>


      <table class="table table-striped">

 <tr>
 
 <th>Date</th>
 <th>Shift Change</th>
 <th>Late to shift</th>
 <th>Pay</th>
 <th>Hours</th>
 
 <th >update</th>
 <th >Delete</th>
 
 
 </tr>
 

 
 
 <tbody id="tbody">

</tbody>


 

</table>

  <!-- Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type='text/javascript'>
  $(document).ready(function(){
 
   $('#sel_user').change(function(){
    var username = $(this).val();
    $.ajax({
     url:'<?php echo base_url(); ?>index.php/Analysis/userDetails',
     method: 'post',
     data: {memberID: username},
     dataType: 'json',
     success: function(response){
      $("#tbody").empty(); 
      
     
       for(var i=0;i<response.length;i++)
           {
             var update = "<?= base_url() ?>index.php?/Analysis/update/"+response[i].statID;
             var delete1 = "<?= base_url() ?>index.php?/Analysis/delete/"+response[i].statID;
             var Html="<tr><td>"+response[i].Date+"</td><td>"+response[i].shiftchanges+"</td><td>"+response[i].latetoshift+"</td><td>"+response[i].pay+"</td><td>"+response[i].hours+"</td><td><button type='submit' class='like' id='btnSubmit1' value="+response[i].statID+">Update</button></td></td><td><button type='submit' class='like' id='btnSubmit' value="+response[i].statID+">Delete</button></td></tr>";
            $('#tbody').append(Html);

           }
     }
   });
  });
  
 });
 

 $(document).ready(function(){
  
  $("#add").click(function (event) {
    event.preventDefault();
    
    var formData = {
      date: $("#date").val(),
      change: $("#change").val(),
      lates: $("#lates").val(),
      pay: $("#pay").val(),
      
      hours: $("#hours").val(),
      user: $('#sel_user').val(),
     
    };
    
   
    $.ajax({
     url:'<?php echo base_url(); ?>index.php/Analysis/addDetails',
     method: 'post',
     data: formData,
     dataType: 'json',
     success: function(response){
      $("#tbody").empty(); 
      $('form :input').val('');
      for(var i=0;i<response.length;i++)
           {
            var update = "<?= base_url() ?>index.php?/Analysis/update/";
             var delete1 = "<?= base_url() ?>index.php?/Analysis/delete/"+response[i].statID;
             var Html="<tr><td>"+response[i].Date+"</td><td>"+response[i].shiftchanges+"</td><td>"+response[i].latetoshift+"</td><td>"+response[i].pay+"</td><td>"+response[i].hours+"</td><td><button type='submit' class='like' id='btnSubmit1' value="+response[i].statID+">Update</button></td></td><td><button type='submit' class='like' id='btnSubmit' value="+response[i].statID+">Delete</button></td></tr>";
            $('#tbody').append(Html);

           }
     }
   });
    
  });
  $(function() {
    $(document).on("click", '#btnSubmit', function() {
      var statid = $(this).val()
        


        $.ajax({
     url:'<?php echo base_url(); ?>index.php/Analysis/delete',
     method: 'post',
     data: {statID: statid, user: $('#sel_user').val()},
     dataType: 'json',
     success: function(response){
      $("#tbody").empty(); 
      $('form :input').val('');
     
       for(var i=0;i<response.length;i++)
           {
             var update = "<?= base_url() ?>index.php?/Analysis/update/"+response[i].statID;
             var delete1 = "<?= base_url() ?>index.php?/Analysis/delete/"+response[i].statID;
             var Html="<tr><td>"+response[i].Date+"</td><td>"+response[i].shiftchanges+"</td><td>"+response[i].latetoshift+"</td><td>"+response[i].pay+"</td><td>"+response[i].hours+"</td><td><button type='submit' class='like' id='btnSubmit1' value="+response[i].statID+">Update</button></td></td><td><button type='submit' class='like' id='btnSubmit' value="+response[i].statID+">Delete</button></td></tr>";
            $('#tbody').append(Html);

           }
     }
   });
    });
});


$(function() {
    $(document).on("click", '#btnSubmit1', function() {
      var statid = $(this).val();

      
      $("#update").show();
      $("#add").hide();
      
      $.ajax({
     url:'<?php echo base_url(); ?>index.php/Analysis/update',
     method: 'post',
     data: {statID: statid, user: $('#sel_user').val()},
     dataType: 'json',
     success: function(response){
      $("#date").val(response[0].Date)
      $("#change").val(response[0].shiftchanges)
      $("#lates").val(response[0].latetoshift)
      $("#pay").val(response[0].pay)
      
      $("#hours").val(response[0].hours)
      
      
     
      
     }
   });

       
    });
});


$(function() {
    $(document).on("click", '#update', function() {
      var statid = $(this).val();

      
      event.preventDefault();
      var formData = {
      date: $("#date").val(),
      change: $("#change").val(),
      lates: $("#lates").val(),
      pay: $("#pay").val(),
      
      hours: $("#hours").val(),
      user: $('#sel_user').val(),
     
    };
      
      $.ajax({
     url:'<?php echo base_url(); ?>index.php/Analysis/updatevalue',
     method: 'post',
     data: formData,
     dataType: 'json',
     success: function(response){
      
      $("#tbody").empty(); 
      $('form :input').val('');
      $("#update") .hide();
      $("#add").show();

     
       for(var i=0;i<response.length;i++)
           {
             var update = "<?= base_url() ?>index.php?/Analysis/update/"+response[i].statID;
             var delete1 = "<?= base_url() ?>index.php?/Analysis/delete/"+response[i].statID;
             var Html="<tr><td>"+response[i].Date+"</td><td>"+response[i].shiftchanges+"</td><td>"+response[i].latetoshift+"</td><td>"+response[i].pay+"</td><td>"+response[i].hours+"</td><td><button type='submit' class='like' id='btnSubmit1' value="+response[i].statID+">Update</button></td></td><td><button type='submit' class='like' id='btnSubmit' value="+response[i].statID+">Delete</button></td></tr>";
            $('#tbody').append(Html);

           }
      
      
     
      
     }
   });

       
    });
});



});




 </script>