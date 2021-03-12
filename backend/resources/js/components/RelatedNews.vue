<template>
    <v-app class="related-news">

        <v-card
                color="red lighten-2"
                dark
        >
            <v-card-title class="headline red lighten-3">
                Search for News
            </v-card-title>

            <v-card-text>
                <v-autocomplete
                        v-model="model"
                        :items="items"
                        :loading="isLoading"
                        :search-input.sync="search"
                        color="white"
                        hide-no-data
                        hide-selected
                        item-text="title"
                        item-value="title"
                        label="All News"
                        placeholder="Start typing to Search"
                        prepend-icon="mdi-database-search"
                        return-object
                >

                    <template slot="item" slot-scope="{ item, index }">
                        <v-avatar
                                :tile="false"
                                :size="50"
                                color="grey lighten-4"
                        >
                            <img :src="item.imagePath"/>
                        </v-avatar>
                        <span style="margin-left:10px;">{{item.title}}</span>
                    </template>
                    <template slot="selection" slot-scope="{ item, index }">
                        <v-avatar
                                :tile="false"
                                :size="50"
                                color="grey lighten-4"
                        >
                            <img :src="item.imagePath"/>
                        </v-avatar>
                        <span style="margin-left:10px;">{{item.title}}</span>
                    </template>
                </v-autocomplete>


            </v-card-text>
            <v-divider></v-divider>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                        :disabled="!model"
                        color="grey darken-3"
                        @click="model = null"
                >
                    Clear
                    <v-icon right>mdi-close-circle</v-icon>
                </v-btn>

                <v-btn
                        :disabled="!model"
                        @click="add"
                >
                    Add
                    <v-icon right>mdi-close-circle</v-icon>
                </v-btn>
            </v-card-actions>
        </v-card>


        <draggable v-model="relatedNews" tag="div" class="related-news__list">
            <div class="relaxed-news__item" v-for="(item, i) in relatedNews">

            </div>
        </draggable>
    </v-app>
</template>


<script>
    import draggable from 'vuedraggable'
    import Vue from 'vue'

    export default {
        props: {
            related: {
                type: [Array],
                default: []
            }
        },

        components: { draggable },

        data: () => ({
            descriptionLimit: 60,
            entries: [],
            isLoading: false,
            model: null,
            search: null,
            relatedNews: []
        }),

        methods: {
            add() {

            }
        },

        computed: {
            fields () {
                if (!this.model) return []

                return Object.keys(this.model).map(key => {
                    return {
                        key,
                        value: this.model[key] || 'n/a'
                    }
                })
            },
            items () {
                return this.entries.map(entry => {
                    const title = entry.title.length > this.descriptionLimit
                        ? entry.title.slice(0, this.descriptionLimit) + '...'
                        : entry.title

                    return Object.assign({}, entry, { title })
                })
            }
        },

        watch: {
            search (val) {
                // Items have already been loaded
                if (this.items.length > 0) return

                // Items have already been requested
                if (this.isLoading) return

                this.isLoading = true

                // Lazily load input items
                fetch('/news/get-all')
                    .then(res => res.json())
                    .then(res => {
                        const { count, entries } = res
                        this.count = count
                        this.entries = entries
                    })
                    .catch(err => {
                        console.log(err)
                    })
                    .finally(() => (this.isLoading = false))
            }
        }
    }
</script>


<style lang="scss" scoped>

</style>