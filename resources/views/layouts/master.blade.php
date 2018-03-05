<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Social Sports</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::to('css/styles.css') }}">

    {{--  Google Fonts  --}}
    <link href="https://fonts.googleapis.com/css?family=Mina" rel="stylesheet">
</head>
<body>
    <div class="container">

        <!-- Static navbar -->
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="{{ route('post.index') }}">Home</a>
              <a class="navbar-brand" href="{{ route('post.create') }}">New Post</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              </ul>
            </div>
          </div>
        </nav>
  
        <!-- Main body -->
        @yield('content')

    </div>
</body>
</html>