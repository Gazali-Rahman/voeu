<?php

namespace App\Livewire\Admin;

use App\Models\Invitation;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class ManageInvitation extends Component
{
    use WithPagination;

    public $search = '';

    public function delete($id)
    {
        $invitation = Invitation::findOrFail($id);

        // 1. Hapus Foto Dinamis dari Storage
        if (isset($invitation->content['dynamic_photos'])) {
            foreach ($invitation->content['dynamic_photos'] as $photo) {
                if (!empty($photo['path']) && Storage::disk('public')->exists($photo['path'])) {
                    Storage::disk('public')->delete($photo['path']);
                }
            }
        }

        // 2. Hapus File Musik dari Storage
        if (isset($invitation->content['music'])) {
            $musicPath = $invitation->content['music'];
            if (!empty($musicPath) && Storage::disk('public')->exists($musicPath)) {
                Storage::disk('public')->delete($musicPath);
            }
        }

        // 3. Opsional: Hapus folder folder slug jika kosong
        // Storage::disk('public')->deleteDirectory('invitations/' . $invitation->slug);

        $invitation->delete();

        session()->flash('success', 'Undangan dan asset file berhasil dihapus selamanya.');
    }
    // Method untuk menjalankan Seeder
    public function generatePreviews()
    {
        try {
            // Menjalankan seeder spesifik untuk Demo
            Artisan::call('db:seed', [
                '--class' => 'DemoInvitationSeeder'
            ]);

            session()->flash('success', 'Data demo untuk seluruh katalog berhasil dibuat!');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $invitations = Invitation::with(['order', 'catalog'])
            ->where('slug', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.manage-invitation', [
            'invitations' => $invitations
        ]);
    }
}
