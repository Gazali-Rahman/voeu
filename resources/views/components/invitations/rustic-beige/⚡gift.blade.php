<?php

use Livewire\Component;

new class extends Component {
    public $invitation;
    public $gifts = [];

    public function mount($invitation)
    {
        $this->invitation = $invitation;
        // Mengambil array daftar rekening dari JSON content
        $this->gifts = $this->invitation->content['gifts'] ?? [];
    }
};
?>

<div>
    <div class="py-20 px-6 relative flex flex-col items-center overflow-hidden ">

        <div class="text-center z-10 mb-8">
            <p class="text-[9px] font-['Poppins'] text-[#3E2C23]/60 uppercase tracking-[0.5em] mb-3">
                Share The Love
            </p>
            <h2 class="text-4xl font-['Abigail'] text-[#3E2C23] drop-shadow-sm">Wedding Gift</h2>
        </div>

        <div class="absolute top-1/4 -left-16 transform -rotate-90 origin-center z-0 opacity-[0.03] pointer-events-none">
            <span class="text-[7rem] font-['Abigail'] text-[#3E2C23] whitespace-nowrap">Thank You</span>
        </div>

        <div class="absolute top-0 -left-6 w-40 z-0 rotate-90 pointer-events-none">
            <img src="{{ asset('assets/png/catalog6/bunga1.png') }}" alt="Bunga" class="w-full object-cover">
        </div>

        <div class="w-full max-w-sm relative z-10 flex flex-col items-center">

            <p class="text-[10px] font-['Poppins'] text-[#3E2C23]/70 text-center leading-relaxed mb-10 px-4">
                Kehadiran serta doa restu Anda merupakan karunia yang sangat berarti bagi kami. Namun, jika Anda ingin
                memberikan tanda kasih, kami menyediakan fitur Amplop Digital di bawah ini:
            </p>
            <div class="w-full flex flex-col gap-6">

                @forelse($gifts as $index => $gift)
                    <div x-data="{ copied: false }"
                        class="bg-[#F5EBE1] border border-[#3E2C23]/10 rounded-[2rem] p-6 shadow-sm relative overflow-hidden group hover:shadow-md transition-all duration-300">

                        <div class="absolute -bottom-10 -right-10 w-50 pointer-events-none">
                            <img src="{{ asset('assets/png/catalog6/bunga3.png') }}" alt="Ornamen"
                                class="w-full object-cover">
                        </div>

                        <h3 class="text-xl font-['Abigail'] text-[#3E2C23] mb-1 relative z-10">
                            {{ $gift['bank_name'] }}
                        </h3>

                        <p
                            class="text-[10px] font-['Poppins'] text-[#3E2C23]/60 uppercase tracking-widest mb-4 relative z-10">
                            a.n {{ $gift['account_name'] }}
                        </p>

                        <div class="flex items-center justify-between relative z-10">

                            <span class="text-[15px] font-semibold font-['Poppins'] text-[#3E2C23] tracking-widest">
                                {{ $gift['account_number'] }}
                            </span>

                            <button
                                @click="navigator.clipboard.writeText('{{ $gift['account_number'] ?? '' }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl transition-all duration-300 focus:outline-none"
                                :class="copied ? 'bg-green-100 text-green-700 border border-green-200' :
                                    'bg-[#3E2C23] text-white hover:bg-[#2A1E17] shadow-sm'">

                                <span class="text-[8px] font-['Poppins'] uppercase tracking-widest font-medium"
                                    x-text="copied ? 'Tersalin!' : 'Salin'"></span>

                                <svg x-show="!copied" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                                </svg>

                                <svg x-show="copied" style="display: none;" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    class="w-3 h-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </button>
                        </div>

                    </div>
                @empty
                    <div class="text-center py-10 bg-[#F5EBE1] border border-[#3E2C23]/10 rounded-[2rem]">
                        <p class="text-[10px] font-['Poppins'] text-[#3E2C23]/50 italic">Fitur amplop digital saat ini
                            tidak diaktifkan.</p>
                    </div>
                @endforelse

            </div>
        </div>

    </div>
</div>
