<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">My Favorite Locations On The Map</div>
                    <div id="map" style="height: 500px;">
                        <l-map :zoom="zoom" :center="center" v-on:click="addMarker">
                            <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
                            <l-marker 
                                v-for="marker in markers" v-bind:key="marker.id"
                                :lat-lng="{'lat': marker.latitude, 'lng': marker.longitude}" >
                                <l-tooltip :content="marker.name"></l-tooltip>
                            </l-marker>
                        </l-map>
                    </div>
                </div>

                <table class="table">
                        <thead>
                            <th>Name</th>
                            <th>Comment</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                        </thead>
                        <tbody>
                            <template v-if="!markers.length">
                                <tr>
                                    <td colspan="4" class="text-center">No Markers Available</td>
                                </tr>
                            </template>
                            <template v-else>
                                <tr v-for="marker in markers" :key="marker.id">
                                    <td>{{ marker.name }}</td>
                                    <td>{{ marker.comment }}</td>
                                    <td>{{ marker.latitude }}</td>
                                    <td>{{ marker.longitude }}</td>
                                </tr>
                            </template>
                        </tbody>
                    </table>

            </div>
        </div>
    </div>
</template>

<script>
    import { LMap, LMarker, LTileLayer, LTooltip } from "vue2-leaflet";
    import L from 'leaflet';
    import 'leaflet/dist/leaflet.css';

    delete L.Icon.Default.prototype._getIconUrl;

    L.Icon.Default.mergeOptions({
    iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
    iconUrl: require('leaflet/dist/images/marker-icon.png'),
    shadowUrl: require('leaflet/dist/images/marker-shadow.png')
    });

    export default {
    name: '#Home',
    components: { LMap, LTileLayer, LMarker, LTooltip },
        data() {
            return {
                zoom:14,
                center: [48.1364522, 11.5803871],
                url:'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution:'&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                //markers: [ ]
            
            }
        },
        mounted () {
            this.$store.dispatch('getMarkers');
        },
        computed: {
            markers() {
                return this.$store.getters.markers;
            }
        },
        methods: {
            // removeMarker(id) {
            //     axios.post(`/api/markers/remove/${id}`)
            //         .then((response) => {
            //             this.$router.push('/');
            //             //this.markers.splice(index, 1);
            //         })
            //         .catch((error)=> {
            //             this.$router.push('/');
            //             console.log(error);
            //             JSON.stringify(error);
            //         });
            // },
            addMarker(event) {
                this.$router.push({ path: '/new', query: { latlng: event.latlng} });
            }
        }
    };

</script>

<style>


</style>
