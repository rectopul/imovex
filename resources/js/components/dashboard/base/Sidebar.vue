<template>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark border-end" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading"></div>

                    <!-- <a class="nav-link" :href="route('dashboard.index')">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        Página Inicial
                    </a> -->

                    <a class="nav-link" :href="route('dashboard.property.index')">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        Imóveis
                    </a>

                    <a class="nav-link" :href="route('dashboard.contact.index')">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        Mensagens <span class="ms-1 rounded-pill badge bg-success">{{ newMessages }}</span>
                    </a>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#blog-collapse" aria-expanded="false" aria-controls="blog-collapse">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        Blog
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>
                    <div class="collapse" id="blog-collapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" :href="route('dashboard.blog.post.index')">
                                Posts
                            </a>
                            <a class="nav-link" :href="route('dashboard.blog.post.create')">
                                Novo Post
                            </a>
                            <a class="nav-link" :href="route('dashboard.blog.comment.index')">
                                Comentários
                            </a>
                            <a class="nav-link" :href="route('dashboard.blog.category.index')">
                                Categorias
                            </a>
                        </nav>
                    </div>
                    
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#faq-collapse" aria-expanded="false" aria-controls="faq-collapse">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        Dicionário
                        <div class="sb-sidenav-collapse-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>
                    <div class="collapse" id="faq-collapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" :href="route('dashboard.faq.index')">
                                Lista
                            </a>
                            <a class="nav-link" :href="route('dashboard.faq.create')">
                                Novo
                            </a>
                        </nav>
                    </div>

                    <a class="nav-link" :href="route('dashboard.configuration.create')">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        Configurações
                    </a>

                    <a class="nav-link" :href="route('dashboard.privacy.create')">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        Privacidade
                    </a>

                    <a class="nav-link" :href="route('dashboard.user.index')">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        Usuários
                    </a>

                    <a class="nav-link" href="#" @click.prevent="logout">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-power-off"></i>
                        </div>
                        Sair
                    </a>

                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
        props: {
            user: Object,
            newMessages: String
        },
        methods: {
            logout() {
                var self = this

                axios.post(self.route('dashboard.logout'))
                .then(function(response){
                    location.href = response.data.redirect
                })
            }
        },

    }
</script>

<style scoped>
    .nav-link {
        margin-left: 1rem;
        margin-right: 1rem;
        margin-bottom: 0.5rem;
        border-radius: 0.2rem;
    }

    .nav-link:hover {
        background: hsla(0, 0%, 100%, 0.13);
        opacity: 1;
    }

    .nav-link.active {
        background: hsla(0, 0%, 100%, 0.23) !important;
    }
</style>
