<?php

class Model
{
    private $api_url;

    public function __construct($api_url)
    {
        $this->api_url = $api_url;
    }

    // Enregistrer une réservation via l'API
    public function enregistrerResa($nom, $prenom, $mail, $dateVisite, $HeureVisite, $NbPersonne)
    {
        $data = http_build_query(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'mail' => $mail,
            'dateVisite' => $dateVisite,
            'HeureVisite' => $HeureVisite,
            'NbPersonne' => $NbPersonne // J'ai ajusté le nom de la clé pour correspondre à ce que votre API attend
        ));

        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $data
            )
        );

        $context = stream_context_create($options);
        $result = file_get_contents($this->api_url, false, $context);

        return $result;
    }

    public function getResaById($id)
    {
        // Construire l'URL de l'API avec l'ID de la réservation
        $url = $this->api_url . '?id=' . $id;
    
        // Tenter d'effectuer la requête à l'API
        $result = file_get_contents($url);
    
        // Vérifier si la requête a réussi
        if ($result === false) {
            // La requête a échoué, retourner false ou une valeur indiquant une erreur
            return false;
        }
    
        // La requête a réussi, décoder le résultat JSON
        $reservation = json_decode($result, true);
    
        // Vérifier si le décodage JSON a réussi
        if ($reservation === null) {
            // Le décodage JSON a échoué, retourner false ou une valeur indiquant une erreur
            return false;
        }
    
        // La requête et le décodage JSON ont réussi, retourner les informations de la réservation
        return $reservation;
    }
}
