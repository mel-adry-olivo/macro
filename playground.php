<?php 

require './includes/db-config.php';
require './includes/template-components.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Macro™</title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="/macro/styles.css">
      <link rel="stylesheet" href="/macro/utilities.css">
      <!-- <script src="/macro/js/router.js" type="module" defer></script> -->
      <!-- <script src="/macro/js/events.js" type="module"></script> -->
      <script src="https://unpkg.com/lucide@latest"></script>
  </head>
  <body>
    <div class="container">
        <h1 style="color: var(--clr-text-secondary); font-size: var(--text-2xl);">Macro Playground</h1>
        <?php require './includes/warehouse/stock-transfer-form.php'; ?>
    </div>
    <script>

      const dropdownWarehouse = document.querySelector('.dropdown-warehouse');
      const dropdownRack = document.querySelector('.dropdown-rack');

      const radioButtons = document.querySelectorAll('input[type="radio"]');
      radioButtons.forEach((radioButton) => {
        radioButton.addEventListener('change', () => {
          if(radioButton.value === 'rack') {
            dropdownRack.classList.add('selected');
          } else {
            dropdownRack.classList.remove('selected');
          }

          if(radioButton.value === 'warehouse') {
            dropdownWarehouse.classList.add('selected');
          } else {
            dropdownWarehouse.classList.remove('selected');
          }
        })
      })

      const checkedButton = document.querySelector('input[type="radio"]:checked');
        if(checkedButton.value === 'rack') {
          dropdownRack.classList.add('selected');
        } else {
          dropdownRack.classList.remove('selected');
        }

        if(checkedButton.value === 'warehouse') {
          dropdownWarehouse.classList.add('selected');
        } else {
          dropdownWarehouse.classList.remove('selected');
        }


      lucide.createIcons();
    </script>
  </body>
</html>
