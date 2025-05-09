function generatedDateRanges(selectorId) {
    const start = moment().startOf("year");
    const end = moment().endOf("year");

    $(`#${selectorId}`).daterangepicker(
        {
            startDate: start,
            endDate: end,
            ranges: {
                Today: [moment(), moment()],
                Yesterday: [
                    moment().subtract(1, "days"),
                    moment().subtract(1, "days"),
                ],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [
                    moment().startOf("month"),
                    moment().endOf("month"),
                ],
                "Last Month": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
                "This Year Q1": [
                    moment().quarter(1).startOf("quarter"),
                    moment().quarter(1).endOf("quarter"),
                ],
                "This Year Q2": [
                    moment().quarter(2).startOf("quarter"),
                    moment().quarter(2).endOf("quarter"),
                ],
                "This Year Q3": [
                    moment().quarter(3).startOf("quarter"),
                    moment().quarter(3).endOf("quarter"),
                ],
                "This Year Q4": [
                    moment().quarter(4).startOf("quarter"),
                    moment().quarter(4).endOf("quarter"),
                ],
                "This Year": [moment().startOf("year"), moment().endOf("year")],
                "Last Year": [
                    moment().subtract(1, "year").startOf("year"),
                    moment().subtract(1, "year").endOf("year"),
                ],
            },
        },
        function (start, end, label) {
            $(`#${selectorId} .form-control`).val(
                `${start.format("DD/MM/YYYY")} - ${end.format("DD/MM/YYYY")}`
            );
        }
    );
}

function initializeDatatable(selectorId, options = {}) {
    return $(`#${selectorId}`).DataTable({
        dom:
            "<'row'" +
           "<'col-sm-6 d-flex align-items-center justify-content-start my-4'f>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end'B>" +
            ">" +
            "<'table-responsive'tr>" +
            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">",
        buttons: [
            {
                extend: "pageLength",
                titleAttr: "Record Count",
                className: "btn-light-pri",
            },
            {
                extend: "collection",
                text: '<span><i class="la la-download"></i> Data Export</span>',
                titleAttr: "Record Export",
                className: "btn-light-pri",
                buttons: [
                    {
                        extend: "csvHtml5",
                        text: '<li><span><i class="la la-file-text-o"></i></span>&nbsp;<span>CSV Export</span></li>',
                        exportOptions: {
                            columns: ":visible",
                        },
                    },
                    {
                        extend: "excelHtml5",
                        text: '<li><span><i class="la la-file-excel-o"></i></span>&nbsp;<span>Excel Export</span></li>',
                        exportOptions: {
                            columns: ":visible",
                        },
                    },
                    {
                        extend: "pdfHtml5",
                        text: '<li><span><i class="la la-file-pdf-o"></i></span>&nbsp;<span>PDF Export</span></li>',
                        exportOptions: {
                            columns: ":visible",
                        },
                    },
                    {
                        extend: "copyHtml5",
                        text: '<li><span><i class="la la-copy"></i></span>&nbsp;<span>Copy Table</span></li>',
                        exportOptions: {
                            columns: ":visible",
                        },
                    },
                    {
                        extend: "print",
                        text: '<li><span><i class="la la-print"></i></span>&nbsp;<span>Print Table</span></li>',
                        exportOptions: {
                            columns: ":visible",
                        },
                    },
                ],
            },
        ],
        pageLength: options?.pageLength || 10,
        lengthMenu: [
            [10, 15, 20, 50, 100, -1],
            [
                "10 records",
                "15 records",
                "20 records",
                "50 records",
                "100 records",
                "Show all",
            ],
        ],
    });
}

function initializeSelect2(selectorId, placeholder) {
    $(`#${selectorId}`).select2({
        placeholder,
    });
}

function initializeUniqueSelect2(selectorId, placeholder, dataAttributes = []) {
    $(`#${selectorId}`).select2({
        placeholder,
        templateResult: function(item) {
            return formatSelectItem(item, dataAttributes);
        },
        templateSelection: function(item) {
            return formatSelectSelection(item);
        },
        matcher: function(params, data) {
            return customMatcher(params, data, dataAttributes);
        }
    });

    function formatSelectItem(item, attributes) {
        if (!item.id) {
            return item.text;
        }

        let itemElements = attributes.map((attr, index) => {
            let attrValue = $(item.element).data(attr);

            if (index === 0) {
                return `<span class="fw-bold item-${attr}">${attrValue || ''}</span>`;
            } else {
                return `<span class="item-${attr}">${attrValue || ''}</span>`;
            }
        }).join('<br>');

        return $(`<div class="d-flex flex-column">${itemElements}</div>`);
    }

    function formatSelectSelection(item) {
        return item.text;
    }

    function customMatcher(params, data, attributes) {
        if ($.trim(params.term) === '') {
            return data;
        }

        let match = false;

        attributes.forEach(attr => {
            let attrValue = $(data.element).data(attr);
            if (attrValue && attrValue.toString().toLowerCase().includes(params.term.toLowerCase())) {
                match = true;
            }
        });

        if (match) {
            return data;
        }

        return null;
    }
}

function linkExportButtonWithDatatable(table) {
    $("#export-csv").on("click", function (e) {
        e.preventDefault();
        table.button(".buttons-csv").trigger();
    });

    $("#export-excel").on("click", function (e) {
        e.preventDefault();
        table.button(".buttons-excel").trigger();
    });

    $("#export-pdf").on("click", function (e) {
        e.preventDefault();
        table.button(".buttons-pdf").trigger();
    });

    $("#export-copy").on("click", function (e) {
        e.preventDefault();
        table.button(".buttons-copy").trigger();
    });

    $("#export-print").on("click", function (e) {
        e.preventDefault();
        table.button(".buttons-print").trigger();
    });
}

// function initializeRepeater(selectorId, initEmpty) {
//     $(`#${selectorId}`).repeater({
//         initEmpty: initEmpty,

//         show: function() {
//             $(this).slideDown();

//             // Reinit select2
//             $(this).find('[data-kt-repeater="select2"]').select2();

//         },

//         hide: function(deleteElement) {
//             $(this).slideUp(deleteElement);
//         },

//         ready: function () {
//             // Init select2
//             $('[data-kt-repeater="select2"]').select2();
//         }
//     });
// }
