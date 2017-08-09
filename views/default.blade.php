@if (!empty($menu) && is_array($menu))
    <ul class="adminmenu_list">
        @foreach ($menu as $actionName => $action)
            <li class="adminmenu_item">
                @if (!empty($action['type']) && $action['type'] != 'get')
                    <form
                            method="POST"
                            class="adminmenu_form"

                            @if (!empty($action['route']))
                            action="{{ $action['route'] }}"
                            @endif
                    >
                        {{ csrf_field() }}
                        {{ method_field($action['type']) }}
                    </form>
                @endif
                <a
                        @if (!empty($action['type']) && $action['type'] != 'get')
                        data-has-form
                        @endif

                        @if (!empty($action['route']))
                        href="{{ $action['route'] }}"
                        @endif

                        @if (!empty($action['title']))
                        title="{{ $action['title'] }}"
                        @endif
                >
                    @if (!empty($action['icon']))
                        <i class="{{ $action['icon'] }}"></i>
                    @endif

                    @if (!empty($action['label']))
                        <span class="adminmenu_label">
                        {{ $action['label'] }}
                    </span>
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
@endif