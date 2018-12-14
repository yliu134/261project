create table FOOD (
FID INT NOT NULL,
Fname VARCHAR(100) NOT NULL,
Fprice FLOAT NOT NULL,
Primary key (FID)
);

create table CUSTOMER (
CID INT NOT NULL,
Username VARCHAR(100) NOT NULL,
Pnum VARCHAR(100) NOT NULL,
Password VARCHAR(100) NOT NULL,
Primary key (CID)
);

create table DELIVERY_GROUP (
LocID INT NOT NULL,
Lname VARCHAR(100) NOT NULL,
Primary key (LocID)
);
create table ORDERS (
Onum INT NOT NULL,
Time DATETIME NOT NULL,
Addr TEXT NOT NULL,
CID INT NOT NULL,
LocID INT NOT NULL,
Primary key (Onum),
foreign key (LocID) references DELIVERY_GROUP(LocID)
ON DELETE RESTRICT
on update RESTRICT
,
foreign key (CID) references CUSTOMER(CID)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
create table ITEM (
Onum INT NOT NULL,
FID INT NOT NULL,
Quantity INT NOT NULL,
foreign key (Onum) references ORDERS(Onum)
on delete CASCADE
ON UPDATE CASCADE  ,
foreign key (FID) references FOOD(FID)
ON DELETE RESTRICT
ON UPDATE RESTRICT ,
Primary key (Onum, FID)
);
