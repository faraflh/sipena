<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function index()
    {
        $services = [
            [
                'icon' => 'bi-gem',
                'title' => 'Premium Quality',
                'description' => 'Experience the best quality services tailored to your needs.'
            ],
            [
                'icon' => 'bi-bar-chart',
                'title' => 'Data Analytics',
                'description' => 'Transform your data into actionable insights.'
            ],
            [
                'icon' => 'bi-brush',
                'title' => 'Creative Design',
                'description' => 'Make your brand stand out with stunning designs.'
            ],
        ];

        $aboutPoints = [
            'Innovative solutions for complex problems.',
            'Dedicated to achieving excellence.',
            'A team of experts with diverse skillsets.',
        ];

        $clients = [
            ['name' => 'Client One', 'logo' => 'client1.png'],
            ['name' => 'Client Two', 'logo' => 'client2.png'],
            ['name' => 'Client Three', 'logo' => 'client3.png'],
        ];

        // Pass data to the view
        return view('beranda', compact('services', 'aboutPoints', 'clients'));
    }
}
