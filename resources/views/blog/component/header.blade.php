<header id="header">
    <div class="navbox">
        <h2 id="mnavh"><span class="navicon"></span></h2>
        <!--<div class="logo"><a href="###">个人博客</a></div>-->
        <nav style="margin-left: 240px;">
            <ul id="starlist">
                <li><a href="{{route('blog.index')}}" @if($current=='index') class="selected" @endif>首页</a></li>
                @foreach($categories as $category)
                    @if(empty($category['children']))
                        <li><a href="{{route('blog.category',[$category['id']])}}" @if($current=='category' && $category['id']==request()->id) class="selected" @endif>{{$category['name']}}</a></li>
                    @else
                        <li class="menu"><a href="javascript:">{{$category['name']}}</a>
                            <ul class="sub">
                                @foreach($category['children'] as $child)
                                    <li><a href="{{route('blog.category',[$child['id']])}}" @if($current=='category' && $child['id']==request()->id) class="selected" @endif>{{$child['name']}}</a></li>
                                @endforeach
                            </ul>
                            <span></span>
                        </li>
                    @endif
                @endforeach
                <li><a href="{{route('blog.archive')}}" @if($current=='archive') class="selected" @endif>归档</a></li>
                <li><a href="{{route('blog.about')}}" @if($current=='about') class="selected" @endif>关于我</a></li>
            </ul>
        </nav>
        <!--<div class="searchico"></div>-->
    </div>
</header>
<div class="searchbox">
    <div class="search">
        <form action="" method="post" name="searchform" id="searchform">
            <input name="keyboard" id="keyboard" class="input_text" value="请输入关键字词" style="color: rgb(153, 153, 153);"
                   onFocus="if(value=='请输入关键字词'){this.style.color='#000';value=''}"
                   onBlur="if(value==''){this.style.color='#999';value='请输入关键字词'}" type="text">
            <input name="show" value="title" type="hidden">
            <input name="tempid" value="1" type="hidden">
            <input name="tbname" value="news" type="hidden">
            <input name="Submit" class="input_submit" value="搜索" type="submit">
        </form>
    </div>
    <div class="searchclose"></div>
</div>