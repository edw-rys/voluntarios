jQuery.event.special.touchstart = {
    setup: function(_, ns, handle) {
        if (ns.includes("noPreventDefault")) {
            this.addEventListener("touchstart", handle, { passive: false });
        } else {
            this.addEventListener("touchstart", handle, { passive: true });
        }
    }
};

(function ($) {
    "use strict";

    const lang    = $('html')[0].lang;
    const _token  = $('meta[name="csrf-token"]').attr('content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
    });

    $(document).ajaxComplete(function( event, request, settings ) {
        $('[data-toggle="tooltip"]').not( '[data-original-title]' ).tooltip({
            trigger: 'hover'
        });
    });

    /**
     * Moment
     */
    moment.updateLocale(lang, {
        week: {dow: 1} // Monday is the first day of the week
    });

    /**
     * Tooltip
     */
    tooltip();

    /**
     * Select2
     */
    select2();
    select2Ajax();

    /**
     * SummerNote
     */
    summernote();
    summernote('.summernote-tiny');

    /**
     * Clear invalid's input class when keydown
     */
    clearInvalidFields();

    $('#appsModal').on('shown.bs.modal', function () {
        $('#quick-search').trigger('focus');
    });

    /**
     * DateTimePicker (Tempus)
     */
    let dateTimeField = $('.datetimepicker');
    if (dateTimeField.length > 0) {
        dateTimeField.datetimepicker({
            format: dateTimeField.data('format') ? dateTimeField.data('format') : 'YYYY-MM-DD',
            useStrict: false,
            //useCurrent: false,
            //maxDate: moment(new Date()),
            buttons: {
                showToday: false,
                showClear: true,
                showClose: true
            },
            icons: {
                time: 'ik ik-clock',
                date: 'ik ik-calendar',
                up: 'ik ik-arrow-up',
                down: 'ik ik-arrow-down',
                previous: 'ik ik-chevron-left',
                next: 'ik ik-chevron-right',
                today: 'ik ik-calendar',
                clear: 'ik ik-delete',
                close: 'ik ik-x'
            },
            tooltips: {
                today: 'Hoy',
                clear: 'Eliminar selección',
                close: 'Cerrar calendario',
                selectMonth: 'Seleccionar mes',
                prevMonth: 'Mes anterior',
                nextMonth: 'Mes siguiente',
                selectYear: 'Seleccionar año',
                prevYear: 'Año anterior',
                nextYear: 'Año siguiente',
                selectDecade: 'Seleccionar década',
                prevDecade: 'Década anterior',
                nextDecade: 'Década siguiente',
                prevCentury: 'Centuria anterior',
                nextCentury: 'Centuria siguiente',
                pickHour: 'Elegir hora',
                incrementHour: 'Incrementar hora',
                decrementHour: 'Decrementar hora',
                pickMinute: 'Elegir Minuto',
                incrementMinute: 'Incrementar Minute',
                decrementMinute: 'Decrementar Minute',
                pickSecond: 'Elegir Segundo',
                incrementSecond: 'Incrementar Segundo',
                decrementSecond: 'Decrementar Segundo',
                togglePeriod: 'Intercambiar periodo',
                selectTime: 'Seleccionar Tiempo',
                selectDate: 'Seleccionar Fecha'
            },
        });
    }

    /**
     * Sidebar Toggle
     */
    let StorageSidebarName  = 'sidebar-toggle-collapsed';
    let StorageMiniSidebar  = localStorage.getItem(StorageSidebarName);
    let navToggle           = $('.nav-toggle');

    // Sidebar
    let main_wrapper = document.getElementById('main-wrapper');
    if (StorageMiniSidebar === '1') {
        try{
            main_wrapper.classList.add('nav-expanded', 'menu-expanded');
        }catch(e){}
        navToggle.children('i.toggle-icon').attr('data-toggle', 'expanded').removeClass('ik-toggle-left').addClass('ik-toggle-right');
        localStorage.setItem(StorageSidebarName, '1');
    } else {
        main_wrapper.classList.remove('nav-expanded', 'menu-expanded');
        main_wrapper.classList.add('nav-collapsed', 'menu-collapsed');
    }

    // Toggle Button for sidebar
    navToggle.on('click', function (e) {
        e.preventDefault();
        localStorage.setItem(StorageSidebarName, (Boolean(StorageMiniSidebar)) ? '' : '1');
    });

    /**
     * Menu accordion
     */
    $('[data-accordion="true"]').find('.accordion-toggle').on('click', function () {
        $(this).nextUntil('.accordion-toggle').slideToggle('fast');
        $(this).after().toggleClass('accordion-toggle-close');
    });

    /**
     * Purge Cache
     */
    $('#purge-cache').on('click', function (e) {
        e.preventDefault();
        iMessageModal('warning', $(this), 'Se requiere aprobar la purga del caché. ¿Estás seguro de continuar?');
        return false;
    });

    /**
     * Select All
     */
    let customs = $('.custom-checkbox input.custom-control-input');
    $('.select-all-table').on('click', function () {
        $(this).parents('thead').siblings('tbody').find(customs).prop('checked', 'checked');
    });
    $('.deselect-all-table').on('click', function () {
        $(this).parents('thead').siblings('tbody').find(customs).prop('checked', '');
    });
    $('.select-all-tables').on('click', function () {
        $(this).parent().siblings('.permissions').find(customs).prop('checked', 'checked');
    });
    $('.deselect-all-tables').on('click', function () {
        $(this).parent().siblings('.permissions').find(customs).prop('checked', '');
    });


    // Normal
    $('.select-all').on('click', function () {
        let $select2 = $(this).parent().siblings('.select2');
        $select2.find('option').filter(function(i, e) { return $(e).val() !== ""}).prop('selected', 'selected');
        $select2.trigger('change');
    });
    $('.deselect-all').on('click', function () {
        let $select2 = $(this).parent().siblings('.select2');
        $select2.find('option').filter(function(i, e) { return $(e).val() !== ""}).prop('selected', '');
        $select2.trigger('change')
    });

    // Bottom
    $('.select-all-bottom').on('click', function () {
        let $select2 = $(this).parents('.form-group').find('.select2');
        $select2.find('option').prop('selected', 'selected');
        $select2.trigger('change');
    });
    $('.deselect-all-bottom').on('click', function () {
        let $select2 = $(this).parents('.form-group').find('.select2');
        $select2.find('option').prop('selected', '');
        $select2.trigger('change')
    });

    /**
     * Tree View
     */
    let treeView = $('.treeview');
    if (treeView.length > 0) {
        treeView.each(function () {
            let shouldExpand = false;

            $(this).find('li').each(function () {
                if ($(this).hasClass('active')) {
                    shouldExpand = true;
                }
            });

            if (shouldExpand) {
                $(this).addClass('active');
            }
        });
    }

    /**
     * Slug
     */
    let alias   = $('#alias');
    let url     = alias.attr('href');

    $('.slug').on('keyup', function () {
        let value       = $(this).val();
        let target      = $(this).attr('data-slug-target');
        let separator   = $(this).attr('data-separator');

        let string = getSlug(value, {
            lang: lang,
            separator: (separator !== '') ? separator : '-'
        });

        if (target !== '') {
            $(document).find(target).val(string);

            if (alias.length > 0) {
                alias.find('#new_alias').html(string);
                url = url + string;
            }
        }
    });

    $('.sluggable').on('change keyup input paste propertychange', function () {
        if (alias.length > 0) {
            let value = $(this).val();

            alias.find('#new_alias').html(value);
            url = url + value;
        }
    });

    /**
     * Repeater
     */
    let repeater = $('#page-blocks');
    if (repeater.length > 0) {
        repeater.createRepeater(true, 'fast');
    }

    /**
     * iCheck
     */
    let iCheck = $('.icheck');
    if (iCheck.length > 0) {
        iCheck.iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red',
            increaseArea: '20%',
            labelHover: true
        });
    }

    /**
     * OrderAble
     */
    let OrderAble = document.getElementById('orderable');
    if (OrderAble !== null) {
        new Sortable(OrderAble, {
            handle: '.handle',
            animation: 150,
            ghostClass: 'blue-background-class',
            onEnd: function (evt) {
                let IDs = [];

                $(evt.to).find('.list-group-item').each(function () {
                    IDs.push($(this).attr('data-order'));
                });

                $(evt.to).siblings('#order').val(IDs);
            }
        });
    }

    /**
     * OrderAble - Nested
     */
    // Making all siblings movable
    let nestedSortables = [].slice.call(document.querySelectorAll('.nested-sortable'));
    if (nestedSortables.length > 0) {
        // Loop through each nested sortable element
        for (let i = 0; i < nestedSortables.length; i++) {
            new Sortable(nestedSortables[i], {
                handle: '.handle',
                animation: 150,
                fallbackOnBody: true,
                ghostClass: 'blue-background-class',
                swapThreshold: 1,
                onEnd: function (evt) {
                    let object  = $(evt.to);
                    let nested  = '';
                    let items  = [];
                    let order = 1;
                    let level1 = 1;
                    let level2 = 1;
                    let level3 = 1;
                    let level4 = 1;

                    // Levels (Main or Inner)
                    nested = (object.hasClass('col')) ? object.unbind() : object.parents('.list-group').unbind();

                    // Process all items
                    nested.find('.list-group-item').each(function (key, value) {
                        if ($(this).data('level') === 1) {
                            order = level1;
                        } else if ($(this).data('level') === 2) {
                            order = level2;
                        } else if ($(this).data('level') === 3) {
                            order = level3;
                        } else if ($(this).data('level') === 4) {
                            order = level4;
                        }

                        items.push({
                            id:     $(this).data('id'),
                            title:  $(this).find('span').html(),
                            order:  order
                        });

                        if ($(this).data('level') === 1) {
                            level1++;
                        } else if ($(this).data('level') === 2) {
                            level2++;
                        } else if ($(this).data('level') === 3) {
                            level3++;
                        } else if ($(this).data('level') === 4) {
                            level4++;
                        }
                    });

                    nested.siblings('#order').val(JSON.stringify(items));
                }
            });
        }
    }

    /**
     * Widgets
     */
    let widgets = $('#widgets');
    if (widgets.length > 0) {
        widgets.sortable({
            items: 'tbody > tr',
            cursor: 'pointer',
            handle: '.handle',
            axis: 'y',
            dropOnEmpty: false,
            start: function (e, ui) {
                ui.item.addClass('selected');
            },
            stop: function (e, ui) {
                ui.item.removeClass('selected');
                let i = 1;
                $(this).find('tr').each(function (key, value) {
                    $(this).find('td').eq(1).html(i);
                    i++;
                });
            }
        });
    }

    /**
     * Only One actions
     */
    let onlyOne = $('.only-one');
    if (onlyOne.length > 0) {
        // Show edit btn on hover
        onlyOne.unbind().find('label').hover(function () {
            $(this).find('.show-to-edit').toggleClass('d-none');
        });

        // Checkbox
        onlyOne.unbind().find('input[type="checkbox"]').on('change', function () {
            $('input[type="checkbox"]').not(this).prop('checked', false);
        });
    }

    /**
     * Set checkbox toggleable
     */
    $('[data-checkbox="togglable"]').on('click', function () {
        $(this).is(':checked') ? $(this).val(1) : $(this).val(0);
    });

    /**
     * Require elements
     */
    $('input,textarea,select').filter('[required]').each(function (key, value) {
        $(this).siblings('label').append('<span class="text-danger pl-1">*</span>');
    });

    /**
     * Image Modal
     */
    $(document).on('click', '[data-img-modal=true]', function (e) {
        e.preventDefault();
        let modal   = $('#imgModal');
        let img     = $(this).attr('src');

        modal.find('.modal-body').html('<img src="' + img.replace('thumbnails', 'covers') + '" alt="" width="100%" class="p-2">');
        modal.modal('show');
    });

    $('[type=file]').on('change', function (e) {
        e.preventDefault();
        $(this).siblings('img').remove();
    });

    $('#filter-header').on('click', function (e) {
        e.preventDefault();
        $(this).siblings('.card-header-right').find('.minimize-card').trigger('click');
    });

    /**
     * Show info
     */
    $(document).on('click', '[data-show=true]', function (e) {
        e.preventDefault();
        let ajax = [];
        ajax.push({
            url: $(this).attr('href'),
            type: 'GET',
            dataType: 'json'
        });
        iMessageModal('ajax', $(this), '', ajax);
    });

    /**
     *  Delete Item
     */
    $(document).on('click', '[data-delete=true]', function (e) {
        e.preventDefault();
        iMessageModal('danger', $(this));
    });

    /**
     * Block Item
     */
    $(document).on('click', '[data-block=true]', function (e) {
        e.preventDefault();
        iMessageModal('warning', $(this), '¿Está seguro de bloquear el registro?');
    });

    /**
     * Unblock Item
     */
    $(document).on('click', '[data-unblock=true]', function (e) {
        e.preventDefault();
        iMessageModal('warning', $(this), '¿Está seguro de desbloquear el registro?');
    });

    /**
     * Restore Item
     */
    $(document).on('click', '[data-restore=true]', function (e) {
        e.preventDefault();
        iMessageModal('warning', $(this), '¿Está seguro de restaurar el registro?');
    });

    /**
     * Base Modal
     */
    $(document).on('click', '[data-base-modal=true]', function (e) {
        e.preventDefault();
        let modal   = $('#baseModal');
        let title   = $(this).data('modal-title');
        let url     = ($(this).data('ajax') !== '') ? $(this).data('ajax') : $(this).attr('url');

        modal.find('.modal-title').html(title);

        $.ajax({
            url: url,
            method: 'POST',
            async: true,
            cache: false,
            dataType: 'json',
            beforeSend: function () {
                modal.find('.modal-body').addClass('text-center').html('Cargando...');
            }
        }).done(function (response, textStatus, jqXHR) {
            modal.find('.modal-body').removeClass('text-center').html(response);
        }).fail(function (jqXHR, textStatus, errorThrown) {
            let content = JSON.parse(jqXHR.responseText).message;
            modal.find('.modal-body').removeClass('text-center').html(content);
        });

        modal.modal('show');
    });

    /**
     * Add New Item on Select2
     */
    $('.addNewItem').select2().on('select2:open', function () {
        let select2 = $(this);
        let a       = select2.data('select2');

        // Check if not exists
        if (! $('.select2-link').length) {
            a.$results
                .parents('.select2-results')
                .append('<div class="select2-link bg-gray-3 text-white text-center py-2"><a href="#" class="btn-block"><i class="fas fa-plus pr-1"></i> Añadir ítem</a></div>')
                .on('click', function (e) {
                    e.preventDefault();
                    a.trigger('close');

                    iMessageModal();
                });
        }
    });

    $('[data-target="#show-modal-plan"]').on('click', function (e) {
        let plan        = $(this).parents('.plans');
        let planModal   = $(document).find('#show-modal-plan');
        let title       = planModal.find('.modal-plan-title');
        let description = planModal.find('.modal-plan-description');
        let image       = planModal.find('.modal-plan-image');
        let features    = planModal.find('.modal-plan-features');
        let price       = planModal.find('.modal-plan-price');
        let editBtn     = planModal.find('.modal-plan-edit');
        let deleteBtn   = planModal.find('.modal-plan-delete');

        title.html(plan.find('.title').clone());
        image.html(plan.find('.image').attr('class', 'image img-fluid').clone());
        price.html(plan.find('.price').clone());
        description.html(plan.find('.description').clone());

        // Features
        let plan_features   = plan.find('.features').data('plan-features');
        let JSONObject      = JSON.stringify(plan_features);
        let JSONParse       = JSON.parse(JSONObject);

        if (JSONParse.length > 0) {
            let featuresText = '';
            $.each(JSONParse, function (key, val) {
                $.each(val, function (key2, val2) {
                    featuresText += key2 + ' = ' + val2 + '<br>';
                });
            });

            features.find('.listed').html(featuresText);
        } else {
            features.find('.listed').html('');
        }

        // Edit button
        editBtn.attr('href', plan.data('edit'));

        // Delete button
        deleteBtn.attr('action', plan.data('delete')).children('input[name="id"]').val(plan.data('id'));
    });
})(jQuery);




if($('#client_id')){
    $('#client_id').change(function(){
        $('#payment').html('$0');
        var type_pago = document.getElementById('field-type-pago-dates');
        if(!type_pago) return ;
        type_pago.innerHTML = '';
        var client_id = $(this).val();
        if(!client_id) return ;
        $.ajax({
            url : '/admin/contracts/client/'+client_id,
            type : 'GET',

            // el tipo de información que se espera de respuesta
            dataType : 'json',

            success : function(contracts) {
                strOption = '<option value="">- Seleccione -</option>';
                console.log(contracts);
                for (const contract of contracts) {
                    if(contract.rates.rate_plan.type == 'PURCHASE'){
                        strOption += `<option value="${contract.id}">$${contract.rates.unit_free}C/U - ${contract.rates.rate_plan.name} - ${contract.rates.plan.name} - ${contract.rates.request_limit.name} - Producto: ${contract.rates.product.name}</option>`;
                    }else{
                        strOption += `<option value="${contract.id}">$${contract.rates.rate} - ${contract.rates.rate_plan.name} - ${contract.rates.plan.name} - ${contract.rates.request_limit.name} - Producto: ${contract.rates.product.name}</option>`;
                    }
                }

                document.getElementById('contract_id').innerHTML=strOption;
            },
            error : function(jqXHR, status, error) {
                alert('Disculpe, existió un problema');
            }
        });
    });

    $('#contract_id').change(function(){
        $('#payment').html('$0');
        var contract_id = $(this).val();
        if(!contract_id) return ;

        $.ajax({
            url : '/admin/contracts/get/'+contract_id,
            type : 'GET',

            // el tipo de información que se espera de respuesta
            dataType : 'json',

            success : function(contract) {
                // debugger
                $('#rate_plan').val(contract.rates.rate_plan.id);
                if(contract.rates.rate_plan.type == 'POST PAGO')
                    designDataPostPago( contract.start_date, contract.end_date, contract.months_payment, contract.rates.rate);

                else if(contract.rates.rate_plan.type == 'PRE PAGO'){
                    processPrePago(contract);
                }
                else if(contract.rates.rate_plan.type == 'PURCHASE')
                    setPriceByPurchase(contract.rates.unit_free, contract.first_limit_stop);
            },
            error : function(jqXHR, status, error) {
                alert('Disculpe, existió un problema');
            }
        });
    });
    /**
     *
     * @param {*} contract
     */
    function processPrePago(contract){
        designDataPrePago( contract.rates.rate, contract.first_limit_stop);
    }

    function setPriceByPurchase(rate, cant) {
        document.getElementById('field-type-pago-dates').innerHTML = ''
        $('#payment').html('$'+(rate * cant).toFixed(2));
    }

    function designDataPrePago( rate, cant ){
        document.getElementById('field-type-pago-dates').innerHTML = ''
        $('#payment').html('$'+(rate).toFixed(2));
    }

    function checkInvaliDate(date, collections) {
        if(!collections) return false;
        for (const collection of collections) {
            if(date>= moment(collection.start_date ) && date<=moment(collection.end_date)){
                return true;
            }
        }
        return false;
    }
    function setPriceByPrePago(rate) {
        $('#payment').html('$'+rate.toFixed(2));
    }
    function designDataPostPago(start_date, end_date, options, $rate){
        var date_start = moment(start_date);
        var date_end   = moment(end_date);
        options = refactorOptions(options);

        var strOptions = modelOptions(date_start, date_end, options);

        var domOption =`
            <label for="months_selected">Meses
            </label>
            <select name="months_selected[]" id="months_selected" class="form-control select2" multiple="multiple" data-placeholder="Seleccione los meses" required>
                <option></option>
                ${strOptions}
            </select>`;
        document.getElementById('field-type-pago-dates').innerHTML = domOption;
        addEventMonthsChange($rate);
        $('#months_selected').select2()
    }
    /**
     *
     * @param {*} start_date  | momment
     * @param {*} end_date    | momment
     * @param {*} options     | array
     */
    function modelOptions(start_date, end_date, options){

        var dates = []
        var start_date = moment(start_date)
        var start      = moment(start_date)

        if(start || end_date)
            while (true) {
                if(start>end_date){
                    break;
                }
                // if day in month is different
                if(start.date() != start_date.date()){
                    // change date
                    var endMonth = moment(start).endOf('month');
                    if( start_date.date() >  endMonth.date() ){
                        start.date(endMonth.date());
                    }else{
                        start.date(start_date.date());
                    }
                }

                next_date = moment(start);
                next_date.add(1, 'month')

                // if day in month is different
                if(next_date.date() != start_date.date()){
                    // change date
                    var endMonth = moment(next_date).endOf('month');
                    if( start_date.date() >  endMonth.date() ){
                        next_date.date(endMonth.date());
                    }else{
                        next_date.date(start_date.date());
                    }
                }


                var dataFormat = {
                    start_date : moment(start) ,
                    end_date   : next_date,
                    value      : start.format()+'|'+next_date.format()
                };
                var object = options.find( data =>moment(data.start_date).format('D/M/y') == dataFormat.start_date.format('D/M/y') && moment(data.end_date).format('D/M/y') == dataFormat.end_date.format('D/M/y') );
                if(!object)
                    dates.push(dataFormat);

                start.add(1, 'month')
            }

        var strOptions = ''
        for (const date_ of dates) {
            strOptions += `<option value="${date_.value}">${date_.start_date.format('D/M/y')} - ${date_.end_date.format('D/M/y')}</option>`;
        }
        return strOptions;
    }
    function addEventMonthsChange($rate){
        $('#months_selected').change(function(){
            var months = $(this).val();
            var payment = $rate * months.length;
            $('#payment').html('$'+payment.toFixed(2));
        }
        );
    }
    function refactorOptions(options) {
        var opArr = [];
        for (const option of options) {
            opArr = [...opArr, ...option]
        }
        return opArr
    }
}
function toggle(query, class_){
    $(query).toggleClass(class_);
}