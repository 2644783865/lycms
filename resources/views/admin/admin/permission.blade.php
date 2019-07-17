@extends('admin.layout')

@section('main')
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="example-text-input">当前帐号：{{$admin->name}}[{{$admin->email}}]</label>
            </div>
            <form action="" method="post" onsubmit="ajaxSubmit(this);return false;">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                <label class="lyear-checkbox checkbox-primary">
                                    <input name="checkbox" type="checkbox" id="check-all">
                                    <span> 全选</span>
                                </label>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($menus as $menu1)
                            <tr>
                                <td>
                                    <label class="lyear-checkbox checkbox-primary">
                                        <input name="menu_ids[]" type="checkbox" class="checkbox-parent"
                                               dataid="id-{{$menu1['id']}}" value="{{$menu1['id']}}"
                                               @if(in_array($menu1['id'],$menu_ids)) checked="checked" @endif>
                                        <span> {{$menu1['name']}}</span>
                                    </label>
                                </td>
                            </tr>
                            @if(!empty($menu1['children']))
                                @foreach($menu1['children'] as $menu2)
                                    <tr>
                                        <td class="p-l-20">
                                            <label class="lyear-checkbox checkbox-primary">
                                                <input name="menu_ids[]" type="checkbox"
                                                       class="checkbox-parent checkbox-child"
                                                       dataid="id-{{$menu1['id']}}-{{$menu2['id']}}"
                                                       value="{{$menu2['id']}}"
                                                       @if(in_array($menu2['id'],$menu_ids)) checked="checked" @endif>
                                                <span> {{$menu2['name']}}</span>
                                            </label>
                                        </td>
                                    </tr>
                                    @if(!empty($menu2['children']))
                                        <tr>
                                            <td class="p-l-40">
                                                @foreach($menu2['children'] as $menu3)
                                                    <label class="lyear-checkbox checkbox-primary checkbox-inline">
                                                        <input name="menu_ids[]" type="checkbox"
                                                               class="checkbox-child"
                                                               dataid="id-{{$menu1['id']}}-{{$menu2['id']}}-{{$menu3['id']}}"
                                                               value="{{$menu3['id']}}"
                                                               @if(in_array($menu3['id'],$menu_ids)) checked="checked" @endif>
                                                        <span> {{$menu3['name']}}</span>
                                                    </label>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-offset-1 col-sm-offset-2 col-sm-10" style="margin-bottom: 20px;">
                    <button type="submit" class="btn btn-danger btn-submit">保 存</button>
                    <button type="button" class="btn btn-default btn-cancel"
                            onclick="window.location.href=document.referrer;">
                        取 消
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            //动态选择框，上下级选中状态变化
            $('input.checkbox-parent').on('change', function () {
                var dataid = $(this).attr("dataid");
                $('input[dataid^=' + dataid + '-]').prop('checked', $(this).is(':checked'));
            });
            $('input.checkbox-child').on('change', function () {
                var dataid = $(this).attr("dataid");
                dataid = dataid.substring(0, dataid.lastIndexOf("-"));
                var parent = $('input[dataid=' + dataid + ']');
                if ($(this).is(':checked')) {
                    parent.prop('checked', true);
                    //循环到顶级
                    while (dataid.lastIndexOf("-") != 2) {
                        dataid = dataid.substring(0, dataid.lastIndexOf("-"));
                        parent = $('input[dataid=' + dataid + ']');
                        parent.prop('checked', true);
                    }
                } else {
                    //父级
                    if ($('input[dataid^=' + dataid + '-]:checked').length == 0) {
                        parent.prop('checked', false);
                        //循环到顶级
                        while (dataid.lastIndexOf("-") != 2) {
                            dataid = dataid.substring(0, dataid.lastIndexOf("-"));
                            parent = $('input[dataid=' + dataid + ']');
                            if ($('input[dataid^=' + dataid + '-]:checked').length == 0) {
                                parent.prop('checked', false);
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection