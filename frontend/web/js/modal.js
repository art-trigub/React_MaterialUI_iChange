(function ($) {
    "use strict";

    var app = window.app = window.app || {}; // window.app namespace

    var _ajaxLoading = {};
    var _ajax = function (stop_param) {

        this._preloader;
        this._before;
        this._complete;

        this.preloader = function (el) {
            if (stop_param && !_ajaxLoading[stop_param]) {
                this._preloader = el;
            }
            return this;
        },

       this.before = function (f) {
           if (stop_param && !_ajaxLoading[stop_param]) {
               this._before = f;
           }
           return this;
       },

       this.complete = function (f) {
           if (stop_param && !_ajaxLoading[stop_param]) {
               this._complete = f;
           }

           return this;
       },

       this.request = function (type, url, ajaxParams, success) {
           var self = this;
           $.ajax($.extend({
               url: url,
               type: type,
               beforeSend: function () {
                   if (!_ajaxLoading[stop_param]) {
                       if (self._preloader && self._preloader instanceof jQuery)
                           self._preloader.addClass('loading');

                       if (self._before && typeof self._before == 'function')
                           self._before.apply(null);

                       stop_param && (_ajaxLoading[stop_param] = true);
                   } else {
                       return false;
                   }
               },
               complete: function () {
                   if (self._preloader && self._preloader instanceof jQuery)
                       self._preloader.removeClass('loading');

                   if (self._complete && typeof self._complete == 'function')
                       self._complete.apply(null);

                   stop_param && (_ajaxLoading[stop_param] = false);
               },
               success: success || $.noop,
               error: function (err1, err2) {
                   console.error(err1, err2);
               }
           }, ajaxParams || {}));
       }
    };

    app.ajax = function (stop_param) {
        return new _ajax(stop_param);
    };

    app.modal = (function() {

        var defaultTemplate =
            '<div class="ui modal default ${modalClassName}">' +
                '<i class="close icon"></i>' +
                '{{if title}}' +
                    '<div class="header">${title}</div>' +
                '{{/if}}' +
                '<div class="content {{if !title}}content_untitled{{/if}}">' +
                    '{{html content}}' +
                '</div>' +
                '<div class="actions">' +
                    '{{each buttons}}' +
                    '<span class="ui button ${className}">${text}</span>' +
                    '{{/each}}' +
                    '{{if btnDeny}}' +
                    '<span class="ui button cancel">${btnDeny}</span>' +
                    '{{/if}}' +
                    '{{if btnApprove}}' +
                    '<span class="ui button approve button is-danger">${btnApprove}</span>' +
                    '{{/if}}' +
                '</div>' +
            '</div>';


        var confirmTemplate =
            '<div class="ui modal confirm">' +
                '<div class="header">${title}</div>' +
                    '<div class="content">' +
                    '${message}' +
                    '</div>' +
                    '<div class="actions">' +
                        '<span class="ui button cancel">' + lajax.t('Cancel') + '</span>' +
                        '<span class="ui button approve button is-danger">' + lajax.t('Ok') + '</span>' +
                    '</div>' +
            '</div>';

        var alertTemplate =
            '<div class="ui modal alert">' +
                '{{if title}}' +
                '<div class="header">${title}</div>' +
                '{{/if}}' +
                '<div class="content">' +
                '{{html message}}' +
                '</div>' +
                '<div class="actions">' +
                    '<span class="ui button approve">' + lajax.t('Ok') + '</span>' +
                '</div>' +
            '</div>';

        var _ajax = function(url, ajaxOptions, callback) {
            app.ajax('modal')
                .before(function () {
                    $.tmpl(defaultTemplate, {modalClassName: '_preloader', title: ''})
                        .modal('show dimmer')
                        .parents('.ui.dimmer').addClass('loading');
                })
                .complete(function () {
                    $('.ui.dimmer.loading')
                        .removeClass('loading')
                        .find('.ui.modal._preloader').remove();
                })
                .request('get', url, ajaxOptions || {}, callback);
        };


        return {

            alert: function(title, message, params) {
                $.tmpl(alertTemplate, {
                    title: title,
                    message: message
                }).modal($.extend({
                    onHidden: function() {
                        $(this).remove();
                    }
                }, params || {})).modal('show');
            },

            confirm: function(title, message, confirm) {
                $.tmpl(confirmTemplate, {
                    title: title,
                    message: message
                }).modal({
                    onApprove: function() {
                        confirm.call(this);
                    },
                    onHidden: function() {
                        $(this).remove();
                    }
                }).modal('show');
            },
            /**
             * @param string title the title of modal
             * @param string content the content of modal can be string or jQuery object
             * @param object params the params of UI modal
             */
            show: function(title, content, params) {
                params = params || {};
                content = content instanceof jQuery ?
                    $("<div/>").append(content.clone()).html() :
                    content;

                params.buttons = params.buttons || [
                    {text: 'Ok', className: 'approve'},
                    {text: 'Cancel', className: 'cancel'}
                ];

                $.tmpl(defaultTemplate, {
                    title: title,
                    content: content,
                    buttons: params.buttons,
                    modalClassName: params['modalClassName'] || ''
                }).modal($.extend({
                    onHidden: function() {
                        $(this).remove();
                    }
                }, params)).modal('show');
            },
            /**
             * @param string title
             * @param object|string (jQuery tmpl OR Html string OR url)
             * @param object the ajax params
             * @param object the form modal params
             *
             * @use onHidden: function() {
                        if($(this).data('approved')) {
                            ...
                        }
                    }
             *
             * ajax response must be json {form: 'form html', status: OK or ERR, ?message: ''}
             */
            //CActiveForm validateOnSubmit = false; must be
            ajaxForm: function(title, content, ajaxOptions, modalOptions) {
                var modal = this;

                var submitForm = function($modal) {
                    var form = $("form", $modal);
                    app.ajax('ajax_form_modal')
                        .preloader($modal.find('.ui.button.approve'))
                        .request('post', form.attr('action'), $.extend(ajaxOptions || {}, {data: form.serialize()}), function(data) {
                            try {
                                var response = $.parseJSON(data);
                                if (response.form) {
                                    $modal.find('.content').html(response.form);
                                    formEvent($modal.find('.content').find('form'), $modal);
                                }

                                if (response.status == "OK") {
                                    if (response['message']) {
                                        $modal.data('approved', true);
                                        modal.alert(false, response['message']);
                                    } else {
                                        $modal.data('approved', true).modal('hide');
                                    }
                                }
                            } catch (err) {
                                $modal.find('.content').html(data);
                            }
                        });
                };

                var formEvent = function(form, modal) {
                    var self = this;
                    form.on('submit', function (e) {
                        e.preventDefault();
                        if ($(this).data('approve') === true && //yii fix (active form)
                            $(this).find('.has-error').length === 0 //yii fix
                        ) {
                            submitForm($(modal));
                        }
                    });
                };

                var resultModalOptions = $.extend({
                    onVisible: function () {
                        var self = this;
                        formEvent($(this).find('form'), self);
                    },
                    onApprove: function () {
                        //submitForm($(this));
                        var form = $(this).find('form');
                            form.data('approve', true).submit();
                            form.data('approve', false);

                        return false;
                    }
                }, modalOptions || {});

                if(typeof content == 'string' && content.indexOf('/')===0) { //url
                    _ajax(content, ajaxOptions, function(data) {
                        var response = $.parseJSON(data);
                        modal.show(title, response.form, resultModalOptions);
                    });
                } else {
                    this.show(title, content, resultModalOptions);
                }
            },
            /**
             * @param string url the URL to which the request is sent
             * @param object ajaxOptions the ajax options
             * @param object modalOptions the UI modal options
             *
             * @response the ajax response can be String or JSON like {title: value, body: value};
             */
            ajax: function(url, ajaxOptions, modalOptions) {
                var self = this;
                _ajax(url, ajaxOptions, function(data) {
                    try {
                        var response = $.parseJSON(data);
                        if('title' in response || 'body' in response) {
                            self.show(response.title || false, response.body || '', modalOptions);
                        } else {
                            console.error('Response must have `title` OR `body` properties');
                        }
                    } catch (e) {
                        self.show(false, data, modalOptions);
                    }
                });
            }
        }
    }())
}(jQuery));
