<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class="nav-item">
                        <a class ="nav-link active" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach

                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                </div>
            </div>
            </nav>





        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{__('messages.edit grade')}}
                </div>
                @if (Session::has('updated'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('updated')}}
                    </div>    
                @endif
                <form action="{{route('grade.update',$data['id'])}}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.student name')}}</label>
                        <input type="text" class="form-control" value="{{$data['name']}}" name="name" placeholder="{{__('messages.student name')}}">
                        @error('name')
                            <small class="text-danger form-text">{{$message}}</small>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.address')}}</label>
                        <input type="text" class="form-control" value="{{$data['address']}}" name="address" placeholder="{{__('messages.address')}}">
                        @error('address')
                            <small class="text-danger form-text">{{$message}}</small>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.mark')}}</label>
                        <input type="number" class="form-control" value="{{$data['mark']}}" name="mark" placeholder="{{__('messages.mark')}}">
                        @error('mark')
                            <small class="text-danger form-text">{{$message}}</small>
                        @enderror
                    </div><br>
                    <button type="submit" class="btn btn-primary">{{__('messages.enter')}}</button>
                </form>
            </div>
        </div>        
    </body>
</html>