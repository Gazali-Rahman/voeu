<?php

namespace App\Livewire\Admin;

use App\Models\Promo;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class Managepromo extends Component
{
    use WithPagination;

    public $code, $type = 'fixed', $value, $limit, $expires_at, $is_active = true;
    public $promoId;
    public $isEdit = false;

    // Tambahkan properti pencarian jika perlu
    public $search = '';

    protected function rules()
    {
        return [
            'code' => 'required|unique:promos,code,' . $this->promoId,
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:1',
            'limit' => 'required|integer|min:1',
            'expires_at' => 'nullable|date',
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->isEdit) {
            $promo = Promo::find($this->promoId);
            $promo->update([
                'code' => strtoupper($this->code),
                'type' => $this->type,
                'value' => $this->value,
                'limit' => $this->limit,
                'expires_at' => $this->expires_at,
                'is_active' => $this->is_active,
            ]);
            session()->flash('success', 'Promo berhasil diperbarui.');
        } else {
            Promo::create([
                'code' => strtoupper($this->code),
                'type' => $this->type,
                'value' => $this->value,
                'limit' => $this->limit,
                'expires_at' => $this->expires_at,
                'is_active' => true,
            ]);
            session()->flash('success', 'Promo berhasil ditambahkan.');
        }

        $this->cancelEdit();
    }

    public function edit($id)
    {
        $promo = Promo::findOrFail($id);
        $this->promoId = $id;
        $this->code = $promo->code;
        $this->type = $promo->type;
        $this->value = $promo->value;
        $this->limit = $promo->limit;
        $this->expires_at = $promo->expires_at ? date('Y-m-d\TH:i', strtotime($promo->expires_at)) : null;
        $this->is_active = $promo->is_active;
        $this->isEdit = true;
    }

    public function cancelEdit()
    {
        $this->reset(['code', 'type', 'value', 'limit', 'expires_at', 'promoId', 'isEdit', 'is_active']);
    }

    public function toggleStatus($id)
    {
        $promo = Promo::findOrFail($id);
        $promo->update([
            'is_active' => !$promo->is_active
        ]);
    }

    public function delete($id)
    {
        Promo::find($id)->delete();
        session()->flash('success', 'Promo berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.managepromo', [
            'promos' => Promo::where('code', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(10)
        ]);
    }
}
