<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card border-1">
                    <div class="card-header">Tambah Mahasiswa</div>
                    <div class="card-body">
                        <form action="#" method="post" @submit.prevent="update">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input
                                    type="text"
                                    v-model="form.nama"
                                    id="nama"
                                    class="form-control"
                                />
                                <div
                                    v-if="theErrors.nama"
                                    class="mt-2 text-danger"
                                >
                                    {{ theErrors.nama[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nim">Nim</label>
                                <input
                                    type="text"
                                    v-model="form.nim"
                                    id="nim"
                                    class="form-control"
                                />
                                <div
                                    v-if="theErrors.nim"
                                    class="mt-2 text-danger"
                                >
                                    {{ theErrors.nim[0] }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="prodi">Program Studi</label>
                                <select
                                    @change="selectedProdi"
                                    id="prodi"
                                    class="form-control"
                                >
                                    <option
                                        value="form.prodi_id"
                                        v-text="form.prodi"
                                    ></option>
                                    <template v-for="prodi in prodis">
                                        <option
                                            v-if="form.prodi_id != prodi.id"
                                            :key="prodi.id"
                                            :value="prodi.id"
                                        >
                                            {{ prodi.nama }}
                                        </option>
                                    </template>
                                </select>
                                <div
                                    v-if="theErrors.prodi_id"
                                    class="mt-2 text-danger"
                                >
                                    {{ theErrors.prodi_id[0] }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="jurusan">Jurusan</label>
                                <select
                                    @change="selectedJurusan"
                                    id="jurusan"
                                    class="form-control"
                                >
                                    <option
                                        value="form.jurusan_id"
                                        v-text="form.jurusan"
                                    ></option>
                                    <template v-for="jurusan in jurusans">
                                        <option
                                            v-if="form.jurusan_id != jurusan.id"
                                            :key="jurusan.id"
                                            :value="jurusan.id"
                                        >
                                            {{ jurusan.nama }}
                                        </option>
                                    </template>
                                </select>
                                <div
                                    v-if="theErrors.jurusan_id"
                                    class="mt-2 text-danger"
                                >
                                    {{ theErrors.jurusan_id[0] }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fakultas">Fakultas</label>
                                <input
                                    type="text"
                                    v-model="form.fakultas"
                                    id="fakultas"
                                    class="form-control"
                                />
                                <div
                                    v-if="theErrors.fakultas"
                                    class="mt-2 text-danger"
                                >
                                    {{ theErrors.fakultas[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input
                                    type="text"
                                    v-model="form.alamat"
                                    id="alamat"
                                    class="form-control"
                                />
                                <div
                                    v-if="theErrors.alamat"
                                    class="mt-2 text-danger"
                                >
                                    {{ theErrors.alamat[0] }}
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: [],
            prodis: [],
            jurusans: [],
            theErrors: [],
            selectedP: "",
            selectedJ: ""
        };
    },

    mounted() {
        this.getProdis();
        this.getJurusans();
        this.getMahasiswa();
    },

    methods: {
        // method mengambil data prodi
        async getProdis() {
            let response = await axios.get("/api/prodi");
            if (response.status === 200) {
                this.prodis = response.data;
            }
        },

        // method mengambil data jurusan
        async getJurusans() {
            let response = await axios.get("/api/jurusan");
            if (response.status === 200) {
                this.jurusans = response.data;
            }
        },

        async getMahasiswa() {
            let response = await axios.get(
                `/api/mahasiswa/${this.$route.params.mhsId}`
            );
            this.form = response.data.data;
        },

        selectedProdi(e) {
            this.selectedP = e.target.value;
        },

        selectedJurusan(e) {
            this.selectedJ = e.target.value;
        },

        async update() {
            this.form["prodi_id"] = this.selectedP || this.form.prodi_id;
            this.form["jurusan_id"] = this.selectedJ || this.form.jurusan_id;

            let response = await axios.patch(
                `/api/mahasiswa/${this.$route.params.mhsId}/edit`,
                this.form
            );

            if (response.status == 200) {
                swal("Good job!", response.data.massage, "success");

                this.$router.push("/mahasiswa/table");
            }
        }
    }
};
</script>
