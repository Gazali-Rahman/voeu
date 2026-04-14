<?php

namespace App\Livewire\Admin;

use App\Models\Catalog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class ManageCatalog extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';

    // Form properties
    public $name, $slug, $description, $price, $image, $preview_url;
    public $is_active = true;
    public $catalog_id = null;
    public $oldImage;

    // Modal state
    public $isModalOpen = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function openModal()
    {
        $this->resetInputFields();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->slug = '';
        $this->description = '';
        $this->price = '';
        $this->image = null;
        $this->oldImage = null;
        $this->preview_url = '';
        $this->is_active = true;
        $this->catalog_id = null;
    }

    public function store()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:catalogs,slug,' . $this->catalog_id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'preview_url' => 'nullable',
            'is_active' => 'boolean',
        ];

        if ($this->catalog_id) {
            $rules['image'] = 'nullable|image|max:2048'; // 2MB Max
        } else {
            $rules['image'] = 'required|image|max:2048';
        }

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'preview_url' => $this->preview_url,
            'is_active' => $this->is_active,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('catalogs', 'public');

            // Delete old image if updating
            if ($this->catalog_id && $this->oldImage) {
                Storage::disk('public')->delete($this->oldImage);
            }
        }

        Catalog::updateOrCreate(['id' => $this->catalog_id], $data);

        session()->flash('message', $this->catalog_id ? 'Catalog Updated Successfully.' : 'Catalog Created Successfully.');

        $this->closeModal();
    }

    public function edit($id)
    {
        $catalog = Catalog::findOrFail($id);
        $this->catalog_id = $catalog->id;
        $this->name = $catalog->name;
        $this->slug = $catalog->slug;
        $this->description = $catalog->description;
        $this->price = $catalog->price;
        $this->oldImage = $catalog->image; // Store old image path
        $this->preview_url = $catalog->preview_url;
        $this->is_active = $catalog->is_active;

        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        $catalog = Catalog::findOrFail($id);
        if ($catalog->image) {
            Storage::disk('public')->delete($catalog->image);
        }
        $catalog->delete();
        session()->flash('message', 'Catalog Deleted Successfully.');
    }

    public function toggleActive($id)
    {
        $catalog = Catalog::findOrFail($id);
        $catalog->update(['is_active' => !$catalog->is_active]);
        session()->flash('message', 'Catalog Status Updated Successfully.');
    }

    public function render()
    {
        $catalogs = Catalog::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.manage-catalog', compact('catalogs'));
    }
}
