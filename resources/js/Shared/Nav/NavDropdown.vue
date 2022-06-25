<template>
    <div>
        <span class="font-semibold align-middle hover:text-gray-400 hover:cursor-pointer">{{ label }} <span class="text-xs">▼</span></span>
        <div class="hidden">
            <slot />
        </div>
    </div>
</template>

<script>
import NavAnchor from "./NavAnchor";
import NavLink from "./NavLink";

export default {
    components: { NavAnchor, NavLink },
    props: {
        label: String,
    }
}
</script>
