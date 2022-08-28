<template>
    <Head title="Groups" />
    <div>
        <SuperGroupCard v-for="supergroup of supergroups" :title="supergroup.name">
            <Group v-for="group of supergroup.groups" :group="group" />
        </SuperGroupCard>
    </div>
    <div class="mt-5 flex justify-end">
        <Link href="/groups/create" as="div">
            <ActionButton variant="add">Add supergroup</ActionButton>
        </Link>
    </div>

</template>

<script>

import SuperGroupCard from "../../Shared/Group/SuperGroupCard";
import Group from "../../Shared/Group/Group";

export default {
    name: 'GroupIndex',
    components: { SuperGroupCard, Group },
    props: {
        categories: Array,
    },

    data() {
        return {
            supergroups: [
                {
                    id: 1,
                    name: "Lost Ark",
                    position: 2,
                    groups: [
                        {
                            id: 100,
                            supergroup_id: 1,
                            channel_id: null,
                            name: "Lost Ark - Group 1",
                            description: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.",
                            recruiting: true,
                            position: 3,
                            created_at: "2022-08-02T12:12:12.000000Z",
                            updated_at: "2022-08-02T12:12:12.000000Z",
                            deleted_at: null,
                            channel: {},
                            form: []
                        },
                        {
                            id: 102,
                            supergroup_id: 1,
                            channel_id: null,
                            name: "Lost Ark - Group 3",
                            description: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.",
                            recruiting: false,
                            position: 20,
                            created_at: "2022-08-02T12:12:12.000000Z",
                            updated_at: "2022-08-02T12:12:12.000000Z",
                            deleted_at: null,
                            channel: {},
                            form: []
                        },
                        {
                            id: 101,
                            supergroup_id: 1,
                            channel_id: null,
                            name: "Lost Ark - Group 2",
                            description: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.",
                            recruiting: true,
                            position: 15,
                            created_at: "2022-08-02T12:12:12.000000Z",
                            updated_at: "2022-08-02T12:12:12.000000Z",
                            deleted_at: null,
                            channel: {},
                            form: []
                        }
                    ]
                },
                {
                    id: 2,
                    name: "Ashes of Creation",
                    position: 1,
                    groups: [
                        {
                            id: 103,
                            supergroup_id: 2,
                            channel_id: null,
                            name: "Home of Unity",
                            description: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.",
                            recruiting: true,
                            position: 5,
                            created_at: "2022-08-02T12:12:12.000000Z",
                            updated_at: "2022-08-02T12:12:12.000000Z",
                            deleted_at: null,
                            channel: {},
                            form: []
                        },
                        {
                            id: 105,
                            supergroup_id: 2,
                            channel_id: null,
                            name: "Hand of Unity",
                            description: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.",
                            recruiting: false,
                            position: 2,
                            created_at: "2022-08-02T12:12:12.000000Z",
                            updated_at: "2022-08-02T12:12:12.000000Z",
                            deleted_at: null,
                            channel: {},
                            form: []
                        }
                    ]
                },
                {
                    id: 3,
                    name: "New World",
                    position: 3,
                    groups: [
                        {
                            id: 110,
                            supergroup_id: 3,
                            channel_id: null,
                            name: "New World - Group 1",
                            description: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.",
                            recruiting: false,
                            position: 3,
                            created_at: "2022-08-02T12:12:12.000000Z",
                            updated_at: "2022-08-02T12:12:12.000000Z",
                            deleted_at: "2022-08-05T12:12:12.000000Z",
                            channel: {},
                            form: []
                        },
                        {
                            id: 111,
                            supergroup_id: 3,
                            channel_id: null,
                            name: "New World- Group 3",
                            description: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.",
                            recruiting: true,
                            position: 20,
                            created_at: "2022-08-02T12:12:12.000000Z",
                            updated_at: "2022-08-02T12:12:12.000000Z",
                            deleted_at: null,
                            channel: {},
                            form: []
                        },
                        {
                            id: 112,
                            supergroup_id: 3,
                            channel_id: null,
                            name: "New World - Group 2",
                            description: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.",
                            recruiting: true,
                            position: 15,
                            created_at: "2022-08-02T12:12:12.000000Z",
                            updated_at: "2022-08-02T12:12:12.000000Z",
                            deleted_at: null,
                            channel: {},
                            form: []
                        },
                        {
                            id: 113,
                            supergroup_id: 3,
                            channel_id: null,
                            name: "New World- Group 3",
                            description: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.",
                            recruiting: true,
                            position: 33,
                            created_at: "2022-08-02T12:12:12.000000Z",
                            updated_at: "2022-08-02T12:12:12.000000Z",
                            deleted_at: null,
                            channel: {},
                            form: []
                        },
                        {
                            id: 114,
                            supergroup_id: 3,
                            channel_id: null,
                            name: "New World - Group 4",
                            description: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.",
                            recruiting: true,
                            position: 23,
                            created_at: "2022-08-02T12:12:12.000000Z",
                            updated_at: "2022-08-02T12:12:12.000000Z",
                            deleted_at: null,
                            channel: {},
                            form: []
                        }
                    ]
                }
            ]
        }
    },

    created() {
        console.log({asd: this.$page.props})
    }
}
</script>
