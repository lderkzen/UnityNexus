<template>
    <Head title="UnityNexus" />

    <Nav />
    <div class="py-3">
        <div class="container mx-auto">
            <slot />
        </div>
    </div>
</template>

<script>
import Nav from "./Nav/Nav";

export default {
    components: { Nav }
}
</script>

