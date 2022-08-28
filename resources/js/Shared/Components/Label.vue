<template>
    <span :class="['px-3 py-1 text-sm text-center rounded-full min-w-[4rem]', variantClassList]">
        <slot />
    </span>
</template>

<script>
export default {
    props: {
        variant: {
            type: String,
            default: "Default"
        }
    },
    computed: {
        variantClassList() {
            switch (this.variant.toLowerCase()) {
                case "add":
                    return "bg-lime-500 text-black";
                case "delete":
                    return "bg-rose-500";
                default:
                    return "bg-sky-500";
            }
        }
    }
}
</script>
