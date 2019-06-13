Requete Sql permettant d afficher les tables


CREATE TABLE `Infos` (
       `Id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
       `Pseudo` varchar(250) ,
       `Email` varchar(250) ,
       `Mdp` varchar(250),
       `Score_total` INT NOT NULL);
//INSERT INTO Infos (Pseudo, Email, Mdp, Score_total) VALUES('Bite','bite@gmail.com', 'test', '123')


CREATE TABLE `Jeu` (
       `Id_jeu`  INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
       `Id_joueur` INT NOT NULL,
       `T_reponse` INT NOT NULL,
       `R_carre_estime` DECIMAL(10,2) NOT NULL,
       `R_carre_Reel` DECIMAL(10,2) NOT NULL,
       `Marge_erreur`DECIMAL(10,2) NOT NULL,
       `T_jeu` INT NOT NULL,
       FOREIGN KEY (Id_joueur) REFERENCES Infos(Id));


CREATE TABLE `Connexion` (
        `Id_conn` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `nb_conn` INT NOT NULL,
       `date_conn` INT NOT NULL,
       `T_jeu_total` INT NOT NULL,
       FOREIGN KEY (Id_conn) REFERENCES Jeu(Id_jeu));

