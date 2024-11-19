<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>
<body>

<form action="{{ route('pypal.post') }}" method="POST">
            @csrf
            <div class="form-group">
            <input type="text" name="product_name" class="form-control" value='test_product' required>
            <input type="number" name="quantity" class="form-control" value='1'  required>
                <label for="amount">Montant (USD) :</label>
                <input type="number" name="price" class="form-control" value='' step="0.01" min="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">Payer avec PayPal</button>
</form>
</body>
</html>