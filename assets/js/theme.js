(function () {
	const onReady = function (callback) {
		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', callback, { once: true });
			return;
		}

		callback();
	};

	onReady(function () {
		const navigation = document.querySelector('.top-navigation');

		if (!navigation) {
			return;
		}

		const button = navigation.querySelector('.menu-toggle');
		const menu = navigation.querySelector('.menu');

		if (!button || !menu) {
			return;
		}

		button.addEventListener('click', function () {
			const expanded = button.getAttribute('aria-expanded') === 'true';
			button.setAttribute('aria-expanded', String(!expanded));
			menu.classList.toggle('is-open', !expanded);
			navigation.classList.toggle('is-open', !expanded);
		});
	});
}());
