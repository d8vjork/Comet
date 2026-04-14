(function (api, config) {
	if (!api || !document.body) {
		return;
	}

	const root = document.documentElement;
	const body = document.body;
	const knownColorSchemes = config.colorSchemes || [];
	const knownLayouts = config.layouts || [];
	const fontFamilies = config.fontFamilies || {};

	const replaceBodyClass = function (prefix, value, knownValues) {
		knownValues.forEach(function (knownValue) {
			body.classList.remove(prefix + knownValue);
		});

		body.classList.add(prefix + value);
	};

	api('comet_color_scheme', function (setting) {
		setting.bind(function (value) {
			replaceBodyClass('scheme-', value, knownColorSchemes);
		});
	});

	api('comet_layout', function (setting) {
		setting.bind(function (value) {
			replaceBodyClass('layout-', value, knownLayouts);
		});
	});

	api('comet_font_family', function (setting) {
		setting.bind(function (value) {
			if (fontFamilies[value]) {
				root.style.setProperty('--comet-body-font', fontFamilies[value]);
			}
		});
	});

	api('comet_font_size', function (setting) {
		setting.bind(function (value) {
			root.style.setProperty('--comet-body-size', value);
		});
	});

	api('comet_footer_text', function (setting) {
		setting.bind(function (value) {
			const footer = document.querySelector('.site-footer__text');

			if (footer) {
				footer.innerHTML = value || footer.dataset.defaultText || '';
			}
		});
	});

	api('comet_show_post_author', function (setting) {
		setting.bind(function (value) {
			body.classList.toggle('has-hidden-post-author', !value);
		});
	});
}(window.wp && window.wp.customize, window.cometCustomizer || {}));
