<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

#[Layout('components.layouts.admin')]
class Manageuser extends Component
{
    use WithPagination;

    public $search = '';

    // Reset halaman ke 1 kalau user ngetik di kolom search
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updateRole($userId, $roleName)
    {
        $user = User::findOrFail($userId);
        $user->syncRoles($roleName);

        session()->flash('message', "Role for {$user->name} updated to {$roleName}.");
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() === $user->id) {
            session()->flash('error', "You cannot delete your own account.");
            return;
        }

        $user->delete();
        session()->flash('message', "User deleted successfully.");
    }

    public function render()
    {
        return view('livewire.admin.manageuser', [
            'users' => User::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->with('roles')
                ->latest()
                ->paginate(10),
            'allRoles' => Role::all()
        ]); // Menggunakan layout admin yang tadi kita buat
    }
}
