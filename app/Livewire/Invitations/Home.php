<?php

namespace App\Livewire\Invitations;

use App\Models\Invitation;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.invitation')]
class Home extends Component
{
    public $invitation;
    public $guestName;

    public function mount($slug)
    {
        // Ambil data yang sama seperti di Show
        $this->invitation = Invitation::with('catalog')
            ->where('slug', $slug)
            ->firstOrFail();
        $this->guestName = request()->query('to', 'Bapak/Ibu/Saudara/i');
        $this->setSeo();
    }

    private function setSeo()
    {
        $title = $this->invitation->content['nama_pria'] . ' & ' . $this->invitation->content['nama_wanita'];
        $description = 'The Wedding of ' . $title;
        $ogImage = asset('assets/img/default-thumbnail.jpg');

        if (!empty($this->invitation->content['og_image'])) {
            $ogImage = asset('storage/' . $this->invitation->content['og_image']);
        }

        \Artesaos\SEOTools\Facades\SEOMeta::setTitle($title);
        \Artesaos\SEOTools\Facades\SEOMeta::setDescription($description);
        \Artesaos\SEOTools\Facades\SEOMeta::setCanonical(url()->current());

        \Artesaos\SEOTools\Facades\OpenGraph::setTitle($title);
        \Artesaos\SEOTools\Facades\OpenGraph::setDescription($description);
        \Artesaos\SEOTools\Facades\OpenGraph::setUrl(url()->current());
        \Artesaos\SEOTools\Facades\OpenGraph::addImage($ogImage);
        \Artesaos\SEOTools\Facades\OpenGraph::addProperty('type', 'website');

        \Artesaos\SEOTools\Facades\TwitterCard::setTitle($title);
        \Artesaos\SEOTools\Facades\TwitterCard::setSite('@voeu'); // Or whatever the handle is
    }

    public function render()
    {
        $templateName = $this->invitation->catalog->slug; // Misal: 'vintage-royal'
        view()->share('invitation', $this->invitation);
        // Arahkan ke blade home yang ada di dalam folder template tersebut
        return view('livewire.invitations.' . $templateName . '.home', [
            'invitation' => $this->invitation,
            'guestName' => $this->guestName
        ]);
    }
}
