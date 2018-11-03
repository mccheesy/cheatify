<template>
    <b-navbar toggleable="sm" fixed="top" sticky=true type="light" variant="info">
        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
        <b-navbar-brand to="home">Cheatify</b-navbar-brand>
        <b-btn to="cheat.index" variant="outline-light" size="sm">Cheats</b-btn>
        <b-navbar-nav class="ml-auto">
            <b-nav-form>
                <b-form-input size="sm" class="mr-sm-2" type="text" placeholder="Search"/>
                <b-btn type="submit" variant="outline-light" size="sm">Search</b-btn>
            </b-nav-form>
        </b-navbar-nav>
    </b-navbar>
</template>

<script>
export default {
    props: []
}
</script>
