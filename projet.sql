
CREATE TABLE membre (
  id_membre int(5) NOT NULL auto_increment,
  pseudo varchar(15) NOT NULL,
  -mdp varchar(255) NOT NULL,
  nom varchar(50) NOT NULL,
  prenom varchar(50) NOT NULL,
  -email varchar(50) NOT NULL,
  ville varchar(20) NOT NULL,
  cp INTEGER NOT NULL,
  adresse text NOT NULL,
  statut int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY  (id_membre),
  UNIQUE KEY pseudo (pseudo)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;


CREATE TABLE animal(
  id_animal int(5) NOT NULL auto_increment,
  membre_id int(5) NOT NULL,
  prenom varchar(20) NOT NULL,
  espece enum('chien','chat') NOT NULL,
  couleur varchar(20) NOT NULL,
  age INTEGER NOT NULL,
  sexe enum('f','m') NOT NULL,
  photo VARCHAR(255) NULL,
  description TEXT NOT NULL,
  PRIMARY KEY (id_animal),
  KEY membre_id (membre_id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1 ;


CREATE TABLE produit(
  id_produit int(5) NOT NULL auto_increment,
  reference int(15) NOT NULL, 
  titre varchar(50) NOT NULL,
  categorie varchar(50) NOT NULL,
  description TEXT NOT NULL,
  photo varchar(255) NOT NULL,
  prix double(7,2) NOT NULL,
  origine_site varchar (255) NOT NULL,
  PRIMARY KEY (id_produit),
  UNIQUE KEY (reference)
)ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

CREATE TABLE specialiste(
  id_specialiste int(5) NOT NULL auto_increment,
  nom varchar(50) NOT NULL,
  prenom varchar(50) NOT NULL,
  profession varchar(50) NOT NULL,
  telephone varchar(20) NOT NULL,
  email varchar(50) NOT NULL,
  adresse TEXT NOT NULL,
  ville varchar(50) NOT NULL,
  cp INTEGER NOT NULL,
  PRIMARY KEY (id_specialiste)
)ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

CREATE TABLE association(
  id_association int(5) NOT NULL auto_increment,
  nom varchar (250) NOT NULL,
  animal_concerne enum('chien','chat') NOT NULL,
  telephone varchar(20)  NOT NULL,
  email varchar(50) NOT NULL,
  adresse TEXT NOT NULL,
  ville varchar (50) NOT NULL,
  cp INTEGER NOT NULL,
  service varchar(250) NOT NULL,
  description TEXT NOT NULL,
  PRIMARY KEY (id_association)
)ENGINE=InnoDB DEFAULT CHARSET=latin1 ;
-- a voir pour ajouter un carnet de santé avec 

Create Table carnet_sante(
  id_carnet int(5) NOT NULL auto_increment,
  animal_id int(5) NOT NULL,
  PRIMARY KEY (id_qrc),
  KEY animal_id (animal_id),
)ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

--lien one to many avec carnet_sante
Create table Visite_medical(
  id_visite int(5) NOT NULL AUTO_INCREMENT,
  date_visite date NOT NULL,
  description text NUll,
  diagnostique text NULL,
  analyses text NULL,
  specialiste_id int(5) NOT NULL,
  carnet_id int(5) NOT NULL,
  PRIMARY KEY (id_visite),
  KEY specialiste_id (specialiste_id),
  KEY specialiste_id (carnet_id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1 ;


Create table antecedent_medical(
  id_antecedent int(5) NOT NULL AUTO_INCREMENT,
  nom varchar(250) NOT NULL,
  description text NULL,
  carnet_id int(5) NOT NULL,
  PRIMARY KEY (id_visite),
  KEY carnet_id (carnet_id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

