function validareFormular()
{
    const numarPentruCareFormularulEsteValid=5;
    let numePersoana=document.getElementById("nume").value;
    let prenumePersoana=document.getElementById("prenume").value;
    let raspunsIntrebare1=document.getElementsByName("raspuns1");
    let raspunsIntrebare2=document.getElementsByName("raspuns2[]");
    let raspunsIntrebare3=document.getElementsByName("raspuns3");
    let contor=0;

    if(verificareNume(numePersoana))
        contor++;
    if(verificareNume(prenumePersoana))
        contor++;
    if(verificareButon(raspunsIntrebare1))
        contor++;
    if(verificareButon(raspunsIntrebare2))
        contor++;
    if(verificareButon(raspunsIntrebare3))
        contor++;

    if(contor==numarPentruCareFormularulEsteValid)
        document.getElementById("form_submit_button").submit();
    else if(contor==0)
        alert("Nu ati completat niciun camp");
    else alert("Nu ati completat toate campurile");
    return false;
}

function verificareNume(nume)
{
    let numeleEsteValid=true;
    nume=nume.trim();

    if(nume.length<2) // daca numele are lungimea mai mica decat 2 caractere
        numeleEsteValid=false;
    for(i=0; i<nume.length; i++)
        if(nume.charAt(i)<'A' || (nume.charAt(i)>'Z' && nume.charAt(i)<'a') || nume.charAt(i)>'z') // daca numele contine caractere ce nu sunt litere
        {
            numeleEsteValid=false;
            break;
        }
    if(nume.charAt(0)>='a' && nume.charAt(0)<='z') // daca primul caracter este litera mica
        numeleEsteValid=false;
    for(i=1; i<nume.length; i++)
        if(nume.charAt(i)>='A' && nume.charAt(i)<='Z') // daca vreun caracter in afara de primul este litera mare
        {
            numeleEsteValid=false;
            break;
        }
    return numeleEsteValid;
}

function verificareButon(raspuns)
{
    for(var i=0, length=raspuns.length; i<length; i++)
        if(raspuns[i].checked) // returnam true daca exista un buton selectat
            return true;
    return false;
}

document.getElementById("form_submit_button").onclick=validareFormular;