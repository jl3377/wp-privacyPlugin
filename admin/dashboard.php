<div class="container">

<div class="row">
        
        <div class="col-12">
        <h1 class="wp-heading-inline">Opciones de Privacidad</h1> 
        <h6><?php _e('Plugin para gestionar la privacida de su sitio web', 'artegrafico-lopdgdd'); ?></h6>
        </div>

        <div class="col-12">

        <hr />

        
        <ul class="tabMenu">
            <li class="tabLi tabDefault active"><span class="dashboard" onclick="openTab(event, 'dashboard')">Inicio</span></li>
            <li class="tabLi"><span class="options" onclick="openTab(event, 'options')">Opciones</span></li>            
            <li class="tabLi"><span class="who-am-i" onclick="openTab(event, 'who-am-i')">Who am i</span></li>   
        </ul>

        <div class="tabs">
            <div id="dashboard" class="tabContent">
                <h3>Inicio</h3>
                <p>Desde aquí podrá activar el aviso de privacidad que se mostrará a los usuarios que naveguen por su página web. <br />Podrá gestionar las siguientes opciones:</p>
                <p>
                + <?php _e('Mensaje por defecto que se mostrará', 'artegrafico-lopdgdd'); ?><br />
                + <?php _e('Mensaje ampliado.', 'artegrafico-lopdgdd'); ?><br />
                + <?php _e('URL donde será redireccionado si pulsa en más información', 'artegrafico-lopdgdd'); ?>                
                </p>
                
            </div>
            <div id="options" class="tabContent">
                <?php require_once( _PRIVACIDAD_DIR . 'admin/options.php' );  ?>               
            </div>
            <div id="who-am-i" class="tabContent">
                <?php require_once( _PRIVACIDAD_DIR . 'admin/who-am-i.php' );  ?>               
            </div>
        </div><!-- end tabs -->

        </div>

    </div>

<script>

/**
 * openTab 
 */
function openTab(evt, tab) {
    
    sessionStorage.setItem('tabPrivacidad', '.'+tab); 
  
    // find selectors and hide not selected
    tabContent = document.querySelectorAll(".tabContent");     
    for ( i=0; i<tabContent.length; i++) {
        tabContent[i].style.display = "none";
        tabContent[i].id === tab ? tabContent[i].style.display = "block" : tabContent[i].style.display = "none";
    }

    // remove active class from li
    tabLi = document.querySelectorAll('.tabMenu li span');
    for ( i=0; i<tabLi.length; i++) {
        if (tabLi[i] != tab) {
            tabLi[i].setAttribute('class', ''); }
    }
    // active tab
    evt.currentTarget.setAttribute('class', tab + ' active');
 
}

// selected tab opened
activeTab = sessionStorage.getItem("tabPrivacidad");
(activeTab) ? document.querySelector(".tabMenu "+activeTab).click() : document.querySelector(".tabMenu .dashboard").click();
</script>


</div>