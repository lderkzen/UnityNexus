<template>
    <a class="font-semibold hover:text-gray-400" :class="{'font-bold': active}">
        <slot />
    </a>
</template>

<script>

export default {
    props: {
        active: Boolean
    }
}
</script>

<style scoped>

</style>
