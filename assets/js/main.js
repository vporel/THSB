function $(element){
	return document.querySelector(element);
}

document.querySelectorAll(".images img").forEach(image => {
	image.onclick = () => {
		document.querySelector("#popup-image").style.display="block";
		document.querySelector("#popup-image img").src=image.src;
	};
});

let INFO_TYPE = null;
let ELEMENT_SELECTOR = null;
function modifierInfoMairie(infoType, elementSelector){
	INFO_TYPE = infoType;
	ELEMENT_SELECTOR = elementSelector;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			$("#modifier-info-mairie-box #form").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "admin/modifier-info-mairie.php?infoType="+infoType+"&GET_INPUT_CODE", true);
	//xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	//let data = "repositoryClass='.str_replace("\\", "\\\\", $this->repositoryClass).'"; 
	//xhttp.send(data);
	xhttp.send();
	$("#modifier-info-mairie-box #info").textContent = infoType.toUpperCase();
	$("#modifier-info-mairie-box").style.visibility = "visible";
}

function enregistrerInfoMairie(){
	if(INFO_TYPE != null && ELEMENT_SELECTOR != null){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				$(ELEMENT_SELECTOR).innerHTML = this.responseText;
				$("#modifier-info-mairie-box").style.visibility = "hidden";
			}
		};
		xhttp.open("POST", "admin/modifier-info-mairie.php?infoType="+INFO_TYPE+"&AJAX_POST", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		let data = "info-valeur="+$("#modifier-info-mairie-box #info-valeur").value; 
		xhttp.send(data);
	}
}