<form method="POST" action="/user/login">
    <input type="hidden" name="token" value="<?php echo $token ?? ''; ?>">
    Email: <input type="email" name="email" value="<?php echo $email ?? ''; ?>" /><br />
    Passw: <input type="password" name="password" value="<?php echo $password ?? ''; ?>" /><br />
    <input type="submit" name="submit">
</form>
<?php echo $this->showTemplate('formError', ['error' => $error ?? '']); ?>