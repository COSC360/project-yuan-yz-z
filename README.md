Project descriptions and details

Description:
We are doing the Discussion forum website.
This website would allow registered users to create and interact with other discussion threads. Unregistered users can only view available information.
Furthermore, there are functionalities to search for certain information on the site, and users can change settings of their profiles. Users can also delete their only posts.
There will also be users with admin permission level who can delete any discussion posts.

Functional requirements of the project:
Browse discussions as visitors
Search for items/posts by keyword without registering
Register with name, e-mail and image
Login using user id and password
Registered users are able to comment
view/edit their profile
password recovery via email
Search for user by name, email or post as admin
Enable/disable users as admin
Edit/delete posts/comments as admin
Post discussion threads
Alert on successful posting and comments on current discussion threads
Collapsible discussion threads

Technical requirements outlined in project info for the deliverable:
Hand-styled layout with contextual menus (i.e. when user has logged on to site, menus reflect change). Layout frameworks are not permitted other than Bootstrap (see above).
2 or 3 column layout using appropriate design principles (i.e. highlighting nav links when hovered over, etc) responsive design
Form validation with JavaScript
Server-side scripting with PHP
Data storage in MySQL
Appropriate security for data
Site must maintain state (user state being logged on, etc)
Responsive design philosophy (minimum requirements for different non-mobile display sizes)
AJAX (or similar) utilization for asynchronous updates (meaning that if a discussion thread is updated, another user who is viewing the same thread will not have to refresh the page to see the update)
User images (thumbnail) and profile stored in database
Simple discussion (topics) grouping and display
Navigation breadcrumb strategy (i.e. user can determine where they are in threads)
Error handling (bad navigation)
Beautiful styling

mysql stuff

create table users (
id int AUTO_INCREMENT,
name varchar(100),
email varchar(100),
admin int,
userName varchar(100),
pass varchar(1000),
primary KEY(id)
);

create table thread (
id int AUTO_INCREMENT,
userId int,
authorName varchar(100),
content varchar(100),
title varchar(50),
primary key (id),
CONSTRAINT fk_users FOREIGN KEY (userId)  
 REFERENCES users(id)  
 ON DELETE CASCADE
);
