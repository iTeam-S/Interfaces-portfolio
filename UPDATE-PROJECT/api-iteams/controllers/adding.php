<?php
class ControllerAdd {

    public function membre(string $nom, string $prenom, string $prenom_usuel,
     string $user_github, string $tel1, string $tel2, string $mail, string $adresse) {
        if(!empty(trim($nom)) && !empty(trim($prenom)) && !empty(trim($prenom_usuel))
         && !empty(trim($user_github)) && !empty(trim($tel1)) && !empty(trim($mail))
         && !empty(trim($adresse))) {
            if(preg_match("#^([0-9 +]{12})$#", $tel1) && preg_match("#^([0-9 +]{12})$#", $tel2)){
                if(preg_match("#^[a-zA-Z0-9_+.-]+@[a-z]{2, 7}\.[a-z]{2, 4}#", $mail)) {
                    $infos=[
                        'nom' => strip_tags(ucwords($nom)),
                        'prenom' => strip_tags(ucwords($prenom)),
                        'prenom_usuel' => strip_tags(trim($prenom_usuel)),
                        'user_github' => strip_tags(trim($user_github)),
                        'tel1' => strip_tags(trim($tel1)),
                        'tel2' => strip_tags(trim($tel2)),
                        'mail' => strip_tags(trim($mail)),
                        'adresse' => strip_tags(trim($adresse))
                    ];
                    $add=new Membre();
                    $add->addMembre($infos);
                    unset($add);
                    echo '1';
                }
                else throw new Exception("erreur: adresse email invalide !");
            }
            else throw new Exception("Erreur: numéro télephone invalide !");
        } 
        else throw new Exception("Erreur: un des paramètres requis est vide 'add membre' !");
    }

    public function formations(string $lieu, string $annee, string $type,
     string $description, int $id_membre) {
        if(!empty(trim($lieu)) && !empty(trim($annee)) && !empty(trim($type))
         && !empty(trim($description)) && !empty(trim($id_membre))) {
            $infos=[
                'lieu' => strip_tags(trim($lieu)),
                'annee' => strip_tags(trim($annee)),
                'type' => strip_tags(trim($type)),
                'description' => strip_tags($description),
                'id_membre' => strip_tags(trim($description))
            ];
            $add=new Formations();
            $add->addFormations($infos);
            unset($add);
            echo '1';
        }
        else throw new Exception("Erreur: un des paramètres est vide pour 'add formations' !");        
    }

    public function fonction(int $id_membre, int $id_poste) {
        if(!empty((trim($id_membre))) && preg_match("#[1-7]#", trim($id_poste))) {
            $infos=[
                'id_membre' => strip_tags($id_membre),
                'id_poste' =>strip_tags(trim($id_poste))
            ];
            $add=new Fonction();
            $add->addFonction($infos);
            unset($add);
            echo '1';
        }
        else throw new Exception("Erreur: un des paramètres est vide pour 'add fonction' !");
    }

    public function experiences(string $nom, string $annee, string $type, 
     string $description, int $id_membre) {
        if(!empty(trim($nom)) && !empty(trim($annee)) && !empty(trim($type))
         && !empty(trim($id_membre))){
            $infos=[
                'nom' => strip_tags(trim($nom)),
                'annee' => strip_tags(trim($annee)),
                'type' => strip_tags(trim($type)),
                'description' => strip_tags($description),
                'id_membre' => strip_tags(trim($id_membre))
            ];
            $add=new Experiences();
            $add->addExperiences($infos);
            unset($add);
            echo '1';
        }
        else throw new Exception("Erreur: un des paramètres est vide pour 'add experiences' !");
    }
}
