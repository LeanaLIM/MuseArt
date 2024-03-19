<?php

/* class Model
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
        //sert à envoyer les données à l'API
        $result = file_get_contents($this->api_url, false, $context);

        $id = $this->api_url->lastInsertId();

        return array('result' => $result, 'id' => $id);
    }

    public function getResaById($id)
    {
        $data = http_build_query(array(
            'id' => $id
        ));

        $options = array(
            'http' => array(
                'method' => 'GET',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $data
            )
        );

        $context = stream_context_create($options);
        $result = file_get_contents($this->api_url, false, $context);

        return $result;
    } */

