<?php

namespace App\Http\Controllers;

use  App\Models\Store;

class StoreController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $stores = Store::all();
        return view('store.index', compact('stores'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        return view('store.create');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $data = request()->validate([
        'name' => 'required|string',
        'description' => 'nullable|string',
        'image' => 'nullable|file',
        'address' => 'nullable|string',
        'schedule' => 'nullable|string',
        'longitude' => 'nullable|string',
        'latitude' => 'nullable|string'
        ]);

        $data = $this->services->getGeoData($data);

        if (request()->hasFile('image')) {
            $data['image']= $this->imageService->storeImage(request()->file('image'));
        }
        Store::create($data);
        return redirect()->route('stores.index');
    }

    /**
     * @param Store $store
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(Store $store)
    {
        return view('store.edit', compact('store'));
    }

    /**
     * @param Store $store
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Store $store)
    {
        $data = request()->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|file',
            'address' => 'nullable|string',
            'schedule' => 'nullable|string',
            'longitude' => 'nullable|string',
            'latitude' => 'nullable|string'
        ]);
        $data = $this->services->getGeoData($data);

        if (request()->hasFile('image')) {
            $data['image'] = $this->imageService->storeImage(request()->file('image'));
            $this->imageService->deleteStoreImage($store);
        } else {
            unset($data['image']);
        }
        $store->update($data);

        return redirect()->route('stores.edit', $store->id);
    }

    /**
     * @param Store $store
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Store $store)
    {
        $this->imageService->deleteStoreImage($store);
        $store->delete();
        return redirect()->route('stores.index');
    }

}
