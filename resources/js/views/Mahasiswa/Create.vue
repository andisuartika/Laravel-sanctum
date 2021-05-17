<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card border-1">
                    <div class="card-header">Tambah Mahasiswa</div>
                    <div class="card-body">
                        <form action="#" method="post" @submit.prevent="store">
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
                                    v-model="form.prodi_id"
                                    id="prodi"
                                    class="form-control"
                                >
                                    <option
                                        v-for="prodi in prodis"
                                        :key="prodi.id"
                                        :value="prodi.id"
                                    >
                                        {{ prodi.nama }}
                                    </option>
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
                                    v-model="form.jurusan_id"
                                    id="jurusan"
                                    class="form-control"
                                >
                                    <option
                                        v-for="jurusan in jurusans"
                                        :key="jurusan.id"
                                        :value="jurusan.id"
                                    >
                                        {{ jurusan.nama }}
                                    </option>
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
            form: {
                nama: "",
                nim: "",
                prodi_id: "",
                jurusan_id: "",
                fakultas: "",
                alamat: ""
            },
            prodis: [],
            jurusans: [],
            theErrors: []
        };
    },

    mounted() {
        this.getProdis();
        this.getJurusans();
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

        // method store
        async store() {
            try {
                let response = await axios.post(
                    "/api/mahasiswa/create",
                    this.form
                );
                if (response.status === 200) {
                    this.form.nama = "";
                    this.form.nim = "";
                    this.form.prodi_id = "";
                    this.form.jurusan_id = "";
                    this.form.fakultas = "";
                    this.form.alamat = "";
                    this.theErrors = [];

                    swal("Good job!", response.data.massage, "success");
                    this.$router.push("/mahasiswa/table");
                }
            } catch (e) {
                this.theErrors = e.response.data.errors;
                swal("Something Wrong!", "Data gagal ditambahkan!", "error");
            }
        }
    }
};
</script>
