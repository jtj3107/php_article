<?php
if ( !isset($_GET['dan']) ) {
  $_GET['dan'] = "2";
}

if ( !isset($_GET['limit']) ) {
  $_GET['limit'] = "9";
}

$dan = intval($_GET['dan']);
$limit = intval($_GET['limit']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$dan?>단</title>

  <link rel="stylesheet" href="common.css">
</head>
<body>
  <h1><?=$dan?>단</h1>

  <hr>

  <?php for ( $i = 1; $i <= $limit; $i++ ) { ?>
    <div>
      <?=$dan?> * <?=$i?> = <?=$dan * $i?>
    </div>
  <?php } ?>
  
  <hr>

  <?php for ( $dan2 = 1; $dan2 <= 9; $dan2++ ) { ?>
    <?php
    $aClass = "";

    if ( $dan2 == $dan ) {
      $aClass = "red";
    }
    ?>
    <a class="<?=$aClass?>" href="dan.php?dan=<?=$dan2?>"><?=$dan2?>단</a>
  <?php } ?>
</body>
</html>