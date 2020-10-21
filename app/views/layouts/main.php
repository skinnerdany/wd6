<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <script src="jquery.js"></script>
        <style>
            #menu {
                width: 300px;
                border: 1px solid #0f0;
                margin-right: 10px;
                float: left;
                padding: 10px;
            }
            #content {
                border: 1px solid #0f0;
                width: 600px;
                float: left;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <div id="menu">
            <?php echo $__menu; ?>
        </div>
        <div id="content">
            <?php echo $__content; ?>
        </div>
        <?php //echo ; ?>
    </body>
</html>