<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= assetUrl(); ?>css/main.css">
    <title>Management</title>
  </head>
  <body>

<div class="centers">
  <div class="container">
  <div class="row">
    <div class="col-sm border border-secondary" >
    <img src="<?= assetUrl() ?>/img/headerIMG.png" class="center">
    </div>
    <div class="col-sm border border-secondary">
   
    <form method="POST" action="<?php echo base_url(); ?>index.php/login/login">
    		            	<fieldset>
    		                	<div class="form-group">
    		                    	<input class="form-control" placeholder="Email"  name="email" required>
    		                	</div>
    		                	<div class="form-group">
    		                    	<input class="form-control" placeholder="Password" type="password" name="password" required>
    		                	</div>
    		                	<button type="submit" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-log-in"></span> Login</button>
    		            	</fieldset>
    		        	</form>
    </div>
    
  </div>
</div>
</div>


  </body>
</html>




