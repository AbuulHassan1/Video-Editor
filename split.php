<?php

if (isset($_POST["submit"]))
{
    $file_name = $_FILES["video"]["tmp_name"];
    $cut_from = $_POST["cut_from"];
    $duration = $_POST["duration"];

//    $command =     "ffmpeg -i" . $file_name . "-ss" . $cut_from .  "-t" . $duration . "-async 1 cut.mp4";
    $command = "ffmpeg -i " . $file_name . " -vcodec copy -ss " . $cut_from . " -t " . $duration . " output.mp4";
    system($command);
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
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="split.php">
                    <i class="fa fa-home"></i>
                    Split
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="merge.php">
                    Merge
                </a>
            </li>

        </ul>
    </div>
</nav>

    <div class="container">
            <div>
                <form method="POST" enctype="multipart/form-data">

                    <div class="float-child">
                        <div class="form-group col-md-12">
                            <label>Video</label>
                            <input type="file" name="video" class="form-control" onchange="onFileSelected(this);">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Cut from</label>
                            <input type="text" name="cut_from" class="form-control" placeholder="00:00:00">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Duration</label>
                            <input type="text" name="duration" class="form-control" placeholder="00:00:00">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" style="margin-top: 8%;" name="submit" class="btn btn-primary btn-block">Split</button>
                        </div>
                    </div>
                    <div class="float-child">
                        <div class="form-group col-md-6">
                            <video width="500" height="320" id="video" controls></video>
                        </div>
                    </div>
                </form>
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
            var video = document.getElementById("video");
            video.setAttribute("src", src);
        };
        reader.readAsDataURL(file);
    }
</script>