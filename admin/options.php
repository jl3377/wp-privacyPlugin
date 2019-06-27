<div class="container">

<div class="row">
        
        <div class="col-12"><hr />
        <!--<h3 class="wp-heading-inline">Opciones de Privacidad</h3>    -->
        </div>
    </div>

</div>

<!-- form -->
<form method="POST" action="options.php">       
    <?php settings_fields( 'aglopdgdd_content' );
    do_settings_sections( 'aglopdgdd_content' ); 
    submit_button(); ?>
</form> <!-- end form -->

<script>
/*
previa.addEventListener('click', (event) => {

    event.preventDefault();
    
    // modal window
    let div = document.createElement('div');
    div.id = "modalPrivacidad";
    privacidadForm.append(div);

    // modal content
    let divContent = document.createElement('div')
    divContent.setAttribute('class', "modalPrivacidadContent");
    div.append(divContent);

    // close button
    let close = document.createElement('span');
    close.setAttribute('class', 'modalPrivacidadClose');
    close.innerHTML = '&times;';
    divContent.append(close);

    // titulo
    let h2 = document.createElement('h2');
    h2.innerHTML = document.querySelector("#title").value;
    divContent.append(h2);

    // descripcion
    let p = document.createElement('p');
    p.innerHTML = document.querySelector('#description').value;
    divContent.append(p);

    // button
    let link = document.createElement('a');
    link.innerHTML = "Más información";
    //link.setAttribute('href', document.querySelector('#url').value);
    link.href = document.querySelector('#url').value;
    divContent.append(link);

    // close event
    close.addEventListener( 'click', () => {
        div.style.display = 'none';
    });     
    
});*/



</script>
<?php

//echo print_r($privacidad->debug());