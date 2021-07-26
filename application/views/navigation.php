


<ul>
 
 
 <?php if ($test[0]['level'] == 0) { ?>
    <li><a href="<?= base_url(); ?>index.php?/User">Scheduler</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Chat">Chat</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Forum">Forum</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Empanalysis">Analysis</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Empreport">&#x21</a></li>
 <li><a href="<?= base_url(); ?>index.php?/User/Logout">Log Out</a></li>
 <?php } else if($test[0]['level'] == 1) { ?>
    <li><a href="<?= base_url(); ?>index.php?/User">Scheduler</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Chat">Chat1</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Forum">Forum1</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Setup">Set up Schedule1</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Analysis">Analysis1</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Createacc">Create Account1</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Empreport">&#x21</a></li>
 <li><a href="<?= base_url(); ?>index.php?/User/Logout">Log Out1</a></li>
 <?php } else { ?>
    <li><a href="<?= base_url(); ?>index.php?/User">Scheduler</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Chat">Chat2</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Forum">Forum2</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Setup">Set up Schedule2</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Analysis">Analysis2</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Createacc">Create Account2</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Admreport">&#x21</a></li>
 <li><a href="<?= base_url(); ?>index.php?/User/Logout">Log Out2</a></li>
 <?php } ?>
</ul>

