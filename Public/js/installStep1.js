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
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: preg_w
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
        }
    });
})(jQuery);