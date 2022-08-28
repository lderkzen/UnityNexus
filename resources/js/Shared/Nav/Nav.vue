<template>
    <nav class="z-50 min-w-full bg-navbar shadow-lg">
        <div class="flex flex-row justify-between items-center">
            <ul class="flex flex-row items-center space-x-1">
                <li class="ml-2"><NavLink href="/" class="py-3 pr-2 pl-3" :active="$page.component === 'App'"><img src="/images/hou_logo_small.png" alt="HoU Logo"></NavLink></li>
                <li><NavLink href="/" class="py-3 pr-2" :active="$page.component === 'App'">UnityNexus</NavLink></li>
                <li><NavLink href="/members" class="py-3 pr-2 pl-3" :active="$page.component === 'MemberIndex'">Members</NavLink></li>
                <li><NavLink href="/groups" class="py-3 pr-2 pl-3" :active="$page.component === 'GroupIndex'">Groups</NavLink></li>
            </ul>
            <ul class="flex flex-row items-center space-x-1 mr-2">
                <li>
                    <NavDropdown class="py-3 px-2 pr-3" :label="$page.props.auth.data.username">
                        <NavLink href="#" as="button" method="POST">Logout</NavLink>
                    </NavDropdown>
                </li>
                <li>
                    <button @click="toggleTheme">Toggle Theme</button>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
import NavAnchor from "./NavAnchor";
import NavBrand from "./NavBrand";
import NavLink from "./NavLink";
import NavDropdown from "./NavDropdown";

export default {
    components: { NavAnchor, NavBrand, NavLink, NavDropdown },

    created() {
        const userTheme = localStorage.getItem("theme")
        const systemTheme = window.matchMedia("(prefers-color-scheme: dark)").matches;
        //document.documentElement.classList.toggle("dark");
        console.log({asd: this.$page.props.auth})
    },

    methods: {
        toggleTheme() {
            document.documentElement.classList.toggle("dark");
        }
    }
}
</script>

<style>
nav li img {
    height: 25px;
    width: auto;
}
</style>
