<?php
/**
 * 159.339 Internet Programming Assignment 3
 * Student : Shenchuan Gao (16131180)
 */
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Search Page</title>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet"/>
</head>
<body>
<div class="container">
    <br/>
    <h2 align="center">Welcome to Toolshed!</h2><br/>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">Search</span>
            <input type="text" name="search_text" id="search_text" placeholder="Search by Tool Name"
                   class="form-control"/>
        </div>
    </div>
    <br/>
</div>
</body>
</html>
<script>
    $(document).ready(function () {
        $('#search_text').keyup(function () {
            var txt = $(this).val();
            $.ajax({
                url: "model/ToolHandler.php",
                method: "post",
                data: {search: txt},
                dataType: "text",
                success: function (data) {
                    $('#result').html(data);
                }
            });
        });
    });
</script>
