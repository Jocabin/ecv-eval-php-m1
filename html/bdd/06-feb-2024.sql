USE ecv_m1_eval;

CREATE TABLE orders
(
    id         INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_id INTEGER NOT NULL,
    user_id    INTEGER NOT NULL,
    total      FLOAT   NOT NULL
);

CREATE TABLE products
(
    id          INTEGER      NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL,
    description TEXT         NOT NULL,
    price       FLOAT        NOT NULL
);

ALTER TABLE orders
    ADD FOREIGN KEY (user_id) REFERENCES users (id);

ALTER TABLE orders
    ADD FOREIGN KEY (product_id) REFERENCES products (id);