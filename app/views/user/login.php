<form method="POST" action="/">
    <input type="hidden" name="token" value="<?php echo $_GET['token'] ?? ''; ?>">
    Email: <input type="email" name="email" /><br />
    Passw: <input type="password" name="password" /><br />
    <input type="submit" name="submit">
</form>