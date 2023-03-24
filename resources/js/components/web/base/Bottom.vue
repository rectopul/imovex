<template>
	<section>
        <footer class="bg-gray-2 py-2">
            <div class="container-xxl">
                <div class="row align-items-center">
                
                    <div class="col-12 col-md-8 col-lg-4 col-xl-5">
                        <ul class="nav flex-row flex-sm-row justify-content-center justify-content-lg-start align-items-center">
                            <li class="nav-item">
                                <a class="nav-link fs-14 fw-bold" :href="route('web.about.index')">Sobre Nós</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-14 fw-bold" :href="route('web.faq.index')">Dúvidas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-14 fw-bold" :href="route('web.contact.create')">Contato</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-14 fw-bold" :href="route('web.privacy.index')">Privacidade</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-12 col-md-4 col-lg-4 col-xl-2 text-center">
                        <img v-if="logo" :src="logo" alt="Logo Imóvel Explorer">
                    </div>

                    <div class="col-12 col-md-8 col-lg-4 col-xl-5 text-center text-xl-end social-links">
                        <span class="phone fs-14 fw-bold me-4">
                            <whatsapp-icon /> {{ whatsapp }}
                        </span>
                        <span class="">
                            <a v-if="facebook" :href="'https://www.facebook.com/'+facebook" target="_blank">
                                <facebook-icon />
                            </a>
                            <a v-if="instagram" :href="'https://www.instagram.com/'+instagram" target="_blank">
                                <instagram-icon />
                            </a>
                            <a v-if="youtube" :href="'https://www.youtube.com/'+youtube" target="_blank">
                                <youtube-icon />
                            </a>
                        </span>
                    </div>
                </div>
            </div>

            

        </footer>
        <div class="text-center bottom fs-14 fw-light text-gray-5 bg-white py-3">
            <p class="m-0">Copyright © 2020-{{ site }}. Todos os direitos reservados. </p>
            <p class="m-0">{{ company }} CNPJ: {{ cnpj }} - Endereço: {{ address }}</p>
        </div>
    </section>
</template>

<script>
    
    export default {
        
        props: {
            logo: String,
            whatsapp: String,
            facebook: String,
            instagram: String,
            youtube: String,
            company: String,
            cnpj: String,
            address: String,
            site: String
        }
    }
</script>

<style scoped>
    footer { 
        margin-top: 4.063rem;
    }

    footer > * {
        font-weight: bold !important;
    }

    a { color: inherit; }

    a:hover { color: var(--bs-primary) }

    img { height: 3.969rem; }

</style>