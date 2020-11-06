<form method="POST" action="/user/reset">
    Email: <input type="email" name="email" value="<?php echo $email ?? ''; ?>" /><br />
    <input type="submit" name="submit">
</form>
<?php echo $this->showTemplate('formError', ['error' => $error ?? '']); ?>