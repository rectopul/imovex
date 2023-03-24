<template>
	<aside>
        <div class="row">
            
            <div v-if="posts" class="col">
                <nav class="nav flex-column border border-gray-3 rounded-5">
            
                    <span class="nav-link fs-13 fw-semi-bold text-dark nav-title">Os mais lidos</span>
                    
                    <a v-for="(post, index) in posts" :key="post.id" class="nav-link d-flex mb-3" :href="route('web.blog.post.show', post)">
                        <span class="fs-30 fw-semi-bold me-2">{{ index + 1 }}</span>
                        <div>
                            <p class="m-0 fs-13 fw-bold lh-1 mb-2 text-info">{{ post.title }}</p>
                            <p class="m-0 fs-13 fw-light lh-16 mb-1">{{ post.description }}</p>
                            <p class="m-0 fs-14 fw-medium text-info">{{ post.publish }}</p>
                        </div>
                    </a>

                </nav>
            </div>

            <div v-if="categories" class="col">
                <nav id="categories-nav" class="nav flex-column border border-gray-3 rounded-5">
            
                    <span class="nav-link fs-13 fw-semi-bold text-dark nav-title">Categorias mais lidas</span>
                    
                    <a v-for="category in categories" :key="category.index" class="nav-link fs-13 fw-bold text-info" :href="route('web.blog.index', {categoria: category.name})">
                        {{ category.name }}
                    </a>

                </nav>
            </div>

        </div>
        


        

	</aside>
</template>

<script>

	export default {
		props: {
            posts: [],
            categories: []
        }
	}

</script>

<style scoped>
    
    #categories-nav { margin-top: 1.25rem; }

    .nav-title {
        margin-bottom: 1.25rem !important;
    }

    nav {
        padding: 1.688rem 1.5rem;
    }

    .nav-link {
        padding: 0;
    }

    a {
        text-decoration: none;
        color: inherit;
    }
    
    a:hover {
        color: initial;
    }

    @media (min-width: 576px) and (max-width: 991.98px) { 
        #categories-nav { margin-top: 0; }
    }
</style>