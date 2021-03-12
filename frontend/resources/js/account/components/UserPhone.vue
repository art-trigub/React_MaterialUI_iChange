<template>
    <div>
        <div v-for="(phone, i) in phones">
            <input type="hidden" :name="'User[phones][' + i + '][user_phone_id]'" :value="phone.user_phone_id"/>
            <input type="text" v-model="phone.value" :name="'User[phones][' + i + '][value]'">
            <button icon color="red" @click="removePhone(i)">
                delete
            </button>
        </div>
        <button type="button" class="btn btn-link" @click="addNewPhone"><i class="flaticon-plus"></i> Add new phone</button>
    </div>
</template>

<script>
    export default {
        props: {
            phones: {
                type: [Array],
                default: []
            }
        },
        data: () => ({
            models: this.phones
        }),
        methods: {
            addNewPhone() {
                this.models.push({});
            },

            removePhone(index) {
                this.models.splice(index, 1);
            }
        }
    }
</script>