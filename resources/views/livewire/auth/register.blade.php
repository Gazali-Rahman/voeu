<div class="min-h-screen bg-[#F9F8F6] flex flex-col justify-center py-12 sm:px-6 lg:px-8 font-sans text-[#2D2D2D]">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <h2 class="text-4xl font-serif tracking-tight text-[#1a1a1a]">Buat Akun</h2>
        <p class="mt-2 text-sm font-light tracking-widest uppercase text-gray-500">Mulai perjalanan estetik Anda</p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-10 px-8 border border-[#e5e1da] shadow-[0_4px_20px_-10px_rgba(0,0,0,0.05)]">

            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs uppercase tracking-widest font-semibold text-gray-600 mb-2">Nama
                        Lengkap</label>
                    <input name="name" type="text" required
                        class="appearance-none block w-full px-3 py-3 border-b border-[#e5e1da] border-t-0 border-l-0 border-r-0 focus:outline-none focus:ring-0 focus:border-black bg-transparent">
                    @error('name')
                        <span class="text-red-500 text-xs italic">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label
                        class="block text-xs uppercase tracking-widest font-semibold text-gray-600 mb-2">Email</label>
                    <input name="email" type="email" required
                        class="appearance-none block w-full px-3 py-3 border-b border-[#e5e1da] border-t-0 border-l-0 border-r-0 focus:outline-none focus:ring-0 focus:border-black bg-transparent">
                    @error('email')
                        <span class="text-red-500 text-xs italic">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label
                        class="block text-xs uppercase tracking-widest font-semibold text-gray-600 mb-2">Password</label>
                    <input name="password" type="password" required
                        class="appearance-none block w-full px-3 py-3 border-b border-[#e5e1da] border-t-0 border-l-0 border-r-0 focus:outline-none focus:ring-0 focus:border-black bg-transparent">
                    @error('password')
                        <span class="text-red-500 text-xs italic">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-widest font-semibold text-gray-600 mb-2">Konfirmasi
                        Password</label>
                    <input name="password_confirmation" type="password" required
                        class="appearance-none block w-full px-3 py-3 border-b border-[#e5e1da] border-t-0 border-l-0 border-r-0 focus:outline-none focus:ring-0 focus:border-black bg-transparent">
                </div>

                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 border border-transparent text-sm font-medium text-white bg-[#1a1a1a] hover:bg-[#333] transition-all tracking-widest uppercase">
                        Daftar
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center text-xs text-gray-400 border-t border-[#eee] pt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:underline">Masuk</a>
            </div>
        </div>
    </div>
</div>
