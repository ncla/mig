<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MIG</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="">
        <form method="POST" action="{{ route('product.create') }}">
            @csrf
            @method('PUT')

            <label for="ean_13">EAN-13:</label>
            <input type="text" id="ean_13" name="ean_13" maxlength="13">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>

            <label for="initial_cost">Initial cost:</label>
            <input type="number" id="initial_cost" name="initial_cost" required>

            <label for="price_with_tax">Price with tax:</label>
            <input type="number" id="price_with_tax" name="price_with_tax" required>

            <button type="submit">Save</button>
        </form>

        @if(count($products) > 0)
        <table>
            <tr>
                <th>EAN 13</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Initial Cost</th>
                <th>Price with tax</th>
            </tr>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->ean_13 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->initial_cost }}</td>
                <td>{{ $product->price_with_tax }}</td>
            </tr>
            @endforeach
        </table>
        @endif
    </body>
</html>
