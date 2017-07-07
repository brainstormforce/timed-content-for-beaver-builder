(function($){

	FLBuilder.registerModuleHelper('timed-content-module', {

		rules: {
			title: {
				required: true
			}
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
	});
})(jQuery);