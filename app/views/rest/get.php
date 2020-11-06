<script>
    function deleteItem(id)
    {
        if (id === undefined) {
            return false;
        }
        $.ajax({
            url: '/rest',
            dataType: 'json',
            data: {id: id},
            method: 'DELETE',
            success: function (res) {
                if (res.success == 1) {
                    window.location = '/rest';
                }
            }
        });
    }
</script>
<form style="background: #ff9;" method="POST" action="/rest">
    <input type="text" name="name" /><br />
    <input type="number" name="status" />
    <input type="submit" name="submit" />
</form>
<table style="width: 100%;">
    <?php foreach ($items as $item) { ?>
    <tr>
        <td style="border-bottom: 1px solid #000;">
            <a href="/rest?id=<?php echo $item['id']; ?>">Просмотр</a><br />
            <a href="#" onclick="return deleteItem(<?php echo $item['id']; ?>); ">Удаление</a>
        </td>
        <td><?php echo $item['name']; ?></td>
        <td><?php echo $item['status']; ?></td>
        <td><?php echo date('Y-m-d H:i:s', $item['date']); ?></td>
    </tr>
    <?php } ?>
</table>