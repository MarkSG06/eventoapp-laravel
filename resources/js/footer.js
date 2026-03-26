	const headers = document.querySelectorAll('.faqs-item-header');

	headers.forEach(header => {
		header.addEventListener('click', (event) => {
			event.stopPropagation();

			const faq = header.closest('.faqs-item');
			const answer = faq.querySelector('.faqs-item-answer');
			const isOpen = !answer.classList.contains('hide');

			document.querySelectorAll('.faqs-item-answer').forEach(answer => answer.classList.add('hide'));
			document.querySelectorAll('.faqs-item-icon').forEach(icon => icon.textContent = '+');

			if (!isOpen) {
				answer.classList.remove('hide');
				header.querySelector('.faqs-item-icon').textContent = '-';
			}
		});
	});