<template>
    <div class="bg-default mt-10 p-2 rounded shadow-2xl">
        <div class="columns-2 flex items-center">
            <div class="w-full">
                <h1 class="text-3xl mb-2">{{title}}</h1>
            </div>
            <div class="w-full text-right">
                <ActionButton class="mr-2">Configure</ActionButton>
                <ActionButton variant="delete">Delete</ActionButton>
            </div>
        </div>
        <hr>
        <slot />
        <div class="mt-5 flex justify-end">
            <Link href="/group/create" as="div" class=""><ActionButton variant="Add">Add Group</ActionButton></Link>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            required: true
        }
    }
}
</script>

<style>

</style>
