<script>
    function sendForm()
    {
        var data = {
            id: $('input[name=id]').val(),
            name: $('input[name=name]').val(),
            status: $('input[name=status]').val()
        };
        $.ajax({
            url: '/rest',
            method: 'PUT',
            dataType: 'json',
            data: data,
            success: function (res) {
                console.log(res);
            }
        });
        return false;
    }
</script>
<form method="PUT" action="/rest">
    <input type="hidden" name="id" value="<?php echo $id ?? 0; ?>">
    <input type="text" name="name" value="<?php echo $name ?? ''; ?>" /><br />
    <input type="number" name="status"  value="<?php echo $status ?? 0; ?>" />
    <input type="button" onclick="return sendForm();" />
</form>