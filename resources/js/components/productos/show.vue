<template>
    <div >
        <div class="form-row" v-if="errors.length">
            <div class="col-lg-10 alert alert-danger" style="padding-bottom: 0;">
                <ul>
                    <li v-for="(error, index) in errors" :key="'error-'+index">{{ error }}</li>
                </ul>
            </div>
        </div>
        <div class="form-row col-12 col-lg-12" >
            <div class="form-group col-6 col-sm-3 col-lg-3">
                <label for="ruc" >Codigo Principal</label>
               <input type="text" class="form-control" v-model="codigoPrincipal"  placeholder="codigo Principal" minlength="8" maxlength="8"  disabled>
                
                
            </div>
            <div class="form-group col-6 col-sm-3 col-lg-3">
                 <label for="ruc" >Codigo Auxiliar</label>
                <input type="text" class="form-control" v-model="codigoAuxiliar"  placeholder="codigo auxi" minlength="8" maxlength="8" value="" disabled>
            </div>
            
             
        </div>
         <div class="form-row col-12 col-lg-12" >
            
            <div class="form-group col-6 col-sm-6 col-lg-6">
                <label for="nombreComercial">Nombre </label>
                <input type="text" class="form-control"  v-model="nombre" name="nombre" placeholder="descripcion   " disabled>
            </div>
             
        </div>
        <div class="form-row col-12 col-lg-12" >
            
            <div class="form-group col-6 col-sm-3 col-lg-3">
                <label for="nombreComercial">Precio </label>
                <input type="text" class="form-control"  v-model="precio" name="nombre" placeholder="descripcion   " disabled>
            </div>
            <div class="form-group col-6 col-sm-3 col-lg-3">
                <label for="nombreComercial">IVA </label>
                <input type="text" class="form-control"  v-if="impuestoIva==1" value="IVA 12%" disabled>
                 <input type="text" class="form-control"  v-if="impuestoIva==2" value="IVA 0%" disabled>
            </div>
             <div class="form-group col-6 col-sm-3 col-lg-3">
                <label for="nombreComercial">ICE </label>
                <input type="text" class="form-control"  v-model="precio" name="nombre" placeholder="descripcion   " disabled>
            </div>
             
      
             
        </div>
            <!-- <div class="form-group col-8 col-sm-6 col-lg-6">
                <label for="bloque">Emisor</label>
                <select id="bloque" class="form-control" v-model="idempresa">
                    <option v-for="empre in arrayEmpresa" :key="empre.id" :value="empre.id" >{{empre.nombreComercial }}</option>
                </select>
            </div> -->
        
            <div class="form-group col-12 col-lg-8 clearfix">
            <div class="float-right">
                    <a class="btn btn-outline-secondary rounded-pill" href="/admin/producto" role="button">Volver</a>
                     <!-- <a class="btn btn-outline-danger rounded-pill" v-bind:href="'/producto/delete/'+id" role="button">Volver</a> -->
                    <button type="button" class="btn btn-danger rounded-pill" @click="submit">Eliminar producto</button>
                </div>
            </div>
        
    </div>
</template>
<script>

export default {
  data() {
    return {
      productoEdit:[],
      id:this.producto[0].id,
      codigoPrincipal:this.producto[0].codigoPrincipal,
      codigoAuxiliar: this.producto[0].codigoAuxiliar,
      nombre:this.producto[0].nombre,
      precio:this.producto[0].precioUnitario,
      impuestoIva:this.producto[0].impuesto_iva_id,
      idempresa:this.producto[0].emisor_id,
      arrayEmpresa:[],
       arrayimpuestoIva:[],
     
      idempresa:null,
      errors: [],
    
    };
  },
  mounted() {
    
    this.selectCategoria();
      console.log("carga producto mounted.",this.producto[0]);
  },
  computed: {
  },
  methods: {
   submit(event) {
      if (this.errors.length) {
          event.target.disabled = false;
      } else {
        this.post()
      }
    },
    post() {
      axios
        .delete('/producto/delete/'+ this.id)
        .then(
             console.log(this.id)
        )
        .catch(function(error) {
          console.log(error);
        });
    //   }
    },
  
  
   
  },
  props: ["text", "producto"]
};
</script>