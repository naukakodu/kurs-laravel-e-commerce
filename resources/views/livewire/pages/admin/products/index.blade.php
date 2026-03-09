<?php

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new #[Layout('layouts.admin')]
class extends Component {
    use WithPagination;

    public function with(): array
    {
        return [
            'products' => Product::paginate(5),
        ];
    }
}; ?>

<div>
    <h2 class="text-2xl mb-6 mt-2">Lista produktów</h2>
    <div class="mb-4">
        {{ $products->links() }}
    </div>
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-gray-200 border-b rounded-base border-default">
            <tr>
                <th scope="col" class="px-6 py-3 font-medium">
                    Nazwa produktu
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    Nazwa kategorii
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    Cena 'Kup teraz'
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    Cena promocyjna
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    Ilość w magazynie
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    Widoczny
                </th>
                <th scope="col" class="px-6 py-3 font-medium">
                    Utworzono
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
                <tr class="bg-neutral-primary border-b border-default">
                    <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                        {{ $product->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $product->category->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ Number::currency($product->buy_price, 'PLN') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->discount_price ? Number::currency($product->discount_price, 'PLN') : 'Nie określono' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->available_amount }} sztuk
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->is_visible ? 'Tak' : 'Nie' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->created_at->format('d.m.y H:i:s') }}
                    </td>
                </tr>
            @empty
                <tr class="bg-neutral-primary border-b border-default">
                    <td colspan="7" class="text-center py-4">Brak produktów</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
