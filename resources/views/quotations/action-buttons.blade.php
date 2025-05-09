  @canany(['edit quotation', 'delete quotation', 'view quotation'])
      <td>
          <a href="#"
              class="border btn btn-sm btn-secondary btn-flex btn-center btn-active-light-primary @if ($quotation->is_low_stock) border-dark @endif"
              data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
              Actions
              <i class="ki-duotone ki-down fs-5 ms-1"></i>
          </a>
          <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px"
              data-kt-menu="true">
              @can('view quotation')
                  <div class="px-3 menu-item">
                      <a href="{{ route('quotation.show', $quotation) }}" class="px-3 menu-link">
                          <i class="fas fa-eye text-info font-weight-boldest me-2"></i>
                          View
                      </a>
                  </div>
              @endcan

              @if ($quotation->is_approved == 1)
                  @can(['edit quotation'])
                      <div class="px-3 menu-item">
                          <a href="{{ route('quotation.print', $quotation) }}" target="_blank" class="px-3 menu-link">
                              <i class="fas fa-print text-dark font-weight-boldest me-2"></i>
                              Print
                          </a>
                      </div>
                  @endcan
                  @can(['edit quotation'])
                      <div class="px-3 menu-item">
                          <a href="{{ route('quotation.billing', $quotation) }}" target="_blank" class="px-3 menu-link">
                              <i class="fas fa-money-bill-transfer text-primary font-weight-boldest me-2"></i>
                              Change Billing
                          </a>
                      </div>
                  @endcan
              @endif

              @if ($quotation->is_cost_approved == 1)
                  @can(['approve quotation'])
                      <div class="px-3 menu-item">
                          <span data-bs-toggle="modal" data-bs-target="#costApproveConfirmationModal"
                              data-bs-url="{{ route('conditional-approval.create', $quotation) }}">
                              <a type="button" class="px-3 menu-link" title="Approve" data-bs-toggle="tooltip"
                                  data-bs-custom-class="tooltip-inverse" data-bs-placement="top">
                                  <i class="fa-solid fa-check-circle text-success font-weight-boldest me-2"></i>
                                  Cost Approve
                              </a>
                          </span>
                      </div>
                  @endcan
              @endif

              @if ($quotation->is_approved == 0 && $quotation->is_cost_approved == 0)
                  @can(['approve quotation'])
                      <div class="px-3 menu-item">
                          <span data-bs-toggle="modal" data-bs-target="#approveConfirmationModal"
                              data-bs-url="{{ route('quotation.approve', $quotation) }}"
                              data-bs-billing-url="{{ route('quotation.billing', $quotation) }}">
                              <a type="button" class="px-3 menu-link" title="Approve" data-bs-toggle="tooltip"
                                  data-bs-custom-class="tooltip-inverse" data-bs-placement="top">
                                  <i class="fa-solid fa-check-circle text-success font-weight-boldest me-2"></i>
                                  Approve
                              </a>
                          </span>
                      </div>
                  @endcan

                  @can(['reject quotation'])
                      <div class="px-3 menu-item">
                          <span data-bs-toggle="modal" data-bs-target="#rejectConfirmationModal"
                              data-bs-url="{{ route('quotation.reject', $quotation) }}">
                              <a type="button" class="px-3 menu-link" title="reject" data-bs-toggle="tooltip"
                                  data-bs-custom-class="tooltip-inverse" data-bs-placement="top">
                                  <i class="fa-solid fa-xmark text-danger font-weight-boldest me-2"></i>
                                  Reject
                              </a>
                          </span>
                      </div>
                  @endcan
              @endif

              @if ($quotation->is_approved == 2 && $quotation->is_revised == 0)
                  @can(['revise quotation'])
                      <div class="px-3 menu-item">
                          <span data-bs-toggle="modal" data-bs-target="#reviseConfirmationModal"
                              data-bs-url="{{ route('quotation.revise', $quotation) }}">
                              <a type="button" class="px-3 menu-link" title="revise" data-bs-toggle="tooltip"
                                  data-bs-custom-class="tooltip-inverse" data-bs-placement="top">
                                  <i class="fa-solid fa-repeat text-danger font-weight-boldest me-2"></i>
                                  Revise
                              </a>
                          </span>
                      </div>
                  @endcan
              @endif

              @if ($quotation->is_revised == 1)
                  @can('revise quotation')
                      <div class="px-3 menu-item">
                          <a href="{{ route('revised-quotation.create', $quotation) }}" class="px-3 menu-link">
                              <i class="fa-solid fa-repeat text-primary font-weight-boldest me-2"></i>
                              Revise
                          </a>
                      </div>
                  @endcan
              @endif
          </div>
      </td>
  @endcanany
