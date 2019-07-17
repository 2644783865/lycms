<header id="fh5co-header">
    <div class="layout bg-white fixed header-box">
        <div class="container padding-bottom">
            <div class="line">
                <div class="xl12 xs3 xm2 xb2 padding-top">
                    <button class="button icon-navicon float-right" data-target="#header-box_id"></button>
                    <a href="{{route('company.index')}}">
                        <img src="/logo.png" alt="LyCms" style="height: 60px;"/>
                    </a>
                </div>
                <div class="xl12 xs9 xm7 xb7 nav-navicon" id="header-box_id" style="float:right">
                    <div class="x12 margin-big-top">
                        <ul class="nav nav-menu nav-inline nav-split nav-right text-big">
                            <li @if(!empty($current) && $current=='index') class="active" @endif>
                                <a href="{{route('company.index')}}">首页</a>
                            </li>
                            <li @if(!empty($current) && $current=='service') class="active" @endif>
                                <a href='{{route('company.service')}}'><span>服务</span></a>
                            </li>
                            <li @if(!empty($current) && $current=='case') class="active" @endif>
                                <a href='{{route('company.case')}}' rel='dropmenu3'><span>案例</span></a>
                            </li>
                            <li @if(!empty($current) && $current=='news') class="active" @endif>
                                <a href='{{route('company.news')}}' rel='drpmenu4'><span>资讯</span></a>
                            </li>
                            <li @if(!empty($current) && $current=='about') class="active" @endif>
                                <a href='{{route('company.about')}}'><span>关于</span></a>
                            </li>
                            <li @if(!empty($current) && $current=='contact') class="active" @endif>
                                <a href='{{route('company.contact')}}'><span>联系</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>