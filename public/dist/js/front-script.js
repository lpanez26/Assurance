import _regeneratorRuntime from "babel-runtime/regenerator";

var pagesDataOnContractInit = function () {
    var _ref5 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee5() {
        var check_dentist_account;
        return _regeneratorRuntime.wrap(function _callee5$(_context5) {
            while (1) {
                switch (_context5.prev = _context5.next) {
                    case 0:
                        if (!$('body').hasClass('dentist')) {
                            _context5.next = 16;
                            break;
                        }

                        $('.additional-info .current-account a').html(global_state.account).attr('href', 'https://rinkeby.etherscan.io/address/' + global_state.account);
                        $('.additional-info .assurance-account a').html(App.assurance_address).attr('href', 'https://rinkeby.etherscan.io/address/' + App.assurance_address);
                        $('.additional-info .dentacointoken-account a').html(App.dentacoin_token_address).attr('href', 'https://rinkeby.etherscan.io/address/' + App.dentacoin_token_address);
                        _context5.next = 6;
                        return App.assurance_methods.getDentist(global_state.account);

                    case 6:
                        check_dentist_account = _context5.sent;

                        if (check_dentist_account.toLowerCase() == global_state.account.toLowerCase()) {
                            $('.additional-info .is-dentist span').addClass('yes').html('YES');
                        } else {
                            $('.additional-info .is-dentist span').addClass('no').html('NO');
                        }

                        //show current pending and running contracts
                        buildCurrentDentistContractHistory();

                        $('.register-dentist').click(function () {
                            App.assurance_methods.registerDentist();
                        });

                        $('.register-contract').click(function () {
                            App.assurance_methods.registerContract($('.registerContract .patient-address').val().trim(), global_state.account, $('.registerContract .value-usd').val().trim(), $('.registerContract .value-dcn').val().trim(), new Date($('.registerContract .date-start-contract').val().trim()).getTime() / 1000, $('.registerContract .ipfs-hash').val().trim());
                        });

                        $('.dentist-approve-contract').click(function () {
                            App.assurance_methods.dentistApproveContract($('.dentistApproveContract .patient-address').val().trim());
                        });

                        $('.withdraw-to-dentist').click(function () {
                            App.assurance_methods.withdrawToDentist();
                        });

                        $('.break-contract').click(function () {
                            App.assurance_methods.breakContract($('.breakContract .patient-address').val().trim(), global_state.account);
                        });
                        _context5.next = 35;
                        break;

                    case 16:
                        if (!$('body').hasClass('patient')) {
                            _context5.next = 35;
                            break;
                        }

                        $('.additional-info .current-account a').html(global_state.account).attr('href', 'https://rinkeby.etherscan.io/address/' + global_state.account);
                        $('.additional-info .assurance-account a').html(App.assurance_address).attr('href', 'https://rinkeby.etherscan.io/address/' + App.assurance_address);
                        $('.additional-info .dentacointoken-account a').html(App.dentacoin_token_address).attr('href', 'https://rinkeby.etherscan.io/address/' + App.dentacoin_token_address);

                        //we check greater than 0 or more?????? ASK JEREMIAS
                        _context5.t0 = parseInt;
                        _context5.next = 23;
                        return App.dentacoin_token_methods.allowance(global_state.account, App.assurance_address);

                    case 23:
                        _context5.t1 = _context5.sent;
                        _context5.t2 = (0, _context5.t0)(_context5.t1);

                        if (!(_context5.t2 > 0)) {
                            _context5.next = 29;
                            break;
                        }

                        $('.is-allowance-given span').addClass('yes').html('YES');
                        _context5.next = 30;
                        break;

                    case 29:
                        $('.is-allowance-given span').addClass('no').html('NO');

                    case 30:

                        //show current pending and running contracts
                        buildCurrentPatientContractHistory();

                        $('.approve .approve-dcntoken-contract').click(function () {
                            App.dentacoin_token_methods.approve();
                        });

                        $('.register-contract').click(function () {
                            App.assurance_methods.registerContract(global_state.account, $('.registerContract .dentist-address').val().trim(), $('.registerContract .value-usd').val().trim(), $('.registerContract .value-dcn').val().trim(), new Date($('.registerContract .date-start-contract').val().trim()).getTime() / 1000, $('.registerContract .ipfs-hash').val().trim());
                        });

                        $('.patient-approve-contract').click(function () {
                            App.assurance_methods.patientApproveContract($('.patientApproveContract .dentist-address').val().trim());
                        });

                        $('.break-contract').click(function () {
                            App.assurance_methods.breakContract(global_state.account, $('.breakContract .dentist-address').val().trim());
                        });

                    case 35:
                    case "end":
                        return _context5.stop();
                }
            }
        }, _callee5, this);
    }));

    return function pagesDataOnContractInit() {
        return _ref5.apply(this, arguments);
    };
}();

var buildCurrentDentistContractHistory = function () {
    var _ref6 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee6() {
        var current_patients_for_dentist, pending_approval_from_this_dentist_bool, pending_approval_from_patient, running_contacts_bool, i, len, patient, single_patient_body;
        return _regeneratorRuntime.wrap(function _callee6$(_context6) {
            while (1) {
                switch (_context6.prev = _context6.next) {
                    case 0:
                        _context6.next = 2;
                        return App.assurance_methods.getPatientsArrForDentist(global_state.account);

                    case 2:
                        current_patients_for_dentist = _context6.sent;

                        if (!(current_patients_for_dentist.length > 0)) {
                            _context6.next = 17;
                            break;
                        }

                        pending_approval_from_this_dentist_bool = false;
                        pending_approval_from_patient = false;
                        running_contacts_bool = false;
                        i = 0, len = current_patients_for_dentist.length;

                    case 8:
                        if (!(i < len)) {
                            _context6.next = 17;
                            break;
                        }

                        _context6.next = 11;
                        return App.assurance_methods.getPatient(current_patients_for_dentist[i], global_state.account);

                    case 11:
                        patient = _context6.sent;
                        single_patient_body = '<div class="single"><div><label>Patient address:</label> <a href="https://rinkeby.etherscan.io/address/' + patient[1] + '" target="_blank" class="etherscan-hash">' + patient[1] + '</a></div><div><label>USD value:</label> ' + patient[6] + '</div><div><label>DCN value:</label> ' + patient[7] + '</div><div><label>IPFS link: (this is where patient and dentist can see the real contract (pdf) signed between them) <a href="https://gateway.ipfs.io/ipfs/' + patient[8] + '" target="_blank">https://gateway.ipfs.io/ipfs/' + patient[8] + '</a></label></div>';

                        if (patient[3] == true && patient[4] == true) {
                            if (!running_contacts_bool) {
                                $('.running-contacts .fieldset-body').html('');
                                running_contacts_bool = true;
                            }
                            single_patient_body += '<div><label>Date and time for next available withdraw:</label> ' + new Date(parseInt(patient[2]) * 1000) + '</div></div>';
                            $('.running-contacts .fieldset-body').append(single_patient_body);
                        } else if (patient[3] == true) {
                            if (!pending_approval_from_patient) {
                                $('.pending-approval-from-patient .fieldset-body').html('');
                                pending_approval_from_patient = true;
                            }
                            single_patient_body += '<div><label>Date and time contract start:</label> ' + new Date(parseInt(patient[2]) * 1000) + '</div></div>';
                            $('.pending-approval-from-patient .fieldset-body').append(single_patient_body);
                        } else if (patient[4] == true) {
                            if (!pending_approval_from_this_dentist_bool) {
                                $('.pending-approval-from-this-dentist .fieldset-body').html('');
                                pending_approval_from_this_dentist_bool = true;
                            }
                            single_patient_body += '<div><label>Date and time contract start:</label> ' + new Date(parseInt(patient[2]) * 1000) + '</div></div>';
                            $('.pending-approval-from-this-dentist .fieldset-body').append(single_patient_body);
                        }

                    case 14:
                        i += 1;
                        _context6.next = 8;
                        break;

                    case 17:
                    case "end":
                        return _context6.stop();
                }
            }
        }, _callee6, this);
    }));

    return function buildCurrentDentistContractHistory() {
        return _ref6.apply(this, arguments);
    };
}();

var buildCurrentPatientContractHistory = function () {
    var _ref7 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee7() {
        var current_dentists_for_patient, pending_approval_from_this_dentist_bool, pending_approval_from_patient, running_contacts_bool, i, len, patient, single_patient_body;
        return _regeneratorRuntime.wrap(function _callee7$(_context7) {
            while (1) {
                switch (_context7.prev = _context7.next) {
                    case 0:
                        _context7.next = 2;
                        return App.assurance_methods.getWaitingContractsForPatient(global_state.account);

                    case 2:
                        current_dentists_for_patient = _context7.sent;

                        if (!(current_dentists_for_patient.length > 0)) {
                            _context7.next = 17;
                            break;
                        }

                        pending_approval_from_this_dentist_bool = false;
                        pending_approval_from_patient = false;
                        running_contacts_bool = false;
                        i = 0, len = current_dentists_for_patient.length;

                    case 8:
                        if (!(i < len)) {
                            _context7.next = 17;
                            break;
                        }

                        _context7.next = 11;
                        return App.assurance_methods.getPatient(global_state.account, current_dentists_for_patient[i]);

                    case 11:
                        patient = _context7.sent;
                        single_patient_body = '<div class="single"><div><label>Dentist address:</label> <a href="https://rinkeby.etherscan.io/address/' + patient[0] + '" target="_blank" class="etherscan-hash">' + patient[0] + '</a></div><div><label>USD value:</label> ' + patient[6] + '</div><div><label>DCN value:</label> ' + patient[7] + '</div><div><label>IPFS link:  (this is where patient and dentist can see the real contract (pdf) signed between them) <a href="https://gateway.ipfs.io/ipfs/' + patient[8] + '" target="_blank">https://gateway.ipfs.io/ipfs/' + patient[8] + '</a></label></div>';

                        if (patient[3] == true && patient[4] == true) {
                            if (!running_contacts_bool) {
                                $('.running-contacts .fieldset-body').html('');
                                running_contacts_bool = true;
                            }
                            single_patient_body += '<div><label>Date and time for next available withdraw:</label> ' + new Date(parseInt(patient[2]) * 1000) + '</div></div>';
                            $('.running-contacts .fieldset-body').append(single_patient_body);
                        } else if (patient[3] == true) {
                            if (!pending_approval_from_patient) {
                                $('.pending-approval-from-this-patient .fieldset-body').html('');
                                pending_approval_from_patient = true;
                            }
                            single_patient_body += '<div><label>Date and time contract start:</label> ' + new Date(parseInt(patient[2]) * 1000) + '</div></div>';
                            $('.pending-approval-from-this-patient .fieldset-body').append(single_patient_body);
                        } else if (patient[4] == true) {
                            if (!pending_approval_from_this_dentist_bool) {
                                $('.pending-approval-from-dentist .fieldset-body').html('');
                                pending_approval_from_this_dentist_bool = true;
                            }
                            single_patient_body += '<div><label>Date and time contract start:</label> ' + new Date(parseInt(patient[2]) * 1000) + '</div></div>';
                            $('.pending-approval-from-dentist .fieldset-body').append(single_patient_body);
                        }

                    case 14:
                        i += 1;
                        _context7.next = 8;
                        break;

                    case 17:
                    case "end":
                        return _context7.stop();
                }
            }
        }, _callee7, this);
    }));

    return function buildCurrentPatientContractHistory() {
        return _ref7.apply(this, arguments);
    };
}();

// ================== PAGES ==================


function _asyncToGenerator(fn) { return function () { var gen = fn.apply(this, arguments); return new Promise(function (resolve, reject) { function step(key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { return Promise.resolve(value).then(function (value) { step("next", value); }, function (err) { step("throw", err); }); } } return step("next"); }); }; }

var basic = {
    options: {
        alert: null
    },
    init: function init(opt) {
        //basic.addCsrfTokenToAllAjax();
        //basic.stopMaliciousInspect();
    },
    cookies: {
        set: function set(name, value) {
            if (name == undefined) {
                name = "cookieLaw";
            }
            if (value == undefined) {
                value = 1;
            }
            var d = new Date();
            d.setTime(d.getTime() + 10 * 24 * 60 * 60 * 1000);
            var expires = "expires=" + d.toUTCString();
            document.cookie = name + "=" + value + "; " + expires + ";path=/";
            if (name == "cookieLaw") {
                $(".cookies_popup").slideUp();
            }
        },
        erase: function erase(name) {
            document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        },
        get: function get(name) {
            if (name == undefined) {
                var name = "cookieLaw";
            }
            name = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
            }
            return "";
        }
    },
    fixPlaceholders: function fixPlaceholders() {
        $("input[data-placeholder]").each(function () {
            if ($(this).data("placeholders-fixed") == undefined) {
                $(this).data("placeholders-fixed", true);

                basic.setInputsPlaceholder($(this));

                $focus_function = "if($(this).val()=='" + $(this).data("placeholder") + "'){ $(this).val(''); }";
                if ($(this).attr("onkeydown") != undefined) {
                    $focus_function = $(this).attr("onkeydown") + "; " + $focus_function;
                }
                $(this).attr("onkeydown", $focus_function);

                $blur_function = "if($(this).val()==''){ $(this).val('" + $(this).data("placeholder") + "'); }";
                if ($(this).attr("onblur") != undefined) {
                    $blur_function = $(this).attr("onblur") + "; " + $blur_function;
                }
                $(this).attr("onblur", $blur_function);
            }
        });
    },
    clearPlaceholders: function clearPlaceholders(extra_filter) {
        if (extra_filter == undefined) {
            extra_filter = "";
        }
        $("input[data-placeholder]" + extra_filter).each(function () {
            if ($(this).val() == $(this).data("placeholder")) {
                $(this).val('');
            }
        });
    },
    setPlaceholders: function setPlaceholders() {
        $("input[data-placeholder]").each(function () {
            basic.setInputsPlaceholder($(this));
        });
    },
    setInputsPlaceholder: function setInputsPlaceholder(input) {
        if ($(input).val() == "") {
            $(input).val($(input).data("placeholder"));
        }
    },
    fixBodyModal: function fixBodyModal() {
        if ($(".modal-dialog").length > 0 && !$("body").hasClass('modal-open')) {
            $("body").addClass('modal-open');
        }
    },
    fixZIndexBackdrop: function fixZIndexBackdrop() {
        if (jQuery('.bootbox').length > 1) {
            var last_z = jQuery('.bootbox').eq(jQuery('.bootbox').length - 2).css("z-index");
            jQuery('.bootbox').last().css({ 'z-index': last_z + 2 }).next('.modal-backdrop').css({ 'z-index': last_z + 1 });
        }
    },
    showAlert: function showAlert(message, class_name, vertical_center) {
        basic.realShowDialog(message, "alert", class_name, null, null, vertical_center);
    },
    showConfirm: function showConfirm(message, class_name, params, vertical_center) {
        basic.realShowDialog(message, "confirm", class_name, params, null, vertical_center);
    },
    showDialog: function showDialog(message, class_name, type, vertical_center) {
        if (type === undefined) {
            type = null;
        }
        basic.realShowDialog(message, "dialog", class_name, null, type, vertical_center);
    },
    realShowDialog: function realShowDialog(message, dialog_type, class_name, params, type, vertical_center) {
        if (class_name === undefined) {
            class_name = "";
        }
        if (type === undefined) {
            type = null;
        }
        if (vertical_center === undefined) {
            vertical_center = null;
        }

        var atrs = {
            "message": message,
            "animate": false,
            "show": false,
            "className": class_name
        };

        if (dialog_type == "confirm" && params != undefined && params.buttons == undefined) {
            atrs.buttons = {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            };
        }
        if (params != undefined) {
            for (var key in params) {
                atrs[key] = params[key];
            }
        }

        var dialog = eval("bootbox." + dialog_type)(atrs);
        dialog.on('hidden.bs.modal', function () {
            basic.fixBodyModal();
            if (type != null) {
                $('.single-application figure[data-slug="' + type + '"]').parent().focus();
            }
        });
        dialog.on('shown.bs.modal', function () {
            if (vertical_center != null) {
                basic.verticalAlignModal();
            }
            basic.fixZIndexBackdrop();
        });
        dialog.modal('show');
    },
    verticalAlignModal: function verticalAlignModal(message) {
        $("body .modal-dialog").each(function () {
            $(this).css("margin-top", Math.max(20, ($(window).height() - $(this).height()) / 2));
        });
    },
    closeDialog: function closeDialog() {
        bootbox.hideAll();
    },
    request: {
        initialize: false,
        result: null,
        submit: function submit(url, data, options, callback, curtain) {
            options = $.extend({
                type: 'POST',
                dataType: 'json',
                async: true
            }, options);
            if (basic.request.initialize && options.async == false) {
                console.log(['Please wait for parent request']);
            } else {
                basic.request.initialize = true;
                return $.ajax({
                    url: url,
                    data: data,
                    type: options.type,
                    dataType: options.dataType,
                    async: options.async,
                    beforeSend: function beforeSend() {
                        if (curtain !== null) {
                            basic.addCurtain();
                        }
                    },
                    success: function success(response) {
                        basic.request.result = response;
                        if (curtain !== null) {
                            basic.removeCurtain();
                        }
                        basic.request.initialize = false;
                        if (typeof callback === 'function') {
                            callback(response);
                        }
                    },
                    error: function error() {
                        basic.request.initialize = false;
                    }
                });
            }
        },
        validate: function validate(form, callback, data) {
            //if data is passed skip clearing all placeholders and removing messages. it's done inside the calling function
            if (data == undefined) {
                basic.clearPlaceholders();
                $(".input-error-message").remove();
                data = form.serialize();
            }
            return basic.request.submit(SITE_URL + "validate/", data, { async: false }, function (res) {
                if (typeof callback === 'function') {
                    callback();
                }
            }, null);
        },
        markValidationErrors: function markValidationErrors(validation_result, form) {
            basic.setPlaceholders();
            if (typeof validation_result.all_errors == "undefined") {
                if (typeof validation_result.message != "undefined") {
                    basic.showAlert(validation_result.message);
                    return true;
                }
            } else {
                var all_errors = JSON.parse(validation_result.all_errors);
                for (var param_name in all_errors) {
                    //if there is error, but no name for it, pop it in alert
                    if (Object.keys(all_errors).length == 1 && $('[name="' + param_name + '"]').length == 0) {
                        basic.showAlert(all_errors[param_name]);
                        return false;
                    }

                    if (form == undefined) {
                        var input = $('[name="' + param_name + '"]');
                    } else {
                        var input = form.find('[name="' + param_name + '"]');
                    }
                    basic.request.removeValidationErrors(input);
                    if (input.closest('.input-error-message-holder')) {
                        input.closest('.input-error-message-holder').append('<div class="input-error-message">' + all_errors[param_name] + '</div>');
                    } else {
                        input.after('<div class="input-error-message">' + all_errors[param_name] + '</div>');
                    }
                    //basic.setInputsPlaceholder(input);
                }
            }
        },
        removeValidationErrors: function removeValidationErrors(input) {
            input.closest('.input-error-message-holder').find(".input-error-message").remove();
            input.parent().remove(".input-error-message");
        }
    },
    alert: function alert(message) {
        basic.options.alert(message);
    },
    addCurtain: function addCurtain() {
        $("body").prepend('<div class="curtain"></div>');
    },
    removeCurtain: function removeCurtain() {
        $("body .curtain").remove();
    },
    validateEmail: function validateEmail(email) {
        return (/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email)
        );
    },
    validatePhone: function validatePhone(phone) {
        return (/^[\d\.\-]+$/.test(phone)
        );
    },
    validateUrl: function validateUrl(url) {
        return (/(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/.test(url)
        );
    },
    isInViewport: function isInViewport(el) {
        var elementTop = $(el).offset().top;
        var elementBottom = elementTop + $(el).outerHeight();
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();
        return elementBottom > viewportTop && elementTop < viewportBottom;
    },
    isMobile: function isMobile() {
        var isMobile = false; //initiate as false
        // device detection
        if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) {
            isMobile = true;
        }
        return isMobile;
    },
    addCsrfTokenToAllAjax: function addCsrfTokenToAllAjax() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    },
    objHasKey: function objHasKey(object, key) {
        return object ? hasOwnProperty.call(object, key) : false;
    },
    stopMaliciousInspect: function stopMaliciousInspect() {
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });

        document.onkeydown = function (e) {
            if (event.keyCode == 123) {
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                return false;
            }
        };
    }
};

var _require = require('./helper'),
    getWeb3 = _require.getWeb3,
    getContractInstance = _require.getContractInstance;

basic.init();

$(document).ready(function () {

    App.init();
});

$(window).on('load', function () {});

$(window).on('resize', function () {});

$(window).on('scroll', function () {});

//on button click next time when you hover the button the color is bugged until you click some other element (until you move out the focus from this button)
function fixButtonsFocus() {
    if ($('a').length > 0) {
        $('a').click(function () {
            $(this).blur();
        });
    }
}
fixButtonsFocus();

function generateUrl(str) {
    var str_arr = str.split('');
    var cyr = ['Ð°', 'Ð±', 'Ð²', 'Ð³', 'Ð´', 'Ðµ', 'Ñ‘', 'Ð¶', 'Ð·', 'Ð¸', 'Ð¹', 'Ðº', 'Ð»', 'Ð¼', 'Ð½', 'Ð¾', 'Ð¿', 'Ñ€', 'Ñ', 'Ñ‚', 'Ñƒ', 'Ñ„', 'Ñ…', 'Ñ†', 'Ñ‡', 'Ñˆ', 'Ñ‰', 'ÑŠ', 'Ñ‹', 'ÑŒ', 'Ñ', 'ÑŽ', 'Ñ', 'Ð', 'Ð‘', 'Ð’', 'Ð“', 'Ð”', 'Ð•', 'Ð', 'Ð–', 'Ð—', 'Ð˜', 'Ð™', 'Ðš', 'Ð›', 'Ðœ', 'Ð', 'Ðž', 'ÐŸ', 'Ð ', 'Ð¡', 'Ð¢', 'Ð£', 'Ð¤', 'Ð¥', 'Ð¦', 'Ð§', 'Ð¨', 'Ð©', 'Ðª', 'Ð«', 'Ð¬', 'Ð­', 'Ð®', 'Ð¯', ' '];
    var lat = ['a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sht', 'a', 'i', 'y', 'e', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'Io', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sht', 'A', 'I', 'Y', 'e', 'Yu', 'Ya', '-'];
    for (var i = 0; i < str_arr.length; i += 1) {
        for (var y = 0; y < cyr.length; y += 1) {
            if (str_arr[i] == cyr[y]) {
                str_arr[i] = lat[y];
            }
        }
    }
    return str_arr.join('').toLowerCase();
}

function checkIfCookie() {
    if ($('.privacy-policy-cookie').length > 0) {
        $('.privacy-policy-cookie .accept').click(function () {
            basic.cookies.set('privacy_policy', 1);
            $('.privacy-policy-cookie').hide();
        });
    }
}

//binding the refresh captcha event to existing button
function initCaptchaRefreshEvent() {
    if ($('.refresh-captcha').length > 0) {
        $('.refresh-captcha').click(function () {
            $.ajax({
                type: 'GET',
                url: '/refresh-captcha',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function success(response) {
                    $('.captcha-container span').html(response.captcha);
                }
            });
        });
    }
}

var global_state = {};
var temporally_timestamp = 0;
var App = {
    assurance_address: "0x7d0278788bedc4767bb469ea7d143787a133c4a0",
    assurance_abi: [{ "constant": false, "inputs": [{ "name": "_patient_addr", "type": "address" }, { "name": "_dentist_addr", "type": "address" }], "name": "breakContract", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "_api_decimals", "type": "uint256" }], "name": "changeApiDecimals", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "_api_result_dcn_usd_price", "type": "uint256" }], "name": "changeApiResultDcnUsdPrice", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "_min_allowed_amount", "type": "uint256" }], "name": "changeMinimumAllowedAmount", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "_period_to_withdraw", "type": "uint256" }], "name": "changePeriodToWithdraw", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "_usd_over_dcn", "type": "bool" }], "name": "changeUsdOverDcn", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [], "name": "circuitBreaker", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "_patient_addr", "type": "address" }], "name": "dentistApproveContract", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "_dentist_addr", "type": "address" }], "name": "patientApproveContract", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "_patient_addr", "type": "address" }, { "name": "_dentist_addr", "type": "address" }, { "name": "_value_usd", "type": "uint256" }, { "name": "_value_dcn", "type": "uint256" }, { "name": "_date_start_contract", "type": "uint256" }, { "name": "_contract_ipfs_hash", "type": "string" }], "name": "registerContract", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [], "name": "registerDentist", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "_new_admin", "type": "address" }], "name": "transferAdmin", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "_new_owner", "type": "address" }], "name": "transferOwnership", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "_array", "type": "address[]" }], "name": "withdrawToDentist", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "anonymous": false, "inputs": [{ "indexed": true, "name": "_dentist_addr", "type": "address" }, { "indexed": true, "name": "_patient_addr", "type": "address" }, { "indexed": false, "name": "_value", "type": "uint256" }, { "indexed": false, "name": "_date", "type": "uint256" }], "name": "logSuccessfulWithdraw", "type": "event" }, { "anonymous": false, "inputs": [{ "indexed": true, "name": "_dentist_addr", "type": "address" }, { "indexed": false, "name": "_date", "type": "uint256" }], "name": "logSuccessfulDentistRegistration", "type": "event" }, { "anonymous": false, "inputs": [{ "indexed": true, "name": "_dentist_addr", "type": "address" }, { "indexed": true, "name": "_patient_addr", "type": "address" }, { "indexed": false, "name": "_date", "type": "uint256" }, { "indexed": false, "name": "_value_usd", "type": "uint256" }, { "indexed": false, "name": "_value_dcn", "type": "uint256" }], "name": "logSuccessfulContractRegistration", "type": "event" }, { "anonymous": false, "inputs": [{ "indexed": true, "name": "_dentist_addr", "type": "address" }, { "indexed": true, "name": "_patient_addr", "type": "address" }, { "indexed": false, "name": "_date", "type": "uint256" }], "name": "logSuccessfulContractBreak", "type": "event" }, { "anonymous": false, "inputs": [{ "indexed": true, "name": "_patient_addr", "type": "address" }, { "indexed": true, "name": "_dentist_addr", "type": "address" }], "name": "logSuccessfulContractApproval", "type": "event" }, { "constant": true, "inputs": [], "name": "admin", "outputs": [{ "name": "", "type": "address" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "api_decimals", "outputs": [{ "name": "", "type": "uint256" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "api_result_dcn_usd_price", "outputs": [{ "name": "", "type": "uint256" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "AssuranceContract", "outputs": [{ "name": "", "type": "address" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "contract_paused", "outputs": [{ "name": "", "type": "bool" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [{ "name": "_dentist_addr", "type": "address" }], "name": "getDentist", "outputs": [{ "name": "", "type": "address" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "getDentistsArr", "outputs": [{ "name": "", "type": "address[]" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [{ "name": "_patient_addr", "type": "address" }, { "name": "_dentist_addr", "type": "address" }], "name": "getPatient", "outputs": [{ "name": "", "type": "address" }, { "name": "", "type": "address" }, { "name": "", "type": "uint256" }, { "name": "", "type": "bool" }, { "name": "", "type": "bool" }, { "name": "", "type": "bool" }, { "name": "", "type": "uint256" }, { "name": "", "type": "uint256" }, { "name": "", "type": "string" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [{ "name": "_dentist_addr", "type": "address" }], "name": "getPatientsArrForDentist", "outputs": [{ "name": "", "type": "address[]" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [{ "name": "_patient_addr", "type": "address" }], "name": "getWaitingContractsForPatient", "outputs": [{ "name": "", "type": "address[]" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "min_allowed_amount", "outputs": [{ "name": "", "type": "uint256" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "owner", "outputs": [{ "name": "", "type": "address" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "period_to_withdraw", "outputs": [{ "name": "", "type": "uint256" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "usd_over_dcn", "outputs": [{ "name": "", "type": "bool" }], "payable": false, "stateMutability": "view", "type": "function" }],
    assurance_instance: null,
    dentacoin_token_address: "0x19f49a24c7cb0ca1cbf38436a86656c2f30ab362",
    dentacoin_token_abi: [{ "constant": false, "inputs": [{ "name": "_spender", "type": "address" }, { "name": "_value", "type": "uint256" }], "name": "approve", "outputs": [{ "name": "success", "type": "bool" }], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [], "name": "buyDentacoinsAgainstEther", "outputs": [{ "name": "amount", "type": "uint256" }], "payable": true, "stateMutability": "payable", "type": "function" }, { "constant": false, "inputs": [], "name": "haltDirectTrade", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "amountOfEth", "type": "uint256" }, { "name": "dcn", "type": "uint256" }], "name": "refundToOwner", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "amount", "type": "uint256" }], "name": "sellDentacoinsAgainstEther", "outputs": [{ "name": "revenue", "type": "uint256" }], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "newDCNAmount", "type": "uint256" }], "name": "setDCNForGas", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "newBuyPriceEth", "type": "uint256" }, { "name": "newSellPriceEth", "type": "uint256" }], "name": "setEtherPrices", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "newGasAmountInWei", "type": "uint256" }], "name": "setGasForDCN", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "newGasReserveInWei", "type": "uint256" }], "name": "setGasReserve", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "minimumBalanceInWei", "type": "uint256" }], "name": "setMinBalance", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "_to", "type": "address" }, { "name": "_value", "type": "uint256" }], "name": "transfer", "outputs": [{ "name": "success", "type": "bool" }], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "_from", "type": "address" }, { "name": "_to", "type": "address" }, { "name": "_value", "type": "uint256" }], "name": "transferFrom", "outputs": [{ "name": "success", "type": "bool" }], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [{ "name": "newOwner", "type": "address" }], "name": "transferOwnership", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [], "name": "unhaltDirectTrade", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "inputs": [], "payable": false, "stateMutability": "nonpayable", "type": "constructor" }, { "payable": true, "stateMutability": "payable", "type": "fallback" }, { "anonymous": false, "inputs": [{ "indexed": true, "name": "_from", "type": "address" }, { "indexed": true, "name": "_to", "type": "address" }, { "indexed": false, "name": "_value", "type": "uint256" }], "name": "Transfer", "type": "event" }, { "anonymous": false, "inputs": [{ "indexed": true, "name": "_owner", "type": "address" }, { "indexed": true, "name": "_spender", "type": "address" }, { "indexed": false, "name": "_value", "type": "uint256" }], "name": "Approval", "type": "event" }, { "constant": true, "inputs": [{ "name": "_owner", "type": "address" }, { "name": "_spender", "type": "address" }], "name": "allowance", "outputs": [{ "name": "remaining", "type": "uint256" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [{ "name": "_owner", "type": "address" }], "name": "balanceOf", "outputs": [{ "name": "balance", "type": "uint256" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "buyPriceEth", "outputs": [{ "name": "", "type": "uint256" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "DCNForGas", "outputs": [{ "name": "", "type": "uint256" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "decimals", "outputs": [{ "name": "", "type": "uint8" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "DentacoinAddress", "outputs": [{ "name": "", "type": "address" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "directTradeAllowed", "outputs": [{ "name": "", "type": "bool" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "gasForDCN", "outputs": [{ "name": "", "type": "uint256" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "gasReserve", "outputs": [{ "name": "", "type": "uint256" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "minBalanceForAccounts", "outputs": [{ "name": "", "type": "uint256" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "name", "outputs": [{ "name": "", "type": "string" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "owner", "outputs": [{ "name": "", "type": "address" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "sellPriceEth", "outputs": [{ "name": "", "type": "uint256" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "symbol", "outputs": [{ "name": "", "type": "string" }], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "totalSupply", "outputs": [{ "name": "", "type": "uint256" }], "payable": false, "stateMutability": "view", "type": "function" }],
    dentacoin_instance: null,
    web3Provider: null,
    web3_0_2: null,
    web3_1_0: null,
    clinics_holder: null,
    contracts: {},
    loading: false,
    init: function init() {
        return App.initWeb3();
    },
    initWeb3: function () {
        var _ref = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee() {
            return _regeneratorRuntime.wrap(function _callee$(_context) {
                while (1) {
                    switch (_context.prev = _context.next) {
                        case 0:
                            /*if(localStorage.getItem('current-account') != null && typeof(web3) === 'undefined')    {
                                //CUSTOM
                                global_state.account = JSON.parse(localStorage.getItem('current-account')).address;
                                App.web3_1_0 = getWeb3(new Web3.providers.HttpProvider('https://mainnet.infura.io/c6ab28412b494716bc5315550c0d4071'));
                            }else */if (typeof web3 !== 'undefined') {
                                //METAMASK
                                App.web3_0_2 = web3;
                                global_state.account = App.web3_0_2.eth.defaultAccount;
                                //overwrite web3 0.2 with web 1.0
                                web3 = getWeb3(App.web3_0_2.currentProvider);
                                //web3 = getWeb3(new Web3.providers.HttpProvider('https://rinkeby.infura.io/v3/c6ab28412b494716bc5315550c0d4071'));
                                App.web3_1_0 = web3;
                            } else {
                                //NO CUSTOM, NO METAMASK. Doing this final third check so we can use web3_1_0 functions and utils even if there is no metamask or custom imported/created account
                                App.web3_1_0 = getWeb3();
                            }

                            //if user is not logged in with metamask or custom stop here

                            if (!(typeof global_state.account != 'undefined')) {
                                _context.next = 3;
                                break;
                            }

                            return _context.abrupt("return", App.initContract());

                        case 3:
                        case "end":
                            return _context.stop();
                    }
                }
            }, _callee, this);
        }));

        function initWeb3() {
            return _ref.apply(this, arguments);
        }

        return initWeb3;
    }(),
    initContract: function () {
        var _ref2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee2() {
            return _regeneratorRuntime.wrap(function _callee2$(_context2) {
                while (1) {
                    switch (_context2.prev = _context2.next) {
                        case 0:
                            //Assurance
                            App.assurance_instance = new App.web3_1_0.eth.Contract(App.assurance_abi, App.assurance_address);
                            //DentacoinToken
                            App.dentacoin_token_instance = new App.web3_1_0.eth.Contract(App.dentacoin_token_abi, App.dentacoin_token_address);

                            //save current block number into state
                            _context2.next = 4;
                            return App.helper.getBlockNum();

                        case 4:

                            //init pages logic
                            pagesDataOnContractInit();

                        case 5:
                        case "end":
                            return _context2.stop();
                    }
                }
            }, _callee2, this);
        }));

        function initContract() {
            return _ref2.apply(this, arguments);
        }

        return initContract;
    }(),
    dentacoin_token_methods: {
        allowance: function allowance(owner, spender) {
            return App.dentacoin_token_instance.methods.allowance(owner, spender).call({ from: global_state.account }, function (error, result) {
                if (!error) {
                    return result;
                } else {
                    console.error(error);
                }
            });
        },
        approve: function approve() {
            return App.dentacoin_token_instance.methods.approve(App.assurance_address, 9000000000000).send({
                from: global_state.account,
                gas: 65000
            }).on('transactionHash', function (hash) {
                basic.showAlert('Your transaction is now pending. Give it a minute and check for confirmation on <a href="https://rinkeby.etherscan.io/tx/' + hash + '" target="_blank" class="etherscan-hash">Etherscan</a>.', '', true);
            }).catch(function (err) {
                console.error(err);
            });
        }
    },
    assurance_methods: {
        getDentist: function getDentist(dentist_addr) {
            return App.assurance_instance.methods.getDentist(dentist_addr).call({ from: global_state.account }, function (error, result) {
                if (!error) {
                    return result;
                } else {
                    console.error(error);
                }
            });
        },
        getPatient: function getPatient(patient_addr, dentist_addr) {
            return App.assurance_instance.methods.getPatient(patient_addr, dentist_addr).call({ from: global_state.account }, function (error, result) {
                if (!error) {
                    return result;
                } else {
                    console.error(error);
                }
            });
        },
        getDentistsArr: function getDentistsArr() {
            return App.assurance_instance.methods.getDentistsArr().call({ from: global_state.account }, function (error, result) {
                if (!error) {
                    console.log(result);
                } else {
                    console.error(error);
                }
            });
        },
        getPatientsArrForDentist: function getPatientsArrForDentist(dentist_addr) {
            return App.assurance_instance.methods.getPatientsArrForDentist(dentist_addr).call({ from: global_state.account }, function (error, result) {
                if (!error) {
                    return result;
                } else {
                    console.error(error);
                }
            });
        },
        getWaitingContractsForPatient: function getWaitingContractsForPatient(patient_addr) {
            return App.assurance_instance.methods.getWaitingContractsForPatient(patient_addr).call({ from: global_state.account }, function (error, result) {
                if (!error) {
                    return result;
                } else {
                    console.error(error);
                }
            });
        },
        breakContract: function breakContract(patient_addr, dentist_addr) {
            //check if patient and dentist addresses are valid
            if (!innerAddressCheck(patient_addr) || !innerAddressCheck(dentist_addr)) {
                basic.showAlert('Patient and dentist addresses must be valid.');
                return false;
            }
            //CHECK IF THERE IS CONTRACT BETWEEN THEM?????
            return App.assurance_instance.methods.breakContract(patient_addr, dentist_addr).send({
                from: global_state.account,
                gas: 130000
            }).on('transactionHash', function (hash) {
                basic.showAlert('Your transaction is now pending. Give it a minute and check for confirmation on <a href="https://rinkeby.etherscan.io/tx/' + hash + '" target="_blank" class="etherscan-hash">Etherscan</a>.', '', true);
            }).catch(function (err) {
                console.error(err);
            });
        },
        dentistApproveContract: function dentistApproveContract(patient_addr) {
            //check if patient address is valid
            if (!innerAddressCheck(patient_addr)) {
                basic.showAlert('Patient address must be valid.');
                return false;
            }
            return App.assurance_instance.methods.dentistApproveContract(patient_addr).send({
                from: global_state.account,
                gas: 65000
            }).on('transactionHash', function (hash) {
                basic.showAlert('Your transaction is now pending. Give it a minute and check for confirmation on <a href="https://rinkeby.etherscan.io/tx/' + hash + '" target="_blank" class="etherscan-hash">Etherscan</a>.', '', true);
            }).catch(function (err) {
                console.error(err);
            });
        },
        patientApproveContract: function patientApproveContract(dentist_addr) {
            return App.assurance_instance.methods.patientApproveContract(dentist_addr).send({
                from: global_state.account,
                gas: 65000
            }).on('transactionHash', function (hash) {
                basic.showAlert('Your transaction is now pending. Give it a minute and check for confirmation on <a href="https://rinkeby.etherscan.io/tx/' + hash + '" target="_blank" class="etherscan-hash">Etherscan</a>.', '', true);
            }).catch(function (err) {
                console.error(err);
            });
        },
        registerContract: function () {
            var _ref3 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee3(patient_addr, dentist_addr, value_usd, value_dcn, date_start_contract, contract_ipfs_hash) {
                var check_if_dentist_registered;
                return _regeneratorRuntime.wrap(function _callee3$(_context3) {
                    while (1) {
                        switch (_context3.prev = _context3.next) {
                            case 0:
                                _context3.next = 2;
                                return App.assurance_methods.getDentist(dentist_addr);

                            case 2:
                                check_if_dentist_registered = _context3.sent;

                                if (!(!innerAddressCheck(patient_addr) || !innerAddressCheck(dentist_addr))) {
                                    _context3.next = 6;
                                    break;
                                }

                                basic.showAlert('Patient and dentist addresses must be valid.');
                                return _context3.abrupt("return", false);

                            case 6:
                                if (!(check_if_dentist_registered.toLowerCase() != dentist_addr.toLowerCase())) {
                                    _context3.next = 9;
                                    break;
                                }

                                basic.showAlert('You are not registered dentist on the Assurance contract. In order to init contracts you must first register your self.');
                                return _context3.abrupt("return", false);

                            case 9:
                                _context3.t0 = parseInt;
                                _context3.next = 12;
                                return App.dentacoin_token_methods.allowance(patient_addr, App.assurance_address);

                            case 12:
                                _context3.t1 = _context3.sent;
                                _context3.t2 = (0, _context3.t0)(_context3.t1);

                                if (!(_context3.t2 <= 0)) {
                                    _context3.next = 17;
                                    break;
                                }

                                basic.showAlert('This patient didn\'t give allowance to Assurance contract to manage his Dentacoins.');
                                return _context3.abrupt("return", false);

                            case 17:
                                if (!(parseInt(value_usd) <= 0 || parseInt(value_dcn) <= 0)) {
                                    _context3.next = 20;
                                    break;
                                }

                                basic.showAlert('Both USD and DCN values must be greater than 0.');
                                return _context3.abrupt("return", false);

                            case 20:
                                if (!(date_start_contract < 0)) {
                                    _context3.next = 23;
                                    break;
                                }

                                basic.showAlert('Please enter valid date.');
                                return _context3.abrupt("return", false);

                            case 23:
                                return _context3.abrupt("return", App.assurance_instance.methods.registerContract(patient_addr, dentist_addr, value_usd, value_dcn, date_start_contract, contract_ipfs_hash).send({
                                    from: global_state.account,
                                    gas: 330000
                                }).on('transactionHash', function (hash) {
                                    basic.showAlert('Your transaction is now pending. Give it a minute and check for confirmation on <a href="https://rinkeby.etherscan.io/tx/' + hash + '" target="_blank" class="etherscan-hash">Etherscan</a>.', '', true);
                                }).catch(function (err) {
                                    console.error(err);
                                }));

                            case 24:
                            case "end":
                                return _context3.stop();
                        }
                    }
                }, _callee3, this);
            }));

            function registerContract(_x, _x2, _x3, _x4, _x5, _x6) {
                return _ref3.apply(this, arguments);
            }

            return registerContract;
        }(),
        registerDentist: function registerDentist() {
            return App.assurance_instance.methods.registerDentist().send({
                from: global_state.account,
                gas: 100000
            }).on('transactionHash', function (hash) {
                basic.showAlert('Your transaction is now pending. Give it a minute and check for confirmation on <a href="https://rinkeby.etherscan.io/tx/' + hash + '" target="_blank" class="etherscan-hash">Etherscan</a>.', '', true);
            }).catch(function (err) {
                console.error(err);
            });
        },
        withdrawToDentist: function () {
            var _ref4 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee4() {
                var ready_to_withdraw_arr, current_patients_for_dentist, i, len, patient;
                return _regeneratorRuntime.wrap(function _callee4$(_context4) {
                    while (1) {
                        switch (_context4.prev = _context4.next) {
                            case 0:
                                ready_to_withdraw_arr = [];
                                _context4.next = 3;
                                return App.assurance_methods.getPatientsArrForDentist(global_state.account);

                            case 3:
                                current_patients_for_dentist = _context4.sent;

                                if (!(current_patients_for_dentist.length > 0)) {
                                    _context4.next = 15;
                                    break;
                                }

                                i = 0, len = current_patients_for_dentist.length;

                            case 6:
                                if (!(i < len)) {
                                    _context4.next = 15;
                                    break;
                                }

                                _context4.next = 9;
                                return App.assurance_methods.getPatient(current_patients_for_dentist[i], global_state.account);

                            case 9:
                                patient = _context4.sent;

                                //if time passed for next_transfer of contract and if the contract is approved by both patient and dentist and then dentist can withdraw from patient legit
                                console.log(patient);
                                if (Math.round(new Date().getTime() / 1000) > parseInt(patient[2]) && patient[3] && patient[4]) {
                                    ready_to_withdraw_arr.push(patient[1]);
                                }

                            case 12:
                                i += 1;
                                _context4.next = 6;
                                break;

                            case 15:
                                if (!(ready_to_withdraw_arr.length > 0)) {
                                    _context4.next = 19;
                                    break;
                                }

                                return _context4.abrupt("return", App.assurance_instance.methods.withdrawToDentist(ready_to_withdraw_arr).send({
                                    from: global_state.account,
                                    gas: ready_to_withdraw_arr.length * 60000
                                }).on('transactionHash', function (hash) {
                                    basic.showAlert('Your transaction is now pending. Give it a minute and check for confirmation on <a href="https://rinkeby.etherscan.io/tx/' + hash + '" target="_blank" class="etherscan-hash">Etherscan</a>.', '', true);
                                }).catch(function (err) {
                                    console.error(err);
                                }));

                            case 19:
                                basic.showAlert('At this moment you don\'t have any possible withdraws (no running contracts or not ready to withdraw contracts).');
                                return _context4.abrupt("return", false);

                            case 21:
                            case "end":
                                return _context4.stop();
                        }
                    }
                }, _callee4, this);
            }));

            function withdrawToDentist() {
                return _ref4.apply(this, arguments);
            }

            return withdrawToDentist;
        }()
    },
    events: {},
    helper: {
        addBlockTimestampToTransaction: function addBlockTimestampToTransaction(transaction) {
            return new Promise(function (resolve, reject) {
                App.web3_1_0.eth.getBlock(transaction.blockNumber, function (error, result) {
                    if (error !== null) {
                        reject(error);
                    }
                    temporally_timestamp = result.timestamp;
                    resolve(temporally_timestamp);
                });
            });
        },
        getLoopingTransactionFromBlockTimestamp: function getLoopingTransactionFromBlockTimestamp(block_num) {
            return new Promise(function (resolve, reject) {
                App.web3_1_0.eth.getBlock(block_num, function (error, result) {
                    if (error !== null) {
                        reject(error);
                    }
                    resolve(result.timestamp);
                });
            });
        },
        getBlockNum: function getBlockNum() {
            return new Promise(function (resolve, reject) {
                App.web3_1_0.eth.getBlockNumber(function (error, result) {
                    if (!error) {
                        global_state.curr_block = result;
                        resolve(global_state.curr_block);
                    }
                });
            });
        },
        getAccounts: function getAccounts() {
            return new Promise(function (resolve, reject) {
                App.web3_1_0.eth.getAccounts(function (error, result) {
                    if (!error) {
                        resolve(result);
                    }
                });
            });
        },
        estimateGas: function estimateGas(address, function_abi) {
            return new Promise(function (resolve, reject) {
                App.web3_1_0.eth.estimateGas({
                    to: address,
                    data: function_abi
                }, function (error, result) {
                    if (!error) {
                        resolve(result);
                    }
                });
            });
        },
        getGasPrice: function getGasPrice() {
            return new Promise(function (resolve, reject) {
                App.web3_1_0.eth.getGasPrice(function (error, result) {
                    if (!error) {
                        resolve(result);
                    }
                });
            });
        },
        getAddressETHBalance: function getAddressETHBalance(address) {
            return new Promise(function (resolve, reject) {
                resolve(App.web3_1_0.eth.getBalance(address));
            });
        }
    }
};

function initDateTimePicker() {
    if ($(".form_datetime").length > 0) {
        $(".form_datetime").datetimepicker({ format: 'yyyy-mm-dd hh:ii' });
    }
}
initDateTimePicker();

//checking if passed address is valid
function innerAddressCheck(address) {
    return App.web3_1_0.utils.isAddress(address);
}

if ($('body').hasClass('home')) {
    if ($('.testimonials-slider').length > 0) {
        $('.testimonials-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 8000,
            adaptiveHeight: true
        });
    }

    if ($('.open-calculator').length > 0) {
        $('.open-calculator').click(function () {
            $.ajax({
                type: 'POST',
                url: '/get-calculator-html',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function success(response) {
                    if (response.success) {
                        basic.closeDialog();
                        basic.showDialog(response.success, 'calculator-popup', null, true);
                        $('.selectpicker').selectpicker('refresh');
                        fixButtonsFocus();

                        calculateLogic();
                    }
                }
            });
        });
    }
} else if ($('body').hasClass('patient-access')) {
    if ($('.ask-your-dentist-for-assurance').length) {
        $('.ask-your-dentist-for-assurance').click(function () {
            $('html, body').animate({ scrollTop: $('#find-your-dentist').offset().top }, 500);
            $('#find-your-dentist .search-dentist-input').focus();
            return false;
        });
    }

    //login
    $(document).on('successResponseCoreDBApi', function () {
        var _ref8 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee8(event) {
            var custom_form_obj;
            return _regeneratorRuntime.wrap(function _callee8$(_context8) {
                while (1) {
                    switch (_context8.prev = _context8.next) {
                        case 0:
                            if (event.response_data.token) {
                                custom_form_obj = {
                                    token: event.response_data.token,
                                    email: event.response_data.data.email,
                                    name: event.response_data.data.name,
                                    address: event.response_data.data.dcn_address,
                                    avatar_url: event.response_data.data.avatar_url,
                                    have_contracts: false,
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                };

                                //check if CoreDB returned address for this user and if its valid one

                                if (basic.objHasKey(custom_form_obj, 'address') != null && innerAddressCheck(custom_form_obj.address)) {
                                    //var current_dentists_for_logging_user = await App.assurance_methods.getWaitingContractsForPatient(custom_form_obj.address);
                                    //if(current_dentists_for_logging_user.length > 0) {
                                    //custom_form_obj.have_contracts = true;
                                    //}
                                }

                                customJavascriptForm('/patient/authenticate', custom_form_obj, 'post');
                            }

                        case 1:
                        case "end":
                            return _context8.stop();
                    }
                }
            }, _callee8, this);
        }));

        return function (_x7) {
            return _ref8.apply(this, arguments);
        };
    }());

    $(document).on('errorResponseCoreDBApi', function (event) {
        console.log(event, 'errorResponseCoreDBApi');
    });
} else if ($('body').hasClass('support-guide')) {
    if ($('.support-guide-slider').length) {
        $('.support-guide-slider').slick({
            slidesToShow: 3,
            slidesToScroll: 3
        });
    }

    if ($('.list .question').length > 0) {
        $('.list .question').click(function () {
            $(this).closest('li').find('.question-content').toggle(300);
        });
    }
}

//THIS IS FUNCTIONALITY ONLY FOR LOGGED IN USERS
if ($('body').hasClass('logged-in')) {
    $('.logged-user > a, .logged-user .hidden-box').hover(function () {
        $('.logged-user .hidden-box').show();
    }, function () {
        $('.logged-user .hidden-box').hide();
    });
}

function calculateLogic() {
    $('.calculate').click(function () {
        var patients_number = $('#number-of-patients').val();
        var params_type;
        if ($('#general-dentistry').is(':checked') && $('#cosmetic-dentistry').is(':checked') && $('#implant-dentistry').is(':checked')) {
            params_type = 'param_gd_cd_id';
        } else if ($('#general-dentistry').is(':checked') && $('#cosmetic-dentistry').is(':checked')) {
            params_type = 'param_gd_cd';
        } else if ($('#general-dentistry').is(':checked') && $('#implant-dentistry').is(':checked')) {
            params_type = 'param_gd_id';
        } else if ($('#cosmetic-dentistry').is(':checked') && $('#implant-dentistry').is(':checked')) {
            params_type = 'param_cd_id';
        } else if ($('#general-dentistry').is(':checked')) {
            params_type = 'param_gd';
        } else if ($('#cosmetic-dentistry').is(':checked')) {
            params_type = 'param_cd';
        } else if ($('#implant-dentistry').is(':checked')) {
            params_type = 'param_id';
        }

        var country = $('#country').val();
        var currency = $('#currency').val();

        if (patients_number == '' || parseInt(patients_number) <= 0) {
            basic.showAlert('Please enter valid number of patients per day.', '', true);
            return false;
        } else if (params_type == undefined) {
            basic.showAlert('Please select specialties.', '', true);
            return false;
        } else if (country == undefined) {
            basic.showAlert('Please select country.', '', true);
            return false;
        } else if (currency == undefined) {
            basic.showAlert('Please select currency.', '', true);
            return false;
        }
        var calculator_data = {
            'patients_number': patients_number.trim(),
            'params_type': params_type,
            'country': country.trim(),
            'currency': currency.trim()
        };

        $.ajax({
            type: 'POST',
            url: '/get-calculator-result',
            dataType: 'json',
            data: calculator_data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function success(response) {
                basic.closeDialog();
                basic.showDialog(response.success, 'calculator-result-popup', null, true);
                fixButtonsFocus();

                $('.calculate-again').click(function () {
                    $.ajax({
                        type: 'POST',
                        url: '/get-calculator-html',
                        dataType: 'json',
                        data: calculator_data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function success(response) {
                            if (response.success) {
                                basic.closeDialog();
                                basic.showDialog(response.success, 'calculator-popup', null, true);
                                $('.selectpicker').selectpicker('refresh');
                                fixButtonsFocus();

                                calculateLogic();
                            }
                        }
                    });
                });
            }
        });
    });
}

function customJavascriptForm(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for (var key in params) {
        if (params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}

//call the popup for login/sign for patient and dentist
function bindLoginSigninPopupShow() {
    if ($('.show-login-signin').length) {
        $('.show-login-signin').click(function () {
            $.ajax({
                type: 'POST',
                url: '/get-login-signin',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    var _ref9 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee12(response) {
                        var _customErrorHandle;

                        return _regeneratorRuntime.wrap(function _callee12$(_context12) {
                            while (1) {
                                switch (_context12.prev = _context12.next) {
                                    case 0:
                                        if (!response.success) {
                                            _context12.next = 18;
                                            break;
                                        }

                                        //INIT LOGIC FOR ALL STEPS
                                        _customErrorHandle = function _customErrorHandle(el, string) {
                                            el.append('<div class="error-handle">' + string + '</div>');
                                        };

                                        basic.closeDialog();
                                        basic.showDialog(response.success, 'login-signin-popup', null, true);

                                        $('.patient .form-register #privacy-policy-registration-patient').on('change', function () {
                                            if ($(this).is(':checked')) {
                                                $('.patient .form-register .facebook-custom-btn').removeAttr('custom-stopper');
                                                $('.patient .form-register .civic-custom-btn').removeAttr('custom-stopper');
                                            } else {
                                                $('.patient .form-register .facebook-custom-btn').attr('custom-stopper', 'true');
                                                $('.patient .form-register .civic-custom-btn').attr('custom-stopper', 'true');
                                            }
                                        });

                                        $(document).on('civicCustomBtnClicked', function () {
                                            var _ref10 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee9(event) {
                                                return _regeneratorRuntime.wrap(function _callee9$(_context9) {
                                                    while (1) {
                                                        switch (_context9.prev = _context9.next) {
                                                            case 0:
                                                                $('.patient .form-register .step-errors-holder').html('');

                                                            case 1:
                                                            case "end":
                                                                return _context9.stop();
                                                        }
                                                    }
                                                }, _callee9, this);
                                            }));

                                            return function (_x9) {
                                                return _ref10.apply(this, arguments);
                                            };
                                        }());

                                        $(document).on('facebookCustomBtnClicked', function () {
                                            var _ref11 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee10(event) {
                                                return _regeneratorRuntime.wrap(function _callee10$(_context10) {
                                                    while (1) {
                                                        switch (_context10.prev = _context10.next) {
                                                            case 0:
                                                                $('.patient .form-register .step-errors-holder').html('');

                                                            case 1:
                                                            case "end":
                                                                return _context10.stop();
                                                        }
                                                    }
                                                }, _callee10, this);
                                            }));

                                            return function (_x10) {
                                                return _ref11.apply(this, arguments);
                                            };
                                        }());

                                        $(document).on('customCivicFbStopperTriggered', function () {
                                            var _ref12 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime.mark(function _callee11(event) {
                                                return _regeneratorRuntime.wrap(function _callee11$(_context11) {
                                                    while (1) {
                                                        switch (_context11.prev = _context11.next) {
                                                            case 0:
                                                                _customErrorHandle($('.patient .form-register .step-errors-holder'), 'Please agree with our privacy policy.');

                                                            case 1:
                                                            case "end":
                                                                return _context11.stop();
                                                        }
                                                    }
                                                }, _callee11, this);
                                            }));

                                            return function (_x11) {
                                                return _ref12.apply(this, arguments);
                                            };
                                        }());

                                        $('.popup-header-action a').click(function () {
                                            $('.login-signin-popup .popup-body > .inline-block').addClass('custom-hide');
                                            $('.login-signin-popup .popup-body .' + $(this).attr('data-type')).removeClass('custom-hide');
                                        });

                                        $('.login-signin-popup .call-sign-up').click(function () {
                                            $('.login-signin-popup .form-login').hide();
                                            $('.login-signin-popup .form-register').show();
                                        });

                                        $('.login-signin-popup .call-log-in').click(function () {
                                            $('.login-signin-popup .form-login').show();
                                            $('.login-signin-popup .form-register').hide();
                                        });

                                        $('.dentist .form-register .prev-step').click(function () {
                                            var current_step = $('.dentist .form-register .step.visible');
                                            var current_prev_step = current_step.prev();
                                            current_step.removeClass('visible');
                                            if (current_prev_step.hasClass('first')) {
                                                $(this).hide();
                                            }
                                            current_prev_step.addClass('visible');

                                            $('.dentist .form-register .next-step').attr('data-current-step', current_prev_step.attr('data-step'));
                                        });

                                        //SECOND STEP INIT LOGIC
                                        //load address script
                                        _context12.next = 14;
                                        return $.getScript('/assets/js/address.js', function () {});

                                    case 14:

                                        $('#dentist-country').on('change', function () {
                                            $('.step.second .phone .country-code').html('+' + $(this).find('option:selected').attr('data-code'));
                                        });

                                        //THIRD STEP INIT LOGIC
                                        styleAvatarUploadButton();
                                        initCaptchaRefreshEvent();

                                        $('.dentist .form-register .next-step').click(function () {
                                            var this_btn = $(this);
                                            switch (this_btn.attr('data-current-step')) {
                                                case 'first':
                                                    var first_step_inputs = $('.dentist .form-register .step.first .custom-input');
                                                    var errors = false;
                                                    $('.dentist .form-register .step.first').parent().find('.error-handle').remove();
                                                    for (var i = 0, len = first_step_inputs.length; i < len; i += 1) {
                                                        if (first_step_inputs.eq(i).attr('type') == 'email' && !basic.validateEmail(first_step_inputs.eq(i).val().trim())) {
                                                            _customErrorHandle(first_step_inputs.eq(i).parent(), 'Please use valid email address.');
                                                            errors = true;
                                                        } else if (first_step_inputs.eq(i).attr('type') == 'password' && first_step_inputs.eq(i).val().length < 6) {
                                                            _customErrorHandle(first_step_inputs.eq(i).parent(), 'Passwords must be min length 6.');
                                                            errors = true;
                                                        }

                                                        if (first_step_inputs.eq(i).val().trim() == '') {
                                                            _customErrorHandle(first_step_inputs.eq(i).parent(), 'This field is required.');
                                                            errors = true;
                                                        }
                                                    }

                                                    if ($('.dentist .form-register .step.first .custom-input.password').val().trim() != $('.step.first .custom-input.repeat-password').val().trim()) {
                                                        _customErrorHandle($('.step.first .custom-input.repeat-password').parent(), 'Both passwords don\'t match.');
                                                        errors = true;
                                                    }

                                                    if (!errors) {
                                                        $('.dentist .form-register .step').removeClass('visible');
                                                        $('.dentist .form-register .step.second').addClass('visible');
                                                        $('.prev-step').show();

                                                        this_btn.attr('data-current-step', 'second');
                                                    }
                                                    break;
                                                case 'second':
                                                    var second_step_inputs = $('.dentist .form-register .step.second .custom-input');
                                                    var errors = false;
                                                    $('.dentist .form-register .step.second').find('.error-handle').remove();

                                                    //check custom-input fields
                                                    for (var i = 0, len = second_step_inputs.length; i < len; i += 1) {
                                                        if (second_step_inputs.eq(i).is('select')) {
                                                            //IF SELECT TAG
                                                            if (second_step_inputs.eq(i).val().trim() == '') {
                                                                _customErrorHandle(second_step_inputs.eq(i).parent(), 'This field is required.');
                                                                errors = true;
                                                            }
                                                        } else if (second_step_inputs.eq(i).is('input')) {
                                                            //IF INPUT TAG
                                                            if (second_step_inputs.eq(i).val().trim() == '') {
                                                                _customErrorHandle(second_step_inputs.eq(i).parent(), 'This field is required.');
                                                                errors = true;
                                                            }

                                                            if (second_step_inputs.eq(i).attr('type') == 'url' && !basic.validateUrl(second_step_inputs.eq(i).val().trim())) {
                                                                _customErrorHandle(second_step_inputs.eq(i).parent(), 'Please use valid website.');
                                                                errors = true;
                                                            } else if (second_step_inputs.eq(i).attr('type') == 'number' && !basic.validatePhone(second_step_inputs.eq(i).val().trim())) {
                                                                _customErrorHandle(second_step_inputs.eq(i).parent(), 'Please use valid numbers.');
                                                                errors = true;
                                                            }
                                                        }
                                                    }

                                                    //check custom radio buttons
                                                    if ($('.dentist .form-register .step.second [name="work-type"]:checked').val() == undefined) {
                                                        _customErrorHandle($('.dentist .form-register .step.second .radio-buttons-holder'), 'Please select one of the options.');
                                                        errors = true;
                                                    } else {
                                                        if ($('.dentist .form-register .step.second [name="work-type"]:checked').val() == 'an-associate-dentist') {
                                                            $('.dentist .form-register .step.third .search-for-clinic').html('<div class="padding-bottom-10"><input class="custom-input" type="text" minlength="6" maxlength="100" placeholder="Search for clinic"/></div>');

                                                            //bind the logic for the fresh appended input
                                                            var timer,
                                                                delay = 1000;
                                                            $('.search-for-clinic input[type="text"]').bind('keydown blur change', function (e) {
                                                                var this_input = $('.search-for-clinic input[type="text"]');
                                                                clearTimeout(timer);
                                                                timer = setTimeout(function () {
                                                                    $.ajax({
                                                                        type: 'POST',
                                                                        url: '/get-clinics-by-name/' + this_input.val().trim(),
                                                                        dataType: 'json',
                                                                        headers: {
                                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                        },
                                                                        success: function success(response) {
                                                                            if (response.success) {
                                                                                console.log(response.success);
                                                                            } else if (response.error) {
                                                                                basic.showAlert(response.error);
                                                                            }
                                                                        }
                                                                    });
                                                                }, delay);
                                                            });
                                                        } else {
                                                            $('.dentist .form-register .step.third .search-for-clinic').html('');
                                                        }
                                                    }

                                                    //check if error from google place suggester
                                                    if ($('.dentist .form-register .step.second .suggester-parent .alert.alert-warning').is(':visible')) {
                                                        _customErrorHandle($('.dentist .form-register .step.second .radio-buttons-holder'), 'Please select one of the options.');
                                                        errors = true;
                                                    }

                                                    if (!errors) {
                                                        $('.dentist .form-register .step').removeClass('visible');
                                                        $('.dentist .form-register .step.third').addClass('visible');

                                                        this_btn.attr('data-current-step', 'third');
                                                    }
                                                    break;
                                                case 'third':
                                                    $('.dentist .form-register .step.third').find('.error-handle').remove();
                                                    var errors = false;
                                                    //checking if empty avatar
                                                    if ($('.dentist .form-register .step.third #custom-upload-avatar').val().trim() == '') {
                                                        _customErrorHandle($('.step.third .step-errors-holder'), 'Please select avatar.');
                                                        errors = true;
                                                    }

                                                    //checking if no specialization checkbox selected
                                                    if ($('.dentist .form-register .step.third [name="specialization[]"]:checked').val() == undefined) {
                                                        _customErrorHandle($('.step.third .step-errors-holder'), 'Please select specialization/s.');
                                                        errors = true;
                                                    }

                                                    //check captcha length
                                                    if ($('.dentist .form-register .step.third #register-captcha').val().trim() == '' || $('.dentist .form-register .step.third #register-captcha').val().trim().length < 5) {
                                                        _customErrorHandle($('.step.third .step-errors-holder'), 'Please enter correct captcha.');
                                                        errors = true;
                                                    }

                                                    //check if privacy policy checkbox is checked
                                                    if (!$('.dentist .form-register .step.third #privacy-policy-registration').is(':checked')) {
                                                        _customErrorHandle($('.step.third .step-errors-holder'), 'Please agree with our privacy policy.');
                                                        errors = true;
                                                    }

                                                    if (!errors) {
                                                        console.log('submit to controller');
                                                    }
                                                    break;
                                            }
                                        });

                                    case 18:
                                    case "end":
                                        return _context12.stop();
                                }
                            }
                        }, _callee12, this);
                    }));

                    function success(_x8) {
                        return _ref9.apply(this, arguments);
                    }

                    return success;
                }()
            });
        });
    }
}
bindLoginSigninPopupShow();

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            //SHOW THE IMAGE ON LOAD
            $('.bootbox.login-signin-popup .dentist .form-register .step.third .avatar button label').css({ 'background-image': 'url("' + e.target.result + '")' });
            $('.bootbox.login-signin-popup .dentist .form-register .step.third .avatar button label .inner i').addClass('fs-0');
            $('.bootbox.login-signin-popup .dentist .form-register .step.third .avatar button label .inner .inner-label').addClass('fs-0');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function styleAvatarUploadButton() {
    if (jQuery(".upload-file.avatar").length) {
        jQuery(".upload-file.avatar").each(function (key, form) {
            var this_file_btn_parent = jQuery(this);
            this_file_btn_parent.find('button').append('<label for="custom-upload-avatar"><div class="inner"><i class="fa fa-plus" aria-hidden="true"></i><div class="inner-label">Add profile photo</div></div></label>');

            var inputs = document.querySelectorAll('.inputfile');
            Array.prototype.forEach.call(inputs, function (input) {
                var label = input.nextElementSibling,
                    labelVal = label.innerHTML;

                input.addEventListener('change', function (e) {
                    readURL(this);

                    var fileName = '';
                    if (this.files && this.files.length > 1) fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);else fileName = e.target.value.split('\\').pop();

                    /*if(fileName) {
                        if(load_filename_to_other_el)    {
                            $(this).closest('.form-row').find('.file-name').html('<i class="fa fa-file-text-o" aria-hidden="true"></i>' + fileName);
                        }else {
                            label.querySelector('span').innerHTML = fileName;
                        }
                    }else{
                        label.innerHTML = labelVal;
                    }*/
                });
                // Firefox bug fix
                input.addEventListener('focus', function () {
                    input.classList.add('has-focus');
                });
                input.addEventListener('blur', function () {
                    input.classList.remove('has-focus');
                });
            });
        });
    }
}

//hide bootbox popup when its clicked around him (outside of him)
function hidePopupOnBackdropClick() {
    $(document).on('click', '.bootbox', function () {
        var classname = event.target.className;
        classname = classname.replace(/ /g, '.');

        if (classname && !$('.' + classname).parents('.modal-dialog').length) {
            bootbox.hideAll();
        }
    });
}
hidePopupOnBackdropClick();