<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<!-- Gunakan warna background yang sama dengan atasnya agar transisinya mulus -->
<!-- Gunakan warna background yang sama dengan atasnya agar transisinya mulus -->
<div class="w-full bg-[#F9F8F6] py-20 px-8 flex flex-col items-center justify-center text-center relative">

    <img src="{{ asset('assets/png/catalog7/kertas.png') }}" class="w-20 h-auto mb-5" alt="">

    <!-- Arti QS. Ar-Rum: 21 -->
    <!-- leading-relaxed memberi jarak antar baris, max-w-md membatasi lebar paragraf -->
    <p class="font-indie text-xs font-light text-gray-800 leading-relaxed max-w-sm px-10">
        "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri,
        agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.
        Sungguh, pada yang demikian itu benar-benar terdapat tanda-tanda (kebesaran Allah) bagi kaum yang berpikir."
    </p>



    <!-- Sumber Surat -->
    <!-- Saya buat tetap pakai font-indie dengan sedikit tracking (jarak antar huruf) -->
    <p class="mt-10 font-samantha text-sm  ">
        QS. Ar-Rum: 21
    </p>

</div>
