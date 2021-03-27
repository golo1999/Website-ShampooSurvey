<?php
    $nume=$prenume=$raspuns1=$raspuns3=$raspuns4=$raspuns5=$opinie="";
    $contorDatePersonale=0;
    $raspuns2=array();
    $frecventa=array("O dată pe săptămână", "De două ori pe săptămână", "De trei ori pe săptămână", "O dată la două săptămâni");
    $categorieVarsta=array("Sub 18 ani", "Între 18 și 30 de ani", "Între 30 și 50 de ani", "Peste 50 de ani");
    $intrebariChestionar=array("Ce șampon folosiți în mod regulat?", "Ce vă determină să cumpărați acest șampon?", "Ce apreciați cel mai mult la șamponul pe care îl cumpărați?", "Cât de frecvent folosiți șamponul?", "În ce categorie de vârstă vă încadrați?", "Exprimați mai jos câteva opinii personale cu privire la marca de șampon utilizată");
    $titluChestionar="Chestionar marcă șampon favorită";
    $titluPagina="Shampoo Survey";
    $anRealizarePagina="2020";
    $numeStudent="Gologan George-Alexandru";
    $emailStudent="getrightnip12@gmail.com";
    $datePersonale=array("Nume", "Prenume");
    $intrebare1Raspunsuri=array("Pantene", "Elseve", "Dove", "Londa", "Wella");
    $intrebare2Raspunsuri=array("Reclama", "Prețul", "Ambalajul", "Marca", "Disponibilitatea");
    $intrebare3Raspunsuri=array("Mirosul", "Calitatea", "Timpul de efect");
    
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if(isset($_POST["nume"]))
        {
            $nume=trim($_POST["nume"]);
            $contorDatePersonale++;
        }
        if(isset($_POST["prenume"]))
        {
            $prenume=trim($_POST["prenume"]);
            $contorDatePersonale++;
        }
        if(isset($_POST["raspuns1"]))
        {
            $raspuns1=strtoupper(substr($_POST["raspuns1"], 0, 1)).substr($_POST["raspuns1"], 1);
            $contorDatePersonale++;
        }
        if(!empty($_POST["raspuns2"]))
        {
            foreach($_POST["raspuns2"] as $raspuns)
                array_push($raspuns2, strtoupper(substr($raspuns, 0, 1)).substr($raspuns, 1));
            $contorDatePersonale++;
        }
        if(isset($_POST["raspuns3"]))
        {
            $raspuns3=strtoupper(substr($_POST["raspuns3"], 0, 1)).substr($_POST["raspuns3"], 1);
            $contorDatePersonale++;
        }
        if(isset($_POST["frecventa"]))
        {
            switch($_POST["frecventa"])
            {
                case "raspuns4_1":
                    $raspuns4=$frecventa[0];
                    break;
                case "raspuns4_2":
                    $raspuns4=$frecventa[1];
                    break;
                case "raspuns4_3":
                    $raspuns4=$frecventa[2];
                    break;
                case "raspuns4_4":
                    $raspuns4=$frecventa[3];
                    break;
            }
        }
        if(isset($_POST["categorie_varsta"]))
        {
            switch($_POST["categorie_varsta"])
            {
                case "raspuns5_1":
                    $raspuns5=$categorieVarsta[0];
                    break;
                case "raspuns5_2":
                    $raspuns5=$categorieVarsta[1];
                    break;
                case "raspuns5_3":
                    $raspuns5=$categorieVarsta[2];
                    break;
                case "raspuns5_4":
                    $raspuns5=$categorieVarsta[3];
                    break;
            }
        }
        if(isset($_POST["opinie"]))
            $opinie=trim($_POST["opinie"]);

        if($contorDatePersonale==5)
        {
            $raspunsuri=array($raspuns1, $raspuns3, $raspuns4, $raspuns5, $opinie);
            trimitereEmail($nume, $prenume, $intrebariChestionar, $raspunsuri, $raspuns2, $titluChestionar, $emailStudent); 
        }  
    }

    function trimitereEmail($nume, $prenume, $intrebariChestionar, $raspunsuri, $raspunsuriIntrebare2, $titluChestionar, $emailStudent)
    {
        $emailDestinatar="server@yahoo.com";
        $contorRaspunsuriIntrebare2=0;
        $headerEmail="From: $emailStudent";
        $trimisCuSucces="Formularul a fost trimis cu succes!";

        $subiectEmail="Nume: $nume"."<br>"."Prenume: $prenume"."<br>"."$intrebariChestionar[0]: $raspunsuri[0]";
        $subiectEmail.="\r\n"."$intrebariChestionar[1]: ";
        foreach($raspunsuriIntrebare2 as $raspuns)
        {
            $contorRaspunsuriIntrebare2++;
            $subiectEmail.=$raspuns;
            if($contorRaspunsuriIntrebare2<count($raspunsuriIntrebare2))
                $subiectEmail.=", ";
        }
        $subiectEmail.="<br>"."$intrebariChestionar[2]: $raspunsuri[1]"."<br>"."$intrebariChestionar[3]: $raspunsuri[2]"."<br>"."$intrebariChestionar[4]: $raspunsuri[3]";
        if(trim($raspunsuri[4])!=='')
            $subiectEmail.="<br>"."$intrebariChestionar[5]: $raspunsuri[4]";
        
            mail($emailDestinatar, $titluChestionar, $subiectEmail, $headerEmail);
            echo "<script> alert('$trimisCuSucces'); </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $titluPagina; ?> </title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Peddana&display=swap" rel="stylesheet">

</head>
<body>
    <div class="form_container">
        <div class="form_title">
            <h1> <?php echo $titluChestionar; ?> </h1>
        </div>
        <div class="form_body" id="form_body">
            <form method="POST">
                <div class="date_personale">
                    <div class="nume nume_stanga">
                        <div class="nume_container" id="nume_container_1">
                            <label for="nume"> <?php echo $datePersonale[0]; ?> </label>
                            <input type="text" name="nume" id="nume">
                        </div>
                    </div>
                    <div class="nume nume_dreapta">         
                        <div class="nume_container" id="nume_container_2">
                            <label for="prenume"> <?php echo $datePersonale[1]; ?> </label>
                            <input type="text" name="prenume" id="prenume">
                        </div>
                    </div>  
                </div>
                <div class="intrebare intrebare1">
                    <label for="intrebare1"> <?php echo $intrebariChestionar[0]; ?> </label>
                    <div class="raspunsuri1">
                        <input type="radio" name="raspuns1" id="pantene" value="pantene">
                        <label for="pantene"> <?php echo $intrebare1Raspunsuri[0]; ?> </label>
                        <input type="radio" name="raspuns1" id="elseve" value="elseve">
                        <label for="elseve"> <?php echo $intrebare1Raspunsuri[1]; ?> </label>
                        <input type="radio" name="raspuns1" id="dove" value="dove">
                        <label for="dove"> <?php echo $intrebare1Raspunsuri[2]; ?> </label>
                        <input type="radio" name="raspuns1" id="londa" value="londa">
                        <label for="londa"> <?php echo $intrebare1Raspunsuri[3]; ?> </label>
                        <input type="radio" name="raspuns1" id="wella" value="wella">
                        <label for="wella"> <?php echo $intrebare1Raspunsuri[4]; ?> </label>
                    </div> 
                </div>
                <div class="intrebare intrebare2">       
                    <label for="intrebare2"> <?php echo $intrebariChestionar[1]; ?> </label>
                    <div class="raspunsuri2">
                        <input type="checkbox" name="raspuns2[]" id="reclama" value="reclama">
                        <label for="reclama"> <?php echo $intrebare2Raspunsuri[0]; ?> </label>
                        <input type="checkbox" name="raspuns2[]" id="pret" value="prețul">
                        <label for="pret"> <?php echo $intrebare2Raspunsuri[1]; ?> </label>
                        <input type="checkbox" name="raspuns2[]" id="ambalaj" value="ambalajul">
                        <label for="ambalaj"> <?php echo $intrebare2Raspunsuri[2]; ?> </label>
                        <input type="checkbox" name="raspuns2[]" id="marca" value="marca">
                        <label for="marca"> <?php echo $intrebare2Raspunsuri[3]; ?> </label>
                        <input type="checkbox" name="raspuns2[]" id="disponibilitate" value="disponibilitatea">
                        <label for="disponibilitate"> <?php echo $intrebare2Raspunsuri[4]; ?> </label>
                    </div> 
                </div>
                <div class="intrebare intrebare3">
                    <label for="intrebare3"> <?php echo $intrebariChestionar[2]; ?> </label>
                    <div class="raspunsuri3">
                        <input type="radio" name="raspuns3" id="miros" value="mirosul">
                        <label for="miros"> <?php echo $intrebare3Raspunsuri[0]; ?> </label>
                        <input type="radio" name="raspuns3" id="calitate" value="calitatea">
                        <label for="calitate"> <?php echo $intrebare3Raspunsuri[1]; ?> </label>
                        <input type="radio" name="raspuns3" id="timp_efect" value="timpul de efect">
                        <label for="timp_efect"> <?php echo $intrebare3Raspunsuri[2]; ?> </label>
                    </div> 
                </div>
                <div class="intrebare intrebare4">
                    <label for="frecventa"> <?php echo $intrebariChestionar[3]; ?> </label>
                    <div class="raspunsuri4">
                        <select name="frecventa" id="frecventa">
                            <option value="raspuns4_1"> <?php echo $frecventa[0]; ?> </option>
                            <option value="raspuns4_2"> <?php echo $frecventa[1]; ?> </option>
                            <option value="raspuns4_3"> <?php echo $frecventa[2]; ?> </option>
                            <option value="raspuns4_4"> <?php echo $frecventa[3]; ?> </option>
                        </select>
                    </div>
                </div>
                <div class="intrebare intrebare5">   
                    <label for="categorie_varsta"> <?php echo $intrebariChestionar[4]; ?> </label>
                    <div class="raspunsuri5">
                        <select name="categorie_varsta" id="categorie_varsta">
                            <option value="raspuns5_1"> <?php echo $categorieVarsta[0]; ?> </option>
                            <option value="raspuns5_2"> <?php echo $categorieVarsta[1]; ?> </option>
                            <option value="raspuns5_3"> <?php echo $categorieVarsta[2]; ?> </option>
                            <option value="raspuns5_4"> <?php echo $categorieVarsta[3]; ?> </option>
                        </select>
                    </div>
                </div>
                <div class="intrebare intrebare6">
                    <label for="opinie"> <?php echo $intrebariChestionar[5]; ?> </label>
                    <div>
                        <textarea name="opinie" id="opinie" cols="40" rows="5"></textarea>
                    </div>
                </div>
                <div class="submit_container">
                    <input type="submit" value="Trimitere" id="form_submit_button" class="input_submit">
                    <input type="reset" value="Resetare" id="form_reset_button" class="input_reset">
                </div>
            </form>
        </div>
        <div class='form_copyright'>
            <h6> &#169;<?php echo $anRealizarePagina; ?> <a href="https://www.facebook.com/georgealexandru.gologan.10/" target="_blank"> <?php echo $numeStudent; ?> </a></h6>
        </div>
    </div>
    <footer>
        <script src="js.js"></script>
    </footer>
</body>
</html>