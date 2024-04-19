CREATE TABLE preferences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    destination_type VARCHAR(50) NOT NULL,
    activities VARCHAR(255) NOT NULL,
    budget_range VARCHAR(20) NOT NULL,
    travel_companions VARCHAR(100),
    dates DATE
);
