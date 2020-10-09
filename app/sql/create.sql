CREATE TABLE users
(
    id 		serial 		NOT NULL PRIMARY KEY,
    email       varchar(1024)   NOT NULL DEFAULT '',
    password    varchar(32)     NOT NULL DEFAULT '',
    salt        varchar(32)     NOT NULL DEFAULT '',
    token       varchar(32)     NOT NULL DEFAULT '',
    role_id     integer         NOT NULL DEFAULT 0,
    admin       smallint        NOT NULL DEFAULT 0,
    status      smallint        NOT NULL DEFAULT 0
);


CREATE TABLE role
(
    id 		serial 		NOT NULL PRIMARY KEY,
    name        varchar(512) 	NOT NULL DEFAULT ''
);

CREATE TABLE role_privilege
(
    role_id         integer NOT NULL DEFAULT 0,
    privilege_id    integer NOT NULL DEFAULT 0
);

CREATE TABLE privilege
(
    id 		serial 		NOT NULL PRIMARY KEY,
    name        varchar(512) 	NOT NULL DEFAULT '',
    tag         varchar(512) 	NOT NULL DEFAULT ''
);

insert into privilege (name, tag) VALUES 
('Редактировать каталог', 'edit_catalog'), 
('Редактирование пользователей','edit_users');