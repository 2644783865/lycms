<li class="dropdown dropdown-skin">
    <span data-toggle="dropdown" class="icon-palette"><i class="mdi mdi-palette"></i></span>
    <ul class="dropdown-menu dropdown-menu-right" data-stopPropagation="true">
        <li class="drop-title"><p>主题</p></li>
        <li class="drop-skin-li clearfix">
      <span class="inverse">
        <input type="radio" name="theme" value="default" id="site_theme_1" checked>
        <label for="site_theme_1"></label>
      </span>
      <span>
        <input type="radio" name="theme" value="dark" id="site_theme_2">
        <label for="site_theme_2"></label>
      </span>
      <span>
        <input type="radio" name="theme" value="translucent" id="site_theme_3">
        <label for="site_theme_3"></label>
      </span>
        </li>
        <li class="drop-title"><p>LOGO</p></li>
        <li class="drop-skin-li clearfix">
      <span class="inverse">
        <input type="radio" name="logobg" value="default" id="logo_bg_1" checked>
        <label for="logo_bg_1"></label>
      </span>
      <span>
        <input type="radio" name="logobg" value="color_2" id="logo_bg_2">
        <label for="logo_bg_2"></label>
      </span>
      <span>
        <input type="radio" name="logobg" value="color_3" id="logo_bg_3">
        <label for="logo_bg_3"></label>
      </span>
      <span>
        <input type="radio" name="logobg" value="color_4" id="logo_bg_4">
        <label for="logo_bg_4"></label>
      </span>
      <span>
        <input type="radio" name="logobg" value="color_5" id="logo_bg_5">
        <label for="logo_bg_5"></label>
      </span>
      <span>
        <input type="radio" name="logobg" value="color_6" id="logo_bg_6">
        <label for="logo_bg_6"></label>
      </span>
      <span>
        <input type="radio" name="logobg" value="color_7" id="logo_bg_7">
        <label for="logo_bg_7"></label>
      </span>
      <span>
        <input type="radio" name="logobg" value="color_8" id="logo_bg_8">
        <label for="logo_bg_8"></label>
      </span>
        </li>
        <li class="drop-title"><p>头部</p></li>
        <li class="drop-skin-li clearfix">
      <span class="inverse">
        <input type="radio" name="headerbg" value="default" id="header_bg_1" checked>
        <label for="header_bg_1"></label>
      </span>
      <span>
        <input type="radio" name="headerbg" value="color_2" id="header_bg_2">
        <label for="header_bg_2"></label>
      </span>
      <span>
        <input type="radio" name="headerbg" value="color_3" id="header_bg_3">
        <label for="header_bg_3"></label>
      </span>
      <span>
        <input type="radio" name="headerbg" value="color_4" id="header_bg_4">
        <label for="header_bg_4"></label>
      </span>
      <span>
        <input type="radio" name="headerbg" value="color_5" id="header_bg_5">
        <label for="header_bg_5"></label>
      </span>
      <span>
        <input type="radio" name="headerbg" value="color_6" id="header_bg_6">
        <label for="header_bg_6"></label>
      </span>
      <span>
        <input type="radio" name="headerbg" value="color_7" id="header_bg_7">
        <label for="header_bg_7"></label>
      </span>
      <span>
        <input type="radio" name="headerbg" value="color_8" id="header_bg_8">
        <label for="header_bg_8"></label>
      </span>
        </li>
        <li class="drop-title"><p>侧边栏</p></li>
        <li class="drop-skin-li clearfix">
      <span class="inverse">
        <input type="radio" name="sidebarbg" value="default" id="sidebar_bg_1" checked>
        <label for="sidebar_bg_1"></label>
      </span>
      <span>
        <input type="radio" name="sidebarbg" value="color_2" id="sidebar_bg_2">
        <label for="sidebar_bg_2"></label>
      </span>
      <span>
        <input type="radio" name="sidebarbg" value="color_3" id="sidebar_bg_3">
        <label for="sidebar_bg_3"></label>
      </span>
      <span>
        <input type="radio" name="sidebarbg" value="color_4" id="sidebar_bg_4">
        <label for="sidebar_bg_4"></label>
      </span>
      <span>
        <input type="radio" name="sidebarbg" value="color_5" id="sidebar_bg_5">
        <label for="sidebar_bg_5"></label>
      </span>
      <span>
        <input type="radio" name="sidebarbg" value="color_6" id="sidebar_bg_6">
        <label for="sidebar_bg_6"></label>
      </span>
      <span>
        <input type="radio" name="sidebarbg" value="color_7" id="sidebar_bg_7">
        <label for="sidebar_bg_7"></label>
      </span>
      <span>
        <input type="radio" name="sidebarbg" value="color_8" id="sidebar_bg_8">
        <label for="sidebar_bg_8"></label>
      </span>
        </li>
    </ul>
</li>
<script type="text/javascript">
    // 设置主题配色
    var site_theme_configs = ['theme', 'logobg', 'headerbg', 'sidebarbg'];
    $.each(site_theme_configs, function (index, themeStr) {
        var dataStr = 'data-' + themeStr;
        $('input[name="' + themeStr + '"]').click(function () {
            var value = $(this).val();
            console.log(dataStr);
            $('body').attr(dataStr, value);
            setCookie(dataStr, value, 7);
        });
        if (getCookie(dataStr)) {
            $('body').attr(dataStr, getCookie(dataStr));
            $('input[name="' + themeStr + '"][value="' + getCookie(dataStr) + '"]').prop("checked", "checked");
        }
    });
</script>
