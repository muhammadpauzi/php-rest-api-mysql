CREATE TABLE users(
    id          int NOT NULL AUTO_INCREMENT,
    name        varchar(128) NOT NULL,
    username    varchar(128) NOT NULL,
    email       varchar(128) NOT NULL,
    id_profile  int NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY  username_unique (username),
    UNIQUE KEY  email_unique (email),
    INDEX       name_index (name),
    CONSTRAINT  fk_users_profile
        FOREIGN KEY (id_profile) REFERENCES profiles (id)
            ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB, CHARSET = utf8mb4, COLLATION = utf8mb4_unicode_ci;