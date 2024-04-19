CREATE TABLE destinations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    type VARCHAR(50) NOT NULL,
    budget VARCHAR(20) NOT NULL,
    image LONGBLOB NOT NULL
);

CREATE TABLE activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    destination_id INT NOT NULL,
    activity VARCHAR(100) NOT NULL,
    FOREIGN KEY (destination_id) REFERENCES destinations(id)
);
