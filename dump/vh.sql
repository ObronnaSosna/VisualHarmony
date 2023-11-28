CREATE TABLE comments (
    id      INTEGER NOT NULL,
    text    VARCHAR(100),
    post_id INTEGER NOT NULL,
    users_id INTEGER NOT NULL,
    upvote   INTEGER,
    downvote INTEGER
);

ALTER TABLE comments ADD CONSTRAINT comments_pk PRIMARY KEY ( id );

CREATE TABLE files (
    id   INTEGER NOT NULL,
    path VARCHAR(100)
);

ALTER TABLE files ADD CONSTRAINT files_pk PRIMARY KEY ( id );

CREATE TABLE logins (
    id       INTEGER NOT NULL,
    `user`   VARCHAR(100),
    password VARCHAR(100)
);

ALTER TABLE logins ADD CONSTRAINT logins_pk PRIMARY KEY ( id );

CREATE TABLE posts (
    id          INTEGER NOT NULL,
    title       VARCHAR(100),
    description VARCHAR(100),
    tags        VARCHAR(1000),
    `date`      DATETIME,
    user_id     INTEGER NOT NULL,
    file_id     INTEGER NOT NULL,
    upvote      INTEGER,
    downvote    INTEGER
);

ALTER TABLE posts ADD CONSTRAINT image_pk PRIMARY KEY ( id );

CREATE TABLE profiles (
    id      INTEGER NOT NULL,
    bio     VARCHAR(100),
    user_id INTEGER NOT NULL
);

ALTER TABLE profiles ADD CONSTRAINT profiles_pk PRIMARY KEY ( id );

CREATE TABLE users (
    id       INTEGER NOT NULL,
    login_id INTEGER NOT NULL
);

ALTER TABLE users ADD CONSTRAINT users_pk PRIMARY KEY ( id );

ALTER TABLE comments
    ADD CONSTRAINT comments_posts_fk FOREIGN KEY ( post_id )
        REFERENCES posts ( id );

ALTER TABLE posts
    ADD CONSTRAINT image_files_fk FOREIGN KEY ( file_id )
        REFERENCES files ( id );

ALTER TABLE posts
    ADD CONSTRAINT image_users_fk FOREIGN KEY ( user_id )
        REFERENCES users ( id );

ALTER TABLE profiles
    ADD CONSTRAINT profiles_users_fk FOREIGN KEY ( user_id )
        REFERENCES users ( id );

ALTER TABLE users
    ADD CONSTRAINT users_logins_fk FOREIGN KEY ( login_id )
        REFERENCES logins ( id );


