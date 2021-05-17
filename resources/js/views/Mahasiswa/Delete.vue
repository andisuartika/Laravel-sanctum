<template>
    <button ref="deleteMhs" @click="destroyMhs" class="btn btn-danger">
        Delete
    </button>
</template>

<script>
export default {
    props: ["endpoint"],

    methods: {
        async destroyMhs() {
            swal({
                title: "Apakah Anda Yakin?",
                text: "Apakah anda yakin untuk menghapus data mahasiswa!",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then(willDelete => {
                if (willDelete) {
                    axios.delete(`/api/mahasiswa/${this.endpoint}/delete`);
                    swal("Data Anda Berhasil dihapus!", {
                        icon: "success"
                    });
                    console.log(
                        this.$refs.deleteMhs.parentNode.parentNode.remove()
                    );
                } else {
                    swal("Data tidak dihapus!");
                }
            });
        }
    }
};
</script>
