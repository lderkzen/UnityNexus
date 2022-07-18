<template>
    <Head title="Categories" />
    <Link href="/categories/create" as="button" class="pb-2">
        <h3 class="text-2xl hover:underline">Create a new category... <b class="text-green-500">+</b>
        </h3>
    </Link>
    <br />
    <table class="min-w-full border-collapse">
        <thead>
            <tr class="text-left">
                <th>Category</th>
                <th>Members</th>
                <th>Application</th>
                <th>Open / Closed</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="category in categories" :key="category.id" class="border-y border-default-accent">
                <td class="indent-3 font-semibold">{{ category.name }}</td>
                <td>{{ category.member_count }}</td>
                <td>
                    <Link href="#" class="hover:underline hover:text-gray-400">Application</Link>
                    <Link href="#" as="button" class="px-2 py-1 my-1 ml-3 bg-blue-500 rounded-md hover:bg-blue-600">Edit</Link>
                </td>
                <td>{{ category.status }}</td>
                <td><Link href="#" as="button" class="px-2 py-1 my-1 bg-blue-500 rounded-md hover:bg-blue-600">Edit</Link></td>
                <td><Link href="#" as="button" class="px-2 py-1 my-1 bg-red-500 rounded-md hover:bg-red-600">Delete</Link></td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: 'CategoryIndex',
    props: {
        categories: Array,
    },
}
</script>
