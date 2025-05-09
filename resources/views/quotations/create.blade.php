@extends('layouts.app')

@section('title', 'Create Quotation')

@section('toolbar')
    <h1 class="m-0 text-gray-900 fs-2 fw-bold">Quotations</h1>
    <ul class="mt-2 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('dashboard') }}" class="text-gray-700 text-hover-primary me-1">
                <i class="text-gray-500 ki-outline ki-home fs-7"></i>
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i></li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1"> Job Card Management </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">
            <a href="{{ route('quotation.index') }}" class="text-blue-700 text-hover-primary me-1">
                Go Back
            </a>
        </li>
        <li class="breadcrumb-item"> <i class="text-gray-500 ki-outline ki-right fs-7 mx-n1"></i> </li>
        <li class="text-gray-600 breadcrumb-item fw-bold lh-1">Create Quotation</li>
    </ul>
@endsection

@section('main-content')
    <div class="content flex-column-fluid" id="kt_content">
        <form class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework"
            action="{{ route('quotation.store') }}" method="post" id="quotation-form">
            @csrf
            @include('quotations.form')
        </form>
    </div>

    <div class="modal fade" tabindex="-1" id="lowPriceModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Low Margin Warning</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa-solid fa-xmark fs-5"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>

                <div class="modal-body">
                    <p>
                        <b class="text-warning">Warning:</b>
                        You are selling this product below a 10% margin, which may
                        incur a loss. Do you want to
                        proceed?
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-light-secondary text-dark font-weight-bold hover-scale"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="confirmProceedLowPrice"
                        class="btn btn-sm btn-danger font-weight-bold hover-scale">Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="infoModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Unwarranted Job Card</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa-solid fa-xmark fs-5"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>

                <div class="modal-body">
                    <b class="mb-2 text-info">Polite Reminder:</b>
                    <p id="modalMessage"></p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="text-white btn btn-sm btn-info font-weight-bold hover-scale"
                        data-bs-dismiss="modal">
                        Noted
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script>
        $(function() {
            const jobInspectionDate = $('#date');
            const costInput = $('#quotation_amount');
            const totalVatAmountInput = $('#vat_amount');
            const currencySelectInput = $('#currency_id');
            const totalDiscountAmountInput = $('#discount_amount');
            const totalCostInput = $('#quotation_amount_inclusive_vat');
            const jobInspectionAccordion = $('#jobInspectionAccordion');

            const priceInput = $('#price');
            const productSelectInput = $('#product_id');
            const quantityInput = $('#product_quantity');
            const chargesContainer = $('#charges_container');
            const jobInspectionSelectInput = $('#job_inspection_id');
            const miscellaneousChargeSelectInput = $('#miscellaneous_charge_id');
            const isMiscellaneousChargedSelectInput = $('#is_miscellaneous_charged');
            const isTestingContainer = $('#isTestingContainer');
            const isMiscellaneousChargedContainer = $('#isMiscellaneousChargedContainer');
            const isTestingSelectInput = $('#is_testing');

            const cashCustomerName = $('#name');
            const cashCustomerCompanyName = $('#company_name');
            const cashCustomerEmail = $('#email');
            const cashCustomerPhone = $('#phone');
            const cashCustomerAddress = $('#address');
            const cashCustomerKraPin = $('#kra_pin');

            const cartProductsContainer = $('#cartProducts');
            const newCustomerContainer = $('#newCustomerContainer');
            const quoteTypeSelectInput = $('#quotation_type');
            const salesCustomerContainer = $('#saleCustomersContainer');
            const jobInspectionContainer = $('#jobInspectionsContainer');
            const saleCustomerIdSelectInput = $('#sale_customer_id');

            const brandSelectInput = $('#brand_id');
            const sellingPriceInput = $('#selling_price');
            const issueQuantityInput = $('#issue_quantity');
            const quoteQuantityInput = $('#quote_quantity');
            const brandProductSelectInput = $('#brand_product_id');

            const submitButton = $('#submit_btn');
            const addChargeButton = $('#btn_add_charge');
            const addProductButton = $('#btn_add_product');

            const jobCardReferralStatus = $('#is_referral');
            const warrantyStartDate = $('#warranty_start_date');
            const warrantyOptionSelectInput = $('#is_warranted');
            const warrantyOptionContainer = $('#warrantyOption');
            const warrantyDurationContainer = $('#warrantyDuration');
            const warrantyStartDateContainer = $('#warrantyStartDate');

            const discountValueInput = $('#discount_value');
            const discountTypeContainer = $('#discountType');
            const discountValueContainer = $('#discountValue');
            const discountTypeSelectInput = $('#discount_type');
            const discountOptionContainer = $('#discountOption');
            const discountOptionSelectInput = $('#is_discounted');
            const paymentTypeSelectInput = $('#payment_type');
            const availableQuantityDisplay = $('#available_quantity');

            const termsAndConditionsSelectInput = $('#terms_and_condition_id');
            const termsAndConditionsContainer = $('#terms-and-condition');
            const openingChargesContainer = $('#openingChargesContainer');
            const openingChargesApplicableInput = $('#opening_charges_applicable');
            const openingChargesInput = $('#opening_charges');
            const agentDetailsContainer = $('#agentDetails');
            const agentId = $('#agent_id');
            const agentName = $('#agent_name');
            const agentEarningInput = $('#agent_earning');
            const accountManagerSelectInput = $('#account_manager_id');

            const quotationForm = $('#quotation-form');

            const addedCharges = {};
            const addedProducts = {};

            const brands = @json($brands);
            const customers = @json($customers);
            const currencies = @json($currencies);
            const vatPercentage = @json($vatPercentage);
            const jobInspections = @json($jobInspections);
            const termsAndConditions = @json($termsAndConditions);
            const miscellaneousCharges = @json($miscellaneousCharges);

            const url = '{{ route('quotation.get-quotation-number') }}'

            $.get(url, function(data) {
                $('#quotation_number').val(data.quotation_number)
            });

            jobInspectionDate.flatpickr({
                dateFormat: "Y-m-d",
                defaultDate: @json(now()->format('Y-m-d'))
            });

            initializeUniqueSelect2('brand_product_id', 'select a product', ['name', 'part-number',
                'alpha-number'
            ]);
            initializeUniqueSelect2('product_id', 'select a product', ['name', 'part-number', 'alpha-number']);
            initializeUniqueSelect2('sale_customer_id', 'select customer', ['customer-name', 'customer-phone']);
            initializeUniqueSelect2('job_inspection_id', 'select inspection', ['customer', 'inspection-number',
                'jobcard'
            ]);

            let isChangingQuoteType = false;
            let isChangingCustomer = false;
            let isChangingInspection = false;

            function setCurrencyByCode(currencyCode) {
                const currency = currencies.find(c => c.code === currencyCode) || {
                    id: '',
                    code: 'KES'
                };

                if (!currency) {
                    console.warn(`Currency with code ${currencyCode} not found. Defaulting to KES.`);
                }

                isChangingCustomer = true;
                currencySelectInput.val(currency.id);
                currencySelectInput.trigger('change');
                isChangingCustomer = false;
            }

            function clearCustomerSelection() {
                saleCustomerIdSelectInput.val('').trigger('change');
            }

            saleCustomerIdSelectInput.on('change', function() {
                if (isChangingQuoteType || isChangingInspection) return;

                const saleCustomerId = parseInt($(this).val(), 10);
                const customer = customers.find(c => c.id === saleCustomerId);

                if (customer) {
                    $('#customer_id').val(customer.id);

                    const billingCurrencyCode = customer.billing_currency || 'KES';
                    setCurrencyByCode(billingCurrencyCode);

                    if (customer.account_manager_id === null) {
                        accountManagerSelectInput.prop('disabled', false);
                        toastr.info('Remember to assign an account manager to this customer.');
                    } else {
                        accountManagerSelectInput.prop('disabled', true);
                    }
                } else {
                    toastr.error('Customer not found or billing currency is missing.');
                    currencySelectInput.val('').trigger('change');
                    accountManagerSelectInput.prop('disabled', false);
                }
            });

            quoteTypeSelectInput.on('change', function() {
                const quoteType = $(this).val();
                isChangingQuoteType = true;

                clearCustomerSelection();
                isMiscellaneousChargedSelectInput.val('0').trigger('change');
                jobInspectionSelectInput.val('').trigger('change');
                $('#inspection_products').addClass('d-none');
                inspectionTable.clearData();

                toggleQuoteTypeContainers(quoteType);

                isChangingQuoteType = false;
            });

            function toggleQuoteTypeContainers(quoteType) {
                const containers = [
                    newCustomerContainer,
                    salesCustomerContainer,
                    jobInspectionContainer,
                    cartProductsContainer,
                    openingChargesContainer,
                    isMiscellaneousChargedContainer
                ];

                containers.forEach(container => container.addClass('d-none'));

                if (quoteType === 'sales') {
                    salesCustomerContainer.removeClass('d-none');
                    isTestingContainer.addClass('d-none');
                    clearCashCustomerInputs();
                } else if (quoteType === 'new-customer-quotation') {
                    newCustomerContainer.removeClass('d-none');
                    cartProductsContainer.removeClass('d-none');
                    isTestingContainer.addClass('d-none');
                    setCurrencyByCode('KES');
                } else {
                    clearCashCustomerInputs();
                    jobInspectionAccordion.removeClass('d-none');
                    jobInspectionContainer.removeClass('d-none');
                    $('#inspection_products').removeClass('d-none');
                    isMiscellaneousChargedContainer.removeClass('d-none');
                    isTestingContainer.removeClass('d-none');
                }
            }

            function clearCashCustomerInputs() {
                cashCustomerName.val('')
                cashCustomerPhone.val('')
                cashCustomerEmail.val('')
                cashCustomerKraPin.val('')
                cashCustomerAddress.val('')
                cashCustomerCompanyName.val('')
            }

            jobInspectionSelectInput.on('change', function() {
                const jobInspectionId = $(this).val();
                const jobInspection = jobInspections.find(inspection => inspection.id == jobInspectionId);

                if (!jobInspection) {
                    console.error("Job inspection not found");
                    clearCustomerDetails();
                    return;
                }

                handleReworkValidation(jobInspection);
                handleCustomerDetails(jobInspection);
                handleAccountManagerValidation(jobInspection);
                populateInspectionTable(jobInspection);
            });

            function clearCustomerDetails() {
                $('#customer_name').text('');
                $('#customer_name').val('');
            }

            function handleReworkValidation(jobInspection) {
                if (jobInspection.job_card.type === 'rework' && jobInspection.job_card.warranty_status ===
                    'inactive') {
                    showModal(
                        'Please ensure this quotation includes charges, as the Job Card is classified as an unwarranted rework'
                    );
                }
            }

            function handleCustomerDetails(jobInspection) {
                const customerName = jobInspection.customer.company_name ?? jobInspection.customer.name;
                $('#customer_name').text(customerName);
                $('#customer_name').val(customerName);
            }

            function handleAccountManagerValidation(jobInspection) {
                if (jobInspection.customer.account_manager_id === null) {
                    accountManagerSelectInput.prop('disabled', false);
                    toastr.info('Remember to assign an account manager to this customer.');
                } else {
                    accountManagerSelectInput.prop('disabled', true);
                }
            }

            function populateInspectionTable(jobInspection) {
                const data = jobInspection.job_inspection_products.map(jobCardProduct => ({
                    product_id: jobCardProduct.product_id,
                    brand_name: jobCardProduct?.product?.brand?.name ?? '-',
                    product_name: jobCardProduct.product.name,
                    part_number: jobCardProduct.product.part_number,
                    quantity: jobCardProduct.quantity,
                }));

                inspectionTable.setData(data);
                inspectionTable.setHeight(data.length > 10 ? 400 : "");
            }

            function showModal(message) {
                $('#modalMessage').text(message);
                $('#infoModal').modal('show');
            }

            let jobInspectionProducts = [];

            brandProductSelectInput.on('change', function() {
                const productId = parseInt($(this).val());
                const url =
                    "{{ route('single-product.get-quantity') }}";
                if (!productId) {
                    availableQuantityDisplay.text('');
                    return;
                }

                $.get(url, {
                        product_id: productId
                    })
                    .done(function(response) {
                        const availableQuantity = response.singleProductQuantity || 0;
                        availableQuantityDisplay.text(`Current Qty: ${availableQuantity}.`);
                    })
                    .fail(function() {
                        alert('Failed to fetch product quantity. Please try again.');
                        availableQuantityDisplay.text('Error fetching quantity.');
                    });
            });

            const updateProductSelect = (products) => {
                const options = products.map((product) =>
                    `<option value="${product.id}" data-name="${product.name}" data-part-number="${product.part_number}" data-alpha-number="${product.alpha_number}">${product.name}</option>`
                );
                productSelectInput.html(
                    `<option value="">Select product</option>` + options.join('')
                );
            };

            const loadProducts = (jobInspectionId) => {
                productSelectInput.html('<option>Loading...</option>');

                $.ajax({
                    url: '{{ route('inspection.get-products') }}',
                    type: 'GET',
                    data: {
                        type: 'jobInspectionProducts',
                        jobInspectionId,
                    },
                    dataType: 'json',
                    success: function({
                        jobInspectionProducts: products
                    }) {
                        jobInspectionProducts = products;
                        updateProductSelect(products);
                    },
                    error: function() {
                        productSelectInput.html(
                            '<option value="">Error loading products</option>');
                    },
                });
            };

            jobInspectionSelectInput.on('change', function() {
                const jobInspectionId = $(this).val();
                if (jobInspectionId) {
                    loadProducts(jobInspectionId);
                } else {
                    productSelectInput.html('<option value="">Select product</option>');
                }
            });

            isMiscellaneousChargedSelectInput.on('change', function() {
                if ($(this).val() == '1') {
                    chargesContainer.removeClass('d-none');
                } else {
                    chargesContainer.addClass('d-none');
                }
            });

            agentEarningInput.on('keyup change', function() {
                let discount = Number($(this).val()) || 0;

                if (paymentTypeSelectInput.val() === 'percentage' && discount > 100) {
                    discount = 100;
                    $(this).val(discount);
                    toastr.info("Discount percentage cannot exceed 100.");
                }
            });

            jobInspectionSelectInput.on('change', function() {
                const selectedInspectionId = parseInt($(this).val());
                const paymentType = paymentTypeSelectInput.val();
                const jobInspection = jobInspections.find(inspect => inspect.id ===
                    selectedInspectionId);

                if (jobInspection) {
                    $('#customer_id').val(jobInspection.customer_id);
                    $('#job_card_id').val(jobInspection.job_card_id);

                    let billingCurrencyCode = jobInspection.customer.billing_currency;
                    if (!billingCurrencyCode && jobInspection.customer.account_type === 'cash') {
                        billingCurrencyCode = 'KES';
                    }

                    const billingCurrency = currencies.find(currency => currency.code ===
                        billingCurrencyCode);

                    if (billingCurrency) {
                        currencySelectInput.val(billingCurrency.id).trigger('change');
                    } else {
                        toastr.error('Customer does not have a billing currency.');
                        currencySelectInput.val('').trigger('change');
                    }

                    // Handle Job Opening Charges Details
                    if (jobInspection.job_card.opening_charges_applicable == true) {
                        openingChargesContainer.removeClass('d-none');
                        openingChargesApplicableInput.val('Yes');
                        openingChargesInput.val('');
                    } else {
                        openingChargesContainer.addClass('d-none');
                        openingChargesApplicableInput.val('No');
                        openingChargesInput.val('0');
                    }

                    openingChargesInput.on('keyup change', function() {
                        updateCostAndTotals();
                    });

                    // Handling the agent details
                    if (jobInspection.job_card.agent !== null) {
                        agentDetailsContainer.removeClass('d-none');
                        agentId.val(jobInspection.job_card.agent_id);
                        agentName.val(jobInspection.job_card.agent.name);

                        jobCardReferralStatus.val(jobInspection.job_card.is_referral ?? false);
                        paymentTypeSelectInput.val(jobInspection.job_card.agent.payment_type).trigger(
                            'change');

                        let discount = Number(agentEarningInput.val()) || 0;

                        if (paymentType === 'percentage') {
                            discount = Math.min(discount, jobInspection.job_card.agent.percentage_value,
                                100);

                            if (discount > 100) {
                                discount = 100;
                                toastr.warning("Discount percentage cannot exceed 100.");
                            }

                            agentEarningInput.val(discount);
                        }

                    } else {
                        agentDetailsContainer.addClass('d-none');
                        agentName.val('');
                        paymentTypeSelectInput.val('').trigger('change');
                    }
                } else {
                    $('#customer_id').val('');
                    $('#job_card_id').val('');
                    currencySelectInput.val('').trigger('change');
                    agentDetailsContainer.addClass('d-none');
                    agentName.val('');
                    paymentTypeSelectInput.val('').trigger('change');
                }
            });

            const inspectionTable = new Tabulator("#inspection_products", {
                renderHorizontal: "virtual",
                rowHeight: 50,
                selectable: false,
                columns: [{
                        title: "Product Id",
                        field: "product_id",
                        visible: false,
                    },
                    {
                        title: "Brand",
                        field: "brand_name",
                        headerSort: false,
                    },
                    {
                        title: "Product",
                        field: "product_name",
                        headerSort: false,
                        minWidth: 400,
                        formatter: function(cell) {
                            const productName = cell.getValue();
                            const partNumber = cell.getRow().getData().part_number;
                            return `
                            <div style="font-size: 1em;">${productName}</div>
                            <div style="font-size: 0.8em; color: #777;">Part No: ${partNumber}</div>`;
                        }
                    },
                    {
                        title: "Quantity",
                        field: "quantity",
                        headerSort: false,
                    },
                ],
                layout: "fitColumns",
            });

            const chargesTable = new Tabulator("#miscellaneous_charges", {
                renderHorizontal: "virtual",
                rowHeight: 50,
                columns: [{
                        title: "Charge ID",
                        field: "miscellaneous_charge_id",
                        visible: false,
                    },
                    {
                        title: "Product Id",
                        field: "product_id",
                        visible: false,
                    },
                    {
                        title: "Product",
                        field: "product_name",
                        headerSort: false,
                        minWidth: 300,
                        formatter: function(cell) {
                            const productName = cell.getValue();
                            const partNumber = cell.getRow().getData().part_number;
                            return `
                            <div style="font-size: 1em;">${productName}</div>
                            <div style="font-size: 0.8em; color: #777;">Part No: ${partNumber}</div>`;
                        }
                    },
                    {
                        title: "Charge",
                        field: "charge_name",
                        headerSort: false,
                    },
                    {
                        title: "Quantity",
                        field: "quantity",
                        headerSort: false
                    },
                    {
                        title: "Price",
                        field: "price",
                        headerSort: false
                    },
                    {
                        title: "VAT Amount",
                        field: "vat_amount",
                        headerSort: false
                    },
                    {
                        title: "Total Amount",
                        field: "total_amount",
                        headerSort: false
                    },
                    {
                        title: "Action",
                        field: "example",
                        headerSort: false,
                        formatter: function(cell, formatterParams, onRendered) {
                            return "<i class='fa fa-trash-alt' style='cursor:pointer; color:red;'></i>";
                        },
                        cellClick: function(e, cell) {
                            if (confirm('Are you sure you want to delete this entry?'))
                                cell.getRow().delete();
                            updateCostAndTotals();
                        }
                    }
                ],
                layout: "fitColumns",
            });

            productSelectInput.on('change', function() {
                const productId = parseInt($(this).val());
                const selectedProduct = jobInspectionProducts.find(product => product.id == productId);

                if (selectedProduct) {
                    quantityInput.val(selectedProduct.quantity);
                } else {
                    quantityInput.val('');
                }
            });

            addChargeButton.click(function() {
                const price = Number(priceInput.val());
                const productQuantity = Number(quantityInput.val());
                const productId = parseInt(productSelectInput.val());
                const miscellaneousChargeId = parseInt(miscellaneousChargeSelectInput.val());

                if (price <= 0 || productQuantity <= 0) {
                    toastr.error('Price & quantity should be greater than 0.');
                    return false;
                }

                const selectedProduct = jobInspectionProducts.find(product => product.id === productId);
                if (!selectedProduct) {
                    toastr.error('Selected product does not exist.');
                    return false;
                }

                const chargesTableData = chargesTable.getData();
                const existingRow = chargesTableData.find(row =>
                    row.product_id === productId && row.miscellaneous_charge_id ===
                    miscellaneousChargeId
                );

                if (existingRow) {
                    toastr.error('This product and charge combination has already been added.');
                    return false;
                }

                const miscellaneousCharge = miscellaneousCharges.find(charge =>
                    charge.id === miscellaneousChargeId
                );
                if (!miscellaneousCharge) {
                    toastr.error('Miscellaneous charge does not exist.');
                    return false;
                }

                const totalAmount = price * productQuantity;
                const vatAmount = totalAmount * (vatPercentage / 100);

                const newRowData = {
                    id: generateUniqueChargesRowId(),
                    product_id: selectedProduct.id,
                    product_name: selectedProduct.name,
                    part_number: selectedProduct.part_number,
                    miscellaneous_charge_id: miscellaneousChargeId,
                    charge_name: miscellaneousCharge.name,
                    price: price,
                    quantity: productQuantity,
                    vat_amount: vatAmount,
                    total_amount: totalAmount,
                };

                chargesTable.addData([newRowData]);

                priceInput.val('');
                quantityInput.val('');
                productSelectInput.val('').trigger('change');
                miscellaneousChargeSelectInput.val('').trigger('change');
                updateCostAndTotals();
            });

            function generateUniqueChargesRowId() {
                return '_' + Math.random().toString(36).substr(2, 9);
            }

            let brandProducts = [];

            const updateBrandProductSelect = (brandProducts) => {
                const options = brandProducts.map((product) =>
                    `<option value="${product.id}" data-name="${product.name}" data-part-number="${product.part_number}" data-alpha-number="${product.alpha_number}">${product.name}</option>`
                );
                brandProductSelectInput.html(
                    `<option value="">Select product</option>` + options.join('')
                );
            };

            const loadBrandProducts = (brandId) => {
                brandProductSelectInput.html('<option>Loading...</option>');

                $.ajax({
                    url: '{{ route('brand.get-products') }}',
                    type: 'GET',
                    data: {
                        brand_id: brandId,
                    },
                    dataType: 'json',
                    success: function(response) {
                        const {
                            brandWiseProducts
                        } = response;
                        brandProducts = brandWiseProducts;
                        updateBrandProductSelect(brandProducts);
                    },
                    error: function() {
                        brandProductSelectInput.html(
                            '<option value="">Error loading products</option>');
                    },
                });
            };

            brandSelectInput.on('change', function() {
                const brandId = $(this).val();
                if (brandId) {
                    loadBrandProducts(brandId);
                } else {
                    brandProductSelectInput.html('<option value="">Select product</option>');
                }
            });

            const quotationTable = new Tabulator("#quotation_products", {
                renderHorizontal: "virtual",
                rowHeight: 50,
                columns: [{
                        title: "Brand Id",
                        field: "brand_id",
                        visible: false,
                    },
                    {
                        title: "Brand",
                        field: "brand_name",
                        minWidth: 120,
                        headerSort: false,
                    },
                    {
                        title: "Product Id",
                        field: "product_id",
                        visible: false,
                    },
                    {
                        title: "Product",
                        field: "product_name",
                        minWidth: 300,
                        headerSort: false,
                        formatter: function(cell) {
                            const productName = cell.getValue();
                            const partNumber = cell.getRow().getData().part_number;
                            return `
                            <div style="font-size: 1em;">${productName}</div>
                            <div style="font-size: 0.8em; color: #777;">Part No: ${partNumber}</div>`;
                        }
                    },
                    {
                        title: "Quote Qty",
                        field: "quoted_quantity",
                        minWidth: 100,
                        headerSort: false,
                        formatter: function(cell) {
                            return formatNumberWithCommas(cell.getValue());
                        }
                    },
                    {
                        title: "Issue Qty",
                        field: "issue_quantity",
                        minWidth: 100,
                        headerSort: false,
                        formatter: function(cell) {
                            return formatNumberWithCommas(cell.getValue());
                        }
                    },
                    {
                        title: "Price",
                        field: "selling_price",
                        minWidth: 100,
                        headerSort: false,
                        formatter: function(cell) {
                            return formatNumberWithCommas(cell.getValue());
                        }
                    },
                    {
                        title: "Total",
                        field: "total_amount",
                        minWidth: 100,
                        headerSort: false,
                        formatter: function(cell) {
                            return formatNumberWithCommas(cell.getValue());
                        }
                    },
                    {
                        title: "Action",
                        field: "example",
                        width: 80,
                        headerSort: false,
                        formatter: function(cell, formatterParams, onRendered) {
                            return "<i class='fa fa-trash-alt' style='cursor:pointer; color:red;'></i>";
                        },
                        cellClick: function(e, cell) {
                            if (confirm('Are you sure you want to delete this entry?'))
                                cell.getRow().delete();
                            updateCostAndTotals();
                        }
                    },
                ],
                layout: "fitColumns",
            });

            function formatNumberWithCommas(value) {
                if (value === null || value === "") return "";
                return parseFloat(value).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            brandProductSelectInput.on('change', function() {
                const selectedProductId = $(this).val();
                const selectedProduct = brandProducts.find(product => product.id == selectedProductId);

                if (selectedProduct) {
                    const basePrice = selectedProduct.selling_price;
                    const minPrice = selectedProduct.minimum_selling_price;
                    const maxPrice = selectedProduct.maximum_selling_price;

                    const formattedMinPrice = parseFloat(minPrice).toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    const formattedMaxPrice = parseFloat(maxPrice).toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                    sellingPriceInput.val(basePrice);
                    $('#priceRange').text(`Sell from ${formattedMaxPrice}.`);
                } else {
                    sellingPriceInput.val('');
                    $('#priceRange').text('');
                }
            });

            function showLowPriceModal() {
                return new Promise((resolve) => {
                    const lowPriceModalElement = document.getElementById('lowPriceModal');
                    const lowPriceModal = new bootstrap.Modal(lowPriceModalElement);
                    const confirmButton = document.getElementById('confirmProceedLowPrice');

                    confirmButton.addEventListener('click', function onConfirm() {
                        resolve(true);
                        lowPriceModal.hide();
                        confirmButton.removeEventListener('click', onConfirm);
                    });

                    lowPriceModalElement.addEventListener('hidden.bs.modal', function onClose() {
                        resolve(false);
                        lowPriceModalElement.removeEventListener('hidden.bs.modal', onClose);
                    });

                    lowPriceModal.show();
                });
            }

            addProductButton.click(async function() {
                const brandId = brandSelectInput.val();
                const brandProductId = brandProductSelectInput.val();
                const quoteType = quoteTypeSelectInput.val();
                const quoteQuantity = Number(quoteQuantityInput.val());
                const issueQuantity = Number(issueQuantityInput.val());

                const selectedProduct = brandProducts.find(product => product.id == brandProductId);

                if (!selectedProduct) return;

                const baseCost = selectedProduct.selling_price;
                const minSellingPrice = selectedProduct.minimum_selling_price;
                const maxSellingPrice = selectedProduct.maximum_selling_price;

                let sellingPrice = Number(sellingPriceInput.val()) || selectedProduct.selling_price;

                const existingRow = quotationTable.getData().find(row => row.product_id ==
                    brandProductId &&
                    row.brand_id == brandId);

                if (
                    (quoteType === 'sales' && quoteQuantity !== issueQuantity) ||
                    (quoteType === 'new-customer-quotation' && quoteQuantity !== issueQuantity)
                ) {
                    toastr.error(
                        'For Sales or New Customer Quotation, the quoted and issued quantities must match.'
                    );
                    return false;
                }

                if (existingRow) {
                    toastr.error('You cannot add the same product and brand twice.');
                    return false;
                }

                if (sellingPrice < 0 || quoteQuantity < 0) {
                    toastr.error('Selling price & quantities must be greater than or equal to 0.');
                    return false;
                }

                if (issueQuantity > quoteQuantity) {
                    toastr.error('Issue quantity must be less than or equal to quoted quantity.');
                    return false;
                }

                if (sellingPrice < minSellingPrice) {
                    const proceedWithLowPrice =
                        await showLowPriceModal();
                    if (!proceedWithLowPrice) {
                        return false;
                    }
                }

                const totalAmount = sellingPrice * quoteQuantity;
                const vatAmount = totalAmount * (vatPercentage / 100);

                const newRowData = {
                    id: generateUniqueProductRowId(),
                    brand_id: brandId,
                    brand_name: brands.find(brand => brand.id == brandId).name,
                    product_id: selectedProduct.id,
                    product_name: selectedProduct.name,
                    part_number: selectedProduct.part_number,
                    quoted_quantity: quoteQuantity,
                    issue_quantity: issueQuantity,
                    selling_price: sellingPrice,
                    vat_amount: vatAmount,
                    total_amount: totalAmount,
                };

                quotationTable.addData([newRowData]).then(() => {
                    if (sellingPrice < minSellingPrice) {
                        const newRow = quotationTable.getRow(newRowData.id);
                        newRow.getElement().classList.add('warning-row');
                    }
                });

                sellingPriceInput.val('');
                issueQuantityInput.val('');
                quoteQuantityInput.val('');
                brandSelectInput.val('').trigger('change');
                brandProductSelectInput.val('').trigger('change');

                updateCostAndTotals();
            });

            function generateUniqueProductRowId() {
                return '_' + Math.random().toString(36).substr(2, 9);
            }

            updateCostAndTotals();

            termsAndConditionsSelectInput.on('change', function() {
                const selectedValue = parseInt($(this).val());
                const termsAndCondition = termsAndConditions.find(termsAndCondition => termsAndCondition
                    .id === selectedValue);

                if (termsAndCondition && termsAndCondition.conditions) {
                    $('#conditions').html(termsAndCondition.conditions);
                } else {
                    $('#conditions').html('');
                }
            });

            discountOptionSelectInput.on('change', function() {
                const selectedOption = $(this).val();
                if (selectedOption === '1') {
                    warrantyOptionContainer.removeClass('col-md-6').addClass('col-md-3');
                    discountOptionContainer.removeClass('col-md-6').addClass('col-md-3');
                    discountTypeContainer.removeClass('d-none');
                    discountValueContainer.removeClass('d-none');
                } else {
                    warrantyOptionContainer.addClass('col-md-6').removeClass('col-md-3');
                    discountOptionContainer.addClass('col-md-6').removeClass('col-md-3');
                    discountTypeContainer.addClass('d-none');
                    discountValueContainer.addClass('d-none');

                    discountTypeSelectInput.val('').trigger('change');
                    discountValueInput.val('0.00').trigger('change');
                }
                updateCostAndTotals();
            });

            discountValueInput.on('keyup change', function() {
                let discount = Number($(this).val()) || 0;
                const cost = Number(costInput.val()) || 0;
                const discountType = discountTypeSelectInput.val();

                if (discountType === 'percentage' && discount > 100) {
                    discount = 100;
                    $(this).val(discount);
                    toastr.warning("Discount percentage cannot exceed 100.");
                }

                let calculatedDiscount = 0;
                if (discountType === 'flat-fee') {
                    calculatedDiscount = discount;
                } else if (discountType === 'percentage') {
                    calculatedDiscount = (discount / 100) * cost;
                }

                totalDiscountAmountInput.val(calculatedDiscount.toFixed(2));

                updateCostAndTotals();
            });

            function updateCost() {
                const chargesTotalCost = chargesTable.getData().reduce((sum, row) => sum + Number(row
                    .total_amount) || 0, 0);
                const quotationTotalCost = quotationTable.getData().reduce((sum, row) => sum + Number(row
                    .total_amount) || 0, 0);
                const openingCharges = Number(openingChargesInput.val()) || 0;
                const totalCost = quotationTotalCost + chargesTotalCost + openingCharges;

                costInput.val(totalCost.toFixed(2));
                return totalCost;
            }

            function updateVatAndTotalCost() {
                const cost = updateCost();
                const discount = Number(totalDiscountAmountInput.val()) || 0;
                const totalVatAmount = (vatPercentage / 100) * cost;

                totalVatAmountInput.val(totalVatAmount.toFixed(2));
                const totalCost = Math.max(0, cost + totalVatAmount - discount);

                totalCostInput.val(totalCost.toFixed(2));
            }

            function updateCostAndTotals() {
                updateCost();
                updateVatAndTotalCost();
            }

            updateCostAndTotals();

            function addError(field, message) {
                if (field.next('.invalid-feedback').length === 0) {
                    field.addClass('is-invalid');
                    field.after(`<div class="invalid-feedback fw-bold">${message}</div>`);
                }
            }

            function showError(field, message) {
                toastr.error(message);
                if (field) addError(field, message);
            }

            function validateField(field, message) {
                if (!field.val().trim()) {
                    showError(field, message);
                    return false;
                }
                return true;
            }

            quotationForm.submit(function(e) {
                e.preventDefault();
                submitButton.attr('disabled', true);

                $('.invalid-feedback').remove();
                $('.is-invalid').removeClass('is-invalid');

                let isFormValid = true;

                const requiredFields = [{
                        id: '#quotation_type',
                        name: 'Quotation Type'
                    },
                    {
                        id: '#currency_id',
                        name: 'Currency'
                    },
                    {
                        id: '#terms_and_condition_id',
                        name: 'Terms & Conditions'
                    },
                    {
                        id: '#is_miscellaneous_charged',
                        name: 'Miscellaneous Charges'
                    },
                    {
                        id: '#is_warranted',
                        name: 'Warranty Status'
                    },
                    {
                        id: '#is_discounted',
                        name: 'Discount Status'
                    }
                ];

                requiredFields.forEach(({
                    id,
                    name
                }) => {
                    if (!validateField($(id), `${name} is required.`)) {
                        isFormValid = false;
                    }
                });

                const selectFields = [{
                        field: warrantyOptionSelectInput,
                        message: 'Please select a warranty option.'
                    },
                    {
                        field: discountOptionSelectInput,
                        message: 'Please select a discount option.'
                    },
                    {
                        field: quoteTypeSelectInput,
                        message: 'Please select a quote type.'
                    },
                    {
                        field: termsAndConditionsSelectInput,
                        message: 'Please select terms and conditions.'
                    }
                ];

                selectFields.forEach(({
                    field,
                    message
                }) => {
                    if (!validateField(field, message)) {
                        isFormValid = false;
                    }
                });

                const quoteType = quoteTypeSelectInput.val();
                const inspectionInput = jobInspectionSelectInput.val();

                if (quoteType === 'inspection' && !inspectionInput) {
                    showError(jobInspectionSelectInput, 'Please select a Job Inspection.');
                    isFormValid = false;
                }

                if (quoteType === 'new-customer-quotation') {
                    const newCustomerFields = [{
                            field: $('#name'),
                            message: 'Customer Name is required'
                        },
                        {
                            field: $('#phone'),
                            message: 'Customer Phone is required'
                        }
                    ];

                    newCustomerFields.forEach(({
                        field,
                        message
                    }) => {
                        if (!validateField(field, message)) {
                            isFormValid = false;
                        }
                    });

                    // Find customer based on provided input values
                    const customer = customers.find(cust =>
                        cust.company_name === cashCustomerCompanyName.val() ||
                        cust.email === cashCustomerEmail.val() ||
                        cust.phone === cashCustomerPhone.val() ||
                        cust.kra_pin === cashCustomerKraPin.val()
                    );

                    if (customer) {
                        const duplicateChecks = [{
                                field: cashCustomerPhone,
                                value: customer.phone,
                                message: 'This Phone already exists.'
                            },
                            {
                                field: cashCustomerEmail,
                                value: customer.email,
                                message: 'This Email already exists.'
                            },
                            {
                                field: cashCustomerKraPin,
                                value: customer.kra_pin,
                                message: 'This KRA Pin already exists.'
                            }
                        ];

                        duplicateChecks.forEach(({
                            field,
                            value,
                            message
                        }) => {
                            if (field.val() === value) {
                                showError(field, `${message} Please select an existing customer.`);
                                isFormValid = false;
                            }
                        });
                    }
                }

                if (quoteType === 'inspection' && !$('#job_inspection_id').val()) {
                    showError($('#job_inspection_id'),
                        'Job Inspection is required for inspection quotations.');
                    isFormValid = false;
                } else if (quoteType === 'sales' && !$('#sale_customer_id').val()) {
                    showError($('#sale_customer_id'), 'Customer is required for sales quotations.');
                    isFormValid = false;
                }

                if ($('#is_discounted').val() === '1') {
                    if (!validateField($('#discount_type'),
                            'Discount Type is required when discount is applied.')) {
                        isFormValid = false;
                    }
                    if (!validateField($('#discount_value'),
                            'Discount Value is required when discount is applied.')) {
                        isFormValid = false;
                    }
                }

                if (quoteType === 'inspection' && $('#is_referral').val() === '1') {
                    if (!validateField(agentEarningInput, 'Agent Earning is required.')) {
                        isFormValid = false;
                    }
                }

                const jobInspection = jobInspections.find(job => job.id === parseInt(
                    jobInspectionSelectInput.val()));
                if (jobInspection && jobInspection.opening_charges && !openingChargesInput.val()) {
                    showError(openingChargesInput,
                        'Charges are required when opening charges are applied.');
                    isFormValid = false;
                }

                const quotationProductsData = quotationTable.getData();
                if (quotationProductsData.length > 0) {
                    $(this).append($('<input type="hidden" name="quotation_products"/>').val(JSON
                        .stringify(
                            quotationProductsData)));
                } else {
                    showError(null, 'Please quote at least one product.');
                    isFormValid = false;
                }

                const selectedChargesData = chargesTable.getData();
                $(this).append($('<input type="hidden" name="miscellaneous_charges"/>').val(
                    selectedChargesData.length > 0 ? JSON.stringify(selectedChargesData) : null
                ));

                if (quoteType === 'inspection' && jobInspection) {
                    if (jobInspection.customer.account_type === 'credit' && jobInspection.customer
                        .account_manager_id === null && accountManagerSelectInput.val() === null) {
                        showError(null,
                            'This credit customer has no account manager assigned. Please add an account manager before creating the quotation.'
                        );
                        isFormValid = false;
                    }
                }

                openingChargesApplicableInput.val(openingChargesApplicableInput.val() === 'Yes' ? '1' :
                    '0');
                isTestingSelectInput.val(isTestingSelectInput.val() === '' ? '0' : isTestingSelectInput
                    .val());

                if (isFormValid) {
                    this.submit();
                } else {
                    submitButton.attr('disabled', false);
                }
            });

        });
    </script>
@endsection
