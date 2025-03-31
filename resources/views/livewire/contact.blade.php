<div id="right">
    <form action="/send-mail" method="post">
        @csrf
        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" required>
    
        <label for="email">Jouw e-mailadres:</label>
        <input type="email" id="email" name="email" required>
    
        <label for="message">Bericht:</label>
        <textarea id="message" name="message" required></textarea>
    
        <button type="submit">Verzenden</button>
    </form>
    
</div>