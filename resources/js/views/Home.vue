<template>
    <b-container>
        <b-row>
            <b-col>
                <b-jumbotron
                    header="Cheatify!"
                    lead="Who needs to git gud when you can chit gud?"
                >
                    <b-btn variant="primary" :to="{ 'name': 'cheat.index' }">
                        Start Cheating
                    </b-btn>
                </b-jumbotron>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
export default {
    props: []
}
</script>s
