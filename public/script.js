function getClientDate() {

	const d= new Date();
	const jours = new Array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
	const mois = new Array("Janvier","Février","Mars", "Avril","Mai","juin","Juillet","Aôut","Septembre","Octobre","Novembre","Décembre");

	return jours[d.getDay()] +" "+ d.getDate() +" "+ mois[d.getMonth()] +" "+ d.getFullYear();
}


function ValiderLeFormulaire() {
	let valide = true;
	document.getElementById("ErrCode").innerHTML ="";
	document.getElementById("ErrNom").innerHTML ="";
	document.getElementById("ErrPrenom").innerHTML ="";
	document.getElementById("ErrNote").innerHTML ="";


	if (document.myForm.Code.value==""){
		valide =false;
		document.getElementById("ErrCode").innerHTML="Le code est obligatoire";
	}
	if (document.myForm.Nom.value==""){
		valide =false;
		document.getElementById("ErrNom").innerHTML="Le nom est obligatoire";
	}
	if (document.myForm.Prenom.value==""){
		valide =false;
		document.getElementById("ErrPrenom").innerHTML="Le prénom est obligatoire";
	}
	if (document.myForm.Note.value==""){
		valide =false;
		document.getElementById("ErrNote").innerHTML="La note est obligatoire";
	}
	if (isNaN(document.myForm.Note.value)){
		valide =false;
		document.getElementById("ErrNote").innerHTML="La note doit être un nombre";
	}
	else if (eval(document.myForm.Note.value) <0 || eval(document.myForm.Note.value)> 20){
		valide =false;
		document.getElementById("ErrNote").innerHTML="La note doit être entre 0 et 20";
	}
	return valide;
}


window.addEventListener("DOMContentLoaded", function (event) {

	document.getElementById("LaDate").innerHTML =  getClientDate();

	document.myForm.addEventListener("submit", (event) => {
		if(!ValiderLeFormulaire()) event.preventDefault();
	});


});
