<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <?echo "<title>".$data['title']."</title>";?> 

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    </head>
    <body> 
        <?php
            include 'application/views/'.$content_view; 
        ?>
    </body> 
</html> 