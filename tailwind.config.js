module.exports = {
	content: [
		'./*.php',
		'./inc/**/*.php',
		'./assets/js/**/*.js',
	],
	theme: {
		extend: {
			colors: {
				comet: {
					page: '#E5E5E5',
					surface: '#FFFFFF',
					text: '#444444',
					muted: '#666666',
					border: '#D2D2D2',
					link: '#B91313',
					linkHover: '#E81E1E',
				},
			},
			fontFamily: {
				body: ['Georgia', 'Cambria', '"Palatino Linotype"', 'serif'],
				heading: ['"Droid Sans"', 'Helvetica', 'Arial', 'sans-serif'],
				display: ['"Droid Serif"', 'Georgia', 'serif'],
				ui: ['Verdana', 'Tahoma', 'Helvetica', 'Arial', 'sans-serif'],
				mono: ['"Courier New"', 'Courier', 'monospace'],
			},
			maxWidth: {
				site: '960px',
			},
		},
	},
};
