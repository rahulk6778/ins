<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Api extends ResourceController
{
    protected $modelName = 'App\Models\ProductModel';
    protected $format    = 'json';

    /**
     * Get all products
     */
    public function products()
    {
        try {
            $products = $this->model->findAll();
            return $this->respond([
                'success' => true,
                'data' => $products,
                'count' => count($products),
                'timestamp' => date('c')
            ], 200);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    /**
     * Get single product by ID
     */
    public function product($id = null)
    {
        if ($id === null) {
            return $this->fail('Product ID is required', 400);
        }

        try {
            $product = $this->model->find($id);
            if (!$product) {
                return $this->failNotFound('Product not found');
            }
            return $this->respond([
                'success' => true,
                'data' => $product,
                'timestamp' => date('c')
            ], 200);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    /**
     * Get all categories
     */
    public function categories()
    {
        try {
            $categories = [
                ['id' => 'games', 'name' => 'Games', 'emoji' => '🎮'],
                ['id' => 'software', 'name' => 'Software', 'emoji' => '💻'],
                ['id' => 'subscriptions', 'name' => 'Subscriptions', 'emoji' => '📺'],
                ['id' => 'gift-cards', 'name' => 'Gift Cards', 'emoji' => '🎁'],
                ['id' => 'ai-tools', 'name' => 'AI Tools', 'emoji' => '🤖'],
            ];

            return $this->respond([
                'success' => true,
                'data' => $categories,
                'count' => count($categories),
                'timestamp' => date('c')
            ], 200);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    /**
     * Get products by category
     */
    public function category($id = null)
    {
        if ($id === null) {
            return $this->fail('Category ID is required', 400);
        }

        try {
            $products = $this->model->where('category', $id)->findAll();
            return $this->respond([
                'success' => true,
                'category' => ['id' => $id, 'name' => ucfirst($id)],
                'data' => $products,
                'count' => count($products),
                'timestamp' => date('c')
            ], 200);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    /**
     * Calculate cart total
     */
    public function cartCalculate()
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->fail('POST method required', 405);
        }

        $items = $this->request->getJSON()->items ?? [];
        $taxRate = $this->request->getJSON()->taxRate ?? 0.08;

        if (empty($items)) {
            return $this->fail('Items array is required', 400);
        }

        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += ($item->price ?? 0) * ($item->quantity ?? 1);
        }

        $tax = $subtotal * $taxRate;
        $total = $subtotal + $tax;

        return $this->respond([
            'success' => true,
            'data' => [
                'items' => $items,
                'subtotal' => round($subtotal, 2),
                'tax' => round($tax, 2),
                'discount' => 0,
                'total' => round($total, 2),
                'itemCount' => count($items),
                'timestamp' => date('c')
            ]
        ], 200);
    }

    /**
     * Process checkout
     */
    public function checkout()
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->fail('POST method required', 405);
        }

        $data = $this->request->getJSON();
        $items = $data->items ?? [];
        $customer = $data->customer ?? null;

        if (empty($items) || !$customer) {
            return $this->fail('Items and customer info required', 400);
        }

        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += ($item->price ?? 0) * ($item->quantity ?? 1);
        }

        $tax = $subtotal * 0.08;
        $total = $subtotal + $tax;
        $orderId = 'ORD-' . time();

        return $this->respond([
            'success' => true,
            'data' => [
                'orderId' => $orderId,
                'status' => 'completed',
                'total' => round($total, 2),
                'items' => count($items),
                'customer' => $customer->email ?? 'unknown',
                'timestamp' => date('c'),
                'estimatedDelivery' => date('c', strtotime('+4 days'))
            ]
        ], 200);
    }

    /**
     * Health check endpoint
     */
    public function health()
    {
        return $this->respond([
            'status' => 'ok',
            'timestamp' => date('c')
        ], 200);
    }
}
