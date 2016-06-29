;(function($){
    $('#dataForm').bootstrapValidator({
        message: '这个选项未通过验证',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            dbname: {
                message: noValidate,
                validators: {
                    notEmpty: {
                        message: noempty
                    },
                    maxLength   : {
                        max: 30,
                        message: maxLength30
                    },
                    regexp: {
                        regexp: /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9a-zA-Z_]+$/,
                        message: preg_w_wn
                    }
                }
            },
            uname: {
                message: noValidate,
                validators: {
                    notEmpty: {
                        message: noempty
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: preg_w
                    }
                }
            },
            passWord: {
                validators: {
                    notEmpty: {
                        message: noempty
                    }
                }
            },
            dbhost: {
                validators: {
                    notEmpty: {
                        message: noempty
                    }
                }
            },
            domain: {
                validators: {
                    notEmpty: {
                        message: noempty
                    }
                }
            },
            siteCode: {
                validators: {
                    notEmpty: {
                        message: noempty
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: noempty
                    },
                    emailAddress: {
                        message: emailValidate
                    }
                }
            },
            siteName: {
                validators: {
                    notEmpty: {
                        message: noempty
                    }
                }
            }
        }
    });
})(jQuery);
