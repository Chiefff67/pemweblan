<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<div id="app">
    <button @click="loadAxios">Load data</button>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item, index) in dataUser" :key="index">
                <td>{{ item.username }}</td>
                <td>{{ item.password }}</td>
                <td>{{ item.name }}</td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    const {
        createApp
    } = Vue

    createApp({
        data() {
            return {
                dataUser: [] // Inisialisasi sebagai array kosong
            }
        },
        methods: {
            loadAxios() {
                axios.get("http://localhost/pemweblan/config/api.php")
                    .then(response => {
                        console.log(response.data); // Periksa respons API
                        this.dataUser = response.data; // Assign data dari API
                    })
                    .catch(err => {
                        console.log(err); // Tampilkan error jika ada
                    })
            }
        }
    }).mount('#app')
</script>