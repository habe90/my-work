<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
</head>

<body>

    <p>Poštovani,</p>
    <p>Sljedeći dokumenti su uploadani za verifikaciju firme:</p>
    <ul>
        @foreach ($files as $file)
            <li>{{ $file }}</li>
        @endforeach
    </ul>
    <p>Molimo vas da provjerite dokumente i preduzmete potrebne korake.</p>
    <p>Hvala vam što koristite naše usluge.</p>

</body>

</html>
