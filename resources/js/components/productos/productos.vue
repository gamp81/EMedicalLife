<template>
  <main class="main">
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
    
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Lista de Productos</h1>
             <button  type="button" class="btn btn-danger" @click="abrirModal('producto', 'registrar')">Nuevo</button>
          
          <button
            type="danger"
            icon="el-icon-document"
            @click="cargarPdf()"
          >Reporte</button>
        </div>
      <div class="card mt-2">
        
        
        <div class="card-body" v-if="listado==0">
          <div class="form-group row">
            <div class="col-md-12 col-12">
              <div class="input-group">
                <div class="mr-1">
                  
                </div>

                <div class="mr-1">
                  <input
                    @keyup.native.enter="
                                            listarProducto(1, buscar, criterio)
                                        "
                    placeholder="Texto a buscar"
                    v-model="buscar"
                  >
                </div>

                <div>
                  <button
                    icon="el-icon-search"
                    type="success"
                    @click="
                                            listarProducto(1, buscar, criterio)
                                        "
                  >Buscar</button>
                </div>
              </div>
            </div>
          </div>
          <table class="table table-sm table-responsive">
            <thead>
              <tr>
                <th>Opciones</th>
                <th>Codigo</th>
                <th>Nombre</th>
                 <th>Unidad</th>
                <th>Referencial</th>
                <th>Precio</th>
                
                <th>Categoria</th>
                
                <th>Estado</th>
                <th>Formato largo</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="producto in arrayProducto" :key="producto.id" >
                <td>
                  <button
                    type="button"
                    @click="abrirModal('producto','actualizar',producto)"
                    class="btn btn-warning btn-sm"><i class="icon-pencil"></i>
                  </button>
                  &nbsp;
                  <template v-if="producto.condicion">
                    <button
                      type="button" @click="desactivarProducto(producto.id)"
                      class="btn btn-danger btn-sm"><i class="icon-trash"></i>
                    </button>
                  </template>
                  <template v-else>
                    <button
                      type="button" @click="activarProducto(producto.id)"
                      class="btn btn-info btn-sm"><i class="icon-check"></i>
                    </button>
                  </template>
                </td>
                <td v-text="producto.codigo"></td>
                <td v-text="producto.nombre"></td>
                <td v-text="producto.unidad"></td>
                <td v-text="producto.referencial"></td>
                <td v-text="producto.precio_venta"></td>
                <td v-text="producto.categoria"></td>
                <td>
                  <div v-if="producto.condicion">
                    <span class="badge badge-success">Activo</span>
                  </div>
                  <div v-else>
                    <span class="badge badge-danger">Desactivado</span>
                  </div>
                </td>
                <td>
                  <div v-if="producto.formato">
                    <span class="badge badge-success">Activo</span>
                  </div>
                  <div v-else>
                    <span class="badge badge-danger">Desactivado</span>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <nav>
            <ul class="pagination">
              <li class="page-item" v-if="pagination.current_page > 1">
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="
                                        cambiarPagina(
                                            pagination.current_page - 1,
                                            buscar,
                                            criterio
                                        )
                                    "
                >Ant</a>
              </li>
              <li
                class="page-item"
                v-for="page in pagesNumber"
                :key="page"
                :class="[page == isActived ? 'active' : '']"
              >
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="
                                        cambiarPagina(page, buscar, criterio)
                                    "
                  v-text="page"
                ></a>
              </li>

              <li
                class="page-item"
                v-if="
                                    pagination.current_page <
                                        pagination.last_page
                                "
              >
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="
                                        cambiarPagina(
                                            pagination.current_page + 1,
                                            buscar,
                                            criterio
                                        )
                                    "
                >Sig</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div
      class="modal fade"
      tabindex="-1"
      :class="{ mostrar: modal }"
      role="document"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-md modal-secondary modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" v-text="tituloModal"></h6>
            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <div v-show="errorProducto" class="form-group row div-error">
                  <div class="text-center text-error">
                    <div v-for="error in errorMostrarMsjProducto" :key="error" v-text="error"></div>
                  </div>
                </div>
              <div class="form-group">
                 
                <div class="col-md-12">
                   <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="si" v-model="status">
                    <label class="form-check-label" for="flexRadioDefault1">
                      Formato personalizado
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="no" v-model="status" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                      Formato simple
                    </label>
                  </div>
                   <template>
                            <div>State: <strong>{{ status }}</strong></div>
                      
                    </template>
                  <div class>
                    <label class for="text-input">Codigo </label>
                    <div class >
                      <input placeholder="codigo"  v-model="codigo" disabled>
                    </div>
                  </div>
                </div>
                <div class="col-md-11">
                  <div>
                    <label class for="text-input">Descripcion </label>
                    <div class>
                      <input   placeholder="Descripcion "  v-model="nombre">
                    </div>
                  </div>
                </div>
                <div class="col-md-8" v-if="status=='no'">
                  <div>
                    <label class for="text-input">Unidad </label>
                    <div class>
                      <input   placeholder="unidad "  v-model="unidad">
                    </div>
                  </div>
                </div>
                <div class="col-md-6" v-if="status=='no'">
                  <div>
                    <label class for="text-input">Referenciales </label>
                    <div class>
                      <input placeholder="Referenciales "  v-model="referencial">
                    </div>
                  </div>
                </div>
                
                <div class="col-md-5">
                  <div>
                    <label class for="text-input">Precio venta</label>
                    <div class>
                      <input placeholder="precio venta"  v-model="precioVenta">
                    </div>
                  </div>
                </div>
                
                
                <div class="col-md-6">
                 
                 </div>
                </div>
                <div class="form-row">
                    
                  
              </div>
              <!-- fin form -->
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
            <button
              type="button"
              v-if="tipoAccion == 1"
              class="btn btn-primary"
              @click="registrarProducto()"
            >Guardar</button>
            <button
              type="button"
              v-if="tipoAccion == 2"
              class="btn btn-primary"
              @click="actualizarProducto()"
            >Actualizar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
        formato:0,
        flag:false,
        editorData: '<p>Agregue el Formato aqui.</p>',
        editorConfig: {
                    // The configuration of the editor.
                    extraPlugins: 'justify',
                    toolbar: [ [ 'Bold','Italic',
                    'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] ]
                 },
      input: "",
      //para select
      options: [
        {
          value: "Nombre",
          label: "Nombre"
        },
        {
          value: "categoria",
          label: "Categoria"
        },
        
      ],
      status:'no',
      listado:0,
      value: "",
      //fin select
      producto_id: 0,     
      codigo: "",
      nombre: "",
      unidad:'',
      referencial: "",
   
      precioVenta: "",
     
      
      idCategoria: "",
      nombreCategoria: "",
     
     
     rules: {
       nombre :[
          { required: true, message: 'Por favor escribe el nombre', trigger: 'blur' }
       ],
     },
      arrayProducto: [],
      arrayCategoria: [],
     
      
      modal: 0,
      tituloModal: "",
      tipoAccion: 0,
      errorProducto: 0,
      errorMostrarMsjProducto: [],
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      },
      offset: 3,
      criterio: "nombre",
      buscar: ""
    };
  },
  components: {
          
  },
  computed: {
    
    isActived: function() {
      return this.pagination.current_page;
    },
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  },
  methods: {
   
    //carga pdf products
    cargarPdf(){
      window.open('/producto/listarPdf','_blank');
      },
    
    guardar() {
      this.$message({
        message: "Examen Guardado con éxito.",
        type: "success"
      });
    },
    editar() {
      this.$message({
        message: "Examen Actualizado con éxito.",
        type: "success"
      });
    },
    
   
   
    selectCategoria() {
      let me = this;
      var url = "/categoria/selectCategoria";

      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayCategoria = respuesta.categorias;
          //me.pagination = respuesta.pagination;
          // console.log(arrayCategoria);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    listarProducto(page, buscar, criterio) {
      let me = this;
      var url =
        "/producto?page=" +
        page +
        "&buscar=" +
        buscar +
        "&criterio=" +
        criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayProducto = respuesta.productos.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    cambiarPagina(page, buscar, criterio) {
      let me = this;
      me.pagination.current_page = page;
      me.listarProducto(page, buscar, criterio);
    },
    registrarProducto() {
      
      //validando campos categoria
      if (this.validarProducto()) {
        return;
      }

      let me = this;
     
      if (this.status=='si') {
        me.formato=1;
        me.flag=true;
      }
      axios
        .post("/producto/registrar", {
          codigo: this.codigo,
          nombre: this.nombre,
          unidad:this.unidad,
          referencial: this.referencial,
          precio_venta: this.precioVenta,
          formato:me.formato,
          flag:me.flag,
          editorData:this.editorData,
          idCategoria: this.idCategoria,
          
        })
        .then(function(response) {
          console.log('BANDERA',me.flag);
          me.cerrarModal();
          me.listarProducto(1, "", "nombre");
          me.guardar();
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    actualizarProducto() {
      //validando campos categoria
      if (this.validarProducto()) {
        return;
      }

      let me = this;
      axios
        .put("/producto/actualizar", {
          codigo: me.codigo,
          nombre: me.nombre,
          unidad:me.unidad,
          referencial: me.referencial,
          precio_venta: me.precioVenta,
          idCategoria: me.idCategoria,
          formato : me.formato,
          editorData:me.editorData,
          flag:me.flag,
          id: me.producto_id
        })
        .then(function(response) {
          me.cerrarModal();
          me.listarProducto(1, "", "nombre");
          me.editar();
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    desactivarProducto(id) {
      Swal.fire({
        title: "Estas seguro de desactivar esta categoria?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar"
      }).then(result => {
        if (result.value) {
          let me = this;
          axios
            .put("/producto/desactivar", {
              id: id
            })
            .then(function(response) {
              me.listarProducto(1, "", "nombre");
            })
            .catch(function(error) {
              console.log(error);
            });
        }
      });
    },
    activarProducto(id) {
      Swal.fire({
        title: "Estas seguro de activar esta categoria?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar"
      }).then(result => {
        if (result.value) {
          let me = this;
          axios
            .put("/producto/activar", {
              id: id
            })
            .then(function(response) {
              Swal.fire(
                "Activado!",
                "El registro ha sido desactivado con éxito.",
                "success"
              );
              me.listarProducto(1, "", "nombre");
            })
            .catch(function(error) {
              console.log(error);
            });
        }
      });
    },
    validarProducto() {
      this.errorProducto = 0;
      this.errorMostrarMsjProducto = [];

      if (!this.nombre)
        this.errorMostrarMsjProducto.push(
         
          "El nombre del producto no puede estar vacío."
        );
        // else if(!this.precioCompra) 
        // this.errorMostrarMsjProducto.push(
        //   "El precio compra del producto no puede estar vacío."
        // );
        else if(!this.precioVenta)        
        this.errorMostrarMsjProducto.push(
          "El precio venta del producto no puede estar vacío."         

        );
        // else if(!this.fechaVencimiento) 
        // this.errorMostrarMsjProducto.push(
        //   "Seleccionar la fecha de vencimiento "
          
        // );
        // else if(!this.stock) 
        // this.errorMostrarMsjProducto.push(
        //   "Ingresa el stock "
          
        // );
         else if(!this.idCategoria) 
        this.errorMostrarMsjProducto.push(
          "Seleccionar la categoria "
        );
       
        // else if(!this.idPresentacion) 
        // this.errorMostrarMsjProducto.push(
        //   "Seleccionar el presentacion "
          
        // );
        // else if(!this.idProveedor) 
        // this.errorMostrarMsjProducto.push(
        //   "Seleccionar el proveedor "
          
        // );

        

      if (this.errorMostrarMsjProducto.length) this.errorProducto = 1;

      return this.errorProducto;
    },
    cerrarModal() {
      this.modal = 0;
      this.tituloModal = "";
      this.nombre = "";
      this.usoTerapeutico = "";
    },
    abrirModal(modelo, accion, data = []) {
      switch (modelo) {
        case "producto": {
          switch (accion) {
            case "registrar": {
              this.modal = 1;
              this.tituloModal = "Registrar Prueba";
              this.codigo = "";
              this.nombre = "";
              this.unidad="";
              this.referencial = "";
              this.editorData="Aqui su formato";
              this.status="no";
              this.precioVenta = "";
              
              this.idCategoria = "";
              
              this.nombreCategoria = "";
              
              this.tipoAccion = 1;
              break;
            }
            case "actualizar": {
              this.modal = 1;
              this.tituloModal = "Actualizar Examen";
              this.tipoAccion = 2;
              this.formato=data['formato'];
              if (this.formato==0) {
                  this.status="no";
                  this.flag=false;
                  this.producto_id = data["id"];
                  this.codigo = data["codigo"];
                  this.nombre = data["nombre"];
                  this.unidad = data["unidad"];
                  this.referencial= data["referencial"];
                  this.formato = data["formato"];
                  this.precioVenta = data["precio_venta"];
                  console.log("precio de venta",this.precioVenta,' ',this.formato);
                  this.ubicacion = data["ubicacion"];
                  
                  this.idCategoria = data["idCategoria"];  
              } else {
                    this.status="si";
                    this.producto_id = data["id"];
                  this.codigo = data["codigo"];
                  this.nombre = data["nombre"];
                  this.unidad = data["unidad"];
                  this.formato = data["formato"];
                  this.editorData= data["plantilla"];
                  this.flag=true;
                  this.precioVenta = data["precio_venta"];
                  console.log("precio de venta",this.precioVenta,' ',this.formato);
                  this.idCategoria = data["idCategoria"];
              }
              
              

              break;
            }
          }
        }
      }
      this.selectCategoria();
      
      
    }
  },
  mounted() {
    this.listarProducto(1, this.buscar, this.criterio);
  }
};
</script>