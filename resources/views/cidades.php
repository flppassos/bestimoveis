<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cidades</title>
</head>
<body>
    <h1><?=$subtitulo?></h1>

    <ul>
        <?php foreach ($cidades as $cidade) {
            echo "<li>".$cidade."</li>";
        }
        ?>
    </ul>
</body>
</html>