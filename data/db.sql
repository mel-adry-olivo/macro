CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    stock INT NOT NULL,
    reorder_level INT NULL,
    price DECIMAL(10, 2) NOT NULL,
    supplier_name VARCHAR(100) NOT NULL,
    supplier_address VARCHAR(255) NOT NULL
)

CREATE TABLE warehouses (
    id INT AUTO_INCREMENT PRIMARY KEY,  
    name VARCHAR(255) NOT NULL,         
    address VARCHAR(255) NOT NULL,
    max_unit_capacity INT NOT NULL
);

CREATE TABLE racks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    warehouse_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    max_unit_capacity INT NOT NULL,
    last_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (warehouse_id) REFERENCES warehouses(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE warehouse_product (
    product_id INT NOT NULL,
    warehouse_id INT NOT NULL,
    rack_id INT NULL,                     
    stock_quantity INT NOT NULL,              
    PRIMARY KEY (product_id, warehouse_id),
    FOREIGN KEY (product_id) REFERENCES products(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (warehouse_id) REFERENCES warehouses(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (rack_id) REFERENCES racks(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE inbound_transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    warehouse VARCHAR(255) NOT NULL,
    operation VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    products VARCHAR(255) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE outbound_transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,      
    warehouse VARCHAR(255) NOT NULL,  
    operation VARCHAR(100) NOT NULL,      
    quantity INT NOT NULL,                
    products VARCHAR(255) NOT NULL,        
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP  
);


CREATE TABLE sales_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    warehouse VARCHAR(255) NOT NULL,
    product_names TEXT NOT NULL, 
    quantities TEXT NOT NULL,  
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);




INSERT INTO products (image, name, category, stock, reorder_level, price, supplier_name, supplier_address)
VALUES
    ("/macro/assets/to-kill-a-mockingbird.jpg", "To Kill a Mockingbird", "Fiction", 50, 10, 18.99, "Default Supplier", "123 Default St, City, Country"),
    ("/macro/assets/1984.jpg", "1984", "Dystopian", 80, 15, 15.99, "Default Supplier", "123 Default St, City, Country"),
    ("/macro/assets/the-great-gatsby.jpg", "The Great Gatsby", "Classic", 30, 5, 10.99, "Default Supplier", "123 Default St, City, Country"),
    ("/macro/assets/pride-and-prejudice.png", "Pride and Prejudice", "Romance", 40, 8, 12.99, "Default Supplier", "123 Default St, City, Country"),
    ("/macro/assets/the-hobbit.jpg", "The Hobbit", "Fantasy", 60, 12, 25.99, "Default Supplier", "123 Default St, City, Country");

INSERT INTO warehouses (name, address) 
VALUES
    ('Default Warehouse', '123 Jaro St, Iloilo City, Iloilo');