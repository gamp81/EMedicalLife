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
               <input type="text" class="form-control" v-model="codigoPrincipal"  placeholder="codigo Principal" minlength="8" maxlength="8"  >
                
                
            </div>
            <div class="form-group col-6 col-sm-3 col-lg-3">
                 <label for="ruc" >Codigo Auxiliar</label>
                <input type="text" class="form-control" v-model="codigoAuxiliar"  placeholder="codigo auxi" minlength="8" maxlength="8" value="" required>
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
                <label for="nombreComercial">Precio venta</label>
                <input type="number" class="form-control"  v-model="precio" name="nombre" placeholder="descripcion   " required>
            </div>
            <div class="form-group col-6 col-sm-3 col-lg-3">
                <label for="nombreComercial">Precio Costo</label>
                <input type="text" class="form-control"  v-model="precio_costo" name="nombre" placeholder="Precio costo" required>
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
                <input type="text" class="form-control"  v-model="impuestoICE" name="nombre" placeholder="descripcion   " required>
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
                    <button type="button" class="btn btn-primary rounded-pill" @click="submit">Enviar</button>
                </div>
            </div>
        
    </div>
</template>

<script>

export default {
  data() {
    return {
      
      id:this.producto[0].id,
      codigoPrincipal:this.producto[0].codigoPrincipal,
      codigoAuxiliar: this.producto[0].codigoAuxiliar,
      nombre:this.producto[0].nombre,
      precio:this.producto[0].precioUnitario,
      precio_costo:this.producto[0].precioCosto,
      ubicacion:this.producto[0].ubicacion,
      impuestoIva:this.producto[0].impuesto_iva_id,
      impuestoICE:this.producto[0].impuesto_ice_id,
      idempresa:this.producto[0].emisor_id,
      idcategoria:this.producto[0].idCategoria,
      arrayEmpresa:[],
      arrayCaterogia:[],
      arrayimpuestoIva:[],
      errors: [],
    
    };
  },
  mounted() {
    //console.log("carga vista create mounted.",this.empresa);
    this.selectCategoria();
    this.selectImpuesto();
      console.log("carga producto mounted.",this.producto[0]);
  },
  computed: {
  },
  methods: {
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
   selectImpuesto() {
      let me = this;
      var url = "/api/empresa/combo";

      axios
        .get(url)
        .then(function(response) {
           var respuesta = response.data;
          me.arrayEmpresa = respuesta[0];
          me.arrayimpuestoIva = respuesta[1];
          
          console.log('traido del b',me.arrayEmpresa);
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
        .put("/producto/update",{
            id:this.id,
            codigoPrincipal:this.codigoPrincipal,
            codigoAuxiliar:this.codigoAuxiliar,
            nombre:this.nombre,
            precioUnitario:this.precio,
            precio_costo:this.precio_costo,
            ubicacion:this.ubicacion,
            emisor_id:this.idempresa,
            impuestoIva:this.impuestoIva,
            impuestoIce:this.impuestoIce,
            idcategoria:this.idcategoria,
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
      if (this.codigoPrincipal === '') {
        errores.push("Ingrese codigo principal.");
      } //else {
        if (this.nombre == '') {
          errores.push("Ingrese la descripcion.");
        }
        if (this.precio == '') {
          errores.push(" Ingrese el precio.");
        } 
 
      return errores;
    }
  },
  props: ["text", "producto"]
};
</script>
