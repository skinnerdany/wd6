<?php echo $page['template']; ?>
<div style="background: #fbb;">
    <?php echo $result; ?>
</div>
<form method="POST" action="/?page=reg">
    Email: <input type="email" name="email" /><br />
    Password: <input type="password" name="password"><br />
    Confirm password: <input type="password" name="_password"><br />
    <input type="submit" name="submit" />
</form>