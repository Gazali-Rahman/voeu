<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- SEO & Dynamic Title --}}
    @php

        $title = isset($invitation)
            ? $invitation->content['nama_pria'] . ' & ' . $invitation->content['nama_wanita']
            : 'Voeu Digital Invitation';
        $description = 'The Wedding of ' . $title;
        // Ambil foto pertama dari dynamic_photos sebagai preview thumb
        $ogImage = asset('assets/img/default-thumbnail.jpg'); // Default awal

        if (isset($invitation)) {
            if (!empty($invitation->content['og_image'])) {
                $ogImage = asset('storage/' . $invitation->content['og_image']);
            } elseif (!empty($invitation->content['dynamic_photos'][0]['path'])) {
                $ogImage = asset('storage/' . $invitation->content['dynamic_photos'][0]['path']);
            }
        }

    @endphp

    <title>{{ $title }}</title>

    {{-- Meta Tag untuk WhatsApp/FB/IG --}}
    <meta name="description" content="{{ $description }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $ogImage }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

        @font-face {
            font-family: "vogue";
            src: url("/assets/font/vogue.ttf") format("truetype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: "samantha";
            src: url("/assets/font/samantha.ttf") format("truetype");
            font-weight: normal;
            font-style: normal;
        }
    </style>
</head>

<body>
    {{ $slot }}
</body>


</html>
