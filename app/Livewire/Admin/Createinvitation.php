<?php

namespace App\Livewire\Admin;

use App\Models\Invitation;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
class Createinvitation extends Component
{
    use WithFileUploads;

    public $order;
    public $slug, $nama_pria, $nama_wanita, $tanggal_akad, $tanggal_resepsi, $tempat_akad, $alamat_akad, $tempat_resepsi, $alamat_resepsi, $maps;
    public $nama_pria_lengkap, $nama_wanita_lengkap;
    public $nama_ortu_pria, $nama_ortu_wanita;
    public $label_ortu_pria, $label_ortu_wanita;
    public $music_file;
    public $existing_music;
    // Array untuk menampung slot foto secara dinamis
    public $photo_slots = [];
    public $love_stories = [];
    public $gifts = [];
    public function mount($order_id)
    {
        $this->order = Order::findOrFail($order_id);
        $invitation = Invitation::where('order_id', $order_id)->first();

        if ($invitation && isset($invitation->content['dynamic_photos'])) {
            $this->slug = $invitation->slug;
            $this->nama_pria = $invitation->content['nama_pria'] ?? '';
            $this->nama_wanita = $invitation->content['nama_wanita'] ?? '';

            // Load data teks baru (Nama Lengkap & Ortu)
            $this->nama_pria_lengkap = $invitation->content['nama_pria_lengkap'] ?? '';
            $this->nama_wanita_lengkap = $invitation->content['nama_wanita_lengkap'] ?? '';
            $this->nama_ortu_pria = $invitation->content['nama_ortu_pria'] ?? '';
            $this->nama_ortu_wanita = $invitation->content['nama_ortu_wanita'] ?? '';
            $this->label_ortu_pria = $invitation->content['label_ortu_pria'] ?? 'Putra Pertama Dari';
            $this->label_ortu_wanita = $invitation->content['label_ortu_wanita'] ?? 'Putri Bungsu Dari';

            $this->tanggal_akad = $invitation->content['tanggal_akad'] ?? '';
            $this->tanggal_resepsi = $invitation->content['tanggal_resepsi'] ?? '';
            $this->tempat_akad = $invitation->content['tempat_akad'] ?? '';
            $this->alamat_akad = $invitation->content['alamat_akad'] ?? '';
            $this->tempat_resepsi = $invitation->content['tempat_resepsi'] ?? '';
            $this->alamat_resepsi = $invitation->content['alamat_resepsi'] ?? '';
            $this->maps = $invitation->content['maps'] ?? '';
            $this->existing_music = $invitation->content['music'] ?? null;

            // Load data dari JSON ke array photo_slots
            if (isset($invitation->content['dynamic_photos'])) {
                foreach ($invitation->content['dynamic_photos'] as $item) {
                    $this->photo_slots[] = [
                        'label' => $item['label'],
                        'file' => null,
                        'existing' => $item['path']
                    ];
                }
            }

            if (isset($invitation->content['love_stories'])) {
                foreach ($invitation->content['love_stories'] as $story) {
                    $this->love_stories[] = [
                        'year' => $story['year'],
                        'title' => $story['title'],
                        'story' => $story['story']
                    ];
                }
            }
            if (isset($invitation->content['gifts'])) {
                $this->gifts = $invitation->content['gifts'];
            } else {
                $this->addGift(); // Default 1 slot jika data kosong
            }
        } else {
            $this->slug = $this->order->slug;
            $this->nama_pria = $this->order->groom_name;
            $this->nama_wanita = $this->order->bride_name;
            $this->label_ortu_pria = 'Putra Pertama Dari';
            $this->label_ortu_wanita = 'Putri Bungsu Dari';
            $this->addSlot();
            $this->addStory();
            $this->addGift();
        }
    }

    public function addSlot()
    {
        $this->photo_slots[] = ['label' => '', 'file' => null, 'existing' => null];
    }
    public function addStory()
    {
        $this->love_stories[] = ['year' => '', 'title' => '', 'story' => ''];
    }
    public function addGift()
    {
        $this->gifts[] = ['bank_name' => '', 'account_number' => '', 'account_name' => ''];
    }
    public function removeGift($index)
    {
        unset($this->gifts[$index]);
        $this->gifts = array_values($this->gifts);
    }
    public function removeStory($index)
    {
        unset($this->love_stories[$index]);
        $this->love_stories = array_values($this->love_stories);
    }
    public function removeSlot($index)
    {
        // Ambil info file yang mau dihapus
        $pathToDelete = $this->photo_slots[$index]['existing'] ?? null;

        if ($pathToDelete) {
            // Hapus file dari disk public
            if (Storage::disk('public')->exists($pathToDelete)) {
                Storage::disk('public')->delete($pathToDelete);
            }
        }

        // Baru kemudian hapus dari array
        unset($this->photo_slots[$index]);
        $this->photo_slots = array_values($this->photo_slots);
    }

    public function save()
    {
        $this->validate([
            'photo_slots.*.label' => 'required',
            'photo_slots.*.file' => 'nullable|image|max:5120', // Max 5MB
            'music_file' => 'nullable|mimes:mp3,wav|max:10240',
        ]);

        $finalPhotos = [];

        foreach ($this->photo_slots as $index => $slot) {
            $path = $slot['existing'];

            if (isset($slot['file']) && $slot['file']) {
                // JIKA ADA FILE BARU DIUPLOAD:
                // 1. Hapus file lama jika sebelumnya sudah ada
                if ($slot['existing'] && Storage::disk('public')->exists($slot['existing'])) {
                    Storage::disk('public')->delete($slot['existing']);
                }

                // 2. Simpan file baru
                $path = $slot['file']->store('invitations/' . $this->slug, 'public');
            }

            $finalPhotos[] = [
                'label' => $slot['label'],
                'path' => $path
            ];
        }
        $musicPath = $this->existing_music;
        if ($this->music_file) {
            // Hapus musik lama jika ada
            if ($this->existing_music && Storage::disk('public')->exists($this->existing_music)) {
                Storage::disk('public')->delete($this->existing_music);
            }
            // Simpan musik baru
            $musicPath = $this->music_file->store('invitations/' . $this->slug . '/music', 'public');
        }
        Invitation::updateOrCreate(
            ['order_id' => $this->order->id],
            [
                'catalog_id' => $this->order->catalog_id,
                'slug' => $this->slug,
                'content' => [
                    'nama_pria' => $this->nama_pria,
                    'nama_pria_lengkap' => $this->nama_pria_lengkap, // Simpan teks
                    'nama_wanita' => $this->nama_wanita,
                    'nama_wanita_lengkap' => $this->nama_wanita_lengkap, // Simpan teks
                    'nama_ortu_pria' => $this->nama_ortu_pria,
                    'nama_ortu_wanita' => $this->nama_ortu_wanita,
                    'label_ortu_pria' => $this->label_ortu_pria,
                    'label_ortu_wanita' => $this->label_ortu_wanita,
                    'tanggal_akad' => $this->tanggal_akad,
                    'tanggal_resepsi' => $this->tanggal_resepsi,
                    'tempat_akad' => $this->tempat_akad,
                    'alamat_akad' => $this->alamat_akad,
                    'tempat_resepsi' => $this->tempat_resepsi,
                    'alamat_resepsi' => $this->alamat_resepsi,
                    'maps' => $this->maps,
                    'dynamic_photos' => $finalPhotos,
                    'love_stories' => $this->love_stories,
                    'music' => $musicPath,
                    'gifts' => $this->gifts,
                ]
            ]
        );

        return redirect()->route('admin.orders')->with('success', 'Undangan berhasil disimpan!');
    }

    public function render()
    {
        return view('livewire.admin.createinvitation');
    }
}
