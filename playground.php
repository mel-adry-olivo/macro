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
      <script src="https://unpkg.com/lucide@latest"></script>
  </head>
  <body>
    <div class="container">
        <div class="form-wrapper">
          <h1 class="form-title">Template</h1>
          <div class="form-layout-main">
            <div class="form-layout-row">
              <div class="form-group">
                <span class="form-group-label">Text Input</span>
                <input type="text" class="form-text-input" placeholder="You can type text here" />
              </div>
              <div class="form-group">
                <span class="form-group-label">Text Input [Numbers]</span>
                <input type="text" class="form-text-input" placeholder="You can only type numbers here" numbers/>
              </div>
            </div>
            <div class="form-layout-row">
              <div class="form-group">
                <span class="form-group-label">Select 1</span>
                <div class="form-select-wrapper">
                  <select class="form-select-input">
                    <option value="option-1">Option 1</option>
                    <option value="option-2">Option 2</option>
                  </select>
                  <i data-lucide="chevron-down"></i>
                </div>
              </div>
              <div class="form-group">
                <span class="form-group-label">Select 2</span>
                <div class="form-select-wrapper">
                  <select class="form-select-input">
                    <option value="option-1">Option 1</option>
                    <option value="option-2">Option 2</option>
                  </select>
                  <i data-lucide="chevron-down"></i>
                </div>
              </div>
              <div class="form-group">
                <span class="form-group-label">Select 3</span>
                <div class="form-select-wrapper">
                  <select class="form-select-input">
                    <option value="option-1">Option 1</option>
                    <option value="option-2">Option 2</option>
                  </select>
                  <i data-lucide="chevron-down"></i>
                </div>
              </div>
            </div>
            <div class="form-layout-row">
              <div class="form-group">
                <span class="form-group-label">Button Filled</span>
                <button class="btn btn-primary form-button">
                  <i data-lucide="package"></i>
                  Button
                </button>
              </div>
              <div class="form-group">
                <span class="form-group-label">Button Outlined</span>
                <button class="btn btn-primary form-button" outlined>
                  <i data-lucide="box"></i>
                  Button
                </button>
              </div>
            </div>
            <div class="form-layout-row">
              <div class="form-group">
                <span class="form-group-label">Search Box</span>
                <div class="form-search-box">
                  <i data-lucide="search"></i>
                  <input type="text" class="form-text-input" placeholder="You can search here" search/>
                  <div class="form-search-results"></div>
                </div>
              </div>
            </div>
            <div class="form-layout-row">
              <div class="form-group">
                <span class="form-group-label">Search Selection</span>
                <div class="form-search-selection"></div>
              </div>
            </div>
            <div class="form-layout-row">
              <div class="form-group">
                <span class="form-group-label">Image Upload</span>
                <div class="form-image-chooser">
                  <label for="form-image-input">
                    <i data-lucide="upload"></i>
                    Choose Image
                  </label>
                  <input type="file" id="form-image-input" class="form-image-input" accept="image/*">
                </div>
                <div class="form-image-container"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <script>
      lucide.createIcons();

      const searchData = [
        { id: 1, title: 'Hello' },
        { id: 2, title: 'This is a test' },
        { id: 3, title: 'Item 33' },
        { id: 4, title: 'Omg' },
      ];  

      const searchInput = document.querySelector('.form-text-input[search]');
      const searchResults = document.querySelector('.form-search-results');
      const searchSelection = document.querySelector('.form-search-selection');

      const selectInputs = document.querySelectorAll('.form-select-input');
      const textInputNumbers = document.querySelectorAll('.form-text-input[numbers]');

      searchInput.addEventListener('input', () => {
        const searchTerm = searchInput.value.trim().toLowerCase();
        const filteredData = searchData.filter((item) => item.title.toLowerCase().startsWith(searchTerm));

        searchResults.innerHTML = '';
        filteredData.forEach((item) => {
          const resultItem = document.createElement('div');
          resultItem.classList.add('form-search-results-item');
          resultItem.textContent = item.title;
          searchResults.appendChild(resultItem);
        });

        searchResults.style.display = searchTerm && filteredData.length > 0 ? 'block' : 'none';
      })

      searchResults.addEventListener('click', (e) => {
        if (e.target.classList.contains('form-search-results-item')) {
          const selectedItem = e.target.textContent;
          const existingItems = searchSelection.children;
          let alreadySelected = false;

          for (let i = 0; i < existingItems.length; i++) {
            if (existingItems[i].textContent === selectedItem) {
              alreadySelected = true;
              searchInput.value = '';
              searchResults.innerHTML = '';
              searchResults.style.display = 'none';
              break;
            }
        }

        if (!alreadySelected) {
          const selectionItem = document.createElement('div');
          selectionItem.classList.add('form-search-selection-item');
          selectionItem.textContent = selectedItem;
          selectionItem.innerHTML = `${selectedItem} <button class="remove-button">x</button>`;
          searchSelection.appendChild(selectionItem);
          searchInput.value = '';
          searchResults.innerHTML = '';
          searchResults.style.display = 'none';
        }
      }
      });

      searchSelection.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-button')) {
          e.target.parentElement.remove();
        }
      });

      selectInputs.forEach((input) => {
        input.addEventListener('focus', () => {
          input.parentElement.classList.add('selected');
        });

        input.addEventListener('blur', () => {
          input.parentElement.classList.remove('selected');
        });

        input.addEventListener('change', () => {
          input.parentElement.classList.remove('selected');
        });
      })

      textInputNumbers.forEach((input) => {
        input.addEventListener('input', () => {
          const value = input.value;
          const cleanedValue = value
            .replace(/[^0-9.]/g, '')
            .replace(/^0+(?!$)/, '');

          if(cleanedValue < 0) {
            input.value = '';
          } else {
            input.value = cleanedValue;
          }
        })
      })
    </script>
  </body>
</html>
