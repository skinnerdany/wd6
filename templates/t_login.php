<?php echo $page['template']; ?>
<div style="background: #fbb;">
    <?php echo $result; ?>
</div>
<form method="POST" action="/?page=login">
    Email: <input type="email" name="email" /><br />
    Password: <input type="password" name="password"><br />
    <input type="submit" name="submit" />
</form>