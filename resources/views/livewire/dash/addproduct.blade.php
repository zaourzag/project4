<div>
    <form wire:submit="uploadImage">
    <flux:field>
        <flux:label>Product Name</flux:label>
        <flux:input x-ref="name" />
        <flux:error name="name" />
    </flux:field>

    <flux:field>
        <flux:label>Product Description</flux:label>
        <flux:textarea x-ref="description"></flux:textarea>
        <flux:error name="description" />
    </flux:field>

    <flux:field>
        <flux:label>Product Price</flux:label>
        <flux:input type="number" x-ref="price" />
        <flux:error name="price" />
    </flux:field>

    <form wire:submit="uploadImage">
        <flux:field>
            <flux:label>Product Image</flux:label>
            <flux:input type="file" wire:model="photo" />
            <flux:error name="photo" />
        </flux:field>
    
        <button type="submit">Upload Image</button>
    </form>

    <flux:button wire:click="$js.addProduct($refs.name.value, $refs.description.value, $refs.price.value,$wire.el.querySelector(`input[type='file']`).files[0] )" type="submit">
        Add Product
    </flux:button> 
   
    </form>
    <div id="image-preview" class="mt-4">
        <!-- This will display the uploaded image URL -->
        <p id="image-url"></p>
    </div>

    @error('photo') <span class="error">{{ $message }}</span> @enderror
</div>

</div>
@script
<script>
    $wire.on('imageUploaded', () => {
  
        const imageUrl = event.detail;
            window.imageurl = imageUrl[0].url;
            console.log(imageUrl[0].url);
            document.getElementById('image-url').textContent = `Image URL: ${imageUrl[0].url}`;
            console.log('Image uploaded:', imageUrl);
        // Clear the input field after the image has been uploaded
    });

    </script>
    <script>
        window.addEventListener('imageUploaded', event => {
           
        });
    </script>
@endscript
@script
<script>
    $js("addProduct", (name, description, price, image) => {
        const formData = new FormData();
        formData.append('name', name);
        formData.append('description', description);
        formData.append('price', price);
        formData.append('image', window.imageurl);

        axios.post('/api/products/create', formData, )
        .then(response => {
            const data = response.data;
            console.log(data);
            if (data.message) {
                Livewire.dispatch("productAdded"); // Emit Livewire event to update the UI
                $wire.showMessage("success", data.message);
            }
        })
        .catch(error => {
            const errorMessage = error.response?.data?.message || error.message || 'An error occurred';
            $wire.showMessage('error', errorMessage);
        });
    });
</script>
@endscript