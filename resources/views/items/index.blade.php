<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    @foreach ($data as $datas)
    <style>
        .slide-fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
        }

        .slide-fade-in.active {
            opacity: 1;
            transform: translateY(0);
        }

        .fade-in {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .fade-in.active {
            opacity: 1;
        }

        html {
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
        }

        .parallax {
            background-image: url('{{ Storage::url("public/background/" . $datas->background) }}');
            min-height: 500px;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .parallax::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .content {
            background-color: black;
            padding: 20px;
            color: white;
        }

        .overlay-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            color: white;
            text-align: left;
            width: 80%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: nowrap;
            /* Ensure content does not wrap */
        }

        .overlay-text {
            max-width: 70%;
            flex: 1;
        }

        .overlay-image {
            border-radius: 50%;
            margin-left: 35rem;
            flex: 0 0 auto;
            /* Prevent image from shrinking */
            width: 100%;
            max-width: 200px;
            /* Set a max-width for responsiveness */
            height: auto;
            /* Maintain aspect ratio */
        }

        @media (max-width: 768px) {
            .overlay-content {
                flex-direction: column;
                text-align: center;
            }

            .overlay-image {
                margin-left: 0;
                margin-top: 1rem;
                max-width: 50%;
                /* Adjust max-width for smaller screens */
            }
        }

        .card-body {
            color: black;
        }

        .card {
            margin-top: 20px;
            height: 90%;
            margin-bottom: 20px;
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-text {
            overflow: hidden;
            max-height: 100px;
        }

        .additional-content {
            position: relative;
            text-align: center;
            padding: 60px 20px;
            color: white;
        }

        .additional-content::before {
            content: "";
            background-image: url('{{ Storage::url("public/background/" . $datas->background) }}');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .additional-content::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .footer {
            background-color: black;
            color: white;
            padding: 20px;
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer img {
            border-radius: 50%;
            margin-right: 5px;
        }

        .footer-text {
            margin-right: auto;
        }

        .section-title,
        .overlay-text h1,
        .card-title,
        .additional-content h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
        }

        .section-title {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 20px;
            color: white;
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ $datas->user }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item" style="margin-right: 1rem;">
                        <select id="alphabetDropdown" class="nav-link bg-light" style="border: 0cap;">
                            <option value="">A-Z</option>
                        </select>
                    </li>
                    <li class="nav-item" style="margin-right: 1rem;">
                        <a href="#hobbies" style="text-decoration:none; color:gray;" class="nav-link">Content</a>
                    </li>
                    <li class="nav-item" style="margin-right: 1rem;">
                        <a href="#about" style="text-decoration:none; color:gray;" class="nav-link">About</a>
                    </li>
                    <li class="nav-item dropdown" style="margin-right: 3rem;">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Option
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/login">Login</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main Page -->
    <div class="parallax">
        <div class="overlay-content">
            <div class="overlay-text">
                <h1>{{ $datas->user }}</h1>
                <p>{{ $datas->introduction }}</p>
            </div>
            <div>
                <img src="{{ Storage::url('public/image/' . $datas->logo) }}" alt="Rounded Image" class="overlay-image">
            </div>
        </div>
    </div>
    <!-- content section -->
    <div class="content" id="hobbies">
        <div class="container">
            <h2 class="section-title">Content</h2>
            <div class="row" id="cardContainer">
                <div id="noContentMessage" style="display: none;" class="text-center">
                    <h5 class="navbar-brand">Content Not Available</h5>
                </div>
                @foreach($hobbies as $hobby)
                <div class="col-md-4 mb-4 slide-fade-in" data-alphabet="{{ substr($hobby->name, 0, 1) }}">
                    <div class="card">
                        @if($hobby->image)
                        <img src="{{ asset('storage/images/' . $hobby->image) }}" class="card-img-top" alt="{{ $hobby->name }}">
                        @else
                        <div class="text-center p-5">No Image Available</div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $hobby->name }}</h5>
                            <p class="card-text">{{ $hobby->description }}</p>
                            <a href="{{ route('hobbies.show', $hobby->id) }}" class="btn btn-primary">See more</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- about page -->
    <div class="additional-content" id="about">
        <div class="container fade-in">
            <h2>About {{$datas->user}}</h2>
            <p>{{ $datas->description }}</p>
        </div>
    </div>
    <!-- contact -->
    <div class="content">
        <div class="container">
            <h2 class="section-title">Contact {{$datas->user}}</h2>
            <div class="text-center">
                <form>
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email address</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phone" placeholder="Enter your phone number">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning"><strong>Submit</strong></button>
            </div>
        </div>
        </form>
    </div>
    </div>
    </div>


    <!-- footer -->
    <div class="footer">
        <div class="footer-text">
            <p>&copy; 2024 {{$datas->user}}. All Rights Reserved.</p>
        </div>
        <div>
            <img src="{{ Storage::url('public/image/' . $datas->logo) }}" alt="Rounded Footer Image" width="50">
        </div>
    </div>
    @endforeach

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        function isElementInViewport(el) {
            var rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }

        function addActiveClassToVisibleElements() {
            var slideFadeInElements = document.querySelectorAll('.slide-fade-in');
            slideFadeInElements.forEach(function(element) {
                if (isElementInViewport(element)) {
                    element.classList.add('active');
                }
            });

            var fadeInElements = document.querySelectorAll('.fade-in');
            fadeInElements.forEach(function(element) {
                if (isElementInViewport(element)) {
                    element.classList.add('active');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', addActiveClassToVisibleElements);
        window.addEventListener('scroll', addActiveClassToVisibleElements);
    </script>
    <script src="{{asset('storage/js/sort.js')}}"></script>
</body>

</html>