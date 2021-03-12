window.onload = function () {

    document.querySelector('.mob-menu__burger').addEventListener('click', function () {
        this.classList.toggle('uk-open');
        document.querySelector('.mob-menu__popup').classList.toggle('uk-open');
    });

    document.querySelector('.mob-menu__btn-search').addEventListener('click', function () {
        document.querySelector('.mob-menu__burger').classList.remove('uk-open');
        document.querySelector('.mob-menu__popup').classList.remove('uk-open');
        const mobSearch = document.querySelector('.mob-search');
        mobSearch.classList.add('uk-open');
        setTimeout(function () {
            mobSearch.querySelector('.input').focus();
        }, 200);
    });

    document.querySelector('.mob-search__close').addEventListener('click', function () {
        document.querySelector('.mob-search').classList.remove('uk-open');
    })
};
