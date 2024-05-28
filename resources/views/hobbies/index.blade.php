<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <title>List of Content</title>
    @foreach ($data as $datas)
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
        }

        .parallax {
            background-image: url('{{ Storage::url("public/background/" . $datas->background) }}');
            min-height: 673.1px;
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
            z-index: 1;
        }

        .card {
            margin-top: 20px;
            margin-bottom: 20px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            z-index: 2;
            position: relative;
        }

        .card-header,
        .card-body {
            background: rgba(0, 0, 0, 0);
        }

        .card-body {
            color: white;
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
    </style>
    @endforeach
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">List of Content</a>
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
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#modalAddHobby">Add New Content</a>
                    </li>
                    <li class="nav-item" style="margin-right: 1rem;">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#modalEditPage">Edit Page</a>
                    </li>
                    <li class="nav-item dropdown" style="margin-right: 3rem;">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @auth
                            {{ Auth::user()->name }}
                            @endauth
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @auth
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                            @endauth
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Parallax Section -->
    <div class="parallax">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card" style="background-color: rgba(0, 0, 0, 0);border:0cap;">
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success">
                                Changed successfully
                            </div>
                            @endif
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="row">
                                <div class="row justify-content-center">
                                    <div class="row" id="cardContainer">
                                        <div id="noContentMessage" style="display: none;" class="text-center">
                                            <h5 class="navbar-brand">Content Not Available</h5>
                                        </div>
                                        @foreach($hobbies as $hobby)
                                        <div class="col-md-4 mb-3 slide-fade-in" data-alphabet="{{ substr($hobby->name, 0, 1) }}">
                                            <div class="card" style="background-color: black; border: 3px solid rgba(255, 255, 255, 1);">
                                                @if($hobby->image)
                                                <img src="{{ asset('storage/images/' . $hobby->image) }}" class="card-img-top" alt="Hobby Image">
                                                @else
                                                <div class="text-center p-5">No Image Available</div>
                                                @endif
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $hobby->name }}</h5>
                                                    <p class="card-text">{{ $hobby->description }}</p>
                                                    <!-- Edit button -->
                                                    <a href="#" class="btn btn-primary edit-hobby" data-bs-toggle="modal" data-bs-target="#modalEditHobby_{{ $hobby->id }}">Edit</a>
                                                    <a href="{{ route('hobbies.show', $hobby->id) }}" class="btn btn-success">Show</a>
                                                    <form action="{{ route('hobbies.delete', $hobby->id) }}" method="POST" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal Edit -->
    <div class="modal fade" id="modalEditPage" tabindex="-1" aria-labelledby="modalEditPageLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditPageLabel">Edit Page</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk edit page -->
                    <form method="POST" action="{{ route('items.update', $datas->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="user">{{ __('user') }}</label>
                            <input id="name" type="text" class="form-control @error('user') is-invalid @enderror" name="user" value="{{  $datas->user }}" required autofocus>
                            @error('user')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="introduction">{{ __('introduction') }}</label>
                            <textarea id="introduction" class="form-control @error('introduction') is-invalid @enderror" rows="3" name="introduction" required>{{ $datas->introduction }}</textarea>
                            @error('introduction')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('description') }}</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" rows="5" name="description" required>{{ $datas->description }}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="logo">{{ __('logo') }}</label>
                            <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo">
                            @if($datas->logo)
                            <div class="mt-2">
                                <img src="{{ asset('storage/image/' . $datas->logo) }}" alt="{{ $datas->user }}" class="img-thumbnail" width="150">
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
                            @if($datas->background)
                            <div class="mt-2">
                                <img src="{{ asset('storage/background/' . $datas->background) }}" alt="{{ $datas->user }}" class="img-thumbnail" width="150">
                            </div>
                            @endif
                            @error('background')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add Hobby -->
    <div class="modal fade" id="modalAddHobby" tabindex="-1" aria-labelledby="modalAddHobbyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddHobbyLabel">Add New Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk menambahkan hobby -->
                    <form method="POST" action="{{ route('hobbies.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" rows="4" name="description" required>{{ old('description') }}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">{{ __('Image') }}</label>
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" required>
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top:1rem;">{{ __('Add Content') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edit Hobby -->
    @foreach($hobbies as $hobby)
    <div class="modal fade" id="modalEditHobby_{{ $hobby->id }}" tabindex="-1" aria-labelledby="modalEditHobbyLabel_{{ $hobby->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditHobbyLabel_{{ $hobby->id }}">Edit Hobby</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for editing hobby -->
                    <form method="POST" action="{{ route('hobbies.update', $hobby->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $hobby->name }}" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" class="form-control" name="description" rows="4" required>{{ $hobby->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input id="image" type="file" class="form-control" name="image">
                            @if($hobby->image)
                            <img src="{{ asset('storage/images/' . $hobby->image) }}" alt="Current Image" class="img-fluid mt-2">
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Bootstrap 5 JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('storage/js/sort.js')}}"></script>
</body>

</html>