-- create a new table named "books"
-- column are "id", "title", "price", "quantity", "flag"
-- id is a primary key
-- title is a varchar(255)
-- price is a decimal(10,2)
-- quantity is an integer
-- flag is a boolean

create table books (
    id int not null auto_increment primary key,
    title varchar(255) not null,
    price decimal(10,2) not null,
    quantity int not null,
    flag boolean not null
);

-- insert a textbook
insert into books (title, price, quantity, flag) values ("The Art of Computer Programming", "329.99", "10", "0");

-- insert another textbook
insert into books (title, price, quantity, flag) values ("Computer Systems", "299.99", "5", "0");

-- insert final textbook
insert into books (title, price, quantity, flag) values ("Spanish", "199.99", "1", "1");