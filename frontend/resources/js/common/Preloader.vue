<template>
    <div class="preloader-container">
        <div class="spinningCircle"></div>
    </div>
</template>

<style lang="scss" scoped>

    .preloader-container{
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .spinningCircle {
        height: 40px;
        width: 40px;
        border-radius: 50%;
        border: 4px solid rgba(255,255,255,0);
        border-top-color: 4px solid rgba(62, 62, 62, 0.7);
        border-right-color: 4px solid rgba(62, 62, 62, 0.7);
        -webkit-animation: single2 4s infinite linear;
        animation: single2 4s infinite linear;
    }

    @-webkit-keyframes single2 {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
            border-top-color: rgba(62, 62, 62, 0.7);;
            border-right-color: rgba(62, 62, 62, 0.7);;
        }
        50% {
            border-top-color: rgba(62, 62, 62, 0.7);;
            border-right-color: rgba(62, 62, 62, 0.7);;
        }
        100% {
            -webkit-transform: rotate(720deg);
            transform: rotate(720deg);
            border-top-color: rgba(62, 62, 62, 0.7);;
            border-right-color: #7fc4d1;
        }
    }

    @keyframes single2 {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
            border-top-color: #7fc4d1;
            border-right-color: #7fc4d1;
        }
        50% {
            border-top-color: #1f4f58;
            border-right-color: #1f4f58;
        }
        100% {
            -webkit-transform: rotate(720deg);
            transform: rotate(720deg);
            border-top-color: #7fc4d1;
            border-right-color: #7fc4d1;
        }
    }
</style>