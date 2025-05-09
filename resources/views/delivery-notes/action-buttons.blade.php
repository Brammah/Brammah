  @canany(['edit delivery note', 'delete delivery note', 'view delivery note'])
      <td>
          <a href="#" class="btn btn-sm btn-secondary btn-flex btn-center btn-active-light-primary"
              data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
              Actions
              <i class="ki-duotone ki-down fs-5 ms-1"></i>
          </a>
          <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px"
              data-kt-menu="true">
              @can('view delivery note')
                  <div class="px-3 menu-item">
                      <a href="{{ route('delivery-note.show', $deliveryNote) }}" class="px-3 menu-link">
                          <i class="fas fa-eye text-info font-weight-boldest me-2"></i>
                          View
                      </a>
                  </div>
              @endcan

              @can(['edit delivery note'])
                  <div class="px-3 menu-item">
                      <a href="{{ route('delivery-note.print', $deliveryNote) }}" target="_blank" class="px-3 menu-link">
                          <i class="fas fa-print text-success font-weight-boldest me-2"></i>
                          Print
                      </a>
                  </div>
              @endcan

              {{-- @if ($deliveryNote->is_approved == 0)
                  @can(['approve quotation'])
                      <div class="px-3 menu-item">
                          <span data-bs-toggle="modal" data-bs-target="#approveConfirmationModal"
                              data-bs-url="{{ route('delivery-note.approve', $deliveryNote) }}">
                              <a type="button" class="px-3 menu-link" title="Approve" data-bs-toggle="tooltip"
                                  data-bs-custom-class="tooltip-inverse" data-bs-placement="top">
                                  <i class="fa-solid fa-check-circle text-success font-weight-boldest me-2"></i>
                                  Approve
                              </a>
                          </span>
                      </div>
                  @endcan --}}

              {{-- @can(['delete quotation'])
                      <div class="px-3 menu-item">
                          <span data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"
                              data-bs-url="{{ route('delivery-note.destroy', $deliveryNote) }}">
                              <a type="button" class="px-3 menu-link" title="Delete" data-bs-toggle="tooltip"
                                  data-bs-custom-class="tooltip-inverse" data-bs-placement="top">
                                  <i class="fa-solid fa-trash-alt text-danger font-weight-boldest me-2"></i>
                                  Delete
                              </a>
                          </span>
                      </div>
                  @endcan --}}
              {{-- @endif --}}
          </div>
      </td>
  @endcanany
