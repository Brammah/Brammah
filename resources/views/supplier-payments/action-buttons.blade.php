  @canany(['edit supplier payment', 'delete supplier payment', 'view supplier payment'])
      <td>
          <a href="#" class="btn btn-sm btn-secondary btn-flex btn-center btn-active-light-primary"
              data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
              Actions
              <i class="ki-duotone ki-down fs-5 ms-1"></i>
          </a>
          <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px"
              data-kt-menu="true">
              @can(['edit supplier payment'])
                  <div class="px-3 menu-item">
                      <a href="{{ route('supplier-payment.edit', $supplierPayment) }}" class="px-3 menu-link">
                          <i class="fas fa-edit text-success font-weight-boldest me-2"></i>
                          Edit
                      </a>
                  </div>
              @endcan
          </div>
      </td>
  @endcanany
