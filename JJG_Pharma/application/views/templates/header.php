
<!doctype html>

<html>
<head>
  <meta charset="utf-8">

  <title></title>

<!-- <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic"> -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.css">
<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.css"> -->
  <?php echo link_tag('css/milligram.css') ?>

</head>
<body>

<div class="container" style="background-color:#dcd3e3">
    <div class="row" style="background-color:#dcd3e3" >
      <h2>JJG Pharmacy</h2>
    </div>
    <div class="row" style="background-color:#dcd3e3">
        <div class = "column"><h3><?php echo anchor("JJG_Pharma/index.php/login", "Login") ?></h3></div>
        <div class = "column"><h3><?php echo anchor("JJG_Pharma/index.php/profile", "Profile") ?></h3></div>
        <div class = "column"><h3><?php echo anchor("JJG_Pharma/index.php/medicine", "Medicine") ?></h3></div>
        <div class = "column"><h3><?php echo anchor("JJG_Pharma/index.php/transaction", "Purchases") ?></h3></div>
    </div>
</div>
<div class="container" style="color:#2a292b">
  <h1><?php echo $title ?></h1>
</div>