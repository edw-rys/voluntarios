  
/**
 * Add Spinner
 *
 * @param el
 * @param static_pos
 * @returns {null}
 */
function addSpinner(el, static_pos)
{
    let spinner = el.children('.spinner');

    if (spinner.length && ! spinner.hasClass('spinner-remove')) {
        return null;
    }

    ! spinner.length && (spinner = $('<div class="spinner' + (static_pos ? '' : ' spinner-absolute') + '">').appendTo(el));
    animateSpinner(spinner, 'add');
}

/**
 * Remove Spinner
 *
 * @param el
 * @param complete
 */
function removeSpinner(el, complete)
{
    let spinner = el.children('.spinner');
    spinner.length && animateSpinner(spinner, 'remove', complete);
}

/**
 * Animate Spinner
 *
 * @param el
 * @param animation
 * @param complete
 */
function animateSpinner(el, animation, complete)
{
    if (el.data('animating')) {
        el.removeClass(el.data('animating')).data('animating', null);
        el.data('animationTimeout') && clearTimeout(el.data('animationTimeout'));
    }

    el.addClass('spinner-' + animation).data('animating', 'spinner-' + animation);
    el.data('animationTimeout', setTimeout(function() {
            animation === 'remove' && el.remove();
            complete && complete();
        }, parseFloat(el.css('animation-duration')) * 1000)
    );
}

/**
 * Load select2
 *
 * @param selector
 */
function select2(selector = '.select2') {
    $(document).find(selector).select2({
        allowClear: true,
        width: '100%',
        language: 'es',
        closeOnSelect: true,
        placeholder: function () {
            ($(this).data('placeholder') !== '') ? $(this).data('placeholder') : '- Seleccione -';
        },
    });
}

/**
 * Load select2 using ajax
 *
 * @param selector
 */
function select2Ajax(selector = '*[data-ajax--url]') {
    $(selector).select2({
        allowClear: true,
        width: '100%',
        language: 'es',
        closeOnSelect: true,
        minimumInputLength: 3,
        placeholder: function () {
            ($(this).data('placeholder') !== '') ? $(this).data('placeholder') : '- Seleccione -';
        },
    });
}

/**
 * Load tooltip
 *
 * @param selector
 */
function tooltip(selector = '[data-toggle="tooltip"]') {
    $(document).find(selector).tooltip({
        trigger: 'hover'
    });
}

/**
 * Clear invalid's input class when keydown
 *
 * @param selector
 */
function clearInvalidFields(selector = '.is-invalid') {
    $(document).find(selector).on('keydown', function () {
        let that = $(this);
        that.removeClass('is-invalid');
        that.parent().find('.help-block').remove();
    });
}

/**
 * Create summernote editor
 *
 * @param editorName
 */
function summernote(editorName = '.summernote') {
    let editor          = $(document).find(editorName);
    let editor_height   = editor.data('summernote-height') ? editor.data('summernote-height') : 400;
    let toolbarOptions = [
        ['misc', ['undo', 'redo', 'print']],
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['para', ['style', 'ul', 'ol', 'paragraph']],
        ['fontsize', ['fontsize']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['codeview']],
    ];

    if (editor.length === 0) {
        return;
    }

    if (editorName === '.summernote-tiny') {
        toolbarOptions = [
            ['misc', ['undo', 'redo', 'print']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
        ];
    }

    editor.summernote({
        height: editor_height,
        placeholder: 'Ingrese el texto...',
        focus: false,
        airMode: false,
        fontNames: ['Roboto', 'Calibri', 'Times New Roman', 'Arial'],
        fontNamesIgnoreCheck: ['Roboto', 'Calibri'],
        dialogsInBody: true,
        dialogsFade: true,
        disableDragAndDrop: false,
        lang: 'es-ES',
        toolbar: toolbarOptions,
        popover: {
            air: [
                ['color', ['color']],
                ['font', ['bold', 'underline', 'clear']]
            ]
        }
    });
}

/**
 * Clear LocalStorage values
 */
function clearLocalStorage(item = 'all') {
    if (item === 'all') {
        // Elimina todos los elementos
        localStorage.clear();
    } else {
        // Elimina un elemento específico
        localStorage.removeItem(item);
    }
}

/**
 * iAlert confirmation
 *
 * @param content
 * @param type
 */
function iAlert(content = '', type = 'blue') {
    $.alert({
        title: 'Mensaje',
        content: content,
        autoClose: 'confirm|15000',
        icon: 'ik ik-info',
        backgroundDismiss: true,
        closeIcon: true,
        draggable: false,
        animateFromElement: false,
        animation: 'zoom',
        closeAnimation: 'zoom',
        theme: 'material',
        type: type,
        buttons: {
            confirm: {
                text: 'Ok',
                btnClass: 'btn-default',
                keys: ['enter', 'escape']
            }
        },
    });
}

/**
 * iMessageModal
 *
 * @param modal_type
 * @param element
 * @param content
 * @param ajaxParams
 */
function iMessageModal(modal_type = 'info', element = '', content = '', ajaxParams = []) {
    if (element === '') return;

    let type = '', icon = '', title = '', btn = '';

    if (modal_type === 'info') {
        title   = 'Información';
        icon    = 'ik ik-info';
        type    = 'blue';
        btn     = 'primary';
        content = (content !== '') ? content : 'Info';
    } else if (modal_type === 'success') {
        title   = 'Exitoso';
        icon    = 'ik ik-check-square';
        type    = 'green';
        btn     = 'success';
        content = (content !== '') ? content : 'Ok';
    } else if (modal_type === 'warning') {
        title   = 'Confirmar';
        icon    = 'ik ik-alert-triangle';
        type    = 'orange';
        btn     = 'warning';
        content = (content !== '') ? content : 'Se requiere aprobar está acción. ¿Estás seguro de continuar?';
    } else if (modal_type === 'danger') {
        title   = 'Eliminar';
        icon    = 'ik ik-trash';
        type    = 'red';
        btn     = 'danger';
        content = (content !== '') ? content : 'Eliminar datos críticos puede ocasionar resultados no deseados. ¿Estás seguro de continuar?';
    } else if (modal_type === 'ajax') {
        title   = '';
        icon    = element.parents('body').find('.page-header-title > i').attr('class').replace('bg-blue', '');
        type    = 'green';
        btn     = 'success';

        if (ajaxParams.length === 0) return;
    }

    if (modal_type === 'ajax') {
        $.confirm({
            title: title,
            content: function () {
                let self = this;
                let ajax = ajaxParams[0];

                $.ajax({
                    url: ajax['url'],
                    type: ajax['type'],
                    dataType: ajax['dataType'],
                    beforeSend: function (xhr) {
                        self.setTitle('Cargando...');
                    }
                }).done(function (response) {
                    let source = $($.parseHTML(response.content));
                    let title = source.find('.card-header');
                    let content = source.find('.card-body');

                    self.setTitle(title.html());
                    self.setContent(content.html());
                }).fail(function () {
                    self.setContent('Error');
                });
            },
            columnClass: 'col-md-8 col-md-offset-4 col-sm-8 col-sm-offset-3 col-xs-10 col-xs-offset-1',
            icon: icon,
            backgroundDismiss: true,
            boxWidth: '50%',
            closeIcon: true,
            draggable: false,
            animateFromElement: false,
            animation: 'zoom',
            closeAnimation: 'zoom',
            theme: 'material',
            type: type,
            buttons: {
                close: {
                    text: 'Cancelar',
                    btnClass: 'btn-default',
                    keys: ['escape']
                }
            }
        });

        return;
    }

    $.confirm({
        title: title,
        content: content,
        autoClose: 'close|15000',
        icon: icon,
        backgroundDismiss: true,
        closeIcon: true,
        draggable: false,
        animateFromElement: false,
        animation: 'zoom',
        closeAnimation: 'zoom',
        theme: 'material',
        type: type,
        buttons: {
            confirm: {
                text: 'Ok',
                btnClass: 'btn-' + btn,
                keys: ['enter'],
                action: function () {
                    let target = $(element);

                    // Form
                    if (target.is('form')) {
                        target.submit();
                    }
                    // Link
                    else if (target.is('a')) {
                        location.href = target.attr('href');
                    }
                }
            },
            close: {
                text: 'Cancelar',
                btnClass: 'btn-default',
                keys: ['escape']
            }
        },
    });
}

/**
 * iDeleteDataTablesAjax confirmation
 *
 * @param url
 * @param ids
 * @param dataTable
 * @param content
 */
function iDeleteDataTablesAjax(url, ids, dataTable, content = 'Eliminar datos críticos puede ocasionar resultados no deseados. ¿Estás seguro de continuar?') {
    if (url === '' || ids === '' || dataTable === '') return;

    $.confirm({
        title: 'Eliminar',
        content: content,
        autoClose: 'close|15000',
        icon: 'ik ik-trash',
        backgroundDismiss: true,
        closeIcon: true,
        draggable: false,
        animateFromElement: false,
        animation: 'zoom',
        closeAnimation: 'zoom',
        theme: 'material',
        type: 'red',
        buttons: {
            confirm: {
                text: 'Ok',
                btnClass: 'btn-danger',
                keys: ['enter'],
                action: function () {
                    let button = $('body').find('.dataTables_wrapper .btn-massdelete');
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            ids: ids,
                            _method: 'DELETE'
                        },
                        dataType: 'JSON',
                        beforeSend: function() {
                            button.addClass('disabled');
                            addSpinner($('body'));
                        },
                        success: function (response) {
                            dataTable.DataTable().ajax.reload();
                        },
                        error: function (xhr, textStatus, errorThrown) {
                            let errorMsg = 'Error no especificado.';

                            if (! xhr.responseJSON) {
                                iAlert(errorMsg, 'red');
                                return;
                            }

                            // Message
                            if (xhr.responseJSON.message !== '') {
                                errorMsg = xhr.responseJSON.message;
                            }

                            // Array is defined and has at least one element
                            if (typeof xhr.responseJSON.errors !== 'undefined') {
                                $.each(xhr.responseJSON.errors, function(k, v) {
                                    errorMsg += '<br>- ' + v;
                                });
                            }

                            iAlert(errorMsg, 'orange');
                        },
                        complete: function() {
                            button.removeClass('disabled');
                            removeSpinner($('body'));
                        }
                    });
                }
            },
            close: {
                text: 'Cancelar',
                btnClass: 'btn-default',
                keys: ['escape']
            }
        },
    });
}