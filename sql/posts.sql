CREATE TABLE posts(
    id          int NOT NULL AUTO_INCREMENT,
    title       varchar(128) NOT NULL,
    description varchar(500),
    body        text NOT NULL,
    id_user     int NOT NULL,
    PRIMARY KEY (id),
    INDEX       title_description_index (title, description),
    CONSTRAINT  fk_posts_user
        FOREIGN KEY (id_user) REFERENCES users (id)
            ON DELETE CASCADE ON UPDATE CASCADE,
    created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FULLTEXT    posts_search (title, description)
) ENGINE = InnoDB CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

ALTER TABLE posts
    DROP FOREIGN KEY fk_posts_user;

