create or replace database wsers2;
use wsers2;

create table PPL(
    ID_PERSON into NOT NULL auto_increment,
    LastName varchar(50),
    FirstName varchar(50),
    Age int NOT NULL,
    Username varchar(20) NOT NULL UNIQUE,
    Pswd varchar(100) NOT NULL,
    primary key (ID_PERSON)
)