<template>
    <div>
        <button class="btn btn_green" uk-toggle="target: #call-me-modal">Call me back</button>

        <div class="popup" id="call-me-modal" uk-modal>
            <span @click="test()">test</span>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            test() {
                alert('It\s OK');
            }
        }
    }
</script>