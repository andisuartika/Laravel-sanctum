<template>
    <div class="container">
        <h1>Table Mahasiswa</h1>
        <table class="table border-1">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Jurusan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="mahasiswa in mahasiswas" :key="mahasiswa.id">
                    <td>
                        <router-link
                            :to="{
                                name: 'mahasiswa.show',
                                params: { mhsId: mahasiswa.id }
                            }"
                            >{{ mahasiswa.nama }}</router-link
                        >
                    </td>
                    <td>{{ mahasiswa.prodi }}</td>
                    <td>{{ mahasiswa.jurusan }}</td>
                    <td>
                        <router-link
                            :to="{
                                name: 'mahasiswa.edit',
                                params: { mhsId: mahasiswa.id }
                            }"
                            class="btn btn-primary"
                            >Edit</router-link
                        >
                        <delete-mhs :endpoint="mahasiswa.id" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import DeleteMhs from "./Delete";
export default {
    components: {
        DeleteMhs
    },
    data() {
        return {
            mahasiswas: []
        };
    },

    mounted() {
        this.getMahasiswas();
    },

    methods: {
        async getMahasiswas() {
            let { data } = await axios.get("/api/mahasiswa");
            this.mahasiswas = data.data;
        }
    }
};
</script>
