<script type="text/javascript">

// Création d'une variable cpt_ pour chaque catégorie
<?php $i=0; $tab_cptr = array('gen','dvlpt','st','ev','rdm','vs');
foreach ($boards as $board)  {?>
    let cpt_<?php echo $tab_cptr[$i]?> = document.getElementsByClassName("id_topic <?php echo $board->board_name?>").length;
<?php $i++; } ?>

// Pagination

    // ALL
    // Afficher MAX 5 topics.
    let nbr_pages;
    if (<?php echo $nbr_lignes%5;?>==0){
        nbr_pages=parseInt(<?php echo ($nbr_lignes/5);?>);
    }
    else {
        nbr_pages=parseInt(<?php echo ($nbr_lignes/5)+1;?>);
    }
    
    <?php $diz=5;?>

    for (i=0;i<nbr_pages;i++){
        document.getElementsByClassName("btn "+i)[0].innerHTML= ++i;
        i--;
    }
    for (i=5;i< <?php echo ($nbr_lignes);?>; i++){
        document.getElementsByClassName("id_topic")[i].style.display = "none";
    }
    
    if (<?php echo ($nbr_lignes);?> < 5){
        for (i=0;i< <?php echo ($nbr_lignes);?>;i++){
            document.getElementsByClassName("id_topic")[i].style.display = "block";
        }
    }
    else {
        for (i=0;i<5;i++){
            document.getElementsByClassName("id_topic")[i].style.display = "block";
        }
    }

    // Afficher les 5 topics suivants
    let pages=document.getElementsByClassName("btn-secondary");
    let array = Array.from(pages);
    let array_length = array.length;

    if(array_length<2){
        document.getElementsByClassName("btn-toolbar")[0].style.display = "none";
    }

    array.forEach(element =>{
        
        element.addEventListener('click',()=>{

            let a_1 = (element.innerHTML*5)-5;
            let b = a_1+<?php echo ($nbr_lignes%5);?>;

            for (i=0;i< <?php echo ($nbr_lignes);?>; i++){
                document.getElementsByClassName("id_topic")[i].style.display = "none";
            }

            if (<?php echo $nbr_lignes%5;?> == 0){
                for (i=a_1;i<a_1+5;i++){
                    document.getElementsByClassName("id_topic")[i].style.display = "block";
                }
            }
            else if (element.innerHTML == array.length) {
                for (i=a_1;i<b;i++){
                    document.getElementsByClassName("id_topic")[i].style.display = "block";
                }     
            }
                else {
                    for (i=a_1;i<a_1+5;i++){
                    document.getElementsByClassName("id_topic")[i].style.display = "block";
                } 
                }
            
        })
    }
    );

// Cette partie concerne les onblets: General, Development, Small Talks, Events, Random et Top Secret.
<?php $nom_onglet=0;$num_onglet=6;$nom_cptr=0; foreach ($boards as $board){ $k=$board->board_name?>

    document.getElementsByClassName("<?php echo $tab_cptr[$nom_onglet]?>")[0].addEventListener("click", () => {
    
        //Cacher tous les articles
        <?php $i=0; foreach ($boards as $board) {?>
            for (j=0;j<cpt_<?php echo $tab_cptr[$i]?>;j++){
                document.getElementsByClassName("id_topic <?php echo $board->board_name?>")[j].style.display = "none";}
        <?php $i++; } ?>

        // Effacer les numéros de page
        let pages2=document.getElementsByClassName("btn-group");

        while (document.getElementsByClassName("btn-toolbar")[0].firstChild){
            document.getElementsByClassName("btn-toolbar")[0].removeChild(document.getElementsByClassName("btn-toolbar")[0].lastChild);
        }

        //Si l'onglet RANDOM est sélectionné
        if ("<?php echo $k;?>" == "Random"){

            if (cpt_rdm>5){
                for (j=0;j<5;j++){
                    document.getElementsByClassName("id_topic <?php echo $k?>")[j].style.display = "block";
                }
            }
            else {
                for (j=0;j<cpt_rdm;j++){
                    document.getElementsByClassName("id_topic <?php echo $k?>")[j].style.display = "block";
                }
            }
        }
        
        else if ("<?php echo $k;?>" == "Top Secret"){
            
            let ulr_actuelle = window.location.hash;
            console.log(ulr_actuelle);

        }

        //Si un des onglets restants est sélectionné
        else {
            // Afficher MAX 3 topics par onglet.
            if (cpt_<?php echo $tab_cptr[$nom_cptr]?>>3){for (j=0;j<3;j++){
                document.getElementsByClassName("id_topic <?php echo $k?>")[j].style.display = "block";
            }} 
            else {for (j=0;j<cpt_<?php echo $tab_cptr[$nom_cptr]?>;j++){
                document.getElementsByClassName("id_topic <?php echo $k?>")[j].style.display = "block";
            }}

            // Pagination

                // Afficher les numéros de page
                c = cpt_<?php echo $tab_cptr[$nom_cptr]?>/3;
                
                if (c>1){
                    for (i=0;i<c;i++){
                    document.getElementsByClassName("btn-toolbar")[0].appendChild(document.createElement('div'));
                    document.getElementsByClassName("btn-toolbar")[0].lastChild.setAttribute("class","btn-group mr-2");
                    document.getElementsByClassName("btn-toolbar")[0].lastChild.setAttribute("role","group");
                    document.getElementsByClassName("btn-toolbar")[0].lastChild.setAttribute("aria-label","First group");

                    document.getElementsByClassName("btn-group mr-2")[i].appendChild(document.createElement('button'));
                    document.getElementsByClassName("btn-group mr-2")[i].lastChild.setAttribute("type","button");
                    document.getElementsByClassName("btn-group mr-2")[i].lastChild.setAttribute("class","btn btn-secondary "+i);
                    document.getElementsByClassName("btn-group mr-2")[i].lastChild.innerHTML = ++i,
                    i--;  
                    }
                }

                // Afficher les articles de la page de la catégorie sélectionnée
                let array2 = Array.from(document.getElementsByClassName("btn-secondary"));


                array2.forEach(element =>{
            
                    element.addEventListener('click',()=>{

                        let a = (element.innerHTML*3)-3;
                        let b = a+cpt_<?php echo $tab_cptr[$nom_cptr];?>%3;

                        for (i=0;i< <?php echo ($nbr_lignes);?>; i++){
                            document.getElementsByClassName("id_topic")[i].style.display = "none";
                        }

                        if (a+3 <= cpt_<?php echo $tab_cptr[$nom_cptr]?>){
                            for (i=a;i<a+3;i++){
                                document.getElementsByClassName("id_topic <?php echo $k;?>")[i].style.display = "block";
                            }
                        }
                        else {
                            for (i=a;i<b;i++){
                                document.getElementsByClassName("id_topic <?php echo $k;?>")[i].style.display = "block";
                            }
                        }
                        
                    })
                }
                );

        }

        // Changer l'emplacement du contour bleu en fonction de l'onglet sélectionné
        for(l=5;l<=11;l++){
        document.getElementsByClassName("nav-link")[l].className="nav-link";
        }
        document.getElementsByClassName("nav-link")[<?php echo $num_onglet ?>].className="nav-link active";

    })

<?php $nom_onglet++;$num_onglet++;$nom_cptr++; } ?>


// Cette partie concerne uniquement l'onglet All.
document.getElementsByClassName("All")[0].addEventListener("click", () => {

    // Effacer les articles
    <?php $i=0; foreach ($boards as $board) {?>
            for (j=0;j<cpt_<?php echo $tab_cptr[$i]?>;j++){
                document.getElementsByClassName("id_topic <?php echo $board->board_name?>")[j].style.display = "none";}
        <?php $i++; } ?>

    // Effacer les numéros de page
            let pages2=document.getElementsByClassName("btn-group");

            while (document.getElementsByClassName("btn-toolbar")[0].firstChild){
                document.getElementsByClassName("btn-toolbar")[0].removeChild(document.getElementsByClassName("btn-toolbar")[0].lastChild);
            }
            
    // Afficher les numéros de page
    for (i=0;i< <?php echo ($nbr_lignes/5);?>;i++){
        document.getElementsByClassName("btn-toolbar")[0].appendChild(document.createElement('div'));
        document.getElementsByClassName("btn-toolbar")[0].lastChild.setAttribute("class","btn-group mr-2");
        document.getElementsByClassName("btn-toolbar")[0].lastChild.setAttribute("role","group");
        document.getElementsByClassName("btn-toolbar")[0].lastChild.setAttribute("aria-label","First group");

        document.getElementsByClassName("btn-group mr-2")[i].appendChild(document.createElement('button'));
        document.getElementsByClassName("btn-group mr-2")[i].lastChild.setAttribute("type","button");
        document.getElementsByClassName("btn-group mr-2")[i].lastChild.setAttribute("class","btn btn-secondary "+i);
        document.getElementsByClassName("btn-group mr-2")[i].lastChild.innerHTML = ++i,
        i--;
    }
    
    // Afficher MAX 5 topics.
    if (<?php echo ($nbr_lignes);?> < 5){
        for (i=0;i< <?php echo ($nbr_lignes);?>;i++){
            document.getElementsByClassName("id_topic")[i].style.display = "block";
        }
    }
    else {
        for (i=0;i<5;i++){
            document.getElementsByClassName("id_topic")[i].style.display = "block";
        }
    }
    // Afficher les 5 articles suivants
    let pages=document.getElementsByClassName("btn-secondary");
    let array = Array.from(pages);
    let array_length = array.length;

    if(array_length<2){
        document.getElementsByClassName("btn-toolbar")[0].style.display = "none";
    }

    array.forEach(element =>{
        
        element.addEventListener('click',()=>{

            let a_1 = (element.innerHTML*5)-5;
            let b = a_1+<?php echo ($nbr_lignes%5);?>;

            for (i=0;i< <?php echo ($nbr_lignes);?>; i++){
                document.getElementsByClassName("id_topic")[i].style.display = "none";
            }

            if (<?php echo $nbr_lignes%5;?> == 0){
                for (i=a_1;i<a_1+5;i++){
                    document.getElementsByClassName("id_topic")[i].style.display = "block";
                }
            }
            else if (element.innerHTML == array.length) {
                for (i=a_1;i<b;i++){
                    document.getElementsByClassName("id_topic")[i].style.display = "block";
                }     
            }
                else {
                    for (i=a_1;i<a_1+5;i++){
                    document.getElementsByClassName("id_topic")[i].style.display = "block";
                } 
                }
            
        })
    }
    );

    // Changer l'emplacement du contour bleu en fonction de l'onglet sélectionné
    for(j=5;j<=11;j++){
    document.getElementsByClassName("nav-link")[j].className="nav-link";
    }
    document.getElementsByClassName("nav-link")[5].className="nav-link active";

})

</script>