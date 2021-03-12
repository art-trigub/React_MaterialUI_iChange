<li class="m-slider__item">
    <div class="m-slider__wrap">
        <div>
            <p class="m-slider__subtitle">[[hint]]</p>
            <p class="m-slider__title">[[title]]</p>
            <p class="m-slider__text">[[description]]</p>
        </div>
        <div class="m-slider__btn-wrap">
            [[if button_text]]
            <a class="btn btn_green" href="#">[[button_text]]</a>
            [[/if]]
            [[if link_text]]
            <a class="link link_green arrow-right" href="#">[[link_text]]</a>
            [[/if]]
        </div>
    </div>
    <div class="m-slider__img">
        [[if image]]
        <img src="[[imagePath]]" alt="">
        [[/if]]
    </div>
</li>