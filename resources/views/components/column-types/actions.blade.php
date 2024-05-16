<div class="flex space-x-1 justify-around">
    @if(isset($detailRoute))
        @can('view-' . $permissionSuffix)
            <a href="{{$detailRoute}}">
                <x-button class="bg-green-600" type="link"><i class="fa-solid fa-eye"></i></x-button>
            </a>
        @endcan
    @endif
    @if(isset($editRoute))
        @can('edit-' . $permissionSuffix)
            <a href="{{$editRoute}}">
                <x-button type="link"><i class="fa-solid fa-pen-to-square"></i></x-button>
            </a>
        @endcan
    @endif
    @if(isset($deleteRoute))
        @can('delete-'.$permissionSuffix)
            <form method="POST" action="{{ $deleteRoute }}" style="display: inline" onclick="return confirm('Are you sure?')">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <x-danger-button type="submit"><i class="fa-solid fa-trash"></i></x-danger-button>
            </form>
        @endcan
    @endif
</div>
