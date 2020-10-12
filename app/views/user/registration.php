<form method="POST" action="/user/registration">
    Email: <input type="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" /><br />
    Passw: <input type="password" name="password"  value="<?php echo ($password ?? ''); ?>" /><br />
    confirm Passw: <input type="password" name="cpassword"  value="<?php echo ($cpassword ?? ''); ?>" /><br />
    <input type="submit" name="submit">
</form>
<div style="background: #f99;">
    <?php echo $error ?? ''; ?>
</div>