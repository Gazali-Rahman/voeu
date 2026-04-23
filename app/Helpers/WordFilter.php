<?php

namespace App\Helpers;

class WordFilter
{
    public static function clean($text)
    {
        // Daftar kata kasar (bisa kamu tambah sendiri)
        $badWords = [
            // 1. Kata Kasar/Umpatan Umum
            'anjing',
            'anjng',
            'asu',
            'bangsat',
            'bajingan',
            'brengsek',
            'keparat',
            'fuck',
            'fak',
            'fck',
            'babi',
            'monyet',
            'kunyuk',
            'jancok',
            'jancuk',
            'cuk',
            'coeg',
            'kampret',
            'setan',
            'iblis',
            'dajjal',
            'bejad',
            'goblok',
            'gblok',
            'tolol',
            'bego',
            'idiot',
            'sinting',
            'sarap',
            'edan',

            // 2. Sebutan Organ Intim & Seksualitas (Vulgar)
            'peler',
            'peju',
            'memek',
            'kontol',
            'kntol',
            'jembut',
            'itil',
            'tetek',
            'toket',
            'ngentot',
            'ngewe',
            'ngewey',
            'coli',
            'sange',
            'sangean',
            'bokep',
            'porno',
            'porn',
            'vagina',
            'penis',
            'bitch',
            'lonte',
            'jablay',
            'perek',
            'pelacur',
            'gigolo',
            'germo',
            'slut',
            'whore',
            'asshole',

            // 3. Hinaan Fisik, Disabilitas, & SARA
            'bencong',
            'banci',
            'waria',
            'homo',
            'gay',
            'lesbi',
            'lgbt',
            'kafir',
            'murtad',
            'komunis',
            'pki',
            'cebong',
            'kadrun',
            'autis',
            'cacat',
            'lulut',
            'budeg',
            'buta',
            'gila',

            // 4. Variasi Penulisan Kreatif (Leetspeak)
            '4njing',
            '4n j1ng',
            'b4ngsat',
            'b4jingan',
            'g0blok',
            'k0ntol',
            'm3m3k',
            'anjeng',
            'anjrit',
            'anjay',
            'njirr',
            'njink',
            'bangke',
            'tai',
            't4i',
            'tae',
            'syit',
            'shit',
            'damn',
            'hell'
        ];

        // Mengganti kata kasar dengan asterisk (*)
        return str_ireplace($badWords, '****', $text);
    }
}
