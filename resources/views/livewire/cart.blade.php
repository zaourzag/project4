<div>
    <h1 class="text-2xl font-bold mb-4">Your Shopping Cart</h1>
    <div>
        @if(empty($cart))
            <p class="text-gray-500">{{ __('messages.your_cart_is_empty') }}</p>
        @else
            <!-- Responsive grid layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($cart as $item)
                    <!-- Responsive flux:field -->
                    <flux:field class="border p-2 md:p-4 rounded-lg shadow-md color-zinc-50 text-sm md:text-base">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-32 md:h-48 object-cover rounded-md mb-2 md:mb-4">
                        <h2 class="text-sm md:text-lg font-semibold">{{ $item['name'] }}</h2>
                        <p class=" text-sm md:text-base">{{ __('price') }}: €{{ $item['price'] }}</p>
                        <p class=" text-sm md:text-base">{{ __('quantity') }}: {{ $item['quantity'] }}</p>
                        <p class=" font-bold text-sm md:text-base">{{__('total')}} €{{ $item['price'] * $item['quantity'] }}</p>
                        <flux:button wire:click="$js.removeFromCart({{ $item['id'] }})" class="bg-red-500 text-white px-2 py-1 md:px-4 md:py-2 mt-2 md:mt-4 rounded hover:bg-red-600">Remove from Cart</flux:button>
                    </flux:field>
                @endforeach
            </div>
            <!-- Total and Clear Cart button -->
            <div class="mt-6">
                <p class="text-xl font-bold">Total: €{{ $total }}</p>
                <flux:button wire:click="$js.clearCart()" class="bg-blue-500 text-white px-6 py-2 mt-4 rounded hover:bg-blue-600">Clear Cart</flux:button>
            </div>
        @endif
    </div>
</div>
@script
<script>
    $js("removeFromCart", (id) => {
        fetch('/api/cart/remove', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                id: id,
            }),
        })
            .then(response => response.json())
            .then(data => {
                Livewire.dispatch("cartUpdated2"); // Emit Livewire event to refresh the cart
                axios.post('/broadcast-event', {
                    state: 'success',
                    message: data.message,
                })
                    .then(eventResponse => {
                        console.log('Event dispatched:', eventResponse.data);
                    })
                    .catch(eventError => console.error('Error dispatching event:', eventError));

                Livewire.dispatch("cartUpdated"); // Emit Livewire event to update the cart count
            })

            .catch(error => console.error('error', error));
    });
</script>
@endscript
@script
<script>
    $js("clearCart", (a) => {
        console.log('Cart cleared');
        axios.post('/api/cart/clear').then((response) => {
                    Livewire.dispatch('cartUpdated2');

            axios.post('/broadcast-event', {
                state: 'success',
                message: response.data.message,
            })
                .then(eventResponse => {
                    console.log('Event dispatched:', eventResponse.data);
                })
                .catch(eventError => console.error('Error dispatching event:', eventError));
                        Livewire.dispatch("cartUpdated"); // Emit Livewire event to update the cart count

        })
        .catch(error => console.error('Error:', error));

    });
</script>
@endscript
