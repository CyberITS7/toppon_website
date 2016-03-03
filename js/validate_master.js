(function($) {

    $.fn.validateRequired = function( options ) {

        // Establish our default settings
        var bool=false;
        var settings = $.extend({
            text         : '',
            errMsg       : 'This field is required !',
            errColor     : '#e74c3c',
            color        : '',
            fontStyle    : null,
            complete	 : null
        }, options);

        this.each( function() {
            var input = $(this).val();
            var label_err = $(this).attr("data-label");
            $(label_err).html("");

            if(!validateEmpty(input)){
                $(label_err).css( 'font-size', '12px').html(settings.errMsg);
            }else{
                bool=true;
            }

        });
        return bool;
    };

    $.fn.validateImgType = function( options ) {

        // Establish our default settings
        var bool=false;
        var settings = $.extend({
            text         : '',
            errMsg       : 'This file type is not allowed !',
            errColor     : '#e74c3c',
            color        : '',
            fontStyle    : null,
            complete	 : null
        }, options);

        this.each( function() {
            var input = $(this).val();
            var label_err = $(this).attr("data-label");
            $(label_err).html("");

            var type = this.files[0].type;

            if(type!="image/jpeg" && type!="image/png"){
                $(label_err).css( 'font-size', '12px').html(settings.errMsg);
            }else {
                bool=true;
            }
        });
        return bool;
    };

    $.fn.validateMaxSize = function( options ) {

        // Establish our default settings
        var bool=false;
        var settings = $.extend({
            text         : '',
            errMsg       : 'Max size must be ',
            errColor     : '#e74c3c',
            color        : '',
            size         : '2 Mb',
            max_size	 : 1000*1000*2
        }, options);

        this.each( function() {
            var size = this.files[0].size;
            var input = $(this).val();
            var label_err = $(this).attr("data-label");
            $(label_err).html("");

            if(settings.max_size < size){
                $(label_err).css( 'font-size', '12px').html(settings.errMsg+settings.size);
            }else {
                bool=true;
            }
        });
        return bool;
    };

    $.fn.saveData = function( options ) {

        // Establish our default settings
        var settings = $.extend({
            errMsg       : 'Max size must be ',
            errColor     : '#e74c3c',
            url          : '',
            data         : '',
            locationHref : ''
        }, options);

        return this.each( function() {
            $.ajax({
                url: settings.url,
                data: settings.data,
                type: "POST",
                dataType: 'json',
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    if(data.status != 'error') {
                        alertify.success(data.msg);
                        location.href = settings.locationHref;
                    }else{
                        alertify.error(data.msg);
                    }
                },
                error: function(xhr, status, error) {
                    //var err = eval("(" + xhr.responseText + ")");
                    //alertify.error(xhr.responseText);
                    alertify.error('Cannot response server !');
                }
            });
        });
    };

    $.fn.deleteData = function( options ) {

        // Establish our default settings
        var settings = $.extend({
            alertMsg     : '',
            alertTitle   : '',
            url          : '',
            data         : '',
            locationHref : ''
        }, options);

        return this.each( function() {
            alertify.confirm(settings.alertMsg,
                function(){
                    // Confirm Action
                    // ajax mulai disini
                    $.ajax({
                        url: settings.url,
                        data: settings.data,
                        type: "POST",
                        dataType: 'json',
                        cache:false,
                        contentType: false,
                        processData: false,
                        success:function(data){
                            if(data.status != 'error') {
                                alertify.success(data.msg);
                                location.href = settings.locationHref;
                            }else{
                                alertify.error(data.msg);
                            }
                        },
                        error: function(xhr, status, error) {
                            //var err = eval("(" + xhr.responseText + ")");
                            //alertify.error(xhr.responseText);
                            alertify.error('Cannot response server !');
                        }
                    });
                }
            ).setHeader(settings.alertTitle);
        });
    };

    function validateEmpty(input){
        if(input == "" || input == null){
            return false;
        }else{
            return true;
        }
    }

    function checkAll(){
        return bool;
    }

}(jQuery));
