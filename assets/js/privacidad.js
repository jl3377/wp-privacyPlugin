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