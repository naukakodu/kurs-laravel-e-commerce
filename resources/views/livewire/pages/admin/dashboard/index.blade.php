<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.admin')] class extends Component {
    //
}; ?>

<div>
    <div class="grid grid-flow-col grid-rows-2 gap-4">
        <div class="col-span-1 grid grid-flow-col gap-4">
            <x-admin.card title="Klienci" body="122"/>
            <x-admin.card title="Zamówienia" body="432"/>
        </div>
        <div class="col-span-1">
            <x-admin.card title="Sprzedaż miesięczna" body="+ 29%"/>
        </div>
        <div class="row-span-2 col-span-2">
            <x-admin.card title="Cele na ten miesiąc" body="Sprzedaż - 500"/>
        </div>
    </div>
</div>
