<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

#[Layout('components.layouts.app')]
class Home extends Component
{
    public function mount()
    {
        SEOMeta::setTitle('Voeu | Jasa Undangan Digital Pernikahan Minimalis & Vintage');
        SEOMeta::setDescription('Voeu menyediakan jasa pembuatan undangan digital pernikahan berbasis website dengan desain minimalis, vintage, dan estetik. Abadikan momen spesial Anda dengan undangan digital elegant.');
        SEOMeta::setCanonical(url()->current());

        OpenGraph::setTitle('Voeu - Undangan Digital Pernikahan Minimalis & Vintage');
        OpenGraph::setDescription('Abadikan momen spesial Anda dengan undangan digital elegant dari Voeu.');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addImage(asset('assets/png/logovoeu.png'));
        OpenGraph::addProperty('type', 'website');
    }

    public function render()
    {
        return view('livewire.home');
    }
}
