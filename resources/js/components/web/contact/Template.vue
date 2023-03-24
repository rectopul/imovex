<template>
    <section id="contact">

        <div class="container-xxl">
            <slot name="header"></slot>
            
            <div class="row">
                <slot name="message"></slot>
                <slot name="form"></slot>
            </div>

        </div>

    </section>
</template>