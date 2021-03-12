export default {
    methods: {
        toFixed(val, pr) {
            pr = pr || 2;
            return parseFloat(val).toFixed(pr + 1).slice(0, -1);
        }
    },
    computed: {

    }
}