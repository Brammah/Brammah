  @canany(['edit invoice', 'delete invoice', 'view invoice'])
      <td>
          <a href="#" class="btn btn-sm btn-secondary btn-flex btn-center btn-active-light-primary"
              data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
              Actions
              <i class="ki-duotone ki-down fs-5 ms-1"></i>
          </a>
          <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px"
              data-kt-menu="true">
              @can('view invoice')
                  <div class="px-3 menu-item">
                      <a href="{{ route('credit-note.show', $creditNote) }}" class="px-3 menu-link">
                          <i class="fas fa-eye text-info font-weight-boldest me-2"></i>
                          View
                      </a>
                  </div>
              @endcan

              @if ($creditNote->is_approved == 1)
                  @can(['edit invoice'])
                      <div class="px-3 menu-item">
                          <a href="{{ route('credit-note.print', $creditNote) }}" target="_blank" class="px-3 menu-link">
                              <i class="fas fa-print text-dark font-weight-boldest me-2"></i>
                              Print
                          </a>
                      </div>
                  @endcan
              @endif

              @if ($creditNote->is_approved == 0)
                  @can(['approve invoice'])
                      <div class="px-3 menu-item">
                          <span data-bs-toggle="modal" data-bs-target="#approveConfirmationModal"
                              data-bs-url="{{ route('credit-note.approve', $creditNote) }}">
                              <a type="button" class="px-3 menu-link" title="Approve" data-bs-toggle="tooltip"
                                  data-bs-custom-class="tooltip-inverse" data-bs-placement="top">
                                  <i class="fa-solid fa-check-circle text-success font-weight-boldest me-2"></i>
                                  Approve
                              </a>
                          </span>
                      </div>
                  @endcan
              @endif
          </div>
      </td>
  @endcanany
