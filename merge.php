
<?php

if (isset($_POST["submit"]))
{
    $content = "";
    for ($a = 0; $a < count($_FILES["videos"]["name"]); $a++)
    {
        $content .= "file " . $_FILES["videos"]["name"][$a] . "\n";
    }
    file_put_contents("mylist.txt", $content);

    $command = "ffmpeg -f concat -i mylist.txt -c copy merge.mp4";
    $url = system($command);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        .float-container {
            border: 3px solid #fff;
            padding: 20px;
            margin-top: 5%;

        }

        .float-child {
            width: 50%;
            float: left;
            padding: 20px;
            margin-top: 8%;
        }
        body{
            background-color: white;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-info">
    <a class="navbar-brand" href="#">Video Editor<i class="fas fa-video"></i></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link" href="index.html">
                    <i class="fa fa-home"></i>
                    Split
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="merge.php">
                    Merge
                </a>
            </li>

        </ul>
    </div>
</nav>


    <div class="container">
        <div>
            <div class="float-child">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group col-md-12">
                        <label>Select videos</label>
                        <input type="file" name="videos[]" class="form-control" required multiple onchange="onFileSelected(this);>
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" style="margin-top: 8%;" name="submit" onclick="onFileSelected(<?php echo $url;?>)" class="btn btn-primary btn-block">Merge</button>
                    </div>
<!--                    <div class="form-group col-md-12">-->
<!--                        <label>Video</label>-->
<!--                        <input type="file" name="video" class="form-control" onchange="onFileSelected(this);">-->
<!--                    </div>-->
                </form>
            </div>
            <div class="float-child">
<!--                <input type="file" name="video" class="form-control" onchange="onFileSelected(this);">-->
                <div class="form-group col-md-6">
                    <video width="500" height="320" id="videos" controls>
                    </video>

                </div>
            </div>
        </div>
    </div>

</body>
</html>
<script>
    function onFileSelected(self) {
        var file = self.files[0];
        var reader = new FileReader();
        reader.onload = function (event) {
            var src = event.target.result;
            var video = document.getElementById("videos");
            video.setAttribute("src", src);
        };
        reader.readAsDataURL(file);
    }
</script>
<!---->
<!--<script>-->
<!---->
<!--    function onFileSelected(self) {-->
<!--        var videos = document.getElementById("videos");-->
<!---->
<!--        for (var a = 0; a < self.files.length; a++) {-->
<!--            var file = self.files[a];-->
<!--            var fileReader = new FileReader();-->
<!---->
<!--            fileReader.onload = function (event) {-->
<!--                var src = event.target.result;-->
<!--                var newVideo = document.createElement("video");-->
<!---->
<!--                newVideo.setAttribute("src", src);-->
<!--                newVideo.setAttribute("controls", "controls");-->
<!--                newVideo.setAttribute("width", 500);-->
<!---->
<!--                videos.appendChild(newVideo);-->
<!--            };-->
<!---->
<!--            fileReader.readAsDataURL(file);-->
<!--        }-->
<!--    }-->
<!---->
<!--</script>-->