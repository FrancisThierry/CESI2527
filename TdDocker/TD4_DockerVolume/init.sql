CREATE TABLE contact (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50),
    email VARCHAR(100)
);

INSERT INTO contact (nom, email) VALUES
('Alice Dupont', 'alice@example.com'),
('Bob Martin', 'bob@example.com'),
('Claire Leroy', 'claire@example.com'),
('David Moreau', 'david@example.com'),
('Emma Petit', 'emma@example.com');
