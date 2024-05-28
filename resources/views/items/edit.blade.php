<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <title>Edit Page</title>
</head>
<style>
    .navbar-brand {
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
    }

    .parallax {
        background-image: url('{{ Storage::url("public/background/" . $data->background) }}');
        min-height: 500px;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        z-index: 0;
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

    .navbar-nav .nav-link {
        text-decoration: none;
        /* Menghilangkan underline */
    }

    .navbar-nav .nav-link.add-hobby {
        color: #6c757d;
        /* Warna abu-abu */
    }
</style>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Edit Page</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown" style="margin-right: 3rem;">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Option
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{route('items.edit')}}">Edit Page</a></li>
                            <li><a class="dropdown-item" href="{{ route('hobbies.main') }}">Edit Content</a></li>
                            <li><a class="dropdown-item" href="/">Go back</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- isi -->
    <div class="parallax">
    <br>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Edit Page') }}</div>
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success">
                                Changed successfully
                            </div>
                            @endif
                            <form method="POST" action="{{ route('items.update', $data->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="user">{{ __('user') }}</label>
                                    <input id="name" type="text" class="form-control @error('user') is-invalid @enderror" name="user" value="{{ old('user', $data->user) }}" required autofocus>
                                    @error('user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="introduction">{{ __('introduction') }}</label>
                                    <textarea id="introduction" class="form-control @error('introduction') is-invalid @enderror" rows="3" name="introduction" required>{{ old('introduction', $data->introduction) }}</textarea>
                                    @error('introduction')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">{{ __('description') }}</label>
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" rows="5" name="description" required>{{ old('description', $data->description) }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="logo">{{ __('logo') }}</label>
                                    <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo">
                                    @if($data->logo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/image/' . $data->logo) }}" alt="{{ $data->user }}" class="img-thumbnail" width="150">
                                    </div>
                                    @endif
                                    @error('background')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="background">{{ __('background') }}</label>
                                    <input id="background" type="file" class="form-control @error('background') is-invalid @enderror" name="background">
                                    @if($data->background)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/background/' . $data->background) }}" alt="{{ $data->user }}" class="img-thumbnail" width="150">
                                    </div>
                                    @endif
                                    @error('background')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">{{ __('Update Hobby') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>