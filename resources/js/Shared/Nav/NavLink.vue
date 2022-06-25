<template>
    <Link class="font-semibold hover:text-gray-400" :class="{'font-bold': active}">
        <slot />
    </Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3"

export default {
    components: { Link },
    props: {
        active: Boolean
    }
}
</script>
