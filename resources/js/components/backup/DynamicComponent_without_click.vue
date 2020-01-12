<template>
    <component v-if="schema.children" :is="schema.name" v-bind="schema.props">
        <template v-for="(com,i) in schema.children">
            <dynamic-component v-if="com.slot == 'activator'" slot="activator" :schema="com" :key="i"></dynamic-component>
            <dynamic-component v-else-if="com.slot == 'badge'" slot="badge" :schema="com" :key="i"></dynamic-component>
            <dynamic-component v-else :schema="com" :key="i"></dynamic-component>
        </template>
    </component>
    <component v-else-if="schema.v_html" v-bind:is="schema.name" v-bind="schema.props" v-html="schema.v_html">
        {{schema.content}}
    </component>
    <component v-else-if="schema.v_html" v-bind:is="schema.name" v-bind="schema.props" v-html="schema.v_html">
        {{schema.content}}
    </component>
    <component v-else v-bind:is="schema.name" :key="schema.name" v-bind="schema.props">
        {{schema.content}}
    </component>
</template>

<script>
export default {
    name: 'dynamic-component',
    props:{schema:Object},
    data () {
        return {
            //
        }
    },
    methods: {
        click () {
        },
    },
}
</script>
