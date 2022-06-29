<template>
    <Link class="font-semibold hover:text-gray-400" :class="{'font-bold': active}">
        <slot />
    </Link>
</template>

<script>
export default {
    props: {
        active: Boolean
    }
}
</script>
