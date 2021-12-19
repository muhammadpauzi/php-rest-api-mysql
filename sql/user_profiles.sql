CREATE TABLE user_profiles(
    id          int NOT NULL AUTO_INCREMENT,
    bio         text NOT NULL DEFAULT '',
    facebook    varchar(256) NOT NULL DEFAULT '',
    instagram   varchar(256) NOT NULL DEFAULT '',
    id_user     int NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY id_user_unique (id_user),
    CONSTRAINT  fk_profiles_user
        FOREIGN KEY (id_user) REFERENCES users (id)
            ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB, CHARSET = utf8mb4, COLLATE = utf8mb4_unicode_ci;