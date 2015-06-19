<!doctype html>
<html>
<head>
    <style>
        @import url(http://fonts.googleapis.com/css?family=Gruppo);

        video.background {
            z-index: -100;
            position: fixed;
            top: 0;
            left: 0;
            width: auto;
            min-width: 100vw;
            min-height: 100vh;
            background-size: cover;
        }
        div.mask {
            z-index: -10;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-image: url('image/mask.png');
            background-color: rgba(0,0,0,0.7);
        }
        h1 {
            font-family: 'Gruppo';
            color: #fdfdfd;
            font-size: 112px;
            font-weight: 100;
            text-align: center;
            width: 900px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <div class="mask"></div>
    <video autoplay loop muted class="background">
        <source src="video/djerocku.webm" type="video/webm">
        <source src="video/djerocku.mp4" type="video/mp4">
    </video>
    <h1>Share the experience</h1>
</body>
</html>