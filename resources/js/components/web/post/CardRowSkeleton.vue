<template>
    
    <div class="d-flex flex-wrap align-items-stretch gap-custom">
        <div v-for="(card, index) in cards" :key="index" class="card post-card empty h-100 bg-gray-2 border-0" :class="{'mini': !image(index), 'max': image(index)}">
        
            <div v-if="image(index)" class="row h-100 d-flex flex-wrap g-0">
                <div class="col-6">
                    <div class="post-card-cover empty h-100"></div>
                </div>
                <div class="col-6">
                    <div class="post-data">
                        <h5 class="card-title post-card-title empty"></h5>
                        <p class="card-text post-card-description empty"></p>
                        <p class="card-text post-card-publish empty fs-14"></p>
                    </div>
                </div>
            </div>

            <div v-else class="post-data">
                <h5 class="card-title post-card-title empty"></h5>
                <p class="card-text post-card-description empty"></p>
                <p class="card-text post-card-publish empty"></p>
            </div>

        </div>
    </div>

</template>

<script>
    export default {
        props: {
            cards: Number
        },
        data() {
            return {
                fullPosts: [1, 4, 9, 12, 17, 20, 25, 28]
            }
        },
        methods: {

            image(index) {

                return this.fullPosts.includes(index)

            },

        },
        mounted() {
            this.$root.addSkeletonAnimationClasses('[class^="post-card-"].empty')
        }
    }
</script>

<style scoped>
    
    .gap-custom {
        gap: 20px;
    }

    .post-card { 
        height: 172px !important;
    }

    .post-data {
        padding-left: 1.510vw;
        padding-right: 1.510vw;
        padding-top: 1.875vw;
        padding-bottom: 1.875vw;
    }

    .post-card-cover {
        height: 172px;
        width: 100%;
    }


    .post-card-cover.empty,
    .post-card-title.empty,
    .post-card-description.empty,
    .post-card-publish.empty {
        background: var(--bs-gray-3);
        border-radius: 4px;
    }

    .post-card-title.empty,
    .post-card-publish.empty {
        height: 16px;
    }

    .post-card-title.empty {
        width: 80%;
    }

    .post-card-description.empty {
        height: 48px;
        width: 150px;
    }

    .post-card-publish.empty {
        width: 50%;
    }

    .mini {
        width: 245px;
    }

    .max {
        width: 490px;
    }

    @media (max-width: 1199.98px) {
        .mini {
            width: 180px;
        }

        .max {
            width: 380px;
            height: 172px !important;
        }
    }

    @media (max-width: 991.98px) {
        .mini {
            width: 48%;
        }

        .max {
            width: 48%;
        }
    }

    @media (max-width: 767.98px) {
        .mini {
            width: 100%;
        }

        .max {
            width: 100%;
        }
    }

</style>