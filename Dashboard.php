<?php
ob_start();
    session_start();
    if ($_SESSION['logged_in'] != true) {
        header('Location:login.php');
	    exit();
    }


    include 'DATA_connect.php';
    
    // Définir la date de début (6 mois auparavant)
    $dateDebut = date('Y-m-d', strtotime('-5 months'));
    
    // Initialiser le tableau de recettes par mois à 0
    $recettes = array();
    $moisCourant = date('F', strtotime('-5 months'));
    for ($i = 0; $i < 6; $i++) {
        $recettes[strtolower($moisCourant)] = 0;
        $moisCourant = date('F', strtotime($moisCourant . ' +1 month'));
    }

    
    // Sélectionner les achats des 6 derniers mois
    $req = mysqli_prepare($connex, "SELECT IDCli, IDvoit, Qte, Date FROM Achat WHERE Date >= ?");
    mysqli_stmt_bind_param($req, "s", $dateDebut);
    mysqli_stmt_execute($req);
    $resultat = mysqli_stmt_get_result($req);
    
    // Parcourir les résultats et calculer la recette pour chaque achat
    while ($achat = mysqli_fetch_assoc($resultat)) {
        // Récupérer le prix de la voiture correspondante
        $reqVoit = mysqli_prepare($connex, "SELECT Prix FROM Voiture WHERE IDvoit = ?");
        mysqli_stmt_bind_param($reqVoit, "s", $achat['IDvoit']);
        mysqli_stmt_execute($reqVoit);
        $resultatVoit = mysqli_stmt_get_result($reqVoit);
        
        if ($resultatVoit && mysqli_num_rows($resultatVoit) > 0) {
            $voiture = mysqli_fetch_assoc($resultatVoit);
            $recette = $voiture['Prix'] * $achat['Qte'];
            $mois = date('F', strtotime($achat['Date']));
            $recettes[strtolower($mois)] += $recette;
        }
    }
    
    // // Afficher le tableau de recettes
    // print_r($recettes);
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="BOOTSTRAP/bootstrap-offline-docs-5.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="Gestion bg-dark text-white ">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

        <ul class="Gest nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <span class="fs-4 mt-1"><p class="Titre h1 " >GESTION DE VENTE DE VOITURE</p></span>
        </ul>

        
        <form class=" col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 "  method="GET">
          <!-- <label class="col-sm-4 form-label"  for="RECHERCHE"><h6>RECHERCHE :</h6></label> -->
          <div class="recherche" >
          <input class="form-control" type="search" placeholder="          Tapez Ici !" name="Tapez_Ici" >
          
          <div class="actualiser" >
          <button class="Supp btn btn-primary icon-search " type = "submit" name = "recherche" ></button>
          <button id="actualiser" class="actualiser  btn btn-dark icon-refresh " type = "submit" name = "actualiser" ></button>
          </div>
          </div>  
        </form>
        </div>


      </div>
</div>

<main>

<div class="NAV d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <ul class="nav nav-pills flex-column mb-auto">
      <li><img src="Images/logo.png" class="GestionLogo rounded rounded-circle img-fluid " alt="Client" width="200" height="200"></li>
      <li >
        <a href="#" class="nav-link active " aria-current="page">
          <svg class="bi me-2 " width="16" height="16"><use xlink:href="#home"></use></svg>
          <span class="icon icon-bar-chart" ></span><span class="Titre" >    STATISTIQUE</span> 
        </a>
      </li>
      <li class="nav-item " >
        <a href="Affiche_Client.php" class="nav-link text-white ">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          <span class="icon-group"></span><span class="Titre" >    CLIENTS</span> 
        </a>
      </li>
      <li>
        <a href="Affiche_Voiture.php" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
          <span class="icon-truck"></span><span class="Titre" >    VOITURES</span> 
        </a>
      </li>
      <li>
        <a href="Affiche_Achat.php" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
          <span class="icon-shopping-cart"></span><span class="Titre" >    ACHATS</span> 
        </a>
      </li>
      <li>
        <a href="Facturation.php" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          <span class=" icon-list-alt"></span><span class="Titre" >    FACTURES</span> 
        </a>
      </li>
    </ul>
    <hr>
    <div class="btn">
      <a href="logout.php" class="d-flex align-items-center text-white text-decoration-none " id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <strong><span class="icon icon-signout" ></span class="Titre" >        Deconnexion</strong>
      </a>
      </div>
  </div>
<div class="ListeClient  p-2 text-dark bg-opacity-10 ">

<h2>Recette total accumulé par mois :</h2>  

<?php
include('Histogramme.php');
?>
    
<!-- <table class="table table-striped table-hover " style ="width:100%;" >
  <thead>
    <tr class="table-dark" >
      <th>Mois</th>
      <th>Recettes (Ariary)</th>
    </tr>
  </thead>
  <tbody>
    <?php setlocale(LC_TIME, 'fr_FR.utf8', 'fra'); // Définit la locale en français
    foreach ($recettes as $mois => $recette) { ?>
      <tr>
        <td><?= ucfirst(strftime('%B', strtotime("01-$mois-2023"))) ?></td>
        <td><?= number_format($recette, 2) ?> Ariary</td>
      </tr>
    <?php } ?>
  </tbody>
</table> -->
  
</div>

 
</main>
    
</body>
</html>