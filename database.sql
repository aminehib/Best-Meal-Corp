-- Table recipe
CREATE TABLE recipe (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    preparation_time INT,
    preparation LONGTEXT,
    cooking_time INT,
    servings INT, --nombre de portions/personnes
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, --date+heure  type date et heure
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- se met a jour automatiquement
);

INSERT INTO recipe (title, description, preparation_time, preparation, cooking_time, servings)
VALUES
('Tarte aux pommes', 'Tres bonne tarte maison', 20, 'Eplucher les pommes, preparer la pate puis disposer les tranches avant cuisson.', 30, 6),
('Pizza maison', 'Pizza simple et rapide', 15, 'Etaler la pate, ajouter la sauce et la garniture puis enfourner.', 20, 4),
('Couscous', 'Plat traditionnel', 40, 'Preparer les legumes, cuire la semoule et assembler avec le bouillon.', 60, 5);

-- Table ingredient
CREATE TABLE ingredient (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table tag
CREATE TABLE tag (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table relation recipe_ingredient (N-N avec attributs)
CREATE TABLE recipe_ingredient (
    recipe_id INT,
    ingredient_id INT,
    quantity DECIMAL(10,2),-- 2 chiffre apres la ,
    unit VARCHAR(50),
    notes VARCHAR(255),

    PRIMARY KEY (recipe_id, ingredient_id),
    FOREIGN KEY (recipe_id) REFERENCES recipe(id) ON DELETE CASCADE,
    FOREIGN KEY (ingredient_id) REFERENCES ingredient(id) ON DELETE CASCADE
);

-- Table relation recipe_tag (N-N)
CREATE TABLE recipe_tag (
    recipe_id INT,
    tag_id INT,

    PRIMARY KEY (recipe_id, tag_id),

    FOREIGN KEY (recipe_id) REFERENCES recipe(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tag(id) ON DELETE CASCADE
);

