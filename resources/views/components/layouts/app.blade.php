<x-layouts.app.navbar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
    <script>
    window.userID = {{ optional(auth()->user())->id }};
    let userId = window.userID;
Echo.private(`messages.${userId}`) // Replace `userId` with the authenticated user's ID
.listen('.message.broadcasted', (event) => {
    console.log('Message received:', event);
    $wire.showMessage('success', event.message);
});

    
</script>

</x-layouts.app.navbar>
