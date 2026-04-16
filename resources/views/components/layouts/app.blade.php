<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Voeu | Jasa Undangan Digital Pernikahan Minimalis & Vintage' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/png/logovoeu.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/png/logovoeu.png') }}">
    <meta name="description"
        content="Voeu menyediakan jasa pembuatan undangan digital pernikahan berbasis website dengan desain minimalis, vintage, dan estetik. Abadikan momen spesial Anda dengan undangan digital elegant.">
    <meta name="keywords"
        content="undangan digital, undangan pernikahan website, undangan digital minimalis, undangan digital vintage, undangan digital aesthetic, undangan digital mewah, undangan digital modern, undangan digital premium, undangan digital elegan, jasa undangan digital elegant">
    <meta name="author" content="Voeu Digital">

    <meta property="og:title" content="Voeu - Undangan Digital Pernikahan Minimalis & Vintage">
    <meta property="og:description" content="Abadikan momen spesial Anda dengan undangan digital elegant dari Voeu.">
    <meta property="og:image" content="{{ asset('assets/png/logovoeu.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
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
