<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Detail Mahasiswa
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ mahasiswa.nama }}</h5>
                <p class="card-text">{{ mahasiswa.nim }}</p>
                <p class="card-text">{{ mahasiswa.prodi }}</p>
                <p class="card-text">{{ mahasiswa.jurusan }}</p>
                <p class="card-text">{{ mahasiswa.fakultas }}</p>
                <p class="card-text">{{ mahasiswa.alamat }}</p>
                <router-link
                    :to="{ name: 'mahasiswa.table' }"
                    class="btn btn-primary"
                    >Kembali</router-link
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            mahasiswa: []
        };
    },
    mounted() {
        this.getMahasiswa();
    },

    methods: {
        async getMahasiswa() {
            let { data } = await axios.get(
                "/api/mahasiswa/" + this.$route.params.mhsId
            );
            this.mahasiswa = data.data;
        }
    }
};
</script>
