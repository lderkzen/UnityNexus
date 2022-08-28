<template>
    <button :class="['px-2 py-1 text-center rounded min-w-[6rem] shadow-md hover:ring', variantClassList]">
        <slot />
    </button>

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
                    return "bg-lime-700 hover:ring-lime-900 focus:bg-lime-800";
                case "delete":
                    return "bg-rose-700 hover:ring-rose-900 focus:bg-rose-800";
                default:
                    return "bg-sky-700 hover:ring-sky-900 focus:bg-sky-800";
            }
        }
    }
}
</script>
