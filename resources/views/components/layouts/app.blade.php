<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Livewire</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <style>
        @font-face {
            font-family: "charlotte";
            src: url("/assets/font/The-Charlotte.ttf") format("truetype");
        }

        @font-face {
            font-family: "abigail";
            src: url("/assets/font/abigail-v4.ttf") format("truetype");
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
    </style>
</head>

<body class="bg-white ">
    <livewire:navbar />
    {{ $slot }}
    <livewire:footer />
    @livewireScripts
</body>


</html>
