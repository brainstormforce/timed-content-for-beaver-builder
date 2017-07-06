/*(function($){

	FLBuilder.registerModuleHelper('timedContent', {

		rules: {
			day: {
				required: true
			},
			month: {
				required: true
			},
			year: {
				required: true
			}
		},
		
		submit: function(){

			var self = this;
			var form   = $('.fl-builder-settings'),
				day    = parseInt( form.find('select[name=day]').val() ),
				month  = parseInt( form.find('select[name=month]').val() ),
				year   = parseInt( form.find('input[name=year]').val() ),
				hour   = parseInt( form.find('select[name="hours]').val() ),
				minute = parseInt( form.find('select[name="minutes]').val() ),
				date   = year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':00 ';

			if( !this._validateDate( day, 'day' ) ){
				FLBuilder.alert( FLBuilderStrings.enterValidDay );
				return false;				
			} else if( !this._validateDate( month, 'month' ) ){
				FLBuilder.alert( FLBuilderStrings.enterValidMonth );
				return false;				
			} else if( !this._validateDate( year, 'year' ) ){
				FLBuilder.alert( FLBuilderStrings.enterValidYear );
				return false;				
			} else if( Date.parse( date ) <= Date.now() ) {
				FLBuilder.alert( FLBuilderStrings.countdownDateisInThePast );
				return false;
			}

			return true;

		},

		_isPositiveInteger: function( n ) {
		    return n >>> 0 === parseFloat( n );
		},

		_validateDate: function( date, part ){
			var self     = this,
				form     = $('.fl-builder-settings'),
				day      = parseInt( form.find('select[name=day]').val() ),
				month    = parseInt( form.find('select[name=month]').val() ),
				year     = parseInt( form.find('input[name=year]').val() ),
				fullDays = new Date( year, month, 0 ).getDate();

			if( isNaN( date ) || !this._isPositiveInteger( date ) ){
				return false;
			} else {
				switch( part ){
					case 'day':
						return date <= fullDays;
						break;
					case 'month':
						return date <= 12;
						break;
					case 'year':
						return date >= new Date().getFullYear();
						break;
				}				
			}
		},
	
	});

})(jQuery);*/