<?php 

require './includes/db-config.php';
require './includes/template-components.php';

?>

<!DOCTYPE html>
<html lang="en">
  <?php require './includes/base-head.php' ?>
  <body>
    <div class="container">
        <h1 style="color: var(--clr-text-secondary); font-size: var(--text-2xl);">Macro Playground</h1>
        <?php require './includes/warehouse/link-product-form.php'; ?>
    </div>
  </body>
</html>
