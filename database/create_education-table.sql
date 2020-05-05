CREATE TABLE Education (
profile_id INTEGER,
institution_id INTEGER,
rank INTEGER,
year INTEGER,
CONSTRAINT education_ibfk_1
FOREIGN KEY (profile_id)
REFERENCES Profile (profile_id)
ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT education_ibfk_2
FOREIGN KEY (institution_id)
REFERENCES Institution (institution_id)
ON DELETE CASCADE ON UPDATE CASCADE,
PRIMARY KEY(profile_id, institution_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;