function $(element){
	return document.querySelector(element);
}

document.querySelectorAll(".images img").forEach(image => {
	image.onclick = () => {
		document.querySelector("#popup-image").style.display="block";
		document.querySelector("#popup-image img").src=image.src;
	};
});

let navShowed = false;

$("#navbar-toggler").onclick = () => {
	if(navShowed == false){
		$("#navbar-content").style.left = "0";
		$("#navbar-toggler").textContent = "-";
	}else{
		$("#navbar-content").style.left = "100%";
		$("#navbar-toggler").textContent = "+";
	}
	navShowed = !navShowed;
};