<style>
    #privilegesList {
        border: 1px solid #f00;
        min-height: 100px;
        margin: 20px 0;
        padding: 5px;
    }
</style>
<form method="POST" action="/access/roleSave">
    <input type="hidden" name="id" value="<?php echo $id ?? 0; ?>">
    Название роли: <input type="text" name="name" value="<?php echo $name ?? ''; ?>">
    <div id="privilegesList">
        <b>Привилегии</b><br />
        <?php foreach ($privileges as $privilege) { ?>
        <input type="checkbox" value="<?php echo $privilege['id']; ?>"> <?php echo $privilege['name']; ?><br />
        <?php } ?>
    </div>
    <input type="submit" name="submit">
</form>