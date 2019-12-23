// Get the modal



var modalUP = document.getElementById("myModalUP");
var modalIN = document.getElementById("myModalIN");
var modalCookies = document.getElementById("myModalCookies");
var modalButton = document.getElementById("myModalButton");
checkAcceptCookies();

// Get the button that opens the modal
var siginIn = document.getElementById("signIn");
var signUp = document.getElementById("signUp");

// Get the <span> element that closes the modal
var spanUP = document.getElementsByClassName("close")[0];
var spanIN = document.getElementsByClassName("close")[1];

// When the user clicks the button, open the modal 
signUp.onclick = function() {
  modalUP.style.display = "block";
}

function login() {
  modalIN.style.display = 'block';
}

// When the user clicks on <span> (x), close the modal
spanUP.onclick = function() {
  modalUP.style.display = "none";
}

spanIN.onclick = function() {
  modalIN.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modalIN) {
    modalIN.style.display = "none";
  }
    if (event.target == modalUP) {
    modalUP.style.display = "none";
  }
}

modalButton.onclick = function() {
	window.localStorage.setItem("cookies", "ok");
	modalCookies.style.display = "none";
}

function checkAcceptCookies() {
	if(window.localStorage.getItem("cookies") != null)
		modalCookies.style.display = "none";
	else
		modalCookies.style.display = "block";
}
	