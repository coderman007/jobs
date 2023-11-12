<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="icon" type="image/png" href="/img/icon.png">
    <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        }
    </script>
    @vite(['resources/css/app.css'])
</head>

<body class="antialiased">
    <main
        class="flex flex-col items-center justify-center w-full h-screen bg-gradient-to-r from-emerald-400 to-green-600 background-animation">
        <img src="/img/logo.png" class="w-40 mx-auto mb-8" alt="logo" />
        <h1 class="text-4xl font-thin text-white">Welcome to the Admin Panel</h1>
        <a href="/admin/login"
            class="inline-block px-12 py-4 mt-8 text-lg font-bold tracking-wide text-white uppercase transition duration-200 transform rounded-full shadow-xs bg-gradient-to-br from-teal-300 to-teal-400 shadow-white hover:shadow-2xl active:shadow-xl hover:-translate-y-1 active:translate-y-0">Go
            to Admin Console</a>
    </main>

    <style>
        body {
            font-family: "Inter", sans-serif;
        }

        .background-animation {
            background-size: 400%;

            -webkit-animation: AnimationName 3s ease infinite;
            -moz-animation: AnimationName 3s ease infinite;
            animation: AnimationName 3s ease infinite;
        }

        @keyframes AnimationName {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }
    </style>

</body>

</html>
