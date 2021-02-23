create or replace database wsers2;
use wsers2;

create table ppl(
    ID_PERSON int NOT NULL AUTO_INCREMENT,
    first_name varchar(50),
    family_name varchar(50),
    age int(2),
    PRIMARY KEY (ID_PERSON),
)

INSERT INTO ppl(first_name,family_name,age)
VALUES (pepe, perez, 32)