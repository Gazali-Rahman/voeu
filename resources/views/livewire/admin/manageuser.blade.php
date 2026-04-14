<div>
    <!-- Header Section -->
    <div class="mb-10 flex flex-col md:flex-row md:justify-between md:items-end gap-6">
        <div>
            <h2 class="text-3xl font-light tracking-tight text-gray-900">User Management</h2>
            <p class="text-sm text-gray-500 mt-2 font-medium">Control access and assign roles across the platform</p>
        </div>

        <div class="relative group">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400 group-focus-within:text-indigo-500 transition-colors" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" wire:model.live="search" placeholder="Search accounts..."
                class="bg-white border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full md:w-80 pl-10 p-2.5 shadow-sm transition-all duration-300 hover:border-gray-300 outline-none">
        </div>
    </div>

    <!-- Alert Notifications -->
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show"
            class="mb-6 flex items-center p-4 bg-emerald-50 text-emerald-800 rounded-xl border border-emerald-100 shadow-sm"
            role="alert">
            <svg class="shrink-0 w-4 h-4 mr-3 text-emerald-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="text-sm font-medium tracking-wide">{{ session('message') }}</span>
            <button @click="show = false" type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-emerald-50 text-emerald-500 rounded-lg focus:ring-2 focus:ring-emerald-400 p-1.5 hover:bg-emerald-100 inline-flex items-center justify-center h-8 w-8"
                aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-show="show"
            class="mb-6 flex items-center p-4 bg-rose-50 text-rose-800 rounded-xl border border-rose-100 shadow-sm"
            role="alert">
            <span class="text-sm font-medium tracking-wide">{{ session('error') }}</span>
            <button @click="show = false" type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-rose-50 text-rose-500 rounded-lg p-1.5 hover:bg-rose-100 inline-flex items-center justify-center h-8 w-8">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif

    <!-- Table Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">User Details
                        </th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Role
                            Assignment</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($users as $user)
                        <tr class="hover:bg-indigo-50/30 transition-colors duration-200 group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="relative">
                                        <img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random' }}"
                                            class="h-10 w-10 rounded-full object-cover border-2 border-white shadow-sm group-hover:scale-105 transition-transform duration-300">
                                        @if ($user->hasRole('admin'))
                                            <span
                                                class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-indigo-500 border-2 border-white rounded-full"></span>
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-gray-900">{{ $user->name }}</span>
                                        <span class="text-xs text-gray-500 mt-0.5">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="relative inline-block w-40">
                                    <select wire:change="updateRole({{ $user->id }}, $event.target.value)"
                                        class="block w-full appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded-lg text-sm leading-tight focus:outline-none focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all cursor-pointer font-medium">
                                        @foreach ($allRoles as $role)
                                            <option value="{{ $role->name }}"
                                                {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if ($user->id !== auth()->id())
                                    <button wire:click="deleteUser({{ $user->id }})"
                                        wire:confirm="Are you sure you want to completely remove this user access?"
                                        class="inline-flex items-center justify-center p-2 text-rose-400 hover:text-white hover:bg-rose-500 rounded-lg transition-all duration-200 group-hover:opacity-100 sm:opacity-50 focus:outline-none focus:ring-2 focus:ring-rose-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-600">
                                        Active Session
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <p class="text-sm text-gray-500 font-medium">No users found matching your search
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
