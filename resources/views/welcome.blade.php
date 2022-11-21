<!--http://127.0.0.1:8000/welcome-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Welcome page</title>

    <style>
        .content {
            background-color: #f7f7f7;
            padding: 20px;
            height: 600px;
            width: 300px;
            margin-left: 5%;
            box-shadow: 10px 10px 5px #d1d1d199;
        }
        .containerx {
            width: 60%;
            margin-top: -39%;
            margin-left: 30%;
        }
    </style>

</head>

<body>
    <br><br>
    <div class="content">
        <div class="container">
            <br>
            <input type="text" name="payment_id" id="payment_id" class="form-control" placeholder="select payment id... ">
            <div id="transaction_list">
            </div>
        </div>
    </div>

    <div class="containerx">
        <h2>Transactions Table</h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Payment_ID</th>
                    <th>Amount</th>
                    <th>Currency</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->payment_id }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->currency }}</td>
                        <td>{{ $transaction->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    <script>
        $(document).ready(function() {
            $("#payment_id").on('keyup', function() {
                var value = $(this).val();
                $.ajax({
                    url: "{{ route('search') }}",
                    type: "GET",
                    data: {
                        'name': value
                    },
                    success: function(data) {
                        $("#transaction_list").html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>
