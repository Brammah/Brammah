  @canany(['edit vehicle model', 'delete vehicle model', 'view vehicle model'])
      <td>
          <a href="#" class="btn btn-sm btn-secondary btn-flex btn-center btn-active-light-primary"
              data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
              Actions
              <i class="ki-duotone ki-down fs-5 ms-1"></i>
          </a>
          <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px"
              data-kt-menu="true">
              {{-- @can('view vehicle model')
                  <div class="px-3 menu-item">
                      <a href="{{ route('vehicle-model.show', $vehicleModel) }}" class="px-3 menu-link">
                          <i class="fas fa-eye text-success font-weight-boldest me-2"></i>
                          View
                      </a>
                  </div>
              @endcan --}}

              @can(['edit vehicle model'])
                  <div class="px-3 menu-item">
                      <a href="{{ route('vehicle-model.edit', $vehicleModel) }}" class="px-3 menu-link">
                          <i class="fas fa-edit text-success font-weight-boldest me-2"></i>
                          Edit
                      </a>
                  </div>
              @endcan

              @can(['delete vehicle model'])
                  <div class="px-3 menu-item">
                      <span data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"
                          data-bs-url="{{ route('vehicle-model.destroy', $vehicleModel) }}">
                          <a type="button" class="px-3 menu-link" title="Delete" data-bs-toggle="tooltip"
                              data-bs-custom-class="tooltip-inverse" data-bs-placement="top">
                              <i class="fa-solid fa-trash-alt text-danger font-weight-boldest me-2"></i>
                              Delete
                          </a>
                      </span>
                  </div>
              @endcan
          </div>
      </td>
  @endcanany
