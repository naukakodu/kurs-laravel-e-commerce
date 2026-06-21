<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
    #[Validate('nullable|integer|exists:categories,id')]
    public $category_id = null;

    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('nullable|string|max:2000')]
    public $description = '';

    #[Validate('required|numeric|min:0')]
    public $buy_price = 0.00;

    #[Validate('nullable|numeric|min:0|lt:buy_price')]
    public $discount_price = null;

    #[Validate('required|integer|min:0')]
    public $available_amount = 0;

    #[Validate('required|boolean')]
    public $is_visible = false;
}
