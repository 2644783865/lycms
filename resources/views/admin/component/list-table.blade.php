<div class="card flex-1 scroll-y">
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-responsive table-hover table-condensed">
                <thead>
                {{ $thead }}
                </thead>
                <tbody>
                {{ $tbody }}
                </tbody>
            </table>
        </div>
        {{ $slot }}
    </div>
</div>

@if(isset($page))
    <div class="card">
        <div class="card-body pagination-body">
            <span class="pagination-info">显示第{{$page->firstItem()}}到{{$page->lastItem()}}条，共{{$page->total()}}条记录</span>
            {!! $page->appends($_GET)->links() !!}
        </div>
    </div>
@endif


