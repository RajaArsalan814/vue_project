<template>
  <b-sidebar id="add-new-user-sidebar" :visible="isAddNewUserSidebarActive" bg-variant="white"
    sidebar-class="sidebar-lg" shadow backdrop no-header right @hidden="resetForm"
    @change="(val) => $emit('update:is-add-new-user-sidebar-active', val)">
    <template #default="{ hide }">
      <!-- Header -->
      <div class="
          d-flex
          justify-content-between
          align-items-center
          content-sidebar-header
          px-2
          py-1
        ">
        <h5 class="mb-0"> {{ editData.id ? 'Update' : 'Add ' }} Assign Module
        </h5>

        <feather-icon class="ml-1 cursor-pointer" icon="XIcon" size="16" @click="hide" />
      </div>

      <!-- BODY -->
      <validation-observer #default="{ handleSubmit }" ref="refFormObserver">
        <!-- Form -->
        <b-form class="p-2" @submit.prevent="handleSubmit(onSubmit)" @reset.prevent="resetForm"
          enctype="multipart/form-data">
          <!-- token_amount -->
       
          <!-- Global Level -->
          <validation-provider #default="validationContext" name="level" rules="required">
            <b-form-group label="Select level" label-for="gls_id" :state="getValidationState(validationContext)">
              <v-select v-model="editData.gls_id" :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'" :options="glsdata"
                :reduce="(val) => val.id" label="name" value="id" :clearable="false" input-id="gls_id"
                @input="getModules($event)" />
              <b-form-invalid-feedback :state="getValidationState(validationContext)">
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </b-form-group>
          </validation-provider>

          <validation-provider #default="validationContext" name="Module" rules="required">
            <b-form-group label="Select Module" label-for="module_id" :state="getValidationState(validationContext)">
              <v-select v-model="editData.module_id" :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                :options="moduledata" :reduce="(val) => val.id" label="title" value="id" :clearable="false"
                input-id="module_id" @input="getLesson($event)" />
              <b-form-invalid-feedback :state="getValidationState(validationContext)">
                {{ validationContext.errors[0] }}
              </b-form-invalid-feedback>
            </b-form-group>
          </validation-provider>
            
          <!-- Form Actions -->
          <div class="d-flex mt-2">
            <b-button v-ripple.400="'rgba(255, 255, 255, 0.15)'" variant="primary" class="mr-2" type="submit">
              {{ editData.id ? 'Update' : 'Add ' }}
            </b-button>
            <b-button v-ripple.400="'rgba(186, 191, 199, 0.15)'" type="button" variant="outline-secondary"
              @click="hide">
              Cancel
            </b-button>
          </div>
        </b-form>
      </validation-observer>
    </template>
  </b-sidebar>
</template>

<script>
import {
  BSidebar,
  BForm,
  BMedia,
  BFormGroup,
  BAvatar,
  BFormInput,
  BFormInvalidFeedback,
  BButton,
  BFormDatepicker,
  BFormTimepicker,
  BFormCheckbox, BFormFile,
} from "bootstrap-vue";
import { ValidationProvider, ValidationObserver } from "vee-validate";
import { useInputImageRenderer } from '@core/comp-functions/forms/form-utils'
import { ref, watch, nextTick } from "@vue/composition-api";
import { required, alphaNum, email } from "@validations";
import formValidation from "@core/comp-functions/forms/form-validation";
import Ripple from "vue-ripple-directive";
import vSelect from "vue-select";
import countries from "@/@fake-db/data/other/countries";
import store from "@/store";
import { codeBasic } from "./code";
import { useToast } from 'vue-toastification/composition'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
export default {
  components: {
    BSidebar,
    BFormDatepicker,
    BFormTimepicker,
    BForm,
    BMedia,
    BAvatar,
    BFormGroup,
    BFormInput,
    BFormInvalidFeedback,
    BButton, BFormFile,
    BFormCheckbox,
    vSelect,

    // Form Validation
    ValidationProvider,
    ValidationObserver,
  },
  directives: {
    Ripple,
  },
  model: {
    prop: "editData",
    event: "update:edit-data",
  },
  model: {
    prop: "isAddNewUserSidebarActive",
    event: "update:is-add-new-user-sidebar-active",
  },
  props: {
    isAddNewUserSidebarActive: {
      type: Boolean,
      required: true,
    },

    editData: {
      type: Object,
      required: false,
    },
    emailViewData: {
      type: Object,
      required: false,
    },
    roleOptions: {
      type: Array,
      required: true,
    },
    planOptions: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      required,
      question: '',
      base_url: 'http://phpstack-764354-2704405.cloudwaysapps.com/admin/',
      glsdata: [],
      lessondata: [],
      moduledata: [],
      alphaNum,
      email,
      countries,
      value1: '',
      result: 0
    };
  },
  watch: {

    // Creating function for
    // input component
    isAddNewUserSidebarActive: function (val) {
      if (val == true) {
        this.getModules(this.editData.gls_id);
        this.getLesson(this.editData.module_id);
      }
    },

    // Creating function for
    // result component
    result: function (val) {
      this.result = val;
    }
  },

  methods: {
    getGls() {
      store
        .dispatch('app-user/fetchDropdown', '/gls/search')
        .then(response => {
          this.glsdata = response.data.data
        })
    },
    getModules(val) {
      store
        .dispatch('app-user/fetchDropdown', '/module/search/' + val)
        .then(response => {
          this.moduledata = response.data.data
        })
    }, 
  },
  mounted() {
    this.getGls();
    this.getModules(this.editData.module_id); 
  }, 
  setup(props, { emit }) {
    const toast = useToast()
    const blankUserData = {
      title: "",
      id: "",
    };
    const moduledata = ref(null)
    const refInputEl = ref(null)
    const previewEl = ref(null)
    const { inputImageRenderer } = useInputImageRenderer(refInputEl, base64 => {
      // eslint-disable-next-line no-param-reassign
/*       props.editData.image = base64
      const file1 = refInputEl.value.files[0]
      props.editData.file_type = file1.type  */
    })

    watch(() => { 
      if (!props.isAddNewUserSidebarActive) {
        props.editData.id = '';
        props.editData.token_amount = '';  
      } 
    })
    const userData = ref(JSON.parse(JSON.stringify(blankUserData)));
    const resetuserData = () => {
      userData.value = JSON.parse(JSON.stringify(blankUserData));
    };


    const onSubmit = () => {
      store
        .dispatch("app-user/addUser", props.editData)
        .then((data) => {
          emit("refetch-data");
          emit("update:is-add-new-user-sidebar-active", false);
          toast({
            component: ToastificationContent,
            props: {
              title: data.data.message,
              icon: "CheckCircleIcon",
              variant: "success",
            },
          });
          refetchData();
        })
        .catch((error) => {
          console.log(error.response)
          var e = error.response.data.message;
          Object.keys(e).forEach((key) => {
            toast({
              component: ToastificationContent,
              props: {
                title: e[key][0],
                icon: "AlertTriangleIcon",
                variant: "danger",
              },
            });
          });
        });
    };

    const { refFormObserver, getValidationState, resetForm } =
      formValidation(resetuserData);

    return {
      userData,
      onSubmit,
      codeBasic,
      refFormObserver,
      getValidationState,
      resetForm,
      refInputEl,
      moduledata,
      previewEl,
      inputImageRenderer,

    };
  },
};
</script>

<style lang="scss">
@import "~@resources/scss/vue/libs/vue-select.scss";

#add-new-user-sidebar {
  .vs__dropdown-menu {
    max-height: 200px !important;
  }
}
</style>
