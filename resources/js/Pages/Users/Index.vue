<template>
    <Head title="Members" />
    <div>
        <h1 class="text-4xl">User Index</h1>
    </div>
</template>

<script>
export default {
    name: 'MemberIndex',
    props: {
        users: Array,
    },
}
</script>
