<template>

    <form @submit.prevent="login" id="login-form" :action="route('dashboard.auth.login.store')" method="POST" class="mt-5">

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary w-100">Acessar</button>
        </div>
        <div class="text-center">
            <a href="" class="text-info text-decoration-none">Esqueceu sua senha ?</a>
        </div>

    </form>


</template>

<script>

    import Form from '@/services/Form'


    export default {

        methods: {
            login() {
                
                Form.post(this.$el)
                
            }
        },
        
    }
</script>

<style scoped>
    .la { font-size: 1.4rem; color: var(--bs-gray); }

    .form-control:focus { box-shadow: none; }

    .invalid-feedback { font-size: 0.8rem; }
</style>