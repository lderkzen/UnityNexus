<template>
    <Nav />
    <div class="px-16 pt-14 pb-8">
        <div class="p-2 bg-default rounded-md">
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
