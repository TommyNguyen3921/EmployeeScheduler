


<ul>
 
 
 <?php if ($test[0]['level'] == 0) { ?>
    <li><a href="<?= base_url(); ?>index.php?/User">Home</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Search">Chat</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Contacts">Forum</a></li>
 <li><a href="<?= base_url(); ?>index.php?/About">Set up Schedule</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Home">Analysis</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Search">Create Account</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Empreport">&#x21</a></li>
 <li><a href="<?= base_url(); ?>index.php?/User/Logout">Log Out</a></li>
 <?php } else if($test[0]['level'] == 1) { ?>
    <li><a href="<?= base_url(); ?>index.php?/User">Home1</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Search">Chat1</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Contacts">Forum1</a></li>
 <li><a href="<?= base_url(); ?>index.php?/About">Set up Schedule1</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Home">Analysis1</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Search">Create Account1</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Empreport">&#x21</a></li>
 <li><a href="<?= base_url(); ?>index.php?/User/Logout">Log Out1</a></li>
 <?php } else { ?>
    <li><a href="<?= base_url(); ?>index.php?/User">Home2</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Search">Chat2</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Contacts">Forum2</a></li>
 <li><a href="<?= base_url(); ?>index.php?/About">Set up Schedule2</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Home">Analysis2</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Search">Create Accoun2t</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Empreport">&#x21</a></li>
 <li><a href="<?= base_url(); ?>index.php?/User/Logout">Log Out2</a></li>
 <?php } ?>
</ul>

