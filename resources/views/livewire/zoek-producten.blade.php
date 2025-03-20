


<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
<flux:input type="text" wire:model.live="query" placeholder="Search users"/>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" wire:click="sortBy('naam')" class="px-6 py-3">
                    Naam
                    @if ($sortField === 'naam')
                        @if ($sortDirection === 'asc')
                            ▲
                        @else
                            ▼
                        @endif
                    @endif
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        omschrijving
                    </div>
                </th>
                <th scope="col" wire:click="sortBy('prijs')" class="px-6 py-3">
                    <div class="flex items-center">
                        Prijs
                        @if ($sortField === 'prijs')
                            @if ($sortDirection === 'asc')
                                ▲
                            @else
                                ▼
                            @endif
                        @endif
                        {{-- <a href="#" > <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
  </svg></a> --}}
                    </div>
                </th>
              
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
                <th>
                    <span scope="col"></span>
                </th>
            </tr>
        </thead>
        <tbody>
         @foreach($producten as $product)
         <tr>
        <td>{{ $product->naam }}
        </td>
        <td>{{ $product->omschrijving }}
        </td>
        <td>
           €{{ $product->prijs }}
        </td>
        
            <td>
            <flux:button
                    x-on:click="$wire.$js.addToCart({{ $product->id }}, '{{ $product->naam }}', {{ $product->prijs }}, '{{ $product->afbeelding }}')"
                    class="bg-blue-500 text-white px-4 py-2 mt-2 rounded"
                > Add to Cart
                </flux:button>
                </td>
    </tr> @endforeach </tbody>
    
    </table>
    {{ $producten->links() }}
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
    $wire.showMessage("success", data.message);


        })
        .catch(error => $wire.showMessage('Error', error));
    })
</script>
@endscript
</div>
