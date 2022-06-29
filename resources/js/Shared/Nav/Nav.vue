<template>
    <nav class="fixed z-50 min-w-full bg-navbar shadow-lg">
        <div class="flex flex-row justify-between items-center">
            <ul class="flex flex-row items-center space-x-1">
                <li><NavLink href="/" class="py-3 px-2 pl-3" :active="$page.component === 'App'">Home</NavLink></li>
                <li><NavLink href="/members" class="py-3 px-2 pl-3" :active="$page.component === 'MemberIndex'">Members</NavLink></li>
                <li><NavLink href="/categories" class="py-3 px-2 pl-3" :active="$page.component === 'CategoryIndex'">Categories</NavLink></li>
            </ul>
            <ul class="flex flex-row items-center space-x-1">
                <li>
                    <NavDropdown class="py-3 px-2 pr-3" :label="$page.props.auth.user.username">
                        <NavLink href="#" as="button" method="POST">Logout</NavLink>
                    </NavDropdown>
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
    components: { NavAnchor, NavBrand, NavLink, NavDropdown }
}
</script>
