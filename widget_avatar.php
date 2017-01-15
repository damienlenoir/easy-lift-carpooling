<div id="widget_avatar">
<?php
if(is_file("upload/".$id.".png"))
{
     
     echo '<img ID="avatar" src="upload/'.$id.'.png">';
     
}
else
{
     
     echo '<img ID="avatar" src="images/profil_defaut.jpg">';
     
}
?>

<button id="myBtn">Update</button>

<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <img ID="avatar" src="upload/<?php echo $id; ?>.png">
<form method="POST" action="upload.php" enctype="multipart/form-data">
     <input type="hidden" name="MAX_FILE_SIZE" value="100000">
     Upload New:  <input type="file" name="avatar">
     <input type="submit" name="envoyer" value="Go">
</form>
</div>
 </div>

</div>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>