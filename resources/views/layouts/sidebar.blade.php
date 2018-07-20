<!-- Blog Search Well -->
<div class="well">
    <h4>جستجو در بلاگ</h4>
    <div class="input-group">
        <input type="text" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" type="button">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->
<div class="well">
    <h4>دسته بندی بلاگ</h4>
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
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<div class="well">
    <h4>دیوار ابزار</h4>
    <p>در این بخش میتوانید ابزارهای خود را قرار دهید</p>
</div>