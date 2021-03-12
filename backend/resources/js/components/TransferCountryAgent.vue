<script>
    import qs from 'qs'
    export default {
        methods: {
            changeCourse(e, field, id) {
                e.preventDefault();
                let formData = new FormData(e.target);
                let inputId = parseInt(e.target.elements[1].id.split('-')[1]);

                this.$http.post(e.target.action, formData).then((response) => {
                    console.log(response);
                    let input = document.getElementById('course-' + (inputId + 1))
                    if(input) {
                        input.focus();
                        input.select();
                        // var val = input.value; //store the value of the element
                        // input.value = ''; //clear the value of the element
                        // input.value = val; //set that value back.
                    }

                }).catch((e) => {
                    console.error(e);
                })

                return false;
            }
        }
    }
</script>