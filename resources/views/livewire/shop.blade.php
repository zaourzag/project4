<div>
    <h1>Product Page</h1>
    <div class="grid grid-cols-3 gap-4">
        @foreach($products as $product)
            <div class="border p-4">
                <img src="{{ $product->afbeelding }}" alt="{{ $product->naam }}" class="w-full h-48 object-cover">
                <h2 class="text-xl font-bold">{{ $product->naam }}</h2>
                <p>{{ $product->omschrijving }}</p>
                <p class="text-lg font-semibold">€{{ $product->prijs }}</p>
                <flux:button
                    x-on:click="$wire.$js.addToCart({{ $product->id }}, '{{ $product->naam }}', {{ $product->prijs }}, '{{ $product->afbeelding }}')"
                    class="bg-blue-500 text-white px-4 py-2 mt-2 rounded"> Add to Cart
                </flux:button>
            </div>
        @endforeach
    </div>
</div>
@script
<script>
    $wire.on('showSuccessMessage', message => {
        alert(message);
    });
</script>
@endscript
@script
<script>
   
    $js("addToCart", (id, name, price, image) => {
        fetch('/api/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                id: id,
                name: name,
                price: price,
                image: image,
                quantity: 1,
            }),
        })
            .then(response => response.json())
            .then(data => {
                Livewire.dispatch("cartUpdated"); // Emit Livewire event to update the cart count
                $wire.showMessage("success", data.message);
                

            })
            .catch(error => $wire.showMessage('error', error));
    })
</script>
@endscript
