<ul id="main">


   <?php if ($test[0]['level'] == 0) { ?>
      <li><a href="<?= base_url(); ?>index.php?/Empshiftweek">Schedule</a></li>
      <li><a href="<?= base_url(); ?>index.php?/Chat">Chat</a></li>
      <li><a href="<?= base_url(); ?>index.php?/Forum">Forum</a></li>
      <li><a href="<?= base_url(); ?>index.php?/Empstat">Stat</a></li>
      <li><a href="<?= base_url(); ?>index.php?/Empreport">&#x21</a></li>
      <li><a href="<?= base_url(); ?>index.php?/Profile">Profile</a></li>
      <li><a href="<?= base_url(); ?>index.php?/User/Logout">Log Out</a></li>
   
   <?php } else { ?>

      <li><a href="<?= base_url(); ?>index.php?/Admpendshift">Pending Shifts</a></li>
      <li><a href="<?= base_url(); ?>index.php?/Chat">Chat</a></li>
      <li><a href="<?= base_url(); ?>index.php?/Forum">Forum</a></li>
      <li><a href="<?= base_url(); ?>index.php?/Setupschedule">Manage Scheduler</a></li>
      <li><a href="<?= base_url(); ?>index.php?/Admanalysis">Manage Stat</a></li>
      <li><a href="<?= base_url(); ?>index.php?/Createacc">Create Account</a></li>
      <li><a href="<?= base_url(); ?>index.php?/Admreport">&#x21</a></li>
      <li><a href="<?= base_url(); ?>index.php?/Profile">Profile</a></li>
      <li><a href="<?= base_url(); ?>index.php?/User/Logout">Log Out</a></li>
   <?php } ?>
</ul>