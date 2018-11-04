<template>
    <b-navbar toggleable="sm" fixed="top"
        :sticky=true type="light" variant="info">
        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
        <b-navbar-brand to="/">Cheatify</b-navbar-brand>
        <b-btn variant="outline-light" size="sm"
            :to="{ name: 'cheat.index'}">
            Cheats
        </b-btn>
        <b-navbar-nav class="ml-auto">
            <b-nav-form>
                <b-form-input size="sm" class="mr-sm-2"
                    type="text" placeholder="Search"/>
                <b-btn type="submit" variant="outline-light"
                    size="sm">Search</b-btn>
            </b-nav-form>
        </b-navbar-nav>
    </b-navbar>
</template>

<script>
export default {
    props: []
}
</script>
