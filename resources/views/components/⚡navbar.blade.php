<?php

use Livewire\Component;

new class extends Component {
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    // Opsional: Jika ingin redirect via fungsi
    public function goToOrders()
    {
        return redirect()->route('my-orders');
    }
};
?>

<nav x-data="{ mobileMenuOpen: false }" class="w-full bg-neutral-900 sticky top-0 z-40 border-b border-[#e5e1da]/50 font-sans">
    <div class="max-w-7xl mx-auto px-6 sm:px-10">
        <div class="flex justify-between items-center h-15">

            <div class="shrink-0">
                <a href="/" wire:navigate class="text-2xl font-utama tracking-[0.2em] uppercase text-white">
                    Voeu
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-12">
                <a href="/" wire:navigate
                    class="text-[10px] uppercase tracking-[0.4em] text-white hover:text-neutral-300 transition-all">Home</a>
                <a href="#catalog"
                    class="text-[10px] uppercase tracking-[0.4em] text-white hover:text-neutral-300 transition-all">Collection</a>
                <a href="#promo"
                    class="text-[10px] uppercase tracking-[0.4em] text-white hover:text-neutral-300 transition-all">Promo</a>

                @auth
                    <a href="/my-orders" wire:navigate
                        class="text-[10px] uppercase tracking-[0.4em] text-[#C5A25D] hover:text-white transition-all italic">My
                        Orders</a>
                @endauth
            </div>

            <div class="flex items-center gap-3">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.outside="open = false" class="focus:outline-none ">
                            <div class="h-9 w-9 rounded-full transition-colors cursor-pointer ">
                                <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                    class="h-full w-full rounded-full object-cover  ">
                            </div>
                        </button>
                        <div x-show="open" x-transition style="display: none;"
                            class="absolute right-0 mt-3 w-48 bg-white shadow-xl py-2 z-50">
                            <div class="px-4 py-2 border-b border-[#f5f5f5] mb-1">
                                <p class="text-[10px] font-medium truncate italic">{{ Auth::user()->email }}</p>
                            </div>

                            <a href="/my-orders" wire:navigate
                                class="block px-4 py-2 text-[10px] uppercase tracking-widest text-gray-700 hover:bg-gray-50">My
                                Orders</a>

                            <button wire:click="logout"
                                class="w-full text-left px-4 py-2 text-[10px] uppercase tracking-widest text-red-500 hover:bg-red-50">Logout</button>
                        </div>
                    </div>
                @else
                    <div class="hidden md:block">
                        <a href="/login" wire:navigate
                            class="text-[10px] uppercase tracking-[0.4em] text-white border border-white/30 px-6 py-2 hover:bg-white hover:text-black transition-all duration-500">
                            Login
                        </a>
                    </div>
                @endauth

                <button @click="mobileMenuOpen = true" class="md:hidden p-2 -mr-2 text-white hover:text-neutral-400">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M4 8h16M10 16h10" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen" class="fixed inset-0 z-100 md:hidden" style="display: none;" role="dialog"
        aria-modal="true">
        <div x-show="mobileMenuOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/10 backdrop-blur-sm"
            @click="mobileMenuOpen = false"></div>

        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="fixed inset-y-0 right-0 w-[280px] bg-[#F9F8F6] shadow-2xl overflow-y-auto">

            <div class="flex items-center justify-between px-8 h-20 border-b border-[#e5e1da]/50">
                <span class="text-[10px] uppercase tracking-[0.4em] text-gray-400 italic">Menu</span>
                <button @click="mobileMenuOpen = false"
                    class="text-gray-400 text-[10px] uppercase tracking-widest">Close</button>
            </div>

            <div class="px-8 py-12 flex flex-col space-y-10">
                <a href="/" wire:navigate @click="mobileMenuOpen = false"
                    class="text-xs uppercase tracking-[0.5em] text-[#1a1a1a] hover:italic">Home</a>
                <a href="#catalog" @click="mobileMenuOpen = false"
                    class="text-xs uppercase tracking-[0.5em] text-[#1a1a1a] hover:italic">Collection</a>

                @auth
                    <a href="/my-orders" wire:navigate @click="mobileMenuOpen = false"
                        class="text-xs uppercase tracking-[0.5em] text-[#C5A25D] font-bold italic">My Orders</a>
                @endauth

                <a href="#promo" @click="mobileMenuOpen = false"
                    class="text-xs uppercase tracking-[0.5em] text-[#1a1a1a] hover:italic">Promo</a>

                @guest
                    <div class="pt-10">
                        <a href="/login" wire:navigate @click="mobileMenuOpen = false"
                            class="text-[10px] uppercase tracking-[0.5em] font-bold py-3 px-6 border border-black inline-block">Login</a>
                    </div>
                @endguest

                @auth
                    <div class="pt-10 border-t border-[#e5e1da]">
                        <button wire:click="logout" class="text-[10px] uppercase tracking-[0.5em] text-red-500">Sign
                            Out</button>
                    </div>
                @endauth
            </div>

            <div class="absolute bottom-8 w-full text-center">
                <p class="text-[9px] text-gray-400 tracking-[0.3em] uppercase">&copy; Voeu 2026</p>
            </div>
        </div>
    </div>
</nav>
