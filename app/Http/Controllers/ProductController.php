<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Halaman utama (daftar produk) + pencarian
    public function index(Request $request)
    {
        // Hapus produk yang sudah expired (> 20 hari)
        $deletedCount = Product::deleteExpired();

        // Query dasar: produk aktif (belum kadaluarsa) dan belum terjual
        $query = Product::with('category')
                        ->where('created_at', '>=', now()->subDays(20))
                        ->where('is_sold', false);

        // Jika ada keyword pencarian, tambahkan filter
        if ($request->filled('search_product')) {
            $keyword = $request->search_product;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('description', 'LIKE', "%{$keyword}%");
            });
        }

        $products = $query->orderBy('created_at', 'desc')->get();
        $categories = Category::all();

        return view('home', compact('products', 'categories', 'deletedCount'));
    }

    // Filter berdasarkan kategori (type dan/atau slug)
    public function filter($type, $slug = null)
    {
        Product::deleteExpired();

        $query = Product::with('category')
                        ->where('created_at', '>=', now()->subDays(20))
                        ->where('is_sold', false);

        if ($type) {
            $query->whereHas('category', function ($q) use ($type) {
                $q->where('type', $type);
            });
        }

        if ($slug) {
            $query->whereHas('category', function ($q) use ($slug) {
                $q->where('slug', $slug);
            });
        }

        $products = $query->orderBy('created_at', 'desc')->get();
        $categories = Category::all();

        return view('home', compact('products', 'categories'));
    }

    // Form untuk menjual produk
    public function create()
    {
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    // Simpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'category_id'   => 'required|exists:categories,id',
            'name'          => 'required|string|max:255',
            'price'         => 'required|numeric|min:1000',
            'condition'     => 'required|string',
            'description'   => 'required|string',
            'seller_name'   => 'required|string',
            'seller_contact'=> 'required|string',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        Product::create([
            'category_id'   => $request->category_id,
            'name'          => $request->name,
            'price'         => $request->price,
            'condition'     => $request->condition,
            'description'   => $request->description,
            'seller_name'   => $request->seller_name,
            'seller_contact'=> $request->seller_contact,
            'image'         => $imageName,
            'is_sold'       => false
        ]);

        return redirect()->route('home')->with('success', 'Produk berhasil dijual! 🎉');
    }

    // Detail produk
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        // Jika produk sudah melewati 20 hari, anggap tidak tersedia
        if ($product->created_at < now()->subDays(20)) {
            abort(404, 'Produk sudah tidak tersedia');
        }

        return view('detail', compact('product'));
    }
}