<x-layouts.app.navbar :title="$title ?? 'Heavenly socks'">
    <flux:main>
        {{ $slot }}
    </flux:main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (!window.userID) {
                console.error('User ID is not defined.');
                return;
            }

            Echo.private(`messages.${window.userID}`)
                .listen('.message.broadcasted', (event) => {
                    console.log('Message received:', event);

                    // Display the message using iziToast
                    window.iziToast[event.state]({
                        title: 'Heavenly socks',
                        message: event.message,
                        position: 'topRight',
                        timeout: 3000, //Display Time
                    });
                });
        });
    </script>
</x-layouts.app.navbar>
