<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/all.css') }}">
    <title>مدیریت دسته بندی ها</title>
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
                <li class="active"><a href="{{ route('panel.category') }}">دسته بندی ها</a></li>
                <li><a href="{{ route('panel.users') }}">کاربران</a></li>
                <li><a href="{{ route('panel.comment') }}">کامنت ها</a></li>
                <li><a href="{{ route('panel.contactus') }}">پیام های کاربران</a></li>
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

    <div class="panel-body">
        <div class="row">
            <div class="col-md-2" style="text-align: center">
                <a href="{{ route('category.create') }}" target="_blank">
                    <div style="height: 50px;width: 150px;background-color: #007bff;border-radius: 3px;color: #FFFFFF"><span class="glyphicon glyphicon-plus-sign" style="padding-top: 15px;color: #FFFFFF"></span> درج دسته </div>
                </a>
            </div>
        </div>
    </div>

    <h5>لیست دسته ها</h5>
    <hr>
    <div class="panel-table">
        <table class="table table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ردیف</th>
                <th scope="col">نام دسته</th>
                <th scope="col">ویرایش</th>
                <th scope="col">حذف</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = ($categories->currentpage() - 1) * $categories->perpage() + 1 ?>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $category->name }}</td>
                    <td><a href="{{ route('panel.editcategory', ['category' =>$category->name]) }}" style="color: #007bff"><span class="glyphicon glyphicon-check"></span></a></td>
                    <td><a href="{{ route('panel.deletecategory', ['category' =>$category->name]) }}" style="color: #ac2925"><span class="glyphicon glyphicon-remove"></span></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pager -->
    <div style="text-align:center;">
        {!! $categories->render() !!}
    </div>

</div>

@include('layouts.footer-script')
</body>
</html>