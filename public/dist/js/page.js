$(document).ready(function() {
    var row_id = 0;
    if (location.pathname == '/customers') {

        $('.page-header').html('Customers');
        $('thead tr').append($('<th />', { text: 'Name' }));
        $('thead tr').append($('<th />', { text: 'Address' }));
        $('thead tr').append($('<th />', { text: 'Email' }));
        $('thead tr').append($('<th />', { text: 'Phone' }));

        $('#table').on('click', 'tr', function() {
            try {
                row_id = table.row(this).data().id;
                editor.s.ajax.edit.url = '/api/customers';
                editor.s.ajax.remove.url = '/api/customers';
            } catch (e) {

            }
        });

        var table = $('#table').DataTable({
            "autoWidth": true,
            'responsive': true,
            "ajax": {
                "url": "/api/customers",
                "type": "GET"
            },
            "columns": [
                { "data": "name" },
                { "data": "address" },
                { "data": "email" },
                { "data": "phone" }
            ],
            'bPaginate': false,
            'select': true,
            "bInfo": false,
            "bLengthChange": false
        });

        editor = new $.fn.dataTable.Editor({

            ajax: {
                create: {
                    type: 'POST',
                    url: '/api/customers',
                    data: function(d) {
                        d.name = $("#DTE_Field_name").val();
                        d.address = $("#DTE_Field_address").val();
                        d.phone = $("#DTE_Field_phone").val();
                        d.email = $("#DTE_Field_email").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        table.ajax.reload();
                        $.notify('New customer added.', 'success');
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                edit: {
                    type: 'PATCH',
                    url: '/api/customers',
                    data: function(d) {
                        d.id = row_id;
                        d.name = $("#DTE_Field_name").val();
                        d.address = $("#DTE_Field_address").val();
                        d.email = $("#DTE_Field_email").val();
                        d.phone = $("#DTE_Field_phone").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Customer updated.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                remove: {
                    type: 'DELETE',
                    url: '/api/customers',
                    data: function(d) {
                        d.id = row_id;
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Customer has been trashed.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                }
            },
            table: "#table",
            'idSrc': 'id',
            fields: [{
                label: "Name:",
                name: "name"
            }, {
                label: "Address:",
                name: "address",
                type: "textarea"
            }, {
                label: "Email:",
                name: "email"
            }, {
                label: "Phone:",
                name: "phone",
                attr: {
                    "type": "number"
                }
            }],
            i18n: {
                create: {
                    title: "Add Customer"
                },
                edit: {
                    title: "Edit Customer"
                },
                remove: {
                    title: "Trash Customer"
                }
            }
        });

        new $.fn.dataTable.Buttons(table, [
            { extend: "create", className: 'btn btn-success btn-outline Btn', editor: editor },
            { extend: "edit", className: 'btn btn-primary btn-outline Btn', editor: editor },
            {
                extend: "remove",
                className: 'btn btn-danger btn-outline Btn',
                editor: editor,
                formMessage: function(e, dt) {
                    return 'Are you sure you want to trash the customer?';
                }
            }
        ]);

        table.buttons().container()
            .appendTo($('.col-sm-6:eq(0)', table.table().container()));

    } else if (location.pathname == '/employees') {

        $('.page-header').html('Employees');

        $('thead tr').append($('<th />', { text: 'Name' }));
        $('thead tr').append($('<th />', { text: 'Address' }));
        $('thead tr').append($('<th />', { text: 'Phone' }));
        $('thead tr').append($('<th />', { text: 'Gender' }));
        $('thead tr').append($('<th />', { text: 'Date of joining' }));

        $('#table').on('click', 'tr', function() {
            try {
                row_id = table.row(this).data().id;
                editor.s.ajax.edit.url = '/api/employees';
                editor.s.ajax.remove.url = '/api/employees';
            } catch (e) {

            }
        });

        var table = $('#table').DataTable({
            "autoWidth": true,
            'responsive': true,
            "ajax": {
                "url": "/api/employees",
                "type": "GET",
            },
            "columns": [
                { "data": "name" },
                { "data": "address" },
                { "data": "phone" },
                { "data": "gender" },
                { "data": "doj" }
            ],
            'bPaginate': false,
            'select': true,
            "bInfo": false,
            "bLengthChange": false
        });

        editor = new $.fn.dataTable.Editor({

            ajax: {
                create: {
                    type: 'POST',
                    url: '/api/employees',
                    data: function(d) {
                        d.table = true,
                            d.name = $("#DTE_Field_name").val();
                        d.address = $("#DTE_Field_address").val();
                        d.phone = $("#DTE_Field_phone").val();
                        d.gender = $("input[name='gender']:checked").val();
                        d.doj = $("#DTE_Field_doj").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        table.ajax.reload();
                        $.notify('New employee added.', 'success');
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                edit: {
                    type: 'PATCH',
                    url: '/api/employees',
                    data: function(d) {
                        d.id = row_id;
                        d.name = $("#DTE_Field_name").val();
                        d.address = $("#DTE_Field_address").val();
                        d.phone = $("#DTE_Field_phone").val();
                        d.gender = $("input[name='gender']:checked").val();
                        d.doj = $("#DTE_Field_doj").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Employee updated.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                remove: {
                    type: 'DELETE',
                    url: '/api/employees',
                    data: function(d) {
                        d.id = row_id;
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Employee has been trashed.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                }
            },
            table: "#table",
            'idSrc': 'id',
            fields: [{
                label: "Name:",
                name: "name"
            }, {
                label: "Address:",
                name: "address",
                type: "textarea",
            }, {
                label: "Phone:",
                name: "phone",
                attr: {
                    "type": "number"
                }
            }, {
                label: "Gender:",
                name: "gender",
                type: "radio",
                "ipOpts": [
                    { "label": "Male", "value": "Male" },
                    { "label": "Female", "value": "Female" }
                ]
            }, {
                label: "Date of joining:",
                name: "doj",
                type: "date",
                attr: {
                    "placeholder": "DD-MM-YYYY"
                },
                def: function() { return new Date(); },
                dateFormat: "DD-MM-YYYY"
            }],
            i18n: {
                create: {
                    title: "Add Employee"
                },
                edit: {
                    title: "Edit Employee"
                },
                remove: {
                    title: "Trash Employee"
                }
            }
        });

        new $.fn.dataTable.Buttons(table, [
            { extend: "create", className: 'btn btn-success btn-outline Btn', editor: editor },
            { extend: "edit", className: 'btn btn-primary btn-outline Btn', editor: editor },
            {
                extend: "remove",
                className: 'btn btn-danger btn-outline Btn',
                editor: editor,
                formMessage: function(e, dt) {
                    return 'Are you sure you want to trash the employee?';
                }
            }
        ]);

        table.buttons().container()
            .appendTo($('.col-sm-6:eq(0)', table.table().container()));

    } else if (location.pathname == '/users') {

        $('.page-header').html('Users');
        $('thead tr').append($('<th />', { text: 'Employee' }));
        $('thead tr').append($('<th />', { text: 'Email' }));
        $('thead tr').append($('<th />', { text: 'Admin' }));

        $('#table').on('click', 'tr', function() {
            try {
                row_id = table.row(this).data().id;
                editor.s.ajax.edit.url = '/api/users';
                editor.s.ajax.remove.url = '/api/users';
            } catch (e) {

            }
        });

        var table = $('#table').DataTable({
            "autoWidth": true,
            'responsive': true,
            "ajax": {
                "url": "/api/users",
                "type": "GET",
            },
            "columns": [
                { "data": "employee.name" },
                { "data": "email" },
                { "data": "admin" }
            ],
            'bPaginate': false,
            'select': true,
            "bInfo": false,
            "bLengthChange": false
        });

        editor = new $.fn.dataTable.Editor({

            ajax: {
                create: {
                    type: 'POST',
                    url: '/api/users',
                    data: function(d) {
                        d.table = true,
                            d.emp_id = $("#DTE_Field_emp_id").val();
                        d.email = $("#DTE_Field_email").val();
                        d.admin = $("input[name='admin']:checked").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        table.ajax.reload();
                        $.notify('New user added.', 'success');
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                edit: {
                    type: 'PATCH',
                    url: '/api/users',
                    data: function(d) {
                        d.id = row_id;
                        d.emp_id = $("#DTE_Field_emp_id").val();
                        d.email = $("#DTE_Field_email").val();
                        d.admin = $("input[name='admin']:checked").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('User updated.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                remove: {
                    type: 'DELETE',
                    url: '/api/users',
                    data: function(d) {
                        d.id = row_id;
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('User has been trashed.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                }
            },
            table: "#table",
            'idSrc': 'id',
            fields: [{
                label: "Employee:",
                name: "emp_id",
                type: "select"
            }, {
                label: "Email:",
                name: "email"
            }, {
                label: "Admin:",
                name: "admin",
                type: "radio",
                "ipOpts": [
                    { "label": "Yes", "value": 1 },
                    { "label": "No", "value": 0 }
                ]
            }],
            i18n: {
                create: {
                    title: "Add User"
                },
                edit: {
                    title: "Edit User"
                },
                remove: {
                    title: "Trash User"
                }
            }
        });

        $.ajax({
            url: '/api/employees',
            type: 'GET',
            data: {},
            success: function(response) {

                var employee_info = [];
                response = $.parseJSON(response);
                var data = response['data'];
                for (var i = 0; i < data.length; i++) {
                    employee_info.push({ label: data[i]['id'] + ' - ' + data[i]['name'], value: data[i]['id'] });
                }
                editor.field('emp_id').update(employee_info);

            },
            error: function() {
                $.notify('There was an error fetching employee data.');
            }
        });

        new $.fn.dataTable.Buttons(table, [
            { extend: "create", className: 'btn btn-success btn-outline Btn', editor: editor },
            { extend: "edit", className: 'btn btn-primary btn-outline Btn', editor: editor },
            {
                extend: "remove",
                className: 'btn btn-danger btn-outline Btn',
                editor: editor,
                formMessage: function(e, dt) {
                    return 'Are you sure you want to trash the user?';
                }
            }
        ]);

        table.buttons().container()
            .appendTo($('.col-sm-6:eq(0)', table.table().container()));

    } else if (location.pathname == '/merchants') {

        $('.page-header').html('Merchants');

        $('thead tr').append($('<th />', { text: 'Name' }));
        $('thead tr').append($('<th />', { text: 'Address' }));
        $('thead tr').append($('<th />', { text: 'Description' }));
        $('thead tr').append($('<th />', { text: 'Phone' }));

        $('#table').on('click', 'tr', function() {
            try {
                row_id = table.row(this).data().id;
                editor.s.ajax.edit.url = '/api/merchants';
                editor.s.ajax.remove.url = '/api/merchants';
            } catch (e) {

            }
        });

        var table = $('#table').DataTable({
            "autoWidth": true,
            'responsive': true,
            "ajax": {
                "url": "/api/merchants",
                "type": "GET",
            },
            "columns": [
                { "data": "name" },
                { "data": "address" },
                { "data": "description" },
                { "data": "phone" }
            ],
            'bPaginate': false,
            'select': true,
            "bInfo": false,
            "bLengthChange": false
        });

        editor = new $.fn.dataTable.Editor({

            ajax: {
                create: {
                    type: 'POST',
                    url: '/api/merchants',
                    data: function(d) {
                        d.name = $("#DTE_Field_name").val();
                        d.address = $("#DTE_Field_address").val();
                        d.description = $("#DTE_Field_description").val();
                        d.phone = $("#DTE_Field_phone").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        table.ajax.reload();
                        $.notify('New merchant added.', 'success');
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                edit: {
                    type: 'PATCH',
                    url: '/api/merchants',
                    data: function(d) {
                        d.id = row_id;
                        d.name = $("#DTE_Field_name").val();
                        d.address = $("#DTE_Field_address").val();
                        d.description = $("#DTE_Field_description").val();
                        d.phone = $("#DTE_Field_phone").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Merchant updated.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                remove: {
                    type: 'DELETE',
                    url: '/api/merchants',
                    data: function(d) {
                        d.id = row_id;
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Merchant has been trashed.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                }
            },
            table: "#table",
            'idSrc': 'id',
            fields: [{
                label: "Name:",
                name: "name"
            }, {
                label: "Address:",
                name: "address",
                type: "textarea"
            }, {
                label: "Description:",
                name: "description"
            }, {
                label: "Phone:",
                name: "phone",
                attr: {
                    "type": "number"
                }
            }],
            i18n: {
                create: {
                    title: "Add Merchant"
                },
                edit: {
                    title: "Edit Merchant"
                },
                remove: {
                    title: "Trash Merchant"
                }
            }
        });

        new $.fn.dataTable.Buttons(table, [
            { extend: "create", className: 'btn btn-success btn-outline Btn', editor: editor },
            { extend: "edit", className: 'btn btn-primary btn-outline Btn', editor: editor },
            {
                extend: "remove",
                className: 'btn btn-danger btn-outline Btn',
                editor: editor,
                formMessage: function(e, dt) {
                    return 'Are you sure you want to trash the merchant?';
                }
            }
        ]);

        table.buttons().container()
            .appendTo($('.col-sm-6:eq(0)', table.table().container()));

    } else if (location.pathname == '/products') {

        $('.page-header').html('Products');

        $('thead tr').append($('<th />', { text: 'Name' }));
        $('thead tr').append($('<th />', { text: 'Subtype' }));

        $('#table').on('click', 'tr', function() {
            try {
                row_id = table.row(this).data().id;
                editor.s.ajax.edit.url = '/api/products';
                editor.s.ajax.remove.url = '/api/products';
            } catch (e) {

            }
        });

        var table = $('#table').DataTable({
            "autoWidth": true,
            'responsive': true,
            "ajax": {
                "url": "/api/products",
                "type": "GET",
            },
            "columns": [
                { "data": "name" },
                { "data": "subtype" }
            ],
            'bPaginate': false,
            'select': true,
            "bInfo": false,
            "bLengthChange": false
        });

        editor = new $.fn.dataTable.Editor({

            ajax: {
                create: {
                    type: 'POST',
                    url: '/api/products',
                    data: function(d) {
                        d.name = $("#DTE_Field_name").val();
                        d.subtype = $("#DTE_Field_subtype").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        table.ajax.reload();
                        $.notify('New product added.', 'success');
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                edit: {
                    type: 'PATCH',
                    url: '/api/products',
                    data: function(d) {
                        d.id = row_id;
                        d.name = $("#DTE_Field_name").val();
                        d.subtype = $("#DTE_Field_subtype").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Product updated.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                remove: {
                    type: 'DELETE',
                    url: '/api/products',
                    data: function(d) {
                        d.id = row_id;
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Product has been trashed.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                }
            },
            table: "#table",
            'idSrc': 'id',
            fields: [{
                label: "Name:",
                name: "name",
                type: "select",
                options: { 'Sheet Metal': 'Sheet Metal' },
            }, {
                label: "SubType:",
                name: "subtype",
            }],
            i18n: {
                create: {
                    title: "Add Product"
                },
                edit: {
                    title: "Edit Product"
                },
                remove: {
                    title: "Trash Product"
                }
            }
        });

        new $.fn.dataTable.Buttons(table, [
            { extend: "create", className: 'btn btn-success btn-outline Btn', editor: editor },
            { extend: "edit", className: 'btn btn-primary btn-outline Btn', editor: editor },
            {
                extend: "remove",
                className: 'btn btn-danger btn-outline Btn',
                editor: editor,
                formMessage: function(e, dt) {
                    return 'Are you sure you want to trash the product?';
                }
            }
        ]);

        table.buttons().container()
            .appendTo($('.col-sm-6:eq(0)', table.table().container()));

    } else if (location.pathname == '/machineType') {

        $('.page-header').html('Machine Type');

        $('thead tr').append($('<th />', { text: 'Name' }));
        $('thead tr').append($('<th />', { text: 'Consumption Rate %' }));

        $('#table').on('click', 'tr', function() {
            try {
                row_id = table.row(this).data().id;
                editor.s.ajax.edit.url = '/api/machineType';
                editor.s.ajax.remove.url = '/api/machineType';
            } catch (e) {

            }
        });

        var table = $('#table').DataTable({
            "autoWidth": true,
            'responsive': true,
            "ajax": {
                "url": "/api/machineType",
                "type": "GET",
            },
            "columns": [
                { "data": "name" },
                { "data": "consumptionRate" },
            ],
            'bPaginate': false,
            'select': true,
            "bInfo": false,
            "bLengthChange": false
        });

        editor = new $.fn.dataTable.Editor({

            ajax: {
                create: {
                    type: 'POST',
                    url: '/api/machineType',
                    data: function(d) {
                        d.name = $("#DTE_Field_name").val();
                        d.consumptionRate = $("#DTE_Field_consumptionRate").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        table.ajax.reload();
                        $.notify('New machine type added.', 'success');
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                edit: {
                    type: 'PATCH',
                    url: '/api/machineType',
                    data: function(d) {
                        d.id = row_id;
                        d.name = $("#DTE_Field_name").val();
                        d.consumptionRate = $("#DTE_Field_consumptionRate").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Machine type updated.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                remove: {
                    type: 'DELETE',
                    url: '/api/machineType',
                    data: function(d) {
                        d.id = row_id;
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Machine type has been trashed.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                }
            },
            table: "#table",
            'idSrc': 'id',
            fields: [{
                    label: "Name:",
                    name: "name",
                }, {
                    label: "Consumption Rate %:",
                    name: "consumptionRate",
                    attr: {
                        "type": "number"
                    },
                },

            ],
            i18n: {
                create: {
                    title: "Add Machine Type"
                },
                edit: {
                    title: "Edit Machine Type"
                },
                remove: {
                    title: "Trash Machine Type"
                }
            }
        });

        new $.fn.dataTable.Buttons(table, [

            {
                extend: "remove",
                className: 'btn btn-danger btn-outline Btn',
                editor: editor,
                formMessage: function(e, dt) {
                    return 'Are you sure you want to trash the machine type?';
                }
            }
        ]);

        table.buttons().container()
            .appendTo($('.col-sm-6:eq(0)', table.table().container()));

    } else if (location.pathname == '/machineConsumable') {

        $('.page-header').html('Machine Consumable');
        $('thead tr').append($('<th />', { text: 'Machine Type' }));
        $('thead tr').append($('<th />', { text: 'Name' }));
        $('thead tr').append($('<th />', { text: 'Serial Number' }));
        $('thead tr').append($('<th />', { text: 'Description' }));
        $('thead tr').append($('<th />', { text: 'Price' }));
        $('thead tr').append($('<th />', { text: 'Quantity' }));



        $('#table').on('click', 'tr', function() {
            try {
                row_id = table.row(this).data().id;
                editor.s.ajax.edit.url = '/api/machineConsumable';
                editor.s.ajax.remove.url = '/api/machineConsumable';
            } catch (e) {

            }
        });

        var table = $('#table').DataTable({
            "autoWidth": true,
            'responsive': true,
            "ajax": {
                "url": "/api/machineConsumable",
                "type": "GET",
            },
            "columns": [
                { "data": "machineType.name" },
                { "data": "name" },
                { "data": "serialNumber" },
                { "data": "description" },
                { "data": "price", render: $.fn.dataTable.render.number(',', '.', 0, '$') },
                { "data": "quantity" },
            ],
            'bPaginate': false,
            'select': true,
            "bInfo": false,
            "bLengthChange": false
        });

        editor = new $.fn.dataTable.Editor({

            ajax: {
                create: {
                    type: 'POST',
                    url: '/api/machineConsumable',
                    data: function(d) {
                        d.machineType_id = $("#DTE_Field_machineType_id").val();
                        d.name = $("#DTE_Field_name").val();
                        d.serialNumber = $("#DTE_Field_serialNumber").val();
                        d.description = $("#DTE_Field_description").val();
                        d.price = $("#DTE_Field_price").val();
                        d.quantity = $("#DTE_Field_quantity").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        table.ajax.reload();
                        $.notify('New machine consumable added.', 'success');
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                edit: {
                    type: 'PATCH',
                    url: '/api/machineConsumable',
                    data: function(d) {
                        d.id = row_id;
                        d.machineType_id = $("#DTE_Field_machineType_id").val();
                        d.name = $("#DTE_Field_name").val();
                        d.serialNumber = $("#DTE_Field_serialNumber").val();
                        d.description = $("#DTE_Field_description").val();
                        d.price = $("#DTE_Field_price").val();
                        d.quantity = $("#DTE_Field_quantity").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Machine consumable updated.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                remove: {
                    type: 'DELETE',
                    url: '/api/machineConsumable',
                    data: function(d) {
                        d.id = row_id;
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Machine consumable has been trashed.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                }
            },
            table: "#table",
            'idSrc': 'id',
            fields: [{
                label: "Machine Type:",
                name: "machineType_id",
                type: "select"
            }, {
                label: "Name:",
                name: "name",
            }, {
                label: "Serial Number:",
                name: "serialNumber",
                attr: {
                    "type": "number"
                },
            }, {
                label: "Description:",
                name: "description",
            }, {
                label: "Price /$:",
                name: "price",
                attr: {
                    "type": "number"
                },
            }, {
                label: "Quantity:",
                name: "quantity",
                attr: {
                    "type": "number"
                },
            }],
            i18n: {
                create: {
                    title: "Add Machine Consumable"
                },
                edit: {
                    title: "Edit Machine Consumable"
                },
                remove: {
                    title: "Trash Machine Consumable"
                }
            }
        });
        $.ajax({
            url: '/api/machineType',
            type: 'GET',
            data: {},
            success: function(response) {
                var machineConsumable_machineType = [];
                response = $.parseJSON(response);
                var data = response['data'];
                for (var i = 0; i < data.length; i++) {
                    machineConsumable_machineType.push({ label: data[i]['name'], value: data[i]['id'] });
                }
                editor.field('machineType_id').update(machineConsumable_machineType);
            },
            error: function() {
                $.notify('There was an error fetching Machine Type data.');
            }
        });
        new $.fn.dataTable.Buttons(table, [
            { extend: "create", className: 'btn btn-success btn-outline Btn', editor: editor },
            { extend: "edit", className: 'btn btn-primary btn-outline Btn', editor: editor },
            {
                extend: "remove",
                className: 'btn btn-danger btn-outline Btn',
                editor: editor,
                formMessage: function(e, dt) {
                    return 'Are you sure you want to trash the machine consumable?';
                }
            }
        ]);

        table.buttons().container()
            .appendTo($('.col-sm-6:eq(0)', table.table().container()));

    } else if (location.pathname == '/stocks') {

        $('.page-header').html('Stock');

        $('thead tr').append($('<th />', { text: 'Product' }));
        $('thead tr').append($('<th />', { text: 'Merchant' }));
        $('thead tr').append($('<th />', { text: 'Weight' }));
        $('thead tr').append($('<th />', { text: 'Width' }));
        $('thead tr').append($('<th />', { text: 'Height' }));
        $('thead tr').append($('<th />', { text: 'Thickness' }));
        $('thead tr').append($('<th />', { text: 'Price' }));
        $('thead tr').append($('<th />', { text: 'Quantity' }));
        $('thead tr').append($('<th />', { text: 'Date of purchase' }));

        $('#table').on('click', 'tr', function() {
            try {
                row_id = table.row(this).data().id;
                editor.s.ajax.edit.url = '/api/stocks';
                editor.s.ajax.remove.url = '/api/stocks';
            } catch (e) {

            }
        });
        var table = $('#table').DataTable({
            "autoWidth": true,
            'responsive': true,
            "ajax": {
                "url": "/api/stocks",
                "type": "GET",
            },
            "columns": [{
                    data: null,
                    render: function(data, type, row) {
                        if (data.product.subtype == "") {
                            return data.product.name;
                        }
                        return data.product.name + ', ' + data.product.subtype;
                    },
                    editField: ['product.name', 'product.subtype']
                },
                { "data": "merchant.name" },
                { "data": "weight" },
                { "data": "width" },
                { "data": "height" },
                { "data": "thickness" },
                { "data": "price", render: $.fn.dataTable.render.number(',', '.', 0, '$') },
                { "data": "quantity" },
                { "data": "dop" }
            ],
            'bPaginate': false,
            'select': true,
            "bInfo": false,
            "bLengthChange": false,
        });

        editor = new $.fn.dataTable.Editor({

            ajax: {
                create: {
                    type: 'POST',
                    url: '/api/stocks',
                    data: function(d) {
                        d.product_id = $("#DTE_Field_product_id").val();
                        d.merchant_id = $("#DTE_Field_merchant_id").val();
                        d.weight = $("#DTE_Field_weight").val();
                        d.price = $("#DTE_Field_price").val();
                        d.quantity = $("#DTE_Field_quantity").val();
                        d.width = $("#DTE_Field_width").val();
                        d.height = $("#DTE_Field_height").val();
                        d.thickness = $("#DTE_Field_thickness").val();
                        d.dop = $("#DTE_Field_dop").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('New Stock added.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                edit: {
                    type: 'PATCH',
                    url: '/api/stocks',
                    data: function(d) {
                        d.id = row_id;
                        d.product_id = $("#DTE_Field_product_id").val();
                        d.merchant_id = $("#DTE_Field_merchant_id").val();
                        d.weight = $("#DTE_Field_weight").val();
                        d.price = $("#DTE_Field_price").val();
                        d.quantity = $("#DTE_Field_quantity").val();
                        d.width = $("#DTE_Field_width").val();
                        d.height = $("#DTE_Field_height").val();
                        d.thickness = $("#DTE_Field_thickness").val();
                        d.dop = $("#DTE_Field_dop").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Stock updated.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                remove: {
                    type: 'DELETE',
                    url: '/api/stocks',
                    data: function(d) {
                        d.id = row_id;
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Stock has been trashed.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                }
            },
            table: "#table",
            'idSrc': 'id',
            fields: [{
                label: "Product:",
                name: "product_id",
                type: "select"
            }, {
                label: "Merchant:",
                name: "merchant_id",
                type: "select"
            }, {
                label: "Weight:",
                name: "weight",
                attr: {
                    "type": "number"
                }
            }, {
                label: "Price /$:",
                name: "price",
                attr: {
                    "type": "number"
                }
            }, {
                label: "Quantity:",
                name: "quantity",
                attr: {
                    "type": "number"
                }
            }, {
                label: "Width:",
                name: "width",
                attr: {
                    "type": "number"
                }
            }, {
                label: "Height:",
                name: "height",
                attr: {
                    "type": "number"
                }
            }, {
                label: "Thickness:",
                name: "thickness",
                attr: {
                    "type": "number"
                }
            }, {
                label: "Date of Purchase:",
                name: "dop",
                type: "date",
                attr: {
                    "placeholder": "DD-MM-YYYY"
                },
                def: function() { return new Date(); },
                dateFormat: "DD-MM-YYYY",
            }],
            i18n: {
                create: {
                    title: "Add Stock"
                },
                edit: {
                    title: "Edit Stock"
                },
                remove: {
                    title: "Trash Stock"
                }
            }
        });

        $.ajax({
            url: '/api/stockInfo',
            type: 'GET',
            data: {},
            success: function(response) {
                response = $.parseJSON(response);
                var stock_product = [];
                var stock_merchant = [];
                var products = response['data']['products'];
                var merchants = response['data']['merchants'];

                for (var i = 0; i < products.length; i++) {
                    stock_product.push({ label: products[i]['name'] + ' - ' + products[i]['subtype'], value: products[i]['id'] });
                }

                for (var i = 0; i < merchants.length; i++) {
                    stock_merchant.push({ label: merchants[i]['id'] + ' - ' + merchants[i]['name'], value: merchants[i]['id'] });
                }

                editor.field('product_id').update(stock_product);
                editor.field('merchant_id').update(stock_merchant);

            },
            error: function() {
                $.notify('There was an error fetching product & merchant data.');
            }
        });

        new $.fn.dataTable.Buttons(table, [
            { extend: "create", className: 'btn btn-success btn-outline Btn', editor: editor },
            { extend: "edit", className: 'btn btn-primary btn-outline Btn', editor: editor },
            {
                extend: "remove",
                className: 'btn btn-danger btn-outline Btn',
                editor: editor,
                formMessage: function(e, dt) {
                    return 'Are you sure you want to trash the stock?';
                }
            }
        ]);

        table.buttons().container()
            .appendTo($('.col-sm-6:eq(0)', table.table().container()));

    } else if (location.pathname == '/items_sold') {

        $('.page-header').html('Plasma Operations');
        $('thead tr').append($('<th />', { text: 'Name' }));
        $('thead tr').append($('<th />', { text: 'Electrode' }));
        $('thead tr').append($('<th />', { text: 'Nozzle' }));
        $('thead tr').append($('<th />', { text: 'Shield' }));
        //$('thead tr').append($('<th />', { text: 'Machine Type' }));
        $('thead tr').append($('<th />', { text: 'Stock' }));
        $('thead tr').append($('<th />', { text: 'Stock Quantity' }));
        $('thead tr').append($('<th />', { text: 'Customer' }));
        $('thead tr').append($('<th />', { text: 'Employee' }));
        $('thead tr').append($('<th />', { text: 'Cost' }));
        $('thead tr').append($('<th />', { text: 'Price' }));
        $('thead tr').append($('<th />', { text: 'Date of selling' }));

        $('#table').on('click', 'tr', function() {
            try {
                row_id = table.row(this).data().id;
                editor.s.ajax.edit.url = '/api/items_sold';
                editor.s.ajax.remove.url = '/api/items_sold';
            } catch (e) {

            }
        });
        var table = $('#table').DataTable({
            "autoWidth": true,
            'responsive': true,

            "modalEditor": true,
            "ajax": {
                "url": "/api/items_sold",
                "type": "GET",
            },
            "columns": [
                { "data": "name" },
                { "data": "electrode" },
                { "data": "nozzle" },
                { "data": "shield" },
                // { "data": "machineType.name" },
                {
                    data: null,
                    render: function(data, type, row) {
                        return data.stock.productName + ',' + data.stock.productSubtype + ',' + data.stock.width + '*' + data.stock.height + '*' + data.stock.thickness;
                    },
                    editField: ['stock.productName', 'stock.productSubtype', 'stock.width', 'stock.height', 'stock.thickness']
                },
                { "data": "stockQuantity" },
                {
                    data: null,
                    render: function(data, type, row) {
                        return data.customer.name + ', ' + data.customer.phone;
                    },
                    editField: ['customer.name', 'customer.phone']
                },
                { "data": "employee.name" },
                { "data": "cost", render: $.fn.dataTable.render.number(',', '.', 0, '$') },
                { "data": "price", render: $.fn.dataTable.render.number(',', '.', 0, '$') },
                { "data": "dos" },
            ],
            'bPaginate': false,
            'select': true,
            "bInfo": false,
            "bLengthChange": false,
        });

        editor = new $.fn.dataTable.Editor({

            ajax: {
                create: {
                    type: 'POST',
                    url: '/api/items_sold',
                    data: function(d) {
                        d.name = $("#DTE_Field_name").val();
                        d.electrode = $("#DTE_Field_electrode").val();
                        d.nozzle = $("#DTE_Field_nozzle").val();
                        d.shield = $("#DTE_Field_shield").val();
                        //$("#DTE_Field_machineType_id").val();
                        d.stock_id = $("#DTE_Field_stock_id").val();
                        d.stockQuantity = $("#DTE_Field_stockQuantity").val();
                        d.customer_id = $("#DTE_Field_customer_id").val();
                        d.employee_id = $("#DTE_Field_employee_id").val();
                        d.fuelPrice = $("#DTE_Field_fuelPrice").val();
                        d.price = $("#DTE_Field_price").val();
                        d.dos = $("#DTE_Field_dos").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('New Stock added.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                edit: {
                    type: 'PATCH',
                    url: '/api/items_sold',
                    data: function(d) {
                        d.id = row_id;
                        d.name = $("#DTE_Field_name").val();
                        d.electrode = $("#DTE_Field_electrode").val();
                        d.nozzle = $("#DTE_Field_nozzle").val();
                        d.shield = $("#DTE_Field_shield").val();
                        //$("#DTE_Field_machineType_id").val();
                        d.stock_id = $("#DTE_Field_stock_id").val();
                        d.stockQuantity = $("#DTE_Field_stockQuantity").val();
                        d.customer_id = $("#DTE_Field_customer_id").val();
                        d.employee_id = $("#DTE_Field_employee_id").val();
                        d.fuelPrice = $("#DTE_Field_fuelPrice").val();
                        d.price = $("#DTE_Field_price").val();
                        d.dos = $("#DTE_Field_dos").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Operation updated.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                remove: {
                    type: 'DELETE',
                    url: '/api/items_sold',
                    data: function(d) {
                        d.id = row_id;
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Operation has been trashed.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },

            },
            table: "#table",
            'idSrc': 'id',
            fields: [{
                    label: "Name:",
                    name: "name",
                }, {
                    label: "Electrode:",
                    name: "electrode",
                    attr: {
                        "type": "number"
                    }
                }, {
                    label: "Nozzle:",
                    name: "nozzle",
                    attr: {
                        "type": "number"
                    }
                }, {
                    label: "Shield:",
                    name: "shield",
                    attr: {
                        "type": "number"
                    }
                },
                /* {
                    label: "Machine Type:",
                    name: "machineType_id",
                    type: "select"
                }, */
                {
                    label: "Stock:",
                    name: "stock_id",
                    type: "select"
                }, {
                    label: "Stock Quantity:",
                    name: "stockQuantity",
                    attr: {
                        "type": "number"
                    }
                }, {
                    label: "Customer:",
                    name: "customer_id",
                    type: "select"
                }, {
                    label: "Employee:",
                    name: "employee_id",
                    type: "select"
                }, {
                    label: "Price /$:",
                    name: "price",
                    attr: {
                        "type": "number"
                    }
                }, {
                    label: "Fuel Cost /$:",
                    name: "fuelPrice",
                    attr: {
                        "type": "number"
                    }
                },
                {
                    label: "Date of Sale:",
                    name: "dos",
                    type: "date",
                    attr: {
                        "placeholder": "DD-MM-YYYY"
                    },
                    def: function() { return new Date(); },
                    dateFormat: "DD-MM-YYYY",
                },
            ],
            i18n: {
                create: {
                    title: "Add Operation"
                },
                edit: {
                    title: "Edit Operation"
                },
                remove: {
                    title: "Trash Operation"
                }
            }
        });

        $.ajax({
            url: '/api/items_sold_info',
            type: 'GET',
            data: {},
            success: function(response) {
                response = $.parseJSON(response);
                var solditem_stock = [];
                var solditem_customer = [];
                var solditem_employee = [];
                // var solditem_machineType = [];
                var stocks = response['data']['stocks'];
                var customers = response['data']['customers'];
                var employees = response['data']['employees'];
                //  var machineTypes = response['data']['machineTypes'];
                for (var i = 0; i < stocks.length; i++) {
                    if (stocks[i]['productSubtype'] == "") {
                        solditem_stock.push({ label: stocks[i]['productName'] + ',' + stocks[i]['width'] + '*' + stocks[i]['height'] + '*' + stocks[i]['thickness'], value: stocks[i]['id'] });
                    } else {
                        solditem_stock.push({ label: stocks[i]['productName'] + ',' + stocks[i]['productSubtype'] + ',' + stocks[i]['width'] + '*' + stocks[i]['height'] + '*' + stocks[i]['thickness'], value: stocks[i]['id'] });
                    }
                }
                for (var i = 0; i < customers.length; i++) {
                    solditem_customer.push({ label: customers[i]['name'] + ' , ' + customers[i]['phone'], value: customers[i]['id'] });
                }
                for (var i = 0; i < employees.length; i++) {
                    solditem_employee.push({ label: employees[i]['name'], value: employees[i]['id'] });
                }
                // for (var i = 0; i < machineTypes.length; i++) {
                //     solditem_machineType.push({ label: machineTypes[i]['name'], value: machineTypes[i]['id'] });
                //}

                editor.field('stock_id').update(solditem_stock);
                editor.field('customer_id').update(solditem_customer);
                editor.field('employee_id').update(solditem_employee);
                // editor.field('machineType_id').update(solditem_machineType);

            },
            error: function() {
                $.notify('There was an error fetching additional data.');
            }
        });

        new $.fn.dataTable.Buttons(table, [
            { extend: "create", className: 'btn btn-success btn-outline Btn', editor: editor },
            { extend: "edit", className: 'btn btn-primary btn-outline Btn', editor: editor },
            {
                extend: "remove",
                className: 'btn btn-danger btn-outline Btn',
                editor: editor,
                formMessage: function(e, dt) {
                    return 'Are you sure you want to trash the operation?';
                }
            },
        ]);

        table.buttons().container()
            .appendTo($('.col-sm-6:eq(0)', table.table().container()));

    } else if (location.pathname == '/items_soldd') {

        $('.page-header').html('Router Operations');
        $('thead tr').append($('<th />', { text: 'Name' }));
        $('thead tr').append($('<th />', { text: 'Tool' }));
        $('thead tr').append($('<th />', { text: 'Collet' }));
        $('thead tr').append($('<th />', { text: 'Tool Holder' }));
        //$('thead tr').append($('<th />', { text: 'Machine Type' }));
        $('thead tr').append($('<th />', { text: 'Stock' }));
        $('thead tr').append($('<th />', { text: 'Stock Quantity' }));
        $('thead tr').append($('<th />', { text: 'Customer' }));
        $('thead tr').append($('<th />', { text: 'Employee' }));
        $('thead tr').append($('<th />', { text: 'Cost' }));
        $('thead tr').append($('<th />', { text: 'Price' }));
        $('thead tr').append($('<th />', { text: 'Date of selling' }));

        $('#table').on('click', 'tr', function() {
            try {
                row_id = table.row(this).data().id;
                editor.s.ajax.edit.url = '/api/items_soldd';
                editor.s.ajax.remove.url = '/api/items_soldd';
            } catch (e) {

            }
        });
        var table = $('#table').DataTable({
            "autoWidth": true,
            'responsive': true,

            "modalEditor": true,
            "ajax": {
                "url": "/api/items_soldd",
                "type": "GET",
            },
            "columns": [
                { "data": "name" },
                { "data": "tool" },
                { "data": "collet" },
                { "data": "toolholder" },
                // { "data": "machineType.name" },
                {
                    data: null,
                    render: function(data, type, row) {
                        return data.stock.productName + ',' + data.stock.productSubtype + ',' + data.stock.width + '*' + data.stock.height + '*' + data.stock.thickness;
                    },
                    editField: ['stock.productName', 'stock.productSubtype', 'stock.width', 'stock.height', 'stock.thickness']
                },
                { "data": "stockQuantity" },
                {
                    data: null,
                    render: function(data, type, row) {
                        return data.customer.name + ', ' + data.customer.phone;
                    },
                    editField: ['customer.name', 'customer.phone']
                },
                { "data": "employee.name" },
                { "data": "cost", render: $.fn.dataTable.render.number(',', '.', 0, '$') },
                { "data": "price", render: $.fn.dataTable.render.number(',', '.', 0, '$') },
                { "data": "dos" },
            ],
            'bPaginate': false,
            'select': true,
            "bInfo": false,
            "bLengthChange": false,
        });

        editor = new $.fn.dataTable.Editor({

            ajax: {
                create: {
                    type: 'POST',
                    url: '/api/items_soldd',
                    data: function(d) {
                        d.name = $("#DTE_Field_name").val();
                        d.tool = $("#DTE_Field_tool").val();
                        d.collet = $("#DTE_Field_collet").val();
                        d.toolholder = $("#DTE_Field_toolholder").val();
                        //$("#DTE_Field_machineType_id").val();
                        d.stock_id = $("#DTE_Field_stock_id").val();
                        d.stockQuantity = $("#DTE_Field_stockQuantity").val();
                        d.customer_id = $("#DTE_Field_customer_id").val();
                        d.employee_id = $("#DTE_Field_employee_id").val();
                        d.fuelPrice = $('#DTE_Field_fuelPrice').val();
                        d.price = $("#DTE_Field_price").val();
                        d.dos = $("#DTE_Field_dos").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('New Stock added.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                edit: {
                    type: 'PATCH',
                    url: '/api/items_soldd',
                    data: function(d) {
                        d.id = row_id;
                        d.name = $("#DTE_Field_name").val();
                        d.tool = $("#DTE_Field_tool").val();
                        d.collet = $("#DTE_Field_collet").val();
                        d.toolholder = $("#DTE_Field_toolholder").val();
                        //$("#DTE_Field_machineType_id").val();
                        d.stock_id = $("#DTE_Field_stock_id").val();
                        d.stockQuantity = $("#DTE_Field_stockQuantity").val();
                        d.customer_id = $("#DTE_Field_customer_id").val();
                        d.employee_id = $("#DTE_Field_employee_id").val();
                        d.fuelPrice = $('#DTE_Field_fuelPrice').val();
                        d.price = $("#DTE_Field_price").val();
                        d.dos = $("#DTE_Field_dos").val();
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Operation updated.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                },
                remove: {
                    type: 'DELETE',
                    url: '/api/items_soldd',
                    data: function(d) {
                        d.id = row_id;
                        delete d.data;
                        delete d.action;
                    },
                    success: function() {
                        $.notify('Operation has been trashed.', 'success');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        var json = $.parseJSON(response.responseText);
                        for (var key in json) {
                            $.notify(json[key]);
                        }
                    }
                }
            },
            table: "#table",
            'idSrc': 'id',
            fields: [{
                    label: "Name:",
                    name: "name",
                }, {
                    label: "Tool:",
                    name: "tool",
                    attr: {
                        "type": "number"
                    }
                }, {
                    label: "Collet:",
                    name: "collet",
                    attr: {
                        "type": "number"
                    }
                }, {
                    label: "Tool Holder:",
                    name: "toolholder",
                    attr: {
                        "type": "number"
                    }
                },
                /* {
                                label: "Machine Type:",
                                name: "machineType_id",
                                type: "select"
                            }, */
                {
                    label: "Stock:",
                    name: "stock_id",
                    type: "select"
                }, {
                    label: "Stock Quantity:",
                    name: "stockQuantity",
                    attr: {
                        "type": "number"
                    }
                }, {
                    label: "Customer:",
                    name: "customer_id",
                    type: "select"
                }, {
                    label: "Employee:",
                    name: "employee_id",
                    type: "select"
                }, {
                    label: "Fuel Cost /$:",
                    name: "fuelPrice",
                    attr: {
                        "type": "number"
                    }
                }, {
                    label: "Price /$:",
                    name: "price",
                    attr: {
                        "type": "number"
                    }
                },
                {
                    label: "Date of Sale:",
                    name: "dos",
                    type: "date",
                    attr: {
                        "placeholder": "DD-MM-YYYY"
                    },
                    def: function() { return new Date(); },
                    dateFormat: "DD-MM-YYYY",
                },
            ],
            i18n: {
                create: {
                    title: "Add Operation"
                },
                edit: {
                    title: "Edit Operation"
                },
                remove: {
                    title: "Trash Operation"
                }
            }
        });

        $.ajax({
            url: '/api/items_soldd_info',
            type: 'GET',
            data: {},
            success: function(response) {
                response = $.parseJSON(response);
                var soldditem_stock = [];
                var soldditem_customer = [];
                var soldditem_employee = [];
                //var soldditem_machineType = [];
                var stocks = response['data']['stocks'];
                var customers = response['data']['customers'];
                var employees = response['data']['employees'];
                //var machineTypes = response['data']['machineTypes'];
                for (var i = 0; i < stocks.length; i++) {
                    if (stocks[i]['productSubtype'] == "") {
                        soldditem_stock.push({ label: stocks[i]['productName'] + ',' + stocks[i]['width'] + '*' + stocks[i]['height'] + '*' + stocks[i]['thickness'], value: stocks[i]['id'] });
                    } else {
                        soldditem_stock.push({ label: stocks[i]['productName'] + ',' + stocks[i]['productSubtype'] + ',' + stocks[i]['width'] + '*' + stocks[i]['height'] + '*' + stocks[i]['thickness'], value: stocks[i]['id'] });
                    }
                }
                for (var i = 0; i < customers.length; i++) {
                    soldditem_customer.push({ label: customers[i]['name'] + ' , ' + customers[i]['phone'], value: customers[i]['id'] });
                }
                for (var i = 0; i < employees.length; i++) {
                    soldditem_employee.push({ label: employees[i]['name'], value: employees[i]['id'] });
                }
                // for (var i = 0; i < machineTypes.length; i++) {
                //    soldditem_machineType.push({ label: machineTypes[i]['name'], value: machineTypes[i]['id'] });
                //}

                editor.field('stock_id').update(soldditem_stock);
                editor.field('customer_id').update(soldditem_customer);
                editor.field('employee_id').update(soldditem_employee);
                //editor.field('machineType_id').update(soldditem_machineType);

            },
            error: function() {
                $.notify('There was an error fetching additional data.');
            }
        });

        new $.fn.dataTable.Buttons(table, [
            { extend: "create", className: 'btn btn-success btn-outline Btn', editor: editor },
            { extend: "edit", className: 'btn btn-primary btn-outline Btn', editor: editor },
            {
                extend: "remove",
                className: 'btn btn-danger btn-outline Btn',
                editor: editor,
                formMessage: function(e, dt) {
                    return 'Are you sure you want to trash the operation?';
                }
            },
        ]);

        table.buttons().container()
            .appendTo($('.col-sm-6:eq(0)', table.table().container()));

    } else if (location.pathname == '/') {
        $.ajax({
            url: '/api/tables',
            type: 'GET',
            success: function(response) {
                $("#customers").text(response['data']['customers']);
                $("#Operations").text(response['data']['operations']);
                $("#electrode").text(response['data']['consumables']);
                $("#nozzle").text(response['data']['consumabless']);
                var calendar = [];
                var calendar = response['data']['calendars'];
                var solditem = [];
                var solditem = response['data']['solditems'];
                var soldditem = [];
                var soldditem = response['data']['soldditems'];

                for (var i = 0; i < solditem.length; i++) {
                    xValue = new Date(solditem[i]['dos']);
                    yValue = Number(solditem[i]['price']);
                    yValue2 = Number(solditem[i]['cost']);
                    dps.push({
                        x: xValue,
                        y: yValue
                    });
                    dps1.push({
                        x: xValue,
                        y: yValue2
                    });
                }
                chart.render();
                for (var i = 0; i < soldditem.length; i++) {

                    xValue2 = new Date(soldditem[i]['dos']);
                    y2Value = Number(soldditem[i]['price']);
                    y2Value2 = Number(soldditem[i]['cost']);
                    dpss.push({
                        x: xValue2,
                        y: y2Value
                    });
                    dps11.push({
                        x: xValue2,
                        y: y2Value2
                    });
                }
                chartt.render();



                for (var i = 0; i < calendar.length; i++) {
                    getAllEvent(calendar[i]['dayy'], calendar[i]['monthh'], 2020, calendar[i]['eventDescription']);
                }
                if ($('#electrode').text() === "") {
                    $('#electrodeBody').css('background-color', '#337ab7');
                    $('#electrodeContainer').css('border-color', '#337ab7');
                    $('#viewElectrodeArrow').css('color', '#337ab7');
                    $('#viewElectrode').css('color', '#337ab7');
                    $('#electrodeBody').css('border-color', '#337ab7');
                }
                if ($('#electrode').text() <= 5) {
                    $('#electrodeBody').css('background-color', '#b73333');
                    $('#electrodeBody').css('border-color', '#b73333');
                    $('#electrodeContainer').css('border-color', '#b73333');
                    $('#viewElectrodeArrow').css('color', '#b73333');
                    $('#viewElectrode').css('color', '#b73333');

                } else {
                    $('#electrodeBody').css('background-color', '#337ab7');
                    $('#electrodeContainer').css('border-color', '#337ab7');
                    $('#viewElectrodeArrow').css('color', '#337ab7');
                    $('#viewElectrode').css('color', '#337ab7');
                    $('#electrodeBody').css('border-color', '#337ab7');
                }
                if ($('#nozzle').text() === null) {
                    $('#nozzleBody').css('background-color', '#337ab7');
                    $('#nozzleContainer').css('border-color', '#337ab7');
                    $('#viewNozzleArrow').css('color', '#337ab7');
                    $('#viewNozzle').css('color', '#337ab7');
                    $('#nozzleBody').css('border-color', '#337ab7');
                }
                if ($('#nozzle').text() <= 5) {
                    $('#nozzleBody').css('background-color', '#b73333');
                    $('#nozzleBody').css('border-color', '#b73333');
                    $('#nozzleContainer').css('border-color', '#b73333');
                    $('#viewNozzleArrow').css('color', '#b73333');
                    $('#viewNozzle').css('color', '#b73333');

                } else {
                    $('#nozzleBody').css('background-color', '#337ab7');
                    $('#nozzleContainer').css('border-color', '#337ab7');
                    $('#viewNozzleArrow').css('color', '#337ab7');
                    $('#viewNozzle').css('color', '#337ab7');
                    $('#nozzleBody').css('border-color', '#337ab7');
                }
            },
            error: function() {
                $.notify('There was an error fetching data.');
            }
        });
        $.ajax({
            url: '/api/customers',
            type: 'GETLATEST',
            success: function(response) {
                response = $.parseJSON(response);
                var customers = response['data'];
                $.each(customers, function(i, customer) {
                    $(".latest-customers").append("<tr><td>" + customer['id'] + "</td><td>" + customer['name'] + "</td><td>" + customer['address'] + "</td><td>" + customer['phone'] + "</td></tr>");
                });
            },
            error: function() {
                $.notify('There was an error fetching data.');
            }
        });
    } else if (location.pathname == '/print') {
        $.ajax({
            url: '/api/print',
            type: 'GET',
            success: function(response) {
                response = $.parseJSON(response);
                var operations = response['data'];
                var operationss = response['dataa'];
                $.each(operations, function(i, operation) {
                    $("#myDropdown").append("<a onclick='showService(" + operation['id'] + "," + operation['machineType_id'] + ")'>" + operation['name'] + ",Date:" + operation['dos'] + ",Price:$" + operation['price'] + "</a>");
                });
                $.each(operationss, function(i, operation) {
                    $("#myDropdown").append("<a onclick='showService(" + operation['id'] + "," + operation['machineType_id'] + ")'>" + operation['name'] + ",Date:" + operation['dos'] + ",Price:$" + operation['price'] + "</a>");
                });
            },
            error: function() {
                $.notify('There was an error fetching data.');
            }
        });
    } else if (location.pathname == '/profile') {
        var userDetails;
        var uid = $("input[name=employee]").val();
        $.ajax({
            url: '/api/users',
            type: 'POST',
            async: false,
            data: {
                employee_id: uid
            },
            success: function(response) {
                userDetails = response;
            },
            error: function() {
                $.notify('There was an error fetching user data.');
            }
        });

        $.ajax({
            url: '/api/employees',
            type: 'POST',
            data: {
                employee_id: uid
            },
            success: function(response) {
                $('input[name=name]').val(response['data']['name']);
                $('input[name=phone]').val(response['data']['phone']);
                $('textarea#address').val(response['data']['address']);
                $('input[name=doj]').val(response['data']['doj']);
                $('input[name=gender][value=' + response['data']['gender'] + ']').attr("checked", true);
            },
            error: function() {
                $.notify('There was an error fetching user data.');
            }
        });
        $("input[name=employee]").val(uid);
        $("input[name=email]").val(userDetails['data']['email']);
    }
    $(".form-signin").submit(function(e) {
        e.preventDefault();
    });
    $('#submit-login-form').click(function() {
        var address = $('.form-signin').attr('action');
        var method = $('.form-signin').attr('method');
        var mail = $("input[name= email]").val();
        var pass = $("input[name=password]").val();
        $("input[type=password]").val("");
        $.ajax({
            url: address,
            type: method,
            data: {
                email: mail,
                password: pass,
            },
            success: function() {
                location.reload();
            },
            error: function(response) {
                var json = $.parseJSON(response.responseText);
                for (var key in json) {
                    $.notify(json[key]);
                }
            }
        });
    });


    $("#update_user").submit(function(e) {
        e.preventDefault();
    });
    $('#user_submit').click(function() {
        var uid = $("input[name=employee]").val();
        var mail = $("input[name=email]").val();
        var pass = $("input[name=password]").val();
        var pass_confirm = $("input[name=password_confirmation]").val();
        $("input[type=password]").val("");
        $.ajax({
            url: '/api/users',
            type: 'PATCH',
            data: {
                profile: true,
                employee_id: uid,
                email: mail,
                password: pass,
                password_confirmation: pass_confirm
            },
            success: function() {

                $.notify("Credentials saved successfully.", "success");
            },
            error: function(response) {
                var json = $.parseJSON(response.responseText);
                for (var key in json) {
                    $.notify(json[key]);
                }
            }
        });
    });
    $("#update_employee").submit(function(e) {
        e.preventDefault();
    });
    $('#employee_submit').click(function() {
        var uid = $("input[name=employee]").val();
        var employee_name = $('input[name=name]').val();
        var employee_phone = $('input[name=phone]').val();
        var employee_address = $('textarea#address').val();
        var employee_doj = $('input[name=doj]').val();
        var employee_gender = $('input[name=gender]:checked').val();
        $.ajax({
            url: '/api/employees',
            type: 'PATCH',
            data: {
                id: uid,
                name: employee_name,
                phone: employee_phone,
                address: employee_address,
                doj: employee_doj,
                gender: employee_gender
            },
            success: function() {
                $.notify("Information saved successfully.", "success");
            },
            error: function(response) {
                var json = $.parseJSON(response.responseText);
                for (var key in json) {
                    $.notify(json[key]);
                }
            }
        });
    });
    $('.disabled').css('pointer-events', 'initial');
    $('[data-toggle="tooltip"]').tooltip();
    $('.buttons-edit').hover(function() {
        if ($(this).hasClass('disabled')) {
            $(this).attr("data-toggle", "tooltip");
            $(this).attr("title", "Select a record");
        } else {
            $(this).attr("data-toggle", "");
            $(this).attr("title", "");
        }
    });
    $('.buttons-remove').hover(function() {
        if ($(this).hasClass('disabled')) {
            $(this).attr("data-toggle", "tooltip");
            $(this).attr("title", "Select a record");
        } else {
            $(this).attr("data-toggle", "");
            $(this).attr("title", "");
        }
    });
});

function showService(idd, machineType) {
    if (machineType == 4) {
        $.ajax({
            url: '/api/print',
            type: 'PATCH',
            data: {
                id: idd,
            },
            success: function(response) {
                $('#tablerow').remove();
                response = $.parseJSON(response);
                var operation = response['data']['operation'];
                var customer = response['data']['customer'];
                var stock = response['data']['stock'];
                $(".service").append("<tr id='tablerow'><td id='operationId' style='display:none'>" + operation['id'] + "</td><td id='machineType' style='display:none'>" + operation['machineType_id'] + "</td><td>" + operation['name'] + "</td><td>CNC Router</td><td>" + operation['tool'] + "</td><td>" + operation['collet'] + "</td><td>" + operation['toolholder'] + "</td><td>" + stock['name'] + "," + stock['subtype'] + "</td><td>" + operation['stockQuantity'] + "</td><td>" + customer['name'] + "," + customer['phone'] + "</td><td>" + operation['cost'] + "</td><td id='priceOperation'>" + operation['price'] + "</td><td>" + operation['dos'] + "</td></tr>");
                container.hide();
                $('#tablePrint').show();
                $('#tablePrintttt').hide();
                $('#tablePrinttt').show();
            },
            error: function() {
                $.notify('There was an error fetching data.');
                container.hide();
            }
        });
        document.getElementById("printBtn").disabled = false;
        document.getElementById("printBtnn").disabled = false;
    } else if (machineType == 3) {
        $.ajax({
            url: '/api/printt',
            type: 'PATCH',
            data: {
                id: idd,
            },
            success: function(response) {
                $('#tablerow').remove();
                response = $.parseJSON(response);
                var operation = response['data']['operation'];
                var customer = response['data']['customer'];
                var stock = response['data']['stock'];
                $(".servicee").append("<tr id='tablerow'><td id='operationId' style='display:none'>" + operation['id'] + "</td><td id='machineType' style='display:none'>" + operation['machineType_id'] + "</td><td>" + operation['name'] + "</td><td>CNC Plasma</td><td>" + operation['electrode'] + "</td><td>" + operation['nozzle'] + "</td><td>" + operation['shield'] + "</td><td>" + stock['name'] + "," + stock['subtype'] + "</td><td>" + operation['stockQuantity'] + "</td><td>" + customer['name'] + "," + customer['phone'] + "</td><td>" + operation['cost'] + "</td><td id='priceOperation'>" + operation['price'] + "</td><td>" + operation['dos'] + "</td></tr>");
                container.hide();
                console.log(operation['nozzle']);
                $('#tablePrint').show();
                $('#tablePrinttt').hide();
                $('#tablePrintttt').show();



            },
            error: function() {
                $.notify('There was an error fetching data.');
                container.hide();
            }
        });
        document.getElementById("printBtn").disabled = false;
        document.getElementById("printBtnn").disabled = false;
    }
}

function getCustomer() {
    if ($('#machineType').text() == 4) {
        $.ajax({
            url: '/api/print',
            type: 'PATCH',
            data: {
                id: $('#operationId').text(),
            },
            success: function(response) {
                response = $.parseJSON(response);
                var operation = response['data']['operation'];
                var customer = response['data']['customer'];
                var consumable = response['data']['consumable'];
                var stock = response['data']['stock'];
                var machine = response['data']['machine'];
                $('#cName').text("Mr. " + customer['name']);
                $('#cPhone').text(customer['phone']);
                $('#cAddress').text(customer['address']);
                $('#fuel').text("$" + operation['fuelprice']);
                $('#consumption').text("$" + parseFloat(((parseFloat(operation['price']) - parseFloat(operation['cost'])) * parseFloat(machine['consumptionRate'])) / 100).toFixed(3));
                $('#sName').text(operation['name']);
                $('#sDate').text(operation['dos']);
                $('#sPrice').text("$" + operation['price']);
                $('#stName').text(stock['productName'] + "," + stock['productSubtype']);
                $('#stQuantity').text(operation['stockQuantity']);
                $('#stPrice').text("$" + stock['price']);
                $('#conName').text("Tool");
                $('#conQuantity').text(operation['tool']);
                $('#conPrice').text("$" + consumable[3]['price'] * operation['tool']);
                $('#conNamee').text("Collet");
                $('#conQuantityy').text(operation['collet']);
                $('#conPricee').text("$" + consumable[4]['price'] * operation['collet']);
                $('#cconName').text("Tool Holder");
                $('#cconQuantity').text(operation['toolholder']);
                $('#cconPrice').text("$" + consumable[5]['price'] * operation['toolholder']);
                $('#page-wrapper').height($('#print').height());
                window.print();
            },
            error: function() {
                $.notify('There was an error fetching data.');
                container.hide();
            }
        });
    } else if ($('#machineType').text() == 3) {


        $.ajax({
            url: '/api/printt',
            type: 'PATCH',
            data: {
                id: $('#operationId').text(),
            },
            success: function(response) {
                response = $.parseJSON(response);
                var operation = response['data']['operation'];
                var customer = response['data']['customer'];
                var consumable = response['data']['consumable'];
                var stock = response['data']['stock'];
                var machine = response['data']['machine'];
                $('#cName').text("Mr. " + customer['name']);
                $('#cPhone').text(customer['phone']);
                $('#cAddress').text(customer['address']);
                $('#fuel').text("$" + operation['fuelprice']);
                $('#sName').text(operation['name']);
                $('#sDate').text(operation['dos']);
                $('#sPrice').text("$" + operation['price']);
                $('#consumption').text("$" + parseFloat(((parseFloat(operation['price']) - parseFloat(operation['cost'])) * parseFloat(machine['consumptionRate'])) / 100).toFixed(3));
                $('#stName').text(stock['productName'] + "," + stock['productSubtype']);
                $('#stQuantity').text(operation['stockQuantity']);
                $('#stPrice').text("$" + stock['price']);
                $('#conName').text("Electrode");
                $('#conQuantity').text(operation['electrode']);
                $('#conPrice').text("$" + consumable[3]['price'] * operation['electrode']);
                $('#conNamee').text("Nozzle");
                $('#conQuantityy').text(operation['nozzle']);
                $('#conPricee').text("$" + consumable[1]['price'] * operation['nozzle']);
                $('#cconName').text("Shield");
                $('#cconQuantity').text(operation['shield']);
                $('#cconPrice').text("$" + consumable[2]['price'] * operation['shield']);
                $('#page-wrapper').height($('#print').height());

                window.print();
            },
            error: function() {
                $.notify('There was an error fetching data.');
                container.hide();
            }
        });
    }
}