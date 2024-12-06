export function productsMapper(productData) {
  return productData
    .slice(1) // Skip the header row
    .filter((row) => row.length > 1) // Filter out any empty rows
    .map((row) => ({
      image: row[0].replace(/"/g, ''),
      name: row[1].replace(/"/g, ''),
      category: row[2].replace(/"/g, ''),
      stock: parseInt(row[3]),
      reorder_level: parseInt(row[4]),
      price: parseFloat(row[5]),
      supplier_name: row[6].replace(/"/g, ''),
      supplier_address: row[7].replace(/"/g, '').replace(/\r/, ''),
    }));
}

export async function insertProductsToDatabase(products) {
  try {
    const response = await fetch('/macro/api/insert-products.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ products }), // Send products as JSON
    });

    const result = await response.json();
    console.log(result);
    if (response.ok) {
      console.log('Products inserted successfully', result);
    } else {
      console.log('Error inserting products:', result);
    }
  } catch (error) {
    console.error('Error:', error);
  }
}
