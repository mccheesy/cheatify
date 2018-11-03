<template>
    <div>
        <h3>{{ name }}</h3>
        <h4>{{ code }}</h4>
        <p>{{ description }}</p>
        <p>@{{ creator.name }}</p>
    </div>
</template>

<script>
export default {
    props: [
        'code',
        'creator',
        'description',
        'name',
        'status',
        'uuid',
    ]
}
</script>
