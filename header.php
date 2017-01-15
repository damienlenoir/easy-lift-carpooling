<div id="header">
	<a href="index.php"><img src="images/logo1.PNG" alt="logo" id="logoAnime"> </a>	
</div>
<SCRIPT type="text/javascript">
var images = new Array();
images.push("images/logo2.png");
images.push("images/logo3.png");
images.push("images/logo4.png");
images.push("images/logo5.png");
images.push("images/logo6.png");
images.push("images/logo7.png");
images.push("images/logo8.png");
images.push("images/logo9.png");
images.push("images/logo10.png");
images.push("images/logo11.png");
images.push("images/logo12.png");
images.push("images/logo13.png");
images.push("images/logo14.png");
images.push("images/logo15.png");
images.push("images/logo16.png");
images.push("images/logo17.png");
images.push("images/logo18.png");

var pointeur = 0;

function ChangerImage(){
document.getElementById("logoAnime").src = images[pointeur];
 
if(pointeur < images.length - 1){
pointeur++;
}
else{
pointeur = 0;
}
 
setTimeout("ChangerImage()", 50)
}

logoAnime.onmouseover = function(){
ChangerImage();
}
</SCRIPT>