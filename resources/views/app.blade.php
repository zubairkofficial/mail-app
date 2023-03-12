<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <h1>Mail App</h1>
            </div>
            @if(Session::has('message'))
            <div class="col-md-12 mt-3">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    {{ Session::get('message') }}
                </div>
            </div>
            @endif
            <div class="col-md-12 mt-3">
                <form action="{{ URL::to('mails/send') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" class="form-control" placeholder="A few word..."></textarea>
                        @error('message')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-primary">Send Mails</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mail Status</th>
                        <th>Message</th>
                    </tr>
                    @foreach ($subscribers as $subscriber)
                        <tr>
                            <td>{{ $subscriber->id }}</td>
                            <td>{{ $subscriber->name }}</td>
                            <td>{{ $subscriber->email }}</td>
                            @if($subscriber->mail_delivery)
                            <td>{{ $subscriber->mail_delivery->is_delivered == 1 ? 'Delivered' : 'Not Delivered' }}</td>
                            @else
                            <td>
                                None
                            </td>
                            @endif
                            @if($subscriber->mail_delivery)
                            <td>{{ $subscriber->mail_delivery->message }}</td>
                            @else
                            <td>None</td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>