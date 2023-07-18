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
               <input type="text" class="form-control" v-model="codigoPrincipal"  placeholder="codigo Principal" minlength="8" maxlength="8" value="" required>
                
                
            </div>
            <div class="form-group col-6 col-sm-3 col-lg-3">
                 <label for="ruc" >Codigo de barra</label>
                <input type="text" class="form-control" v-model="codigoAuxiliar"  placeholder="codigo auxi"  value="" required>
            </div>
            
             
        </div>
         <div class="form-row col-12 col-lg-12" >
            
            <div class="form-group col-6 col-sm-6 col-lg-6">
                <label for="nombreComercial">Nombre </label>
                <input type="text" class="form-control"  v-model="nombre" name="nombre" placeholder="descripcion   " required>
            </div>
             
        </div>
        <div class="form-row col-12 col-lg-12" >
            
            <div class="form-group col-6 col-sm-3 col-lg-3">
                <label for="nombreComercial">Precio Venta</label>
                <input type="text" class="form-control"  v-model="precio" name="nombre" placeholder="Precio Venta   " required>
            </div>
            <div class="form-group col-6 col-sm-3 col-lg-3">
                <label for="nombreComercial">Precio Costo</label>
                <input type="text" class="form-control"  v-model="precio_costo" name="nombre" placeholder="Precio costo" >
            </div>
             <div class="form-group col-6 col-sm-3 col-lg-3">
                <label for="nombreComercial">IVA </label>
                <!-- <input type="text" class="form-control"  v-model="precio" name="nombre" placeholder="descripcion   " required> -->
                 <select id="bloque" class="form-control" v-model="impuestoIva">
                    <option v-for="imp in arrayimpuestoIva" :key="imp.id" :value="imp.id" >{{imp.nombre }}</option>
                </select>
            </div>
             <!-- <div class="form-group col-6 col-sm-3 col-lg-3">
                <label for="nombreComercial">ICE </label>
                <input type="text" class="form-control"  v-model="impuestoICE" name="nombre" placeholder="No aplica   " disabled>
            </div> -->
             
        </div>
        <div class="form-row col-12 col-lg-12" >
          <div class="form-group col-8 col-sm-3 col-lg-3">
                <label for="bloque">Categoria</label>
                <select id="bloque" class="form-control" v-model="idcategoria">
                    <option v-for="empre in arrayCaterogia" :key="empre.id" :value="empre.id" >{{empre.nombre }}</option>
                </select>
          </div>
           <div class="form-group col-8 col-sm-3 col-lg-3">
                <label for="bloque">Ubicacion</label>
                <input type="text" class="form-control"  v-model="ubicacion" name="nombre" placeholder="Ubicacion" >
            </div>
          </div>
           
        
            <div class="form-group col-12 col-lg-8 clearfix">
            <div class="float-right">
                    <a class="btn btn-outline-secondary rounded-pill" href="/admin/producto" role="button">Cancelar</a>
                    <button type="button" class="btn btn-primary rounded-pill" @click="submit">Guardar</button>
                </div>
            </div>
        
    </div>
</template>

<script>

export default {
  data() {
    return {
      codigoPrincipal: null,
      codigoAuxiliar: null,
      nombre:null,
      precio:null,
      precio_costo:null,
      ubicacion:null,
      empresa:null,
      arrayEmpresa:[],
      arrayimpuestoIva:[],
      arrayCaterogia:[],
      impuestoIva:null,
      impuestoICE:null,
      idempresa:null,
      idcategoria:null,
      errors: [],
    
     
     
    };
  },
  mounted() {
    

    console.log("carga vista create mounted.",this.empresa);
    this.selectCategoria();
    this.selectEmisor();
  },
  computed: {
  },
  methods: {
   selectEmisor() {
      let me = this;
      var url = "/api/empresa/combo";

      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayEmpresa = respuesta[0];
          me.arrayimpuestoIva = respuesta[1];
          
          //console.log('traido del b COMPLETO', response.data);
          //console.log('traido del b',me.arrayEmpresa);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    selectCategoria() {
      let me = this;
      var url = "/categoria/lista";

      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data.categorias.data;
          me.arrayCaterogia = respuesta;
          //me.arrayimpuestoIva = respuesta[1];
          
          //console.log('traido del b COMPLETO', respuesta);
        
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    submit(event) {
       event.target.disabled = true;
       this.errors = this.validateForm();
      if (this.errors.length) {
          event.target.disabled = false;
      } else {
        this.post()
      }
    },
    post() {
        axios
        .post("/admin/producto",{
            codigoPrincipal:this.codigoPrincipal,
            codigoAuxiliar:this.codigoAuxiliar,
            nombre:this.nombre,
            precioUnitario:this.precio,
            precio_costo:this.precio_costo,
            impuestoIva:this.impuestoIva,
            ubicacion:this.ubicacion,
            emisor_id:this.idempresa,
            idcategoria:this.idcategoria

        })
        .then(function(response) {
          location.replace("/admin/producto/");
           console.log("axios post traido",response);
        })
        .catch(error => this.setPostErrors(error))
        .finally(() => {
          console.log("axios post finalizado");
        });
    },
    setPostErrors(error) {
      // Parsing de los errores retornados por el validate de Laravel en el backend
      this.errors = Object.keys(error.response.data.errors).map(function(
        currentValue,
        index
      ) {
        // Por ahora solo se toma el primer error de cada campo, se debería mejorar para presentar todos los errores
        return error.response.data.errors[currentValue][0];
      });
    },
    validateForm() {
       let errores = [];
     if (this.codigoPrincipal === null) {
        errores.push("Ingrese codigo principal.");
      } //else {
        if (this.nombre == null) {
          errores.push("Ingrese la descripcion.");
        }
        if (this.precio == null) {
          errores.push(" Ingrese el precio.");
        } 
         if (this.precio_costo == null) {
          errores.push(" Ingrese el precio costo.");
        } 
        if (this.impuestoIva == null) {
          errores.push(" Ingrese el IVA.");
        } 
        
      return errores;
    }
  },
  
};
</script>
