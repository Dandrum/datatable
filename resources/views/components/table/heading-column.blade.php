@props(['column'])

<th scope="col" class="px-5 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
    {{ $column->getTitle() }}
</th>
{{--<th scope="col" class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">--}}
{{--    <a href="#" class="inline-flex group">--}}
{{--        Title--}}
{{--        <!-- Active: "bg-gray-200 text-gray-900 group-hover:bg-gray-300", Not Active: "invisible text-gray-400 group-hover:visible group-focus:visible" -->--}}
{{--        <span class="ml-2 flex-none rounded bg-gray-100 text-gray-900 group-hover:bg-gray-200">--}}
{{--                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                      <path fill-rule="evenodd"--}}
{{--                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"--}}
{{--                            clip-rule="evenodd"/>--}}
{{--                    </svg>--}}
{{--                  </span>--}}
{{--    </a>--}}
{{--</th>--}}


