<!--begin::Aside-->
<div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <div class="aside-menu flex-column-fluid">
        <div class="mx-3 my-5 hover-scroll-overlay-y my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}"
            data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
            <div class="menu menu-column menu-sub-indention menu-active-bg menu-state-primary menu-title-gray-700 fs-6 menu-rounded w-100 fw-semibold"
                id="#kt_aside_menu" data-kt-menu="true">
                @can('view dashboard')
                    <div class="mb-2 menu-item">
                        <a class="menu-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <span class="menu-icon">
                                <i class="fa-solid fa-gauge"></i>
                            </span>
                            <span class="menu-title">
                                Dashboard
                            </span>
                        </a>
                    </div>
                @endcan

                <div class="my-2 separator text-muted separator-dashed"></div>

                <div class="pt-5 menu-item">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase">Accounts</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5 aside-footer flex-column-auto" id="kt_aside_footer">
        <a href="https://bramanjo.com" target="_blank" class="btn btn-flex btn-custom btn-primary w-100"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="{{ env('APP_NAME') }}">
            <span class="btn-label">{{ env('APP_NAME') }}</span>
            <span class="path1"></span>
            <span class="path2"></span>
            </i>
        </a>
    </div>
</div>
