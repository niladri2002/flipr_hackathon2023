<?php
require_once('db.php');

?>
<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="content_left.css">
    <link rel="stylesheet" href="content_right.css">
    <link rel="stylesheet" href="playing_misic_bar.css">
    <link rel="stylesheet" href="podcast_item.css">
    <link rel="stylesheet" href="upload.css">
    <title>Document</title>
</head>

<body>
    <header id="main_body">
        <div id="content_left">
            <div id="brand_logo">
                <img src="logo.png" alt="" id="logo_img">
                <br>
                <a class="nav-link" href="logout.php" id="log_out">Logout</a>
            </div>
            <div>

            </div>
            <div id="navbar">
                <ul>
                    <li onclick="showPodcastPanel()"><i class="bi-house-door"></i>Home</li>
                    <li><a href=""><i class="bi-music-note-list"></i>Listen</a></li>
                    <li onclick="showVideoPodcastPanel()"><a href=""><i class="bi-camera-reels"></i>Watch</a></li>
                    <li onclick="showAdminPanel()"><i class="bi-shield-fill-check"></i>Admin</li>
                    <li><a href=""><i class="bi-heart-fill"></i>Liked</a></li>
                </ul>
            </div>
        </div>
        <div class="content_right" id="podcast_panel">
            <div id="top_panel">
                <form class="d-flex">
                    <input class=" input-search" type="search"
                        placeholder="Listen music or watch video.." aria-label="Search"
                        style="height: 36px;font-size:14px;">
                    <button id="search-btn"><i class="bi bi-search"
                            style="color: rgb(0, 221, 255);font-size:20px;"></i></button>
                </form>
            </div>
            <div id="content_right_podcast">
                <?php

                    $table_name = "podcast"; 
                    $query = "select * from $table_name where type=1";
                    $result = mysqli_query($con, $query);

                    $i=0;
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                
                <button class="podcast_button" onclick="playMusic(this.id)" id="<?php echo $row['content']; ?>">
                    <div class="podcast_item" >
                        <img src="<?php echo $row['thumbnail']; ?>" alt="" class="podcast_img">
                        <h3 class="podcast_title"><?php echo $row['title']; ?></h3>
                        <p class="podcast_author"><?php echo $row['author']; ?></p>
                        <i class="bi-play-circle-fill podcast_play_icon"></i>
                    </div>
                </button>

                <?php
                $i=$i+1;
                }
                ?>
                
            </div>
        </div>




        <div class="content_right" id="video_podcast_panel">
            <div id="top_panel">
                <form class="d-flex">
                    <input class=" input-search" type="search"
                        placeholder="Listen music or watch video.." aria-label="Search"
                        style="height: 36px;font-size:14px;">
                    <button id="search-btn"><i class="bi bi-search"
                            style="color: rgb(0, 221, 255);font-size:20px;"></i></button>
                </form>
            </div>
            <div id="content_right_podcast">
                <?php

                    $table_name = "podcast"; 
                    $query = "select * from $table_name where type=2";
                    $result = mysqli_query($con, $query);

                    $i=0;
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                
                <button class="podcast_button" onclick="playVideo(this.id)" id="<?php echo $row['content']; ?>">
                    <div class="podcast_item" >
                    <iframe
                    class="podcast_img"
                            src="<?php echo $row['content']; ?>"
                            title=""
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                    ></iframe>


                    <!-- <img src="<?php echo $row['thumbnail']; ?>" alt="" class="podcast_img"> -->
                    <h3 class="podcast_title"><?php echo $row['title']; ?></h3>
                    <p class="podcast_author"><?php echo $row['author']; ?></p>
                    <i class="bi-play-circle-fill podcast_play_icon"></i>
                </div>
        </button>

                <?php
                $i=$i+1;
                }
                ?>
                
            </div>
        </div>








        <!-- admin panel -->
        <div class="content_right" id="admin_panel">
        <form action="" method="post" id="upload_form" >
            <h3 id="form-heading">
                UPLOAD PODCAST
            </h3>
                <div class="input_field">
                    <label for="">Title</label><br>
                    <input type="text" name="title" id="title">
                </div>
                <div class="input_field">
                    <label for="">Author</label><br>
                    <input type="text" name="author" id="author">
                </div>
                <div class="input_field">
                    <label for="">Thumnail Link</label><br>
                    <input type="text" name="thumbnail" id="thumbnail">
                </div>
                <div class="input_field">
                    <label for="">Content Public Link</label><br>
                    <input type="text" name="content" id="content">
                </div>
                <div class="">

                    <input type="radio" name="type" id="content" value="1">
                    <label for=""> Audio</label><br>
                    <input type="radio" name="type" id="content" value="2">
                    <label for=""> Video</label><br>
                </div>
                <div class="submit-btn">
                    <button type="submit" value="Submit" name="submit">Submit</button>
                </div>
        </form>
        <!-- admin panel  -->
        

    </div>

    </header>
    <div id="playing_music_bar">
        <div id="music_left" sty>
            <img id="playing_music_img" src="" alt="">
            <p id="playing_music_title"></p>

        </div>
                
        <div id="music_right">
            <iframe id="playing_music" src="" frameborder="0" height="50"  width="50%"aria-controls=""></iframe>

        </div>
    </div>
</body>
<script>

</script>
    <script src="index.js"></script>
</html>

<?php

    if($_POST['submit']){

        $title=$_POST['title'];
        $author=$_POST['author'];
        $thumbnail=$_POST['thumbnail'];
        $content=$_POST['content'];
        $type=$_POST['type'];

        
        if($title=="" or $author=="" or $thumbnail=="" or $content=="")
        {
            
            echo '<script>alert("Unsuccessful to submit : Some field was empty")</script>';
        }
        else
        {
            if(filter_var($thumbnail,FILTER_VALIDATE_URL) and filter_var($content,FILTER_VALIDATE_URL))
            {
                $thumbnail=str_replace("file/d/","uc?export=view&id=",$thumbnail);
                $thumbnail=str_replace("/view?usp=share_link","",$thumbnail);
                
                if(@getimagesize($thumbnail))
                {
                    $content=str_replace("view","preview",$content);

                    $query="INSERT INTO podcast values(NULL,'$title','$author','$thumbnail','$content','$type')";
                    echo '<script>alert("Upload successful")</script>';

                }
                else
                {
                    echo '<script>alert("Invalid thumbnail URL")</script>';

                }
                
            }
            else 
            {
                echo '<script>alert("Upload unsuccessful!!! Wrong URLs")</script>';

            }
        }
        $result2 = mysqli_query($con, $query);
        
    }

?>