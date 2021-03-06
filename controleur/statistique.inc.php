<?php
    if(!isset($_GET["action"])) //Si aucune action n'a été demander, alors on affiche la page d'acceuil des statistiques
    {
        include("vue/statistique.inc.php");
    }
    else
    {
        switch($_GET["action"]) //suivant l'action à réaliser,
        {
            //STATISTIQUES PAR REGION
            case 'statRegion':
                $_GET['page'] = 'statRegion';
                include("vue/statistique.inc.php");
				$lesRegions = Region::allRegion();
                include("vue/region.inc.php");
				break;
            case 'statRegionVisiteur':
                $_GET['page'] = 'statRegion';
                include("vue/statistique.inc.php");
                include("vue/v_rechercheVisiteur.inc.php");
                if(isset($_GET['region']))
                {
                    if(isset($_POST['dateDebut']) && isset($_POST['dateFin']))
                    {
                        $jourDebut=substr($_POST['dateDebut'], -2, 2);
                        $moisDebut=substr($_POST['dateDebut'], -5, 2);
                        $anneeDebut=substr($_POST['dateDebut'], -10, 4);
                        //$dateDebut=new Date($jourDebut, $moisDebut, $anneeDebut);
                        $dateDebut=Date::afficher($jourDebut, $moisDebut, $anneeDebut);
                        $jourFin=substr($_POST['dateFin'], -2, 2);
                        $moisFin=substr($_POST['dateFin'], -5, 2);
                        $anneeFin=substr($_POST['dateFin'], -10, 4);
                        //$dateFin=new Date($jourFin, $moisFin, $anneeFin);
                        $dateFin=Date::afficher($jourFin, $moisFin, $anneeFin);
                        $lesVisiteurs=Visiteur::rechercheParDate($_GET['region'], $dateDebut, $dateFin);
                        var_dump($lesVisiteurs);
                    }
                    else
                    {
                        $lesVisiteurs=Visiteur::getAllVisiteurs($_GET['region']);
                    }
                    include("vue/visiteurRegion.inc.php");
                }
				break;

            //AFFICHAGE DES DELEGUES
            case 'delegues':
                $_GET['page'] = 'delegues';
                include("vue/statistique.inc.php");
				$lesDeleg=Visiteur::getDelegues();
                include("vue/v_visiteur.inc.php");
				break;

            //STATISTIQUES PAR SECTEURS
            case 'statSecteur':
                $_GET['page'] = 'statSecteur';
                include("vue/statistique.inc.php");
                $lesStatsSecteurs=Secteur::getAllNbVisiteurs();
                include("vue/secteur.inc.php");
				break;
        }
    }
?>
