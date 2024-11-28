CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    author VARCHAR(100) NOT NULL,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    stock INT NOT NULL,
    stock_threshold INT NULL,
    price DECIMAL(10, 2) NOT NULL
);

CREATE TABLE warehouses (
    id INT AUTO_INCREMENT PRIMARY KEY,  
    name VARCHAR(255) NOT NULL,         
    address VARCHAR(255) NOT NULL 
);

CREATE TABLE racks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    warehouse_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    max_unit_capacity INT NOT NULL,
    last_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (warehouse_id) REFERENCES warehouses(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL,           -- Type can be low_stock, new_order, etc.
    status INT DEFAULT 0,                -- 0 = unread, 1 = read
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Automatically set to the current time when created
);

INSERT INTO books (image, author, name, category, stock, stock_threshold, price)
VALUES
    ("./assets/to-kill-a-mockingbird.jpg", "Harper Lee", "To Kill a Mockingbird", "Fiction", 50, 10, 18.99),
    ("./assets/1984.jpg", "George Orwell", "1984", "Dystopian", 80, 15, 15.99),
    ("./assets/the-great-gatsby.jpg", "F. Scott Fitzgerald", "The Great Gatsby", "Classic", 30, 5, 10.99),
    ("./assets/pride-and-prejudice.png", "Jane Austen", "Pride and Prejudice", "Romance", 40, 8, 12.99),
    ("./assets/the-hobbit.jpg", "J.R.R. Tolkien", "The Hobbit", "Fantasy", 60, 12, 25.99);

INSERT INTO warehouses (name, address) 
VALUES
    ('Main Warehouse', '123 Jaro St, Iloilo City, Iloilo'),
    ('South Depot', '456 Molo St, Iloilo City, Iloilo'),
    ('North East Storage', '789 La Paz St, Iloilo City, Iloilo'),
    ('West Hub', '101 Arevalo St, Iloilo City, Iloilo'),
    ('Central Warehouse', '12 Delgado St, Iloilo City, Iloilo'),
    ('Riverside Depot', '56 Villa St, Iloilo City, Iloilo'),
    ('Iloilo Heights', '789 East Baluarte St, Iloilo City'),
    ('Panay Depot', '34 Balantang St, Iloilo City, Iloilo'),
    ('Mandurriao Hub', '22 N. Alegre St, Iloilo City, Iloilo'),
    ('City Center Storage', '200 Bonifacio St, Iloilo City, Iloilo');


INSERT INTO notifications (message, type)
VALUES
    ("Low stock: To Kill a Mockingbird (Stock: 10)", "low_stock"),
    ("Low stock: 1984 (Stock: 15)", "low_stock"),
    ("New order #10245", "new_order");

INSERT INTO racks (warehouse_id, name, max_unit_capacity)
VALUES 
    (1, 'Rack 1', 100),
    (1, 'Rack 2', 150),
    (2, 'Rack 3', 200),
    (3, 'Rack 4', 250),
    (3, 'Rack 5', 300);
