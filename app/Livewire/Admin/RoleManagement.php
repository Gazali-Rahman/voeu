<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class RoleManagement extends Component
{
    public $roleName = '';
    public $editingRoleId = null;

    protected $rules = [
        'roleName' => 'required|min:3|unique:roles,name',
    ];

    public function saveRole()
    {
        $this->validate();

        Role::create(['name' => strtolower($this->roleName)]);

        $this->roleName = '';
        session()->flash('message', 'Role created successfully.');
    }

    public function deleteRole($id)
    {
        $role = Role::findById($id);
        if ($role->name === 'admin') {
            session()->flash('error', 'Cannot delete admin role.');
            return;
        }
        $role->delete();
    }

    public function render()
    {
        return view('livewire.admin.role-management', [
            'roles' => Role::all()
        ]);
    }
}
