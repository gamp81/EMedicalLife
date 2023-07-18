<template>
  <div>
    <div class="table-responsive">
      <v-data-table
      :dense="false"
      :headers="_headers"
      :items="records"
      item-key="name"
      class="elevation-1"
      :search="search"
      :custom-filter="filterOnlyCapsText"
    >
      <template v-slot:top>
        <v-text-field
          v-model="search"
          label="Buscar (SOLO MAYUSCULAS)"
          class="mx-4"
        ></v-text-field>
      </template>
     
        <template v-slot:item.actions="{ item }">
          
            <a class="btn btn-sm btn-outline-secondary" role="button" title="Ver más información" v-bind:href="text+'/'+item.id">
                  <i class="fas fa-info-circle"></i></a>
            <a class="btn btn-sm btn-outline-secondary" role="button" title="Editar registro" v-bind:href="text+'/'+item.id+'/edit'">
                  <i class="fas fa-edit"></i></a>
                                  
        </template>
    </v-data-table>
      
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="buscarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Buscar producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-row">
                <div class="form-group col-sm-6">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="searchRadios" id="searchRadioRuc" value="ruc" v-model="searchby" checked />
                    <label class="form-check-label" for="searchRadioRuc">Ruc</label>
                  </div>
                  <input type="text" maxlength="13" class="form-control" id="ruc" placeholder="Digite números iniciales." v-bind:disabled="searchby=='razon'" />
                </div>
                <div class="form-group col-sm-6">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="searchRadios" id="exampleRadios2" value="razon" v-model="searchby" />
                    <label class="form-check-label" for="exampleRadios2">Razon social</label>
                  </div>
                  <input type="text" class="form-control" id="razon" placeholder="Ingrese un razon." v-bind:disabled="searchby=='ruc'" />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary rounded-pill" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary rounded-pill" v-on:click="buscar">Buscar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  created() {
    this.debouncedGetAnswer = _.debounce(this.getAnswer, 500);
  },
  data() {
    return {
       search: '',
      
        headers :[
          // {
          //   text: 'Id',
          //   align: 'start',
          //   sortable: true,
          //   value: 'id',show:true
          // },
          { text: 'Codigo P', value: 'codigoPrincipal',show:true },
          { text: 'Codigo de Barras', value: 'codigoAuxiliar',show:true },
          { text: 'Descripcion', value: 'nombre' ,show:true},
          { text: 'Precio venta', value: 'precioUnitario',show:true },
          // { text: 'Precio costo', value: 'precioCosto',show:true },
           { text: 'Ubicacion', value: 'ubicacion',show:false },
          { text: 'Categoria', value: 'categoria',show:false },
          { text: 'Acciones', value: 'actions',show:true },
        ],
      response: null,
      records: [],
      errored: false,
      current_page: 1,
      last_page: 1,
      total: 0,
      from: 0,
      to: 0,
      stepback: true,
      skipback: true,
      stepforw: true,
      skipforw: true,
      searchby: "ruc",
      buscar:'',
    };
  },
  mounted() {
    this.carga();
    console.log("TablaProductosComponent mounted.",this.idrole);
  },
  filters: {
    
  },
  computed: {
       _headers () {
        if (this.idrole===1) {
          return this.headers.filter(x=>x.show)
        }
         if (this.idrole==3) {
          //console.log('este el objeto',this.headers);
          function mostrar(obj){
             if ('value' in obj && obj.value === 'emisor_id' ) {
                console.log('este el objeto',obj.show);
                obj.show=true;
                return obj;
            } else {
             
              return obj;
            }

          }
          return this.headers.filter(mostrar)
        }
          
       }
    },
  methods: {
     filterOnlyCapsText (value, search, item) {
        return value != null &&
          search != null &&
          typeof value === 'string' &&
          value.toString().toLocaleUpperCase().indexOf(search) !== -1
      },
    
   
    carga: function() {
      axios
        .get("/producto/lista", {
          params: {
            page: this.current_page,
          
          }
        })
        .then(response => (this.response = response.data));
    },
    getAnswer: function() {
      this.records = this.response.data;
      this.current_page = parseInt(this.response.current_page);
      this.last_page = parseInt(this.response.last_page);
      this.total = parseInt(this.response.total);
      this.from = parseInt(this.response.from);
      this.to = parseInt(this.response.to);
      if (isNaN(this.from)) {
        this.from = 0;
      }

      if (isNaN(this.to)) {
        this.to = 0;
      }
      if (this.current_page === 1) {
        this.setstatback(true);
      } else if (this.current_page > 1) {
        this.setstatback(false);
      }
      if (this.current_page === this.last_page) {
        this.setstatforw(true);
      } else if (this.last_page > 1) {
        this.setstatforw(false);
      }
    },
    recarga: function() {
      
      this.current_page = 1;
      this.carga();
    },
    setstatback: function(e) {
      this.skipback = e;
      this.stepback = e;
    },
    setstatforw: function(e) {
      this.skipforw = e;
      this.stepforw = e;
    }
  },
  watch: {
    response: function(newResponse, oldResponse) {
      this.debouncedGetAnswer();
    }
  },
  props: ["text","idrole"]
};
</script>