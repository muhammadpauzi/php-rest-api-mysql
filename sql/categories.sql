CREATE TABLE categories(
    id          int NOT NULL AUTO_INCREMENT,
    title       varchar(128) NOT NULL,
    body        text NOT NULL,
    PRIMARY KEY (id),
    INDEX       title_body_index (title, body),
) ENGINE = InnoDB, CHARSET = utf8mb4, COLLATE = utf8mb4_unicode_ci;