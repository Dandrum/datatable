@props(['column', 'value'])

<div class="flex space-x-1 justify-around">
    @if($column->getViewRoute())
        @if($column->getViewPermissioN())
            @can($column->getViewPermissioN())
            @endif
            <a href="{{ route($column->getViewRoute(), $value) }}">
                <x-button class="bg-green-600" type="link">
                    <i class="fa-solid fa-eye"></i>
                </x-button>
            </a>
            @if($column->getViewPermissioN())
            @endcan
        @endif
    @endif

    @if($column->getEditRoute())
        @if($column->getEditPermission())
            @can($column->getEditPermission())
            @endif
            <a href="{{ route($column->getEditRoute(), $value) }}">
                <x-button type="link">
                    <i class="fa-solid fa-pen-to-square"></i>
                </x-button>
            </a>
            @if($column->getEditPermission())
            @endcan
        @endif
    @endif

    @if($column->getDeleteRoute())
        @if($column->getDeletePermission())
            @can($column->getDeletePermission())
            @endif
            <form
                method="POST"
                action="{{ route($column->getDeleteRoute(), $value) }}"
                style="display: inline"
                onclick="return confirm('Are you sure?')"
            >
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <x-danger-button type="submit">
                    <i class="fa-solid fa-trash"></i>
                </x-danger-button>
            </form>
            @if($column->getDeletePermission())
            @endcan
        @endif
    @endif
</div>
