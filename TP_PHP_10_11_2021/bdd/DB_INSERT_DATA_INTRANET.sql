INSERT INTO PROFS(loginProf, matiere_cours, nom_prof, prenom_prof) VALUES
('prof1', 'Web', "Madembo", "Grace"),
('prof2', 'GameDesign', "Valentin", "Nicolas"),
('prof3', 'Algo', "Lehmann", "Nicolas"),
('prof4', 'Algo', "Hatton", "Jerome"),
('Admin', '', "Hatton", "Veronique");

INSERT INTO ETUDIANTS(loginEtudiant, nom_etudiant, prenom_etudiant) VALUES
('etud1', "Bohnert", "Alexandre"),
('etud2', "Eitel", "Hugo"),
('etud3', "LAG", "François"),
('etud4', "Eckle", "Elias");

INSERT INTO NOTES(matiere, valeur, id_etudiant) VALUES
('Web', 10, 1),
('GameDesign', 17, 1),
('Algo', 12, 1);