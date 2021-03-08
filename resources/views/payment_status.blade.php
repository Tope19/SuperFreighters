<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <section class="error-area ptb-100">
        <div class="container">
            <div class="error-content">

                <h3>{{ $title }}</h3>
                <p>
                    {{ $message }}
                </p>
                    <a href="{{ route("index") }}" class="btn-primary btn" >Go back</a>

            </div>
        </div>
    </section>
</body>
</html>
