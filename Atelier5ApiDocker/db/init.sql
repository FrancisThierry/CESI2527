-- db/init.sql

-- 1. Utiliser la syntaxe INT AUTO_INCREMENT pour la fiabilité MySQL
-- 2. Assurer que la syntaxe de la ligne 3 est propre
CREATE TABLE meteo (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    date DATE NOT NULL DEFAULT (CURRENT_DATE), -- Optionnel : Encadrer CURRENT_DATE pour la clarté, ou le laisser sans rien.
    ville VARCHAR(100) NOT NULL,
    meteo VARCHAR(100) NOT NULL
);

INSERT INTO meteo (ville, meteo)
VALUES
('Brest', 'Belle'),
('Quimper', 'Agitée'),
('Lorient', 'Très belle'),
('Nantes', 'Agitée'),
('Saint-Malo', 'Très belle'),
('Vannes', 'Belle'),
('Toulon', 'Belle'),
('Bordeaux', 'Belle'),
('Marseille', 'Très belle'),
('Nice', 'Belle'),
('Montpellier', 'Très belle'),
('Ajaccio', 'Agitée'),
('Bastia', 'Très belle'),
('Perpignan', 'Belle'),
('Menton', 'Agitée'),
('Dunkerque', 'Agitée'),
('Cherbourg', 'Belle'),
('La Rochelle', 'Agitée'),
('Sète', 'Très belle'),
('Boulogne-sur-Mer', 'Belle'),
('Le Havre', 'Agitée'),
('Calais', 'Très belle');