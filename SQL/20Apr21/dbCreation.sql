drop database wsers2;

create database wsers2;
use wsers2;

Create table COUNTRIES (
    C_ID int not null AUTO_INCREMENT,
    C_Name varchar(50) UNIQUE,
    C_Population number(12),
    primary key (C_ID)
);

CREATE TABLE PEOPLE (
    P_ID int NOT NULL AUTO_INCREMENT,
    LName varchar(50),
    FName varchar(50),
    UsrName varchar(20) NOT NULL UNIQUE,
    Psw varchar(100) NOT NULL,
    primary key (P_ID),
    C_ID int not null,
    foreign key (C_ID) references COUNTRIES(C_ID)
);

CREATE TABLE PRODUCTS(
    Pr_ID int not null AUTO_INCREMENT,
    Pr_Name varchar(50),
    Pr_Price int,
    Pr_ItemsInStock int,
    primary key (Pr_ID)
)

Insert into COUNTRIES(CountryName) values ("Luxembourg");