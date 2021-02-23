<template>
<div class="modal fade" id="editProfil">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h4 class="modal-title">Edition Image de Profil</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form enctype="multipart/form-data">
            <div class="modal-body">
                   
                    <div v-if="imageprev" class="text-center">
                        <img :src="imageprev" class="figure-img img-fluid rounded" alt="" style="max-height:100px;">
                    </div>

                    <div class="custom-file">
                       <input type="file" class="custom-file-input" @change="imageSelected" name="image">
                        <label for="image" class="custom-file-label">Selectionner une image</label>
                    </div>
                </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-outline-info" data-dismiss="modal">Ajouter</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
</template>

<script>
export default {
    props:['emp'],
    data(){
        return {
            image:null,
            imageprev:null
        }
    },
    methods:{
        imageSelected(e){
            this.image = e.target.files[0];

            let reader = new FileReader();

            reader.readAsDataURL(this.image);

            reader.onload = e =>{
                this.imageprev = e.target.result
            }
        },
        profilUpload(){
            if(this.image !== null){
                let data = new FormData();
                data.append('image', this.image);
                data.append('empId', this.emp.id);

                axios.post('/api/employedprofil', data)
                .then(response => console.log(response.data))
                .catch(error => alert(error));
            }else{
                this.$emit('imageError');
            }
        }
    }
}
</script>

<style>

</style>
