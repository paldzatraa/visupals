<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Category;
use App\Models\Contact;

class FrontController extends Controller
{
    // Menampilkan halaman utama (Home)
    public function index()
    {
        // Mengambil 6 portofolio terbaru untuk ditampilkan di depan
        $recentPortfolios = Portfolio::with(['category', 'media' => function($query) {
            $query->where('is_featured', true); // Hanya ambil foto utama/sampul
        }])->latest()->take(6)->get();

        return view('front.home', compact('recentPortfolios'));
    }

    // Menampilkan halaman semua karya/portofolio
    public function portfolio()
    {
        $categories = Category::all();
        // Mengambil semua portofolio beserta foto utamanya
        $portfolios = Portfolio::with(['category', 'media' => function($query) {
            $query->where('is_featured', true);
        }])->latest()->get();

        return view('front.portfolio', compact('categories', 'portfolios'));
    }

    // Menampilkan detail satu proyek
    public function show($slug)
    {
        // Mencari portofolio berdasarkan slug (URL) beserta semua foto/videonya
        $portfolio = Portfolio::with(['category', 'media'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('front.show', compact('portfolio'));
    }

    // Menampilkan halaman kontak
    public function contact()
    {
        return view('front.contact');
    }

    // Memproses data formulir kontak yang dikirim pengunjung
    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());

        return redirect()->back()->with('success', 'Pesan kamu berhasil dikirim! Saya akan segera membalasnya.');
    }
}