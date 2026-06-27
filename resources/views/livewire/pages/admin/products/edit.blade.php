<?php

use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.admin')]
class extends Component {
    public Collection $categories;
    public ProductForm $productForm;
    public Product $product;

    public function mount(Product $product): void
    {
        $this->categories = Category::get()->pluck('name', 'id');
        $this->product = $product;

        $this->productForm->fill($this->product->only([
            'category_id',
            'name',
            'description',
            'buy_price',
            'discount_price',
            'available_amount',
            'is_visible',
        ]));
    }

    public function save()
    {
        $this->validate();
        $this->product->update($this->productForm->all());

        return $this->redirect(route('admin.products.index'));
    }
}; ?>

<div>
    <h2 class="text-2xl mb-6 mt-2">Edytuj produkt</h2>
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base">
        <div class="rounded-2xl border border-gray-200 bg-white">
            <div class="space-y-6 border-gray-100 p-5 sm:p-6">
                <form wire:submit.prevent="save">
                    <div class="-mx-2.5 flex flex-wrap gap-y-5">
                        <div class="w-full px-2.5">
                            <h4 class="border-b border-gray-200 pb-4 text-base font-medium text-gray-800">
                                Dane produktu
                            </h4>
                        </div>

                        <div class="w-full px-2.5 xl:w-1/2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                Nazwa <span class="text-red-500">*</span>
                            </label>
                            <input type="text" placeholder="Wpisz nazwę produktu" wire:model="productForm.name"
                                   class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">

                            @error('productForm.name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="w-full px-2.5 xl:w-1/2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                Kategoria
                            </label>
                            <div class="relative z-20 bg-transparent">
                                <select
                                    wire:model="productForm.category_id"
                                    class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">
                                    <option value="">-- Wybierz kategorię produktu --</option>
                                    @foreach ($categories as $id => $name)
                                        <option value="{{ $id }}" class="text-gray-500">
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500">
                                  <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                       xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                  </svg>
                                </span>
                                @error('productForm.category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="w-full px-2.5">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                Opis
                            </label>
                            <div class="relative z-20 bg-transparent">
                                <textarea
                                    wire:model="productForm.description"
                                    class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden"
                                    rows="10"></textarea>

                                @error('productForm.description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="w-full px-2.5 xl:w-1/2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                Cena <span class="text-red-500">*</span>
                            </label>
                            <input type="number" step="0.01"
                                   wire:model="productForm.buy_price"
                                   class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">

                            @error('productForm.buy_price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="w-full px-2.5 xl:w-1/2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                Cena promocyjna
                            </label>
                            <input type="number" step="0.01"
                                   wire:model="productForm.discount_price"
                                   class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden"
                                   placeholder="Pozostaw pole puste, jeśli nie chcesz podawać ceny promocyjnej">
                            @error('productForm.discount_price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="w-full px-2.5 xl:w-1/2">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                Dostępna ilość <span class="text-red-500">*</span>
                            </label>
                            <input type="number" value="0" wire:model="productForm.available_amount"
                                   class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">
                            @error('productForm.available_amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="w-full px-2.5">
                            <div class="flex items-center gap-3">
                                <label class="text-sm font-medium text-gray-800">
                                    Produkt widoczny:
                                </label>

                                <div class="flex flex-wrap items-center gap-4">
                                    <div>
                                        <input type="checkbox"
                                               id="is_visible"
                                               name="is_visible"
                                               wire:model="productForm.is_visible"
                                               class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    @error('productForm.is_visible') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="w-full px-2.5">
                            <div class="mt-1 flex items-center gap-3">
                                <button type="submit"
                                        class="text-white bg-blue-700 inline-block rounded-md box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                                    Zapisz zmiany
                                </button>

                                <a href="{{ route('admin.products.index') }}"
                                   class="flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800">
                                    Anuluj
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
