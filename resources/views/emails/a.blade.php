<!DOCTYPE html>
<html>
<head>
    <title>Nieuw bericht</title>
</head>
<body>
    <p><strong>Naam:</strong> {{ $details['name'] }}</p>
    <p><strong>E-mail:</strong> {{ $details['email'] }}</p>
    <p><strong>Bericht:</strong><br> {{ nl2br(e($details['message'])) }}</p>
</body>
</html>
