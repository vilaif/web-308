<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;
use CodeIgniter\Controller;
use CodeIgniter\Session\Session;

class CartController extends BaseController
{
    public function addToCart()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login untuk menambah keranjang.');
        }
        
        $session = session();
        $cart = $session->get('cart') ?? [];

        $productId = $this->request->getPost('product_id');
        $productName = esc($this->request->getPost('product_name'));
        $price = $this->request->getPost('price');
        $quantity = (int)$this->request->getPost('quantity');

        // Validasi input
        if (!$productId || !$productName || !$price || $quantity <= 0) {
            return redirect()->back()->with('error', 'Data produk tidak valid.');
        }

        // Tambah atau update quantity
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $productName,
                'price' => $price,
                'quantity' => $quantity,
            ];
        }

        $session->set('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }


    public function viewCart()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login untuk melihat keranjang.');
        }
        
        $session = session();
        $cart = $session->get('cart') ?? [];

        return view('cart', [
            'cart' => $cart, 
            'title' => $this->titleData,
        ]);
    }

    public function updateQuantity()
    {
        $session = session();
        $cart = $session->get('cart') ?? [];

        $productId = $this->request->getPost('product_id');
        $newQuantity = (int) $this->request->getPost('quantity');

        if (isset($cart[$productId])) {
            if ($newQuantity > 0) {
                $cart[$productId]['quantity'] = $newQuantity;
            } else {
                unset($cart[$productId]); // hapus jika jumlah 0 atau kurang
            }
            $session->set('cart', $cart);
        }

        return redirect()->to('/cart')->with('success', 'Jumlah produk diperbarui.');
    }

    public function removeFromCart($productId)
    {
        $session = session();
        $cart = $session->get('cart') ?? [];

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $session->set('cart', $cart);
        }

        return redirect()->to('/cart')->with('success', 'Produk dihapus dari keranjang.');
    }


}