<?php
ob_start();
    include("connection.php");

    include("fpdf/fpdf.php");

    $total = 0;

    if(isset($_GET["id"]))
    {
        $num = $_GET["id"];
        $requete2 = $bdd->query("SELECT Client.IDcli,Client.Nom,Client.Contact,Voiture.Prix,Voiture.Design,Voiture.IDvoit,Achat.Qte,Achat.NumAchat,(Voiture.Prix*Achat.Qte) as montant 
                                FROM Client,Voiture,Achat 
                                WHERE (Client.IDcli=Achat.IDCli) AND (Achat.IDvoit=Voiture.IDvoit) AND (Achat.IDCli = '$num')");
        $donne2 = $requete2->fetchAll();
        


    }


    $pdf = new FPDF();

    $pdf->AddPage();
    $pdf->SetFont("arial","B",14);
    $pdf->Cell(110,10,utf8_decode("Facture N° ").$donne2[0]["NumAchat"],0,1,"R");
    $pdf->Cell(80,20,"Date : ".date("d - m - Y"),0,1,"L");
    $pdf->setXY(10,35);
    $pdf->Cell(80,20,"NOM : ".$donne2[0]["Nom"],0,0,"L");
    $pdf->setXY(10,35);
    $pdf->Cell(73,50,"Contact : ".$donne2[0]["Contact"],0,1,"R");
    
    // tableau
    $pdf->Cell(50,10,"ID voiture",1,0,"C");
    $pdf->Cell(50,10,"Design",1,0,"C");
    $pdf->Cell(30,10,"PU (Ar)",1,0,"C");
    $pdf->Cell(20,10,"Quantite",1,0,"C");
    $pdf->Cell(40,10,"Montant (Ar) ",1,1,"C");

    // contenu tab
    foreach ($donne2 as $value) {
        # code...
        $pdf->Cell(50,10,$value["IDvoit"],1,0,"C");
        $pdf->Cell(50,10,$value["Design"],1,0,"C");
        $pdf->Cell(30,10,$value["Prix"],1,0,"C");
        $pdf->Cell(20,10,$value["Qte"],1,0,"C");
        $pdf->Cell(40,10,$value["montant"],1,1,"C");

        $total += intval($value["montant"]); 
    }



    // contenu tab
    $pdf->Cell(50,10,"",0,0,"C");
    $pdf->Cell(50,10,"",0,0,"C");
    $pdf->Cell(30,10,"",0,0,"C");
    $pdf->Cell(20,10,"TOTAL",1,0,"C");
    $pdf->Cell(40,10,$total,1,1,"C");
    $pdf->setXY(100,225);
    $pdf->cell(80,50,utf8_decode("Arrêté par la présente facture à la somme de  ").$total." Ariary.",0,1,"R");

    

    $pdf->OutPut();


?>