<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-y5TtpIOlSRzwbREL"></script>

</head>

<body>
    <button class="btn btn-primary" id="btn-bayar">Bayar</button>
    {{-- @foreach ($token as $t) --}}
        
    <script>
        document.querySelector('#btn-bayar').addEventListener
        ('click', async () => {
            // const response = await fetch("{{ route('payment') }}")
            // const token = await response.text()
            snap.pay("{{ $token }}")
            // fetch("{{ route('payment') }}")
            // .then(response => response.text())
            // .then(token => {
            //     snap.pay(token)
            // })
        })
    </script>
    {{-- @endforeach --}}
</body>

</html>

