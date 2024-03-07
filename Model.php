<?php

class Model
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function enregistrerUtilisateur($nom, $prenom, $email, $idBillet)
    {
        $stmt = $this->db->prepare("INSERT INTO utilisateurs (Nom, Prenom, mail, idBillet) VALUES (?, ?, ?, ?)");

        if ($stmt === false) {
            die("Erreur de préparation de la requête pour enregistrer l'utilisateur : " . $this->db->errorInfo()[2]);
        }

        $stmt->bindParam(1, $nom);
        $stmt->bindParam(2, $prenom);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $idBillet);

        if ($stmt->execute() === false) {
            die("Erreur lors de l'exécution de la requête pour enregistrer l'utilisateur : " . $stmt->errorInfo()[2]);
        }

        $stmt->closeCursor();
    }

    public function enregistrerBillet($dateVisite, $heureVisite, $nombrePersonnes)
    {
        $stmt = $this->db->prepare("INSERT INTO Billets (dateVisite, HeureVisite, NbPersonne) VALUES (?, ?, ?)");

        if ($stmt === false) {
            die("Erreur de préparation de la requête pour enregistrer le billet : " . $this->db->errorInfo()[2]);
        }

        $stmt->bindParam(1, $dateVisite);
        $stmt->bindParam(2, $heureVisite);
        $stmt->bindParam(3, $nombrePersonnes);

        if ($stmt->execute() === false) {
            die("Erreur lors de l'exécution de la requête pour enregistrer le billet : " . $stmt->errorInfo()[2]);
        }

        $idBillet = $this->db->lastInsertId();

        $stmt->closeCursor();

        return $idBillet;
    }

    public function associerBilletUtilisateur($idBillet, $nom, $prenom, $email)
    {
        $stmt = $this->db->prepare("UPDATE utilisateurs SET idBillet = ? WHERE Nom = ? AND Prenom = ? AND mail = ?");

        if ($stmt === false) {
            die("Erreur de préparation de la requête pour associer le billet à l'utilisateur : " . $this->db->errorInfo()[2]);
        }

        $stmt->bindParam(1, $idBillet);
        $stmt->bindParam(2, $nom);
        $stmt->bindParam(3, $prenom);
        $stmt->bindParam(4, $email);

        if ($stmt->execute() === false) {
            die("Erreur lors de l'exécution de la requête pour associer le billet à l'utilisateur : " . $stmt->errorInfo()[2]);
        }

        $stmt->closeCursor();
    }

    // Récupère les informations d'un billet en fonction de son ID
    public function getBilletById($idBillet) {
        $query = "SELECT * FROM Billets WHERE idBillet = :idBillet"; // Changement ici
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idBillet', $idBillet, PDO::PARAM_INT); // Changement ici
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupère les informations d'un utilisateur en fonction de l'ID du billet
    public function getUtilisateurByBilletId($idBillet) {
        $query = "SELECT * FROM utilisateurs WHERE idBillet = :idBillet"; // Changement ici
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idBillet', $idBillet, PDO::PARAM_INT); // Changement ici
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>