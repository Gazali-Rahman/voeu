<div class="max-w-5xl mx-auto">
    <!-- Header Section -->
    <div class="mb-10 flex flex-col md:flex-row md:justify-between md:items-end gap-6">
        <div>
            <h1 class="text-3xl font-light tracking-tight text-gray-900">Role Management</h1>
            <p class="text-sm text-gray-500 mt-2 font-medium">Define and organize administrative groups</p>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show"
            class="mb-8 flex items-center p-4 bg-emerald-50 text-emerald-800 rounded-xl border border-emerald-100 shadow-sm"
            role="alert">
            <svg class="shrink-0 w-4 h-4 mr-3 text-emerald-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="text-sm font-medium tracking-wide">{{ session('message') }}</span>
            <button @click="show = false" type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-emerald-50 text-emerald-500 rounded-lg focus:ring-2 focus:ring-emerald-400 p-1.5 hover:bg-emerald-100 inline-flex items-center justify-center h-8 w-8">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Add Role Form -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-6">
                <h3 class="text-lg font-medium text-gray-900 mb-1">Create New Role</h3>
                <p class="text-xs text-gray-400 mb-6 font-medium">Add a new authorization tier to your system.</p>

                <form wire:submit.prevent="saveRole" class="space-y-5">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Role
                            Name <span class="text-rose-500">*</span></label>
                        <input type="text" wire:model="roleName" placeholder="e.g. Moderator"
                            class="w-full bg-gray-50 border border-gray-200 text-gray-900 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 py-2.5 px-4 shadow-sm transition-all duration-300 outline-none text-sm">
                        @error('roleName')
                            <p class="text-xs text-rose-500 mt-2 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full flex justify-center items-center py-2.5 px-4 rounded-xl shadow-sm border border-transparent bg-indigo-600 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 active:scale-[0.98]">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add New Role
                    </button>
                </form>
            </div>
        </div>

        <!-- Role List Table -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/30">
                    <h3 class="text-sm font-semibold text-gray-800 uppercase tracking-wider">Active Roles</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white border-b border-gray-50">
                                <th
                                    class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider w-2/3">
                                    Role Identifiers</th>
                                <th
                                    class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($roles as $role)
                                <tr class="hover:bg-indigo-50/20 transition-colors duration-200 group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div
                                                class="h-8 w-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center mr-4 group-hover:bg-indigo-100 group-hover:text-indigo-700 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                </svg>
                                            </div>
                                            <span
                                                class="text-sm font-semibold text-gray-800">{{ ucfirst($role->name) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        @if ($role->name !== 'admin')
                                            <button wire:click="deleteRole({{ $role->id }})"
                                                wire:confirm="Remove the '{{ $role->name }}' role? Users with this role might lose access."
                                                class="inline-flex items-center justify-center p-2 text-rose-400 hover:text-white hover:bg-rose-500 rounded-lg transition-all duration-200 opacity-50 group-hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-rose-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                                System Default
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
