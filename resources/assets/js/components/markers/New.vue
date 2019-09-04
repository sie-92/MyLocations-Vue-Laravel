<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Markers</div>

                    <div class="card-body">
                        <div class="new">
                            <form @submit.prevent="add">
                                <table class="table">
                                    <tr>
                                        <th>Name</th>
                                        <td>
                                            <input type="text" class="form-control" v-model="marker.name" placeholder="Name"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Comment</th>
                                        <td>
                                            <input type="text" class="form-control" v-model="marker.comment" placeholder="Comment"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Latitude</th>
                                        <td>
                                            <input type="text" class="form-control" v-model="marker.latitude" placeholder="latitude"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Longitude</th>
                                        <td>
                                            <input type="text" class="form-control" v-model="marker.longitude" placeholder="longitude"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <router-link to="/" class="btn">Cancel</router-link>
                                        </td>
                                        <td class="text-right">
                                            <input type="submit" value="Create" class="btn btn-primary">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <div class="errors" v-if="errors">
                                <ul>
                                    <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                                        <strong>{{ fieldName }}</strong> {{ fieldsError.join('\n') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import validate from 'validate.js';

    export default {
        name: 'MarkersNew',
        data() {
            return {
                marker: {
                    name: '',
                    comment: '',
                    longitude: '',
                    latitude: ''
                },
                errors: null
            };
        },
        created() {
            this.marker.latitude = this.$route.query.latlng.lat;
            this.marker.longitude = this.$route.query.latlng.lng;
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            }
        },
        methods: {
            add() {
                this.errors = null;

                const constraints = this.getConstraints();

                const errors = validate(this.$data.marker, constraints);

                if(errors) {
                    this.errors = errors;
                    return;
                }

                axios.post('/api/markers/new', this.$data.marker)
                    .then((response) => {
                        this.$router.push('/');
                    });
            },
            getConstraints() {
                return {
                    name: {
                        presence: true,
                        length: {
                            minimum: 3,
                            message: 'Must be at least 3 characters long'
                        }
                    },
                    comment: {
                        presence: true
                    },
                    longitude: {
                        presence: true,
                        numericality: true
                    },
                    latitude: {
                        presence: true,
                        numericality: true
                    }
                };
            }
        }
    }
</script>

<style>
.errors {
    background: lightcoral;
    border-radius:5px;
    padding: 21px 0 2px 0;
}
</style>

