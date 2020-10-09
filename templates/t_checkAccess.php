<?php echo $page['template']; ?><br />
<?php if (!isGuest()) { ?>
Authorized as <?php echo $_SESSION['email']; ?><br />
<a href="/?page=logout">Exit</a>
<?php } else { ?>
Unathorized
<?php } ?>