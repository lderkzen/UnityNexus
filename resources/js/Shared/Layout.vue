<template>
    <Head title="UnityNexus" />

    <Nav />
    <div class="container mx-auto">
        <slot />
    </div>
</template>

<script>
import Nav from "./Nav/Nav";

export default {
    components: { Nav }
}
</script>
