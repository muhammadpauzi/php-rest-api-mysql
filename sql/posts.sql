CREATE TABLE posts(
    id          int NOT NULL AUTO_INCREMENT,
    title       varchar(128) NOT NULL,
    description varchar(1000) NOT NULL DEFAULT '',
    body        text NOT NULL,
    id_category int NOT NULL,
    id_user     int NOT NULL,
    PRIMARY KEY (id),
    INDEX       title_body_index (title, body),
    CONSTRAINT  fk_posts_category
        FOREIGN KEY (id_category) REFERENCES categories (id),
    CONSTRAINT  fk_posts_user
        FOREIGN KEY (id_user) REFERENCES users (id)
            ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;