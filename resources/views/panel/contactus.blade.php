<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/all.css') }}">
    <title>مدیریت پیام های کاربران</title>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">مشاهده سایت</a>

        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('panel.index') }}">مقاله ها</a></li>
                <li><a href="{{ route('panel.category') }}">دسته بندی ها</a></li>
                <li><a href="{{ route('panel.users') }}">کاربران</a></li>
                <li><a href="{{ route('panel.comment') }}">کامنت ها</a></li>
                <li class="active"><a href="{{ route('panel.contactus') }}">پیام های کاربران</a></li>
            </ul>
            @if(auth::check())
                <div class="nav navbar-left" style="margin-top: 15px;">
                    <form method="post" action="{{ route('logout') }}">
                        {!! csrf_field() !!}
                        <button class="btn btn-danger btn-xs">خروج از حساب</button>
                    </form>
                </div>
            @endif
        </div>

    </div><!-- /.container-fluid -->
</nav>

<div class="container">
    <div class="penel-titr">
        <h5>{{ auth()->user()->name }} به پنل کاربری خود خوش آمدید</h5>
        <hr>
        @if($message = session('message'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
    </div>

    <h5>لیست پیام های کاربران</h5>
    <hr>
    <div class="panel-table">
        <table class="table table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ردیف</th>
                <th scope="col">نام کاربر</th>
                <th scope="col">ایمیل</th>
                <th scope="col">شماره موبایل</th>
                <th scope="col">متن پیام</th>
                <th scope="col">وضعیت</th>
                <th scope="col">پاسخ به کاربر</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = ($contactuss->currentpage() - 1) * $contactuss->perpage() + 1 ?>
            @foreach($contactuss as $contact)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->mobile }}</td>
                    <td>{{ $contact->body }}</td>
                    <td>
                    @if($contact->answer == 1)
                        <p style="color: #34ce57">پاسخ داده شده است</p>
                    @else
                        <p style="color: #ac2925">در انتظار پاسخ</p>
                    @endif
                    </td>
                    <td><a href="{{ route('panel.answermessage', ['id' => $contact->id]) }}"><span style="color: #007bff" class="glyphicon glyphicon-envelope"></span> پاسخ </a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pager -->
    <div style="text-align:center;">
        {!! $contactuss->render() !!}
    </div>

</div>

@include('layouts.footer-script')
</body>
</html>