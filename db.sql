CREATE TABLE GamePictures(
  GameID int,
  Description varchar(255),
  Path varchar(255),
  FOREIGN KEY (GameID) REFERENCES Game(GameID)
);
CREATE TABLE Game(
  GameID int,
  Name varchar(255),
  Creators varchar(255),
  UpVotes int,
  Description varchar(255),
  Year int,
  Download varchar(255),
  PRIMARY KEY(GameID)
);
CREATE TABLE Creator(
  CreatorID int,
  Name varchar(255),
  Games varchar(255),
  Description varchar(255),
  Github varchar(255),
  PRIMARY KEY (CreatorID)
);
/*this could have a 4th table but the project needs to be further along to determine this
