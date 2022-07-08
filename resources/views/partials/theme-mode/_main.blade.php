<?php
    $btnClass = $params['toggle-btn-class'];
    $menuPlacement = isset($params['menu-placement']) ? $params['menu-placement'] : 'bottom-end';
    $iconClass = isset($params['toggle-btn-icon-class']) ? $params['toggle-btn-icon-class'] : 'svg-icon-1';
    $trigger = isset($params['menu-trigger']) ? $params['menu-trigger'] : "{default:'click', lg: 'hover'}";
?>

<!--begin::Menu toggle-->
<a href="#" class="{{ $btnClass }} " data-kt-menu-trigger="{{ $trigger }}" data-kt-menu-attach="parent" data-kt-menu-placement="{{ $menuPlacement }}">
    {!! theme()->getSvgIcon('icons/duotune/general/gen060.svg', 'theme-light-show ' . $iconClass ) !!}
    {!! theme()->getSvgIcon('icons/duotune/general/gen061.svg', 'theme-dark-show ' . $iconClass ) !!}
</a>
<!--begin::Menu toggle-->

{{ theme()->getView('partials/theme-mode/__menu') }}
