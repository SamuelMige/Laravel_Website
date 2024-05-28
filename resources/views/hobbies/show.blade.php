<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
</head>
<style>
    .navbar-brand {
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
    }

    html {
        scroll-behavior: smooth;
        overflow-x: hidden;
    }

    .parallax {
        background-image: url("{{ asset('storage/images/' . $hobby->image) }}");
        min-height: 673.1px;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        z-index: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .parallax::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: -1;
    }

    .overlay-content {
        position: relative;
        z-index: 1;
        color: white;
        text-align: center;
        max-width: 90%;
        margin: auto;
        overflow: auto;
        padding: 20px;
    }

    .overlay-text {
        font-size: 80px;
    }

    @media (max-width: 768px) {
        .overlay-text {
            font-size: 40px;
        }
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{$hobby->name}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="#" onclick="goBack()" class="me-3 btn btn-dark">Go Back</a>
        </div>
    </nav>
    <div class="parallax">
        <div class="overlay-content">
            <h1 class="overlay-text navbar-brand">{{ $hobby->name }}</h1>
            <p>{{ $hobby->description }}</p>
        </div>
    </div>
<script>
    function goBack() {
        var referrer = document.referrer;
        if (referrer) {
            window.location.href = referrer;
        }
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</html>
