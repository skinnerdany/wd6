<?php foreach ($roles as $role) { ?>
<a href="/access/roleUpdate?id=<?php echo $role['id']; ?>"><?php echo $role['name']; ?></a><br />
<?php } ?>