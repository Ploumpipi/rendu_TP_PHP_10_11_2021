<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Page perso</title>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" type="image/x-icon" href="../images/.png"/>
		<link rel="stylesheet" type="text/css" href="../css/TP_10_11_2021.css">
	</head>
	<body>
		
        <?php
        include('connect_bd.php');
		$type = "admin";

        if($type =="admin"){
			

			$user = "SELECT prenom_prof,nom_prof,loginProf FROM profs WHERE loginProf='admin'";
			foreach($connexion->query($user) as $row){
				echo "<img src='../images/".$row['loginProf'].".png' alt='image de profil' height=100 width=75>";
				echo "<h1>Bienvenue ".$row['prenom_prof']." ".$row['nom_prof']."</h1>";
			}

			if(isset($_GET['notes']) && isset($_GET["idNote"])){
                $note = $_GET["notes"];
                $idNote = $_GET["idNote"];

                for($i=0; $i <sizeof($note); $i++){
                    $req="update notes
                    set valeur = :note
                    where id_note = :idNote";

                    $modele = $connexion -> prepare($req);
                    $modele-> bindValue('note', $note[$i]);
                    $modele-> bindValue('idNote', $idNote[$i]);
                    $modele -> execute();
                }
            }
            

			$notes="SELECT notes.matiere, notes.id_note, notes.valeur, prenom_etudiant, nom_etudiant, etudiants.id_etudiant, AVG(valeur) as moyenne
            FROM notes, etudiants
            WHERE notes.id_etudiant=etudiants.id_etudiant
            GROUP BY notes.matiere";
            echo '<form method="get" action="#">';
            echo '<table>';
            echo '<thead><td>Id étudiant</td><td>Nom étudiant</td><td>Prénom étudiant</td><td>Matière</td><td>Notes</td><td>Éditer</td></thead>';
            echo '<tbody>';
            $i=0;

            foreach($connexion->query($notes) as $row){
                echo '<tr>';
				echo '<td>'.$row['id_etudiant'].'</td>';
                echo '<td>'.$row['nom_etudiant'].'</td>';
				echo '<td>'.$row['prenom_etudiant'].'</td>';
                echo '<td>'.$row['matiere'].'</td>';
                echo '<td>'.$row['valeur'].'<input type="text" id="note'.$i.'" class ="notes" name="notes[]"disabled></input> </td>';
                echo '<td><input id="edit'.$i.'" name="idNote[]" class="edit" type="checkbox" value="'.$row['id_note'].'" onclick="edit(\'edit'.$i.'\', \'note'.$i.'\')"></input></td>';
                echo '</tr>';
                   $i++;
            }
                
                
                    
            echo '</tbody>';
            echo '</table>';
            echo '<input type="submit" value="modifier">
                </form>';

            echo "<h2> Moyennes des étudiants</h2>";
            echo '<table>';
            echo '<thead><td>Matière</td><td>Étudiant</td><td>Moyenne</td></thead>';
            foreach($connexion->query($notes) as $row){
                echo '<tr>';
                echo '<td>'.$row['matiere'].'</td>';
                echo '<td>'.$row['nom_etudiant'].' '.$row['prenom_etudiant'].'</td>';
                echo '<td>'.$row['moyenne'].' </td>';
            	echo '</tr>';
            }

            $moyenne="SELECT AVG(valeur) as moyenne
			FROM notes, etudiants
			WHERE notes.id_etudiant = etudiants.id_etudiant
			group by notes.id_etudiant";
			foreach($connexion->query($moyenne) as $row){
				echo '<tfoot>';
                echo '<td>Moyenne</td><td></td><td id="valMoy">'.$row['moyenne'].'</td>';
                echo '</tfoot>';
			}
            echo '</table>';
				
		}
        ?>
		<script src="../js/TP_10_11_2021.js"></script>
    </body>