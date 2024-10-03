<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<div id="app">
    {{nilai}}
    <div v-text="nilai"></div>
    <div v-html="nilai"></div>

    <div v-if="nilai > 5">
        Now you see me
    </div>
    <div v-else>
        Now you don't
    </div>

    <table>
        <tr>
            <th>Person 1</th>
            <th>Person 2</th>
            <th>Person 3</th>
        </tr>
        <tr>
            <td>Emil</td>
            <td>Tobias</td>
            <td>Linus</td>
        </tr>
        <tr>
            <td>16</td>
            <td>14</td>
            <td>10</td>
        </tr>
    </table>
    <button @click="increment">+</button>


    {{nama}}
    <input type="text" name="nama" v-model="nama">
</div>

<script>
    const {
        createApp
    } = Vue

    createApp({
        data() {
            return {
                nilai: 0,
                nama: ''
            }
        },
        methods: {
            increment() {
                this.nilai++
            }
        }

    }).mount('#app')
</script>