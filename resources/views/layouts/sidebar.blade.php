<!-- Blog Search Well -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-search"></span>
            جستجو در بلاگ
        </div>

        <div class="panel-body">
            <div class="form-group">
                <input type="text" id="search" name="search" class="form-control" placeholder="عنوان مقاله خود را وارد کنید...">
            </div>
            <table class="table table-bordered table-hover">

                <tbody>

                </tbody>

            </table>
        </div>
    </div>


    <!-- /.input-group -->


<!-- Blog Categories Well -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-tasks"></span>
            دسته بندی ها
        </div>
        <div class="panel-body">
            <div class="row">
                @foreach($categories as $row)
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            @foreach($row as $category)
                                <li><a href="{{ route('category.index', ['$category' => $category->name]) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <!-- /.row -->
{{-- Side blog ratest article --}}

<div class="panel panel-default">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-equalizer"></span>
        مقاله های پر بازدید
    </div>
    <div class="panel-body">
        @foreach(\App\Article::all()->take(10)->sortByDesc('viewCount') as $article)
            <ul style="padding: 0px;">
                <li style="list-style: none;padding: 0"><a href="{{ route('article.show', ['article' => $article->slug]) }}">{{ $article->title }}</a></li>
            </ul>
        @endforeach
    </div>
</div>

{{-- Side blog status --}}

<div class="panel panel-default">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-stats"></span>
        آمار بلاگ
    </div>
    <div class="panel-body">
        <p>تعداد کاربر آنلاین: </p>
        <p>تعداد کاربران عضو بلاگ: {{ \App\User::all()->count() }} نفر</p>
        <p>تعداد مقالات بلاگ: {{ \App\Article::all()->count() }} مقاله</p>
        <p>تعداد بازدید از بلاگ:</p>
    </div>
</div>

<!-- Side Widget Well -->

<div class="panel panel-default">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-briefcase"></span>
        دیوار ابزار
    </div>
    <div class="panel-body">
        <p>در این بخش میتوانید ابزارهای خود را قرار دهید</p>
    </div>
</div>