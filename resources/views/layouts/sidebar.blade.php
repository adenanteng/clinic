<div id="kt_aside" class="aside aside-light aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
     data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <div class="aside-logo flex-column-auto h-75px px-2" id="kt_aside_logo">
        <a href="{{ url('/') }}" class="d-flex align-items-center p-5">
            <img alt="Logo" src="{{ asset(getAppLogo()) }}" class="h-40px w-auto logo me-5">
            <span class="text-primary text-dark logo">{{ getAppName() }}</span>
        </a>
        <div id="kt_aside_toggle"
             class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle sidebar-aside-toggle"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="aside-minimize">
            <i class="fs-5 fa-duotone fa-circle-dot"></i>
        </div>
    </div>
    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y" id="kt_aside_menu_wrapper" data-kt-scroll="true"
             data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
             data-kt-scroll-offset="0">
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                 id="sideMenu" data-kt-menu="true">
                @include('layouts.menu')
            </div>
        </div>
    </div>
</div>
