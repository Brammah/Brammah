<div class="aside-footer flex-column-auto px-9" id="kt_aside_footer">
    <div class="d-flex flex-stack">
        <div class="d-flex align-items-center">
            <div class="symbol symbol-circle symbol-40px">
                <img src="{{ asset('assets/media/avatars/' . auth()->user()->gender . '.jpg') }}" alt="photo" />
            </div>

            <div class="ms-2">
                <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold lh-1">
                    {{ auth()->user()->full_name }}
                </a>
                <span class="text-muted fw-semibold d-block fs-7 lh-1">
                    @if (!empty(auth()->user()->getRoleNames()))
                        @foreach (auth()->user()->getRoleNames() as $role)
                            {{ $role }}
                        @endforeach
                    @endif
                </span>
            </div>
        </div>

        <div class="ms-1">
            <div class="btn btn-sm btn-icon btn-active-color-primary position-relative me-n2"
                data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-overflow="true"
                data-kt-menu-placement="top-end">
                <i class="fa-solid fa-right-from-bracket fw-bolder text-dark fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
            <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold fs-6 w-275px"
                data-kt-menu="true">
                <div class="px-3 menu-item">
                    <div class="px-3 menu-content d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <img alt="User Image"
                                src="{{ asset('assets/media/avatars/' . auth()->user()->gender . '.jpg') }}" />
                        </div>
                        <div class="d-flex flex-column">
                            <div class="fw-bold d-flex align-items-center fs-5">{{ auth()->user()->username }}
                                <span class="px-2 py-1 badge badge-light-success fw-bold fs-8 ms-2">
                                    @if (!empty(auth()->user()->getRoleNames()))
                                        @foreach (auth()->user()->getRoleNames() as $role)
                                            {{ $role }}
                                        @endforeach
                                    @endif
                                </span>
                            </div>
                            <a href="#"
                                class="fw-semibold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                        </div>
                    </div>
                </div>
                <div class="my-2 separator"></div>
                <div class="px-5 menu-item">
                    <a href="#" class="px-5 menu-link">My Profile</a>
                </div>

                <div class="px-5 menu-item">
                    <a href="{{ route('logout') }}" class="px-5 menu-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
