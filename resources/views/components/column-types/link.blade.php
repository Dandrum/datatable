@if($this->getFieldData($column->getField(), $data))
        <?php
        $routeArray = $column->getRoute();

        if ($routeArray['id'] === null) {
            $route = route($routeArray['route']);
        } else {
            $route = route($routeArray['route'], $this->getFieldData($routeArray['id'], $data));
        }
        ?>
    <a class="hover:underline" target="{{ $column->getTarget() }}"
       href="{{ $route }}">{!! $this->highlight($this->getFieldData($column->getField(), $data)) !!}</a>
@endif

