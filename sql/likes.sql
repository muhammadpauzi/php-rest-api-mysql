CREATE TABLE likes(
    id          int NOT NULL AUTO_INCREMENT,
    id_post     int NOT NULL,
    id_user     int NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT  fk_likes_post,
        FOREIGN KEY (id_post) REFERENCES posts (id)
            ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT  fk_likes_user
        FOREIGN KEY (id_user) REFERENCES users (id)
            ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;