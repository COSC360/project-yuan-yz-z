create table users ( id int AUTO_INCREMENT, name varchar(100), email varchar(100), admin int, userName varchar(100), pass varchar(1000), primary KEY(id) );

create table thread ( id int AUTO_INCREMENT, userId int, authorName varchar(100), content varchar(100), title varchar(50), primary key (id), CONSTRAINT fk_users FOREIGN KEY (userId)
REFERENCES users(id)
ON DELETE CASCADE );

create table comment( id int AUTO_INCREMENT, userId int, authorName varchar(100), content varchar(100), threadId int(100), PRIMARY key(id), FOREIGN key (userId) REFERENCES users(id) on DELETE CASCADE, foreign key(threadId) REFERENCES thread(id) on DELETE CASCADE );

alter table users add profileImage blob;