<template>

    <a :href="link" class="card post-card h-100 bg-gray-2 border-0" :class="{'mini': !image, 'max': image}">
        
        <div v-if="image" class="row h-100 d-flex flex-wrap g-0">
            <div class="col-6">
                <div class="post-card-cover h-100">
                    <img v-if="post.cover" :src="post.cover" class="img-fluid" :alt="post.title">
                </div>
            </div>
            <div class="col-6">
                <div class="post-data">
                    <h5 class="card-title post-card-title fs-15 text-info">{{ post.short_title }}</h5>
                    <p class="card-text post-card-description fs-13 lh-16 fw-light" v-html="post.short_description"></p>
                    <p class="card-text post-card-publish fs-14 fw-medium text-info">{{ post.publish }}</p>
                </div>
            </div>
        </div>

        <div v-else class="post-data">
            <h5 class="card-title post-card-title fs-15 text-info">{{ post.short_title }}</h5>
            <p v-if="post.short_description" class="card-text post-card-description fs-13 lh-16 fw-light" v-html="post.short_description"></p>
            <p class="card-text post-card-publish fs-14 fw-medium text-info">{{ post.publish }}</p>
        </div>
    </a>

</template>

<script>
    export default {
        props: {
            image: Boolean,
            post: {
                type: Object,
                default: {}
            }
        },
        computed: {
            link() {
                return this.post.title ? this.route('web.blog.post.show', this.post) : '#'
            }
        }
    }
</script>

<style scoped>

    .post-card { 
        text-decoration: none; 
        color: inherit;
        height: 172px !important;
    }

    .post-data {
        padding-left: 1.510vw;
        padding-right: 1.510vw;
        padding-top: 1.875vw;
        padding-bottom: 1.875vw;
    }

    .post-card-title {
        font-weight: bold;
    }

    .post-card-cover > img {
        /* height: 100%; */
        height: 172px;
        width: 100%;
        object-fit: cover;
    }


    .post-card-cover:empty,
    .post-card-title:empty,
    .post-card-description:empty,
    .post-card-publish:empty {
        background: var(--bs-gray-3);
        border-radius: 4px;
    }

    .post-card-title:empty,
    .post-card-publish:empty {
        height: 16px;
    }

    .post-card-title:empty {
        width: 80%;
    }

    .post-card-description:empty {
        height: 48px;
        width: 150px;
    }

    .post-card-publish:empty {
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
            height: 100% !important;
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