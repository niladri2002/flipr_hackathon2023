
function playMusic(elem_id)
{
    var music_element = document.getElementById("playing_music");
    // let contentLink = elem_id.replace("view", "preview");
    // alert(contentLink)
    music_element.setAttribute("src", elem_id);
    
    var image = document.getElementById(elem_id).children[0].children[0];
    var image_src = image.getAttribute("src");
    var img_logo = document.getElementById("playing_music_img");
    img_logo.setAttribute("src", image_src);
    img_logo.style.opacity = 1;
    document.getElementById("playing_music_title").innerText = document.getElementById(elem_id).children[0].children[1].innerText;

}

function showAdminPanel()
{
    document.getElementById("podcast_panel").style.display = "none";
    document.getElementById("video_podcast_panel").style.display = "none";
    document.getElementById("admin_panel").style.display="block";
    
}
function showPodcastPanel()
{
    document.getElementById("admin_panel").style.display = "none";
    document.getElementById("video_podcast_panel").style.display = "none";
    document.getElementById("podcast_panel").style.display = "block";
    
}
function showVideoPodcastPanel()
{
    document.getElementById("admin_panel").style.display="none";
    document.getElementById("podcast_panel").style.display = "none";
    document.getElementById("video_podcast_panel").style.display = "block";
}