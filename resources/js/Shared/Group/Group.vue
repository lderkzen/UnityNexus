<template>
    <div class="py-2">
        <div class="columns-3 pl-5 flex items-top">
            <div class="w-full">
                <span>{{ group.name }}</span>
                <div class="w-full pl-4">
                    <Link :href="`/applications?groups=${group.id}`">> See applications</Link>
                </div>
                <div class="w-full pl-4">
                    <Link :href="`/members?groups=${group.id}`">> See members</Link>
                </div>
            </div>
            <div class="w-full">
                <div class="flex align-items-start flex-row flex-wrap">
                    <Label v-if="group.recruiting" variant="add" >Is recruiting</Label>
                    <Label v-else variant="delete" >Is not recruiting</Label>
                    <Label v-if="group.deleted_at" variant="delete" >Deleted</Label>
                </div>
            </div>
            <div class="w-full text-right">
                <ActionButton v-if="group.recruiting">Apply</ActionButton>
            </div>
        </div>
    </div>
    <hr>

</template>

<script>
import Label from "../Components/Label";

export default {
    components: {
        Label
    },
    props: {
        group: {
            type: Object,
            required: true
        }
    }
}
</script>

