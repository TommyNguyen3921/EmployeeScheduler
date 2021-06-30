


<ul>
 
 
 <?php if ($level == 0) { ?>
    <li><a href="<?= base_url(); ?>index.php?/Home">Home</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Search">Chat</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Contacts">Forum</a></li>
 <li><a href="<?= base_url(); ?>index.php?/About">Set up Schedule</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Home">Analysis</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Search">Create Account</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Contacts">&#x21</a></li>
 <li><a href="<?= base_url(); ?>index.php?/About">Log Out</a></li>
 <?php } else if($level == 1) { ?>
    <li><a href="<?= base_url(); ?>index.php?/Home">Home1</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Search">Chat1</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Contacts">Forum1</a></li>
 <li><a href="<?= base_url(); ?>index.php?/About">Set up Schedule1</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Home">Analysis1</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Search">Create Account1</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Contacts">&#x21</a></li>
 <li><a href="<?= base_url(); ?>index.php?/About">Log Out1</a></li>
 <?php } else { ?>
    <li><a href="<?= base_url(); ?>index.php?/Home">Home2</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Search">Chat2</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Contacts">Forum2</a></li>
 <li><a href="<?= base_url(); ?>index.php?/About">Set up Schedule2</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Home">Analysis2</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Search">Create Accoun2t</a></li>
 <li><a href="<?= base_url(); ?>index.php?/Contacts">&#x21</a></li>
 <li><a href="<?= base_url(); ?>index.php?/About">Log Out2</a></li>
 <?php } ?>
</ul>