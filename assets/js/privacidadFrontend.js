// cookies
// https://stackoverflow.com/questions/10730362/get-cookie-by-name

deleteCookie = function(name)  {
   document.cookie = name+"=;max-age=-1";
}
deleteCookie("lopdgdd"); 
console.log(document.cookie)


/**
 * onload ... checkCookie() 
 */
window.onload = function () {
   checkCookie();
};

/**
 * checkCookie
 * @desc check if cookie exist and hide or show panel
 */
function checkCookie() {

   let lopdgdd = getCookie("lopdgdd");
   lopdgdd ? privacidadBar.style.display = "none" : privacidadBar.style.display = "block";

}

/**
 * setCookie
 * @desc set de cookie values and expire days
 * @param {*} name 
 * @param {*} value 
 * @param {*} days 
 */
function setCookie(name, value, days) {

   let fecha = new Date();
   fecha.setTime(fecha.getTime() + (days * 24 * 60 * 60 * 1000));

   let expires = "expires=" + fecha.toUTCString();
   let secure = "secure";
   let samesite = "samesite=strict"
   //console.log(expires);
   document.cookie = name + "=" + value + ';' + expires + ";" + secure + ";" + samesite;

}

/**
 * getCookie
 * @desc read cookie values
 * @param {*} name 
 */
function getCookie(name) {
   
   let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
   return  match ? decodeURIComponent(match[2]) : undefined;

}

/**
 * function privacidadAceptar
 */
function privacidadAceptar() {

   event.preventDefault();

   setCookie("lopdgdd", true, 180); // escribir la cookie  
   privacidadBar.style.display = "none";  // ocultamos el panel

}