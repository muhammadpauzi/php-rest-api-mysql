CREATE TABLE categories(
    id          int NOT NULL AUTO_INCREMENT,
    title       varchar(128) NOT NULL,
    description varchar(500),
    PRIMARY KEY (id),
    INDEX       title_description_index (title, description),
    created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FULLTEXT    users_search (title, description)
) ENGINE = InnoDB CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;