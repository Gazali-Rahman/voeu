<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Voeu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F9F8F6] font-sans antialiased">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r border-[#e5e1da]/50 flex flex-col">
            <div class="h-20 flex items-center px-8 border-b border-[#e5e1da]/30">
                <span class="text-xl font-utama tracking-widest uppercase">Admin</span>
            </div>
            <nav class="flex-1 px-4 py-8 space-y-2">
                <a href="/admin/dashboard"
                    class="block px-4 py-2 text-[10px] uppercase tracking-[0.3em] {{ request()->is('admin/dashboard') ? 'text-black bg-[#F9F8F6]' : 'text-gray-400 hover:text-black transition-all' }}">Dashboard</a>
                <a href="/admin/catalogs"
                    class="block px-4 py-2 text-[10px] uppercase tracking-[0.3em] {{ request()->is('admin/catalogs') ? 'text-black bg-[#F9F8F6]' : 'text-gray-400 hover:text-black transition-all' }}">Manage
                    Catalog</a>
                <div x-data="{ open: {{ request()->is('admin/users*') || request()->is('admin/roles*') ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full px-4 py-2 text-[10px] uppercase tracking-[0.3em] transition-all"
                        :class="open ? 'text-black' : 'text-gray-400 hover:text-black'">
                        <span>User Management</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 transition-transform"
                            :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="Wait 19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="pl-4 space-y-1 mt-1">
                        <a href="/admin/users"
                            class="block px-4 py-2 text-[9px] uppercase tracking-[0.2em] {{ request()->is('admin/users') ? 'text-black border-l border-black' : 'text-gray-400 hover:text-black' }}">
                            User List
                        </a>
                        <a href="/admin/roles"
                            class="block px-4 py-2 text-[9px] uppercase tracking-[0.2em] {{ request()->is('admin/roles*') ? 'text-black border-l border-black' : 'text-gray-400 hover:text-black' }}">
                            Role Management
                        </a>
                    </div>
                </div>
                <a href="/admin/orders"
                    class="block px-4 py-2 text-[10px] uppercase tracking-[0.3em] text-gray-400 hover:text-black transition-all">Orders</a>
            </nav>
        </aside>

        <main class="flex-1">
            <header
                class="h-20 bg-white/50 backdrop-blur-md border-b border-[#e5e1da]/30 flex items-center justify-end px-10">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="text-[9px] uppercase tracking-widest text-red-400 hover:text-red-600 transition-colors cursor-pointer">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </header>
            <div class="p-10">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>
