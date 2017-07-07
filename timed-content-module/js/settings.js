(function($){

	FLBuilder.registerModuleHelper('timed-content-module', {

		rules: {
			title: {
				required: true
			}
		},

    	init: function() {
        	var form      = $('.fl-builder-settings'),
            content_type  = form.find('select[name=content_type]'),
            expiry_action = form.find('select[name=expire_content_action]');

            content_type.on('change', $.proxy( this._toggle, this ) );
            expiry_action.on('change', $.proxy( this._toggle, this ) );

            $( this._toggle, this );
        },

		submit: function()
		{
			var self = this;
			var form   = $('.fl-builder-settings'),
			
				day    = parseInt( form.find('select[name=day]').val() ),
				month  = parseInt( form.find('select[name=month]').val() ),
				year   = parseInt( form.find('input[name=year]').val() ),
				hour   = parseInt( form.find('select[name="hours"]').val() ),
				minute = parseInt( form.find('select[name="minutes"]').val() ),
				date   = year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':00 ';

			if( Date.parse( date ) <= Date.now() ) {
				FLBuilder.alert( "Error! You should select date in the future." );
				return false;
			}

			return true;

		},

        _toggle: function () {
            var form        = $('.fl-builder-settings'),
                typography    = form.find('.fl-builder-settings-tabs a[href="#fl-builder-settings-tab-timed_typography"]'),
              	content_type  = form.find('select[name=content_type]').val(),
            	expiry_action = form.find('select[name=expire_content_action]').val();

            if( content_type != 'content' && expiry_action != 'msg' ) {
            	typography.hide();
            } else {
                typography.show();
            }
        },
	});
})(jQuery);