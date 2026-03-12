export default (() => {

  const main = document.querySelector('.tabs');

  main?.addEventListener('click', (event) => {

    const tabClicked = event.target.closest('.tab');
    if (!tabClicked) return;

    if (tabClicked.classList.contains('active-tab')) return;

    const tabActive = tabClicked.parentElement.querySelector('.active-tab');

    tabClicked.classList.add('active-tab');
    tabActive?.classList.remove('active-tab');

    const container = tabClicked.closest('.crud-form');

    const contentActive = container.querySelector(
      `.tab-content.active[data-tab="${tabActive.dataset.tab}"]`
    );

    const contentClicked = container.querySelector(
      `.tab-content[data-tab="${tabClicked.dataset.tab}"]`
    );

    contentActive?.classList.remove('active');
    contentClicked?.classList.add('active');

  });

})();