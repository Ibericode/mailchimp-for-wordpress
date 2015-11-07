(function() {
	'use strict';

	window.mc4wp = window.mc4wp || {};

	// dependencies
	var FormWatcher = require('./admin/form-watcher.js');
	var FormEditor = require('./admin/form-editor.js');
	var FieldHelper = require('./admin/field-helper.js');
	var FieldsFactory = require('./admin/fields-factory.js');
	var m = require('../third-party/mithril.js');

	// vars
	var context = document.getElementById('mc4wp-admin');
	var formContentTextarea = document.getElementById('mc4wp-form-content');
	var tabs = require ('./admin/tabs.js')(context);
	var settings = require('./admin/settings.js')(context);
	var fields = require('./admin/fields.js')(m);

	if( formContentTextarea ) {

		// instantiate form editor
		var formEditor = window.formEditor = new FormEditor( formContentTextarea );

		// run field factory (registers fields from merge vars & interest groupings of selected lists)
		var fieldsFactory = new FieldsFactory(settings,fields);
		fieldsFactory.work(settings.getSelectedLists());

		// instantiate form watcher
		var formWatcher = new FormWatcher( formEditor, settings, fields );

		// instantiate form field helper
		var fieldHelper = new FieldHelper( m, tabs, formEditor, fields );
		m.mount( document.getElementById( 'mc4wp-field-wizard'), fieldHelper );
	}

	// convenience methods
	window.mc4wp.toggleElement = function(selector) {
		var elements = document.querySelectorAll(selector);
		for( var i=0; i<elements.length;i++){
			var show = elements[i].clientHeight <= 0;
			elements[i].style.display = show ? '' : 'none';
		}
	}
	window.m = m;
	window.mc4wp_register_field = fields.register;
	window.mc4wp_deregister_field = fields.deregister;
})();