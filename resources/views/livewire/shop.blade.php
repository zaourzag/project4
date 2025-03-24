<div>
    <h1>Product Page</h1>
    <div class="grid grid-flow-row
                grid-cols-1
                md:grid-cols-3
                {{-- lg:grid-cols-3 --}}
                gap-4">
        @foreach($products as $product)
            <flex:field class="border p-4">
                <img src="{{ $product->afbeelding }}" alt="{{ $product->naam }}" class="w-full h-48 object-cover">
                <h2 class="text-xl font-bold">{{ $product->naam }}</h2>
                <p>{{ $product->omschrijving }}</p>
                <p class="text-lg font-semibold">€{{ $product->prijs }}</p>
                <flux:button
                    x-on:click="$wire.$js.addToCart({{ $product->id }}, '{{ $product->naam }}', {{ $product->prijs }}, '{{ $product->afbeelding }}')"
                    > Add to Cart
                </flux:button>
            </flex:field>
        @endforeach
    </div>
</div>
@script
<script>
    $js("addToCart", (id, name, price, image) => {
        axios.post('/api/cart/add', {
      
                id: id,
                name: name,
                price: price,
                image: image,
                quantity: 1,
            })
            .then(data => {
                // Dispatch the event to the backend
                data.message = `${name} added to cart`;
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
            .catch(error => console.error('Error:', error));
    });
</script>
@endscript