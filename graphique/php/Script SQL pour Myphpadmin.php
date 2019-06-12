Requete Sql permettant d afficher les tables


CREATE TABLE `Infos` (
       `Id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
       `Pseudo` INT NOT NULL,
       `Email` INT NOT NULL,
       `Mdp` INT NOT NULL,
       `Score_total` INT NOT NULL);


CREATE TABLE `Jeu` (
       `Id_jeu` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
       `T_réponse` INT NOT NULL,
       `R²estimé` INT NOT NULL,
       `R²Réel` INT NOT NULL,
       `Marge_erreur`INT NOT NULL,
       `T_jeu` INT NOT NULL,
       FOREIGN KEY (Id_jeu) REFERENCES Infos(Id));


CREATE TABLE `Connexion` (
        `Id_conn` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `nb_conn` INT NOT NULL,
       `date_conn` INT NOT NULL,
       `T_jeu_total` INT NOT NULL,
       FOREIGN KEY (Id_conn) REFERENCES Jeu(Id_jeu));

